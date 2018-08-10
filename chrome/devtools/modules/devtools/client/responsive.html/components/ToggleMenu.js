/* This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at http://mozilla.org/MPL/2.0/. */

"use strict";

const { PureComponent } = require("devtools/client/shared/vendor/react");
const PropTypes = require("devtools/client/shared/vendor/react-prop-types");
const dom = require("devtools/client/shared/vendor/react-dom-factories");

let MenuItem = {
  id: PropTypes.string.isRequired,
  label: PropTypes.string.isRequired,
  checked: PropTypes.bool,
};

class ToggleMenu extends PureComponent {
  static get propTypes() {
    return {
      id: PropTypes.string,
      items: PropTypes.arrayOf(PropTypes.shape(MenuItem)).isRequired,
      label: PropTypes.string,
      title: PropTypes.string,
      onChange: PropTypes.func.isRequired,
    };
  }

  constructor(props) {
    super(props);

    this.state = {
      isOpen: false,
    };

    this.onItemChange = this.onItemChange.bind(this);
    this.onToggleOpen = this.onToggleOpen.bind(this);
  }

  onItemChange({ target }) {
    let {
      onChange,
    } = this.props;

    // Close menu after changing an item
    this.setState({
      isOpen: false,
    });

    let id = target.name;
    onChange(id, target.checked);
  }

  onToggleOpen() {
    let {
      isOpen,
    } = this.state;

    this.setState({
      isOpen: !isOpen,
    });
  }

  render() {
    let {
      id: menuID,
      items,
      label: toggleLabel,
      title,
    } = this.props;

    let {
      isOpen,
    } = this.state;

    let {
      onItemChange,
      onToggleOpen,
    } = this;

    let menuItems = items.map(({ id, label, checked }) => {
      let inputID = `devtools-menu-item-${id}`;

      return dom.div(
        {
          className: "devtools-menu-item",
          key: id,
        },
        dom.input({
          type: "checkbox",
          id: inputID,
          name: id,
          checked,
          onChange: onItemChange,
        }),
        dom.label({
          htmlFor: inputID,
        }, label)
      );
    });

    let menuClass = "devtools-menu";
    if (isOpen) {
      menuClass += " opened";
    }
    let menu = dom.div(
      {
        className: menuClass,
      },
      menuItems
    );

    let buttonClass = "devtools-toggle-menu";
    buttonClass += " toolbar-dropdown toolbar-button devtools-button";
    if (isOpen || items.some(({ checked }) => checked)) {
      buttonClass += " selected";
    }
    return dom.div(
      {
        id: menuID,
        className: buttonClass,
        title,
        onClick: onToggleOpen,
      },
      toggleLabel,
      menu
    );
  }
}

module.exports = ToggleMenu;
