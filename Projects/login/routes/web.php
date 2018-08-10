<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Route::get('/', function () {
//     return view('welcome');
// });

//
// Route::get('/', 'PageController@homepage');
// Route::get('/institution', 'PageController@institution');
// Route::get('/services', 'PageController@services');
//
//
// Auth::routes();
//
//
// //Route::get('/homepage', 'PageController@homepage');
// Route::get('/index', 'PageController@index');
// Route::resource('posts','PostsController');

// Route::get('/','ContactMessageController@index');

  // Route::get('/','BursaryController@index');// controller for formtabs form

  // Route::get('contact-us', 'ContactUSController@contactUS');
  // Route::post('contact-us', ['as'=>'contactus.store','uses'=>'ContactUSController@contactUSPost']);

  // Route::get('/multiuploads', 'UploadController@uploadForm');
  // Route::post('/multiuploads', 'UploadController@uploadSubmit');

  // Route::get('/posts', 'PostController@index')->name('posts.index');
  // Route::get('/posts/details/{id}', 'PostController@details')->name('posts.details');
  // Route::get('/posts/add', 'PostController@add')->name('posts.add');
  // Route::post('/posts/insert', 'PostController@insert')->name('posts.insert');// fully functional posts
  // Route::get('/posts/edit/{id}', 'PostController@edit')->name('posts.edit');
  // Route::post('/posts/update/{id}', 'PostController@update')->name('posts.update');
  // Route::get('/posts/delete/{id}', 'PostController@delete')->name('posts.delete');


  Route::get('sendmail', 'SendMailController@sendMail');
  // Route::get('/', [
  //   'as' => 'home',
  //   'uses' => 'PagesController@home' ]);
  //
  // Route::resource('tasks', 'TasksController');

// Route::get('/contact','ContactMessageController@create');
// Route::post('/contact','ContactMessageController@store');
