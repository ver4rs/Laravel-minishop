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




Auth::routes();

Route::get('/', 'HomeController@index')->name('home.index');

Route::prefix('admin')->middleware(['auth'])->group(function () {

	//	USER
	Route::get('users', 'UserController@index')->name('user.index')->middleware('can:isAdmin,App\User');
	Route::delete('users/{id}', 'UserController@destroy')->name('user.destroy')->middleware('can:isAdmin,App\User');;
	Route::get('users/{id}/edit', 'UserController@edit')->name('user.edit')->middleware('can:isAdmin,App\User');;
	Route::patch('users/{id}/edit', 'UserController@update')->name('user.update')->middleware('can:isAdmin,App\User');;


	Route::resource('product', 'ProductController');
//	Route::get('product', 'ProductController@index')->name('product.index');
//	Route::get('product/create', 'ProductController@create')->name('product.create');
//	Route::post('product', 'ProductController@store')->name('product.store');
//	Route::get('product/{id}/edit', 'ProductController@edit')->name('product.edit');
//	Route::patch('product/{id}', 'ProductController@update')->name('product.update');


});