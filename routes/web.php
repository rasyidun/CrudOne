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

Auth::routes();

Route::get('/home', 'HomeController@index'); //->name('home')

Route::get('/admin', function () {

	return view('admin.index');
});


Route::group(['middleware'=>'admin'], function() {

	Route::resource('admin/users', 'AdminUsersController');

	Route::resource('admin/post', 'AdminPostsController');

	Route::resource('admin/posts', 'AdminPostsController');

	Route::resource('admin/categories', 'AdminCategoriesController');

	Route::resource('admin/media', 'AdminMediaController');

  Route::resource('admin/charts', 'AdminChartsController');


	//Route::get ('admin/media/upload', ['as'=>'media.upload', 'uses'=>'AdminMediaController@store']); //to create custom method

	Route::post('/dropzone', 'AdminMediaController@store');

});

Route::get('auth/logout', 'Auth\LoginController@logout');
