/* This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at http://mozilla.org/MPL/2.0/. */

/* eslint-env mozilla/frame-script */

"use strict";

ChromeUtils.import("resource://gre/modules/XPCOMUtils.jsm", this);
ChromeUtils.import("resource://gre/modules/Timer.jsm", this);
ChromeUtils.import("resource://gre/modules/Services.jsm", this);

ChromeUtils.defineModuleGetter(this, "TelemetryStopwatch",
  "resource://gre/modules/TelemetryStopwatch.jsm");

function debug(msg) {
  Services.console.logStringMessage("SessionStoreContent: " + msg);
}

ChromeUtils.defineModuleGetter(this, "FormData",
  "resource://gre/modules/FormData.jsm");

ChromeUtils.defineModuleGetter(this, "DocShellCapabilities",
  "resource:///modules/sessionstore/DocShellCapabilities.jsm");
ChromeUtils.defineModuleGetter(this, "ScrollPosition",
  "resource://gre/modules/ScrollPosition.jsm");
ChromeUtils.defineModuleGetter(this, "SessionHistory",
  "resource://gre/modules/sessionstore/SessionHistory.jsm");
ChromeUtils.defineModuleGetter(this, "SessionStorage",
  "resource:///modules/sessionstore/SessionStorage.jsm");

ChromeUtils.import("resource:///modules/sessionstore/ContentRestore.jsm", this);
XPCOMUtils.defineLazyGetter(this, "gContentRestore",
                            () => { return new ContentRestore(this); });

ChromeUtils.defineModuleGetter(this, "Utils",
  "resource://gre/modules/sessionstore/Utils.jsm");
const ssu = Cc["@mozilla.org/browser/sessionstore/utils;1"]
              .getService(Ci.nsISessionStoreUtils);

// The current epoch.
var gCurrentEpoch = 0;

// A bound to the size of data to store for DOM Storage.
const DOM_STORAGE_LIMIT_PREF = "browser.sessionstore.dom_storage_limit";

// This pref controls whether or not we send updates to the parent on a timeout
// or not, and should only be used for tests or debugging.
const TIMEOUT_DISABLED_PREF = "browser.sessionstore.debug.no_auto_updates";

const PREF_INTERVAL = "browser.sessionstore.interval";

const kNoIndex = Number.MAX_SAFE_INTEGER;
const kLastIndex = Number.MAX_SAFE_INTEGER - 1;

// Grab our global so we can access it in functions below.
const global = this;

/**
 * A function that will recursively call |cb| to collect data for all
 * non-dynamic frames in the current frame/docShell tree.
 */
function mapFrameTree(callback) {
  let [data] = Utils.mapFrameTree(content, callback);
  return data;
}

/**
 * Listens for state change notifcations from webProgress and notifies each
 * registered observer for either the start of a page load, or its completion.
 */
var StateChangeNotifier = {

  init() {
    this._observers = new Set();
    let ifreq = docShell.QueryInterface(Ci.nsIInterfaceRequestor);
    let webProgress = ifreq.getInterface(Ci.nsIWebProgress);
    webProgress.addProgressListener(this, Ci.nsIWebProgress.NOTIFY_STATE_DOCUMENT);
  },

  /**
   * Adds a given observer |obs| to the set of observers that will be notified
   * when when a new document starts or finishes loading.
   *
   * @param obs (object)
   */
  addObserver(obs) {
    this._observers.add(obs);
  },

  /**
   * Notifies all observers that implement the given |method|.
   *
   * @param method (string)
   */
  notifyObservers(method) {
    for (let obs of this._observers) {
      if (obs.hasOwnProperty(method)) {
        obs[method]();
      }
    }
  },

  /**
   * @see nsIWebProgressListener.onStateChange
   */
  onStateChange(webProgress, request, stateFlags, status) {
    // Ignore state changes for subframes because we're only interested in the
    // top-document starting or stopping its load.
    if (!webProgress.isTopLevel || webProgress.DOMWindow != content) {
      return;
    }

    // onStateChange will be fired when loading the initial about:blank URI for
    // a browser, which we don't actually care about. This is particularly for
    // the case of unrestored background tabs, where the content has not yet
    // been restored: we don't want to accidentally send any updates to the
    // parent when the about:blank placeholder page has loaded.
    if (!docShell.hasLoadedNonBlankURI) {
      return;
    }

    if (stateFlags & Ci.nsIWebProgressListener.STATE_START) {
      this.notifyObservers("onPageLoadStarted");
    } else if (stateFlags & Ci.nsIWebProgressListener.STATE_STOP) {
      this.notifyObservers("onPageLoadCompleted");
    }
  },

  QueryInterface: ChromeUtils.generateQI([Ci.nsIWebProgressListener,
                                          Ci.nsISupportsWeakReference])
};

/**
 * Listens for and handles content events that we need for the
 * session store service to be notified of state changes in content.
 */
var EventListener = {

  init() {
    ssu.addDynamicFrameFilteredListener(global, "load", this, true);
  },

  handleEvent(event) {
    // Ignore load events from subframes.
    if (event.target != content.document) {
      return;
    }

    if (content.document.documentURI.startsWith("about:reader")) {
      if (event.type == "load" &&
          !content.document.body.classList.contains("loaded")) {
        // Don't restore the scroll position of an about:reader page at this
        // point; listen for the custom event dispatched from AboutReader.jsm.
        content.addEventListener("AboutReaderContentReady", this);
        return;
      }

      content.removeEventListener("AboutReaderContentReady", this);
    }

    // Restore the form data and scroll position. If we're not currently
    // restoring a tab state then this call will simply be a noop.
    gContentRestore.restoreDocument();
  }
};

/**
 * Listens for and handles messages sent by the session store service.
 */
var MessageListener = {

  MESSAGES: [
    "SessionStore:restoreHistory",
    "SessionStore:restoreTabContent",
    "SessionStore:resetRestore",
    "SessionStore:flush",
    "SessionStore:becomeActiveProcess",
  ],

  init() {
    this.MESSAGES.forEach(m => addMessageListener(m, this));
  },

  receiveMessage({name, data}) {
    // The docShell might be gone. Don't process messages,
    // that will just lead to errors anyway.
    if (!docShell) {
      return;
    }

    // A fresh tab always starts with epoch=0. The parent has the ability to
    // override that to signal a new era in this tab's life. This enables it
    // to ignore async messages that were already sent but not yet received
    // and would otherwise confuse the internal tab state.
    if (data.epoch && data.epoch != gCurrentEpoch) {
      gCurrentEpoch = data.epoch;
    }

    switch (name) {
      case "SessionStore:restoreHistory":
        this.restoreHistory(data);
        break;
      case "SessionStore:restoreTabContent":
        if (data.isRemotenessUpdate) {
          let histogram = Services.telemetry.getKeyedHistogramById("FX_TAB_REMOTE_NAVIGATION_DELAY_MS");
          histogram.add("SessionStore:restoreTabContent",
                        Services.telemetry.msSystemNow() - data.requestTime);
        }
        this.restoreTabContent(data);
        break;
      case "SessionStore:resetRestore":
        gContentRestore.resetRestore();
        break;
      case "SessionStore:flush":
        this.flush(data);
        break;
      case "SessionStore:becomeActiveProcess":
        SessionHistoryListener.collect();
        break;
      default:
        debug("received unknown message '" + name + "'");
        break;
    }
  },

  restoreHistory({epoch, tabData, loadArguments, isRemotenessUpdate}) {
    gContentRestore.restoreHistory(tabData, loadArguments, {
      // Note: The callbacks passed here will only be used when a load starts
      // that was not initiated by sessionstore itself. This can happen when
      // some code calls browser.loadURI() or browser.reload() on a pending
      // browser/tab.

      onLoadStarted() {
        // Notify the parent that the tab is no longer pending.
        sendAsyncMessage("SessionStore:restoreTabContentStarted", {epoch});
      },

      onLoadFinished() {
        // Tell SessionStore.jsm that it may want to restore some more tabs,
        // since it restores a max of MAX_CONCURRENT_TAB_RESTORES at a time.
        sendAsyncMessage("SessionStore:restoreTabContentComplete", {epoch});
      }
    });

    if (Services.appinfo.processType == Services.appinfo.PROCESS_TYPE_DEFAULT) {
      // For non-remote tabs, when restoreHistory finishes, we send a synchronous
      // message to SessionStore.jsm so that it can run SSTabRestoring. Users of
      // SSTabRestoring seem to get confused if chrome and content are out of
      // sync about the state of the restore (particularly regarding
      // docShell.currentURI). Using a synchronous message is the easiest way
      // to temporarily synchronize them.
      //
      // For remote tabs, because all nsIWebProgress notifications are sent
      // asynchronously using messages, we get the same-order guarantees of the
      // message manager, and can use an async message.
      sendSyncMessage("SessionStore:restoreHistoryComplete", {epoch, isRemotenessUpdate});
    } else {
      sendAsyncMessage("SessionStore:restoreHistoryComplete", {epoch, isRemotenessUpdate});
    }
  },

  restoreTabContent({loadArguments, isRemotenessUpdate, reason}) {
    let epoch = gCurrentEpoch;

    // We need to pass the value of didStartLoad back to SessionStore.jsm.
    let didStartLoad = gContentRestore.restoreTabContent(loadArguments, isRemotenessUpdate, () => {
      // Tell SessionStore.jsm that it may want to restore some more tabs,
      // since it restores a max of MAX_CONCURRENT_TAB_RESTORES at a time.
      sendAsyncMessage("SessionStore:restoreTabContentComplete", {epoch, isRemotenessUpdate});
    });

    sendAsyncMessage("SessionStore:restoreTabContentStarted", {
      epoch, isRemotenessUpdate, reason,
    });

    if (!didStartLoad) {
      // Pretend that the load succeeded so that event handlers fire correctly.
      sendAsyncMessage("SessionStore:restoreTabContentComplete", {epoch, isRemotenessUpdate});
    }
  },

  flush({id}) {
    // Flush the message queue, send the latest updates.
    MessageQueue.send({flushID: id});
  }
};

/**
 * Listens for changes to the session history. Whenever the user navigates
 * we will collect URLs and everything belonging to session history.
 *
 * Causes a SessionStore:update message to be sent that contains the current
 * session history.
 *
 * Example:
 *   {entries: [{url: "about:mozilla", ...}, ...], index: 1}
 */
var SessionHistoryListener = {
  init() {
    // The state change observer is needed to handle initial subframe loads.
    // It will redundantly invalidate with the SHistoryListener in some cases
    // but these invalidations are very cheap.
    StateChangeNotifier.addObserver(this);

    // By adding the SHistoryListener immediately, we will unfortunately be
    // notified of every history entry as the tab is restored. We don't bother
    // waiting to add the listener later because these notifications are cheap.
    // We will likely only collect once since we are batching collection on
    // a delay.
    docShell.QueryInterface(Ci.nsIWebNavigation).
      sessionHistory.legacySHistory.addSHistoryListener(this);

    // Collect data if we start with a non-empty shistory.
    if (!SessionHistory.isEmpty(docShell)) {
      this.collect();
      // When a tab is detached from the window, for the new window there is a
      // new SessionHistoryListener created. Normally it is empty at this point
      // but in a test env. the initial about:blank might have a children in which
      // case we fire off a history message here with about:blank in it. If we
      // don't do it ASAP then there is going to be a browser swap and the parent
      // will be all confused by that message.
      MessageQueue.send();
    }

    // Listen for page title changes.
    addEventListener("DOMTitleChanged", this);
  },

  uninit() {
    let sessionHistory = docShell.QueryInterface(Ci.nsIWebNavigation).sessionHistory;
    if (sessionHistory) {
      sessionHistory.legacySHistory.removeSHistoryListener(this);
    }
  },

  collect() {
    // We want to send down a historychange even for full collects in case our
    // session history is a partial session history, in which case we don't have
    // enough information for a full update. collectFrom(-1) tells the collect
    // function to collect all data avaliable in this process.
    if (docShell) {
      this.collectFrom(-1);
    }
  },

  _fromIdx: kNoIndex,

  // History can grow relatively big with the nested elements, so if we don't have to, we
  // don't want to send the entire history all the time. For a simple optimization
  // we keep track of the smallest index from after any change has occured and we just send
  // the elements from that index. If something more complicated happens we just clear it
  // and send the entire history. We always send the additional info like the current selected
  // index (so for going back and forth between history entries we set the index to kLastIndex
  // if nothing else changed send an empty array and the additonal info like the selected index)
  collectFrom(idx) {
    if (this._fromIdx <= idx) {
      // If we already know that we need to update history fromn index N we can ignore any changes
      // tha happened with an element with index larger than N.
      // Note: initially we use kNoIndex which is MAX_SAFE_INTEGER which means we don't ignore anything
      // here, and in case of navigation in the history back and forth we use kLastIndex which ignores
      // only the subsequent navigations, but not any new elements added.
      return;
    }

    this._fromIdx = idx;
    MessageQueue.push("historychange", () => {
      if (this._fromIdx === kNoIndex) {
        return null;
      }

      let history = SessionHistory.collect(docShell, this._fromIdx);
      this._fromIdx = kNoIndex;
      return history;
    });
  },

  handleEvent(event) {
    this.collect();
  },

  onPageLoadCompleted() {
    this.collect();
  },

  onPageLoadStarted() {
    this.collect();
  },

  OnHistoryNewEntry(newURI, oldIndex) {
    // We ought to collect the previously current entry as well, see bug 1350567.
    this.collectFrom(oldIndex);
  },

  OnHistoryGoBack(backURI) {
    // We ought to collect the previously current entry as well, see bug 1350567.
    this.collectFrom(kLastIndex);
    return true;
  },

  OnHistoryGoForward(forwardURI) {
    // We ought to collect the previously current entry as well, see bug 1350567.
    this.collectFrom(kLastIndex);
    return true;
  },

  OnHistoryGotoIndex(index, gotoURI) {
    // We ought to collect the previously current entry as well, see bug 1350567.
    this.collectFrom(kLastIndex);
    return true;
  },

  OnHistoryPurge(numEntries) {
    this.collect();
    return true;
  },

  OnHistoryReload(reloadURI, reloadFlags) {
    this.collect();
    return true;
  },

  OnHistoryReplaceEntry(index) {
    this.collect();
  },

  OnLengthChanged(aCount) {
    // Ignore, the method is implemented so that XPConnect doesn't throw!
  },

  OnIndexChanged(aIndex) {
    // Ignore, the method is implemented so that XPConnect doesn't throw!
  },

  QueryInterface: ChromeUtils.generateQI([
    Ci.nsISHistoryListener,
    Ci.nsISupportsWeakReference
  ])
};

/**
 * Listens for scroll position changes. Whenever the user scrolls the top-most
 * frame we update the scroll position and will restore it when requested.
 *
 * Causes a SessionStore:update message to be sent that contains the current
 * scroll positions as a tree of strings. If no frame of the whole frame tree
 * is scrolled this will return null so that we don't tack a property onto
 * the tabData object in the parent process.
 *
 * Example:
 *   {scroll: "100,100", children: [null, null, {scroll: "200,200"}]}
 */
var ScrollPositionListener = {
  init() {
    ssu.addDynamicFrameFilteredListener(global, "scroll", this, false);
    StateChangeNotifier.addObserver(this);
  },

  handleEvent() {
    MessageQueue.push("scroll", () => this.collect());
  },

  onPageLoadCompleted() {
    MessageQueue.push("scroll", () => this.collect());
  },

  onPageLoadStarted() {
    MessageQueue.push("scroll", () => null);
  },

  collect() {
    return mapFrameTree(ScrollPosition.collect);
  }
};

/**
 * Listens for changes to input elements. Whenever the value of an input
 * element changes we will re-collect data for the current frame tree and send
 * a message to the parent process.
 *
 * Causes a SessionStore:update message to be sent that contains the form data
 * for all reachable frames.
 *
 * Example:
 *   {
 *     formdata: {url: "http://mozilla.org/", id: {input_id: "input value"}},
 *     children: [
 *       null,
 *       {url: "http://sub.mozilla.org/", id: {input_id: "input value 2"}}
 *     ]
 *   }
 */
var FormDataListener = {
  init() {
    ssu.addDynamicFrameFilteredListener(global, "input", this, true);
    StateChangeNotifier.addObserver(this);
  },

  handleEvent() {
    MessageQueue.push("formdata", () => this.collect());
  },

  onPageLoadStarted() {
    MessageQueue.push("formdata", () => null);
  },

  collect() {
    return mapFrameTree(FormData.collect);
  }
};

/**
 * Listens for changes to docShell capabilities. Whenever a new load is started
 * we need to re-check the list of capabilities and send message when it has
 * changed.
 *
 * Causes a SessionStore:update message to be sent that contains the currently
 * disabled docShell capabilities (all nsIDocShell.allow* properties set to
 * false) as a string - i.e. capability names separate by commas.
 */
var DocShellCapabilitiesListener = {
  /**
   * This field is used to compare the last docShell capabilities to the ones
   * that have just been collected. If nothing changed we won't send a message.
   */
  _latestCapabilities: "",

  init() {
    StateChangeNotifier.addObserver(this);
  },

  onPageLoadStarted() {
    // The order of docShell capabilities cannot change while we're running
    // so calling join() without sorting before is totally sufficient.
    let caps = DocShellCapabilities.collect(docShell).join(",");

    // Send new data only when the capability list changes.
    if (caps != this._latestCapabilities) {
      this._latestCapabilities = caps;
      MessageQueue.push("disallow", () => caps || null);
    }
  }
};

/**
 * Listens for changes to the DOMSessionStorage. Whenever new keys are added,
 * existing ones removed or changed, or the storage is cleared we will send a
 * message to the parent process containing up-to-date sessionStorage data.
 *
 * Causes a SessionStore:update message to be sent that contains the current
 * DOMSessionStorage contents. The data is a nested object using host names
 * as keys and per-host DOMSessionStorage data as values.
 */
var SessionStorageListener = {
  init() {
    Services.obs.addObserver(this, "browser:purge-domain-data");
    StateChangeNotifier.addObserver(this);
    this.resetEventListener();
  },

  uninit() {
    Services.obs.removeObserver(this, "browser:purge-domain-data");
  },

  observe() {
    // Collect data on the next tick so that any other observer
    // that needs to purge data can do its work first.
    setTimeoutWithTarget(() => this.collect(), 0, tabEventTarget);
  },

  // We don't want to send all the session storage data for all the frames
  // for every change. So if only a few value changed we send them over as
  // a "storagechange" event. If however for some reason before we send these
  // changes we have to send over the entire sessions storage data, we just
  // reset these changes.
  _changes: undefined,

  resetChanges() {
    this._changes = undefined;
  },

  // The event listener waiting for MozSessionStorageChanged events.
  _listener: null,

  resetEventListener() {
    if (!this._listener) {
      this._listener =
        ssu.addDynamicFrameFilteredListener(global, "MozSessionStorageChanged",
                                            this, true);
    }
  },

  removeEventListener() {
    ssu.removeDynamicFrameFilteredListener(global, "MozSessionStorageChanged",
                                           this._listener, true);
    this._listener = null;
  },

  handleEvent(event) {
    if (!docShell) {
      return;
    }

    // How much data does DOMSessionStorage contain?
    let usage = content.QueryInterface(Ci.nsIInterfaceRequestor)
                       .getInterface(Ci.nsIDOMWindowUtils)
                       .getStorageUsage(event.storageArea);

    // Don't store any data if we exceed the limit. Wipe any data we previously
    // collected so that we don't confuse websites with partial state.
    if (usage > Services.prefs.getIntPref(DOM_STORAGE_LIMIT_PREF)) {
      MessageQueue.push("storage", () => null);
      this.removeEventListener();
      this.resetChanges();
      return;
    }

    let {url, key, newValue} = event;
    let uri = Services.io.newURI(url);
    let domain = uri.prePath;
    if (!this._changes) {
      this._changes = {};
    }
    if (!this._changes[domain]) {
      this._changes[domain] = {};
    }
    this._changes[domain][key] = newValue;

    MessageQueue.push("storagechange", () => {
      let tmp = this._changes;
      // If there were multiple changes we send them merged.
      // First one will collect all the changes the rest of
      // these messages will be ignored.
      this.resetChanges();
      return tmp;
    });
  },

  collect() {
    if (!docShell) {
      return;
    }

    // We need the entire session storage, let's reset the pending individual change
    // messages.
    this.resetChanges();

    MessageQueue.push("storage", () => SessionStorage.collect(content));
  },

  onPageLoadCompleted() {
    this.collect();
  },

  onPageLoadStarted() {
    this.resetEventListener();
    this.collect();
  }
};

/**
 * Listen for changes to the privacy status of the tab.
 * By definition, tabs start in non-private mode.
 *
 * Causes a SessionStore:update message to be sent for
 * field "isPrivate". This message contains
 *  |true| if the tab is now private
 *  |null| if the tab is now public - the field is therefore
 *  not saved.
 */
var PrivacyListener = {
  init() {
    docShell.addWeakPrivacyTransitionObserver(this);

    // Check that value at startup as it might have
    // been set before the frame script was loaded.
    if (docShell.QueryInterface(Ci.nsILoadContext).usePrivateBrowsing) {
      MessageQueue.push("isPrivate", () => true);
    }
  },

  // Ci.nsIPrivacyTransitionObserver
  privateModeChanged(enabled) {
    MessageQueue.push("isPrivate", () => enabled || null);
  },

  QueryInterface: ChromeUtils.generateQI([Ci.nsIPrivacyTransitionObserver,
                                          Ci.nsISupportsWeakReference])
};

/**
 * A message queue that takes collected data and will take care of sending it
 * to the chrome process. It allows flushing using synchronous messages and
 * takes care of any race conditions that might occur because of that. Changes
 * will be batched if they're pushed in quick succession to avoid a message
 * flood.
 */
var MessageQueue = {
  /**
   * A map (string -> lazy fn) holding lazy closures of all queued data
   * collection routines. These functions will return data collected from the
   * docShell.
   */
  _data: new Map(),

  /**
   * The delay (in ms) used to delay sending changes after data has been
   * invalidated.
   */
  BATCH_DELAY_MS: 1000,

  /**
   * The minimum idle period (in ms) we need for sending data to chrome process.
   */
  NEEDED_IDLE_PERIOD_MS: 5,

  /**
   * Timeout for waiting an idle period to send data. We will set this from
   * the pref "browser.sessionstore.interval".
   */
  _timeoutWaitIdlePeriodMs: null,

  /**
   * The current timeout ID, null if there is no queue data. We use timeouts
   * to damp a flood of data changes and send lots of changes as one batch.
   */
  _timeout: null,

  /**
   * Whether or not sending batched messages on a timer is disabled. This should
   * only be used for debugging or testing. If you need to access this value,
   * you should probably use the timeoutDisabled getter.
   */
  _timeoutDisabled: false,

  /**
   * The idle callback ID referencing an active idle callback. When no idle
   * callback is pending, this is null.
   * */
  _idleCallbackID: null,

  /**
   * True if batched messages are not being fired on a timer. This should only
   * ever be true when debugging or during tests.
   */
  get timeoutDisabled() {
    return this._timeoutDisabled;
  },

  /**
   * Disables sending batched messages on a timer. Also cancels any pending
   * timers.
   */
  set timeoutDisabled(val) {
    this._timeoutDisabled = val;

    if (val && this._timeout) {
      clearTimeout(this._timeout);
      this._timeout = null;
    }

    return val;
  },

  init() {
    this.timeoutDisabled =
      Services.prefs.getBoolPref(TIMEOUT_DISABLED_PREF);
    this._timeoutWaitIdlePeriodMs =
      Services.prefs.getIntPref(PREF_INTERVAL);

    Services.prefs.addObserver(TIMEOUT_DISABLED_PREF, this);
    Services.prefs.addObserver(PREF_INTERVAL, this);
  },

  uninit() {
    Services.prefs.removeObserver(TIMEOUT_DISABLED_PREF, this);
    Services.prefs.removeObserver(PREF_INTERVAL, this);
    this.cleanupTimers();
  },

  /**
   * Cleanup pending idle callback and timer.
   */
  cleanupTimers() {
    if (this._idleCallbackID) {
      content.cancelIdleCallback(this._idleCallbackID);
      this._idleCallbackID = null;
    }
    if (this._timeout) {
      clearTimeout(this._timeout);
      this._timeout = null;
    }
  },

  observe(subject, topic, data) {
    if (topic == "nsPref:changed") {
      switch (data) {
        case TIMEOUT_DISABLED_PREF:
          this.timeoutDisabled =
            Services.prefs.getBoolPref(TIMEOUT_DISABLED_PREF);
          break;
        case PREF_INTERVAL:
          this._timeoutWaitIdlePeriodMs =
            Services.prefs.getIntPref(PREF_INTERVAL);
          break;
        default:
          debug("received unknown message '" + data + "'");
          break;
      }
    }
  },

  /**
   * Pushes a given |value| onto the queue. The given |key| represents the type
   * of data that is stored and can override data that has been queued before
   * but has not been sent to the parent process, yet.
   *
   * @param key (string)
   *        A unique identifier specific to the type of data this is passed.
   * @param fn (function)
   *        A function that returns the value that will be sent to the parent
   *        process.
   */
  push(key, fn) {
    this._data.set(key, fn);

    if (!this._timeout && !this._timeoutDisabled) {
      // Wait a little before sending the message to batch multiple changes.
      this._timeout = setTimeoutWithTarget(
        () => this.sendWhenIdle(), this.BATCH_DELAY_MS, tabEventTarget);
    }
  },

  /**
   * Sends queued data when the remaining idle time is enough or waiting too
   * long; otherwise, request an idle time again. If the |deadline| is not
   * given, this function is going to schedule the first request.
   *
   * @param deadline (object)
   *        An IdleDeadline object passed by requestIdleCallback().
   */
  sendWhenIdle(deadline) {
    if (!content) {
      // The frameloader is being torn down. Nothing more to do.
      return;
    }

    if (deadline) {
      if (deadline.didTimeout || deadline.timeRemaining() > MessageQueue.NEEDED_IDLE_PERIOD_MS) {
        MessageQueue.send();
        return;
      }
    } else if (MessageQueue._idleCallbackID) {
      // Bail out if there's a pending run.
      return;
    }
    MessageQueue._idleCallbackID =
      content.requestIdleCallback(MessageQueue.sendWhenIdle, {timeout: MessageQueue._timeoutWaitIdlePeriodMs});
   },

  /**
   * Sends queued data to the chrome process.
   *
   * @param options (object)
   *        {flushID: 123} to specify that this is a flush
   *        {isFinal: true} to signal this is the final message sent on unload
   */
  send(options = {}) {
    // Looks like we have been called off a timeout after the tab has been
    // closed. The docShell is gone now and we can just return here as there
    // is nothing to do.
    if (!docShell) {
      return;
    }

    this.cleanupTimers();

    let flushID = (options && options.flushID) || 0;
    let histID = "FX_SESSION_RESTORE_CONTENT_COLLECT_DATA_MS";

    let data = {};
    for (let [key, func] of this._data) {
      if (key != "isPrivate") {
        TelemetryStopwatch.startKeyed(histID, key);
      }

      let value = func();

      if (key != "isPrivate") {
        TelemetryStopwatch.finishKeyed(histID, key);
      }

      if (value || (key != "storagechange" && key != "historychange")) {
        data[key] = value;
      }
    }

    this._data.clear();

    try {
      // Send all data to the parent process.
      sendAsyncMessage("SessionStore:update", {
        data, flushID,
        isFinal: options.isFinal || false,
        epoch: gCurrentEpoch
      });
    } catch (ex) {
      if (ex && ex.result == Cr.NS_ERROR_OUT_OF_MEMORY) {
        Services.telemetry.getHistogramById("FX_SESSION_RESTORE_SEND_UPDATE_CAUSED_OOM").add(1);
        sendAsyncMessage("SessionStore:error");
      }
    }
  },
};

StateChangeNotifier.init();
EventListener.init();
MessageListener.init();
FormDataListener.init();
SessionHistoryListener.init();
SessionStorageListener.init();
ScrollPositionListener.init();
DocShellCapabilitiesListener.init();
PrivacyListener.init();
MessageQueue.init();

function handleRevivedTab() {
  if (!content) {
    removeEventListener("pagehide", handleRevivedTab);
    return;
  }

  if (content.document.documentURI.startsWith("about:tabcrashed")) {
    if (Services.appinfo.processType != Services.appinfo.PROCESS_TYPE_DEFAULT) {
      // Sanity check - we'd better be loading this in a non-remote browser.
      throw new Error("We seem to be navigating away from about:tabcrashed in " +
                      "a non-remote browser. This should really never happen.");
    }

    removeEventListener("pagehide", handleRevivedTab);

    // Notify the parent.
    sendAsyncMessage("SessionStore:crashedTabRevived");
  }
}

// If we're browsing from the tab crashed UI to a blacklisted URI that keeps
// this browser non-remote, we'll handle that in a pagehide event.
addEventListener("pagehide", handleRevivedTab);

addEventListener("unload", () => {
  // Upon frameLoader destruction, send a final update message to
  // the parent and flush all data currently held in the child.
  MessageQueue.send({isFinal: true});

  // If we're browsing from the tab crashed UI to a URI that causes the tab
  // to go remote again, we catch this in the unload event handler, because
  // swapping out the non-remote browser for a remote one in
  // tabbrowser.xml's updateBrowserRemoteness doesn't cause the pagehide
  // event to be fired.
  handleRevivedTab();

  // Remove all registered nsIObservers.
  SessionStorageListener.uninit();
  SessionHistoryListener.uninit();
  MessageQueue.uninit();

  // Remove progress listeners.
  gContentRestore.resetRestore();

  // We don't need to take care of any StateChangeNotifier observers as they
  // will die with the content script. The same goes for the privacy transition
  // observer that will die with the docShell when the tab is closed.
});
