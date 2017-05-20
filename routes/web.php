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

Route::get('/admin', function () {
    return view('admin.index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group([
  'middleware' => ['admin'],
  'prefix' => '/admin',
], function() {

    Route::resource('/users', 'AdminUsersController', ['as' => 'admin']);
    Route::resource('/posts', 'AdminPostsController', ['as' => 'admin']);
    Route::resource('/categories', 'AdminCategoriesController', ['as' => 'admin']);

});
