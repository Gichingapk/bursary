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

Route::get('/', function () {
    return view('welcome');
});

//auth::routes();
//Route::group(['middleware' => ['web']], function(){
Route::resource('post', 'PostController');
// Route::POST('addPost','PostController@addPost');
// Route::POST('deletePost','PostController@deletePost');
// Route::POST('editPost','PostController@editPost');
// });
