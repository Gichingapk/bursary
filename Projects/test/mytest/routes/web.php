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
// return view('welcome');
// });
// Route::resource('post', 'PostController');
// Auth::routes();

Route::group(['middleware' => ['web']], function(){
Route::resource('post', 'PostController');
Route::POST('addPost','PostController@addPost');
Route::POST('editPost','PostController@editPost');
Route::POST('deletePost','PostController@deletePost');
});

// Route::get('/home', 'HomeController@index')->name('home');
// // Route::get('/main','MainController@index');
// Route::get('main/checklogin','MainController@checklogin');
// Route::get('main/successlogin','MainController@successlogin');
// Route::get('main/logout','MainController@logout');
