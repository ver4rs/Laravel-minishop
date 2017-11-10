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

Route::get('/', 'HomeController@index')->name('home');

Route::prefix('admin')->middleware(['auth', 'can:isAdmin,App\User'])->group(function () {

	//	USER
	Route::get('users', 'UserController@index')->name('user.index');
	Route::delete('users/{id}', 'UserController@destroy')->name('user.destroy');
	Route::get('users/{id}/edit', 'UserController@edit')->name('user.edit');
	Route::patch('users/{id}/edit', 'UserController@update')->name('user.update');




});