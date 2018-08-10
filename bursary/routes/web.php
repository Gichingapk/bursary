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



Route::get('/','BursaryController@index');
