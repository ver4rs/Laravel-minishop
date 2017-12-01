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

Route::get('product/{id}', 'ProductController@show')->name('product.show')->where('id', '[0-9]+');

Route::middleware(['auth'])->group(function () {
	Route::get('shopping', 'CartController@index')->name('shopping.index'); // show shopping list
	Route::post('shopping', 'CartController@store')->name('shopping.store'); // save item to shopping basket
	Route::patch('shopping/{id}/update', 'CartController@update')->name('shopping.update'); // update item in shopping basket
	Route::delete('shopping/{id}/delete', 'CartController@destroy')->name('shopping.destroy'); // delete item in shopping basket

	Route::get('product/{id}/image/{image}', 'ProductController@destroyImage')->name('product.destroyImage');
	Route::post('product/restore', 'ProductController@restoreProduct')->name('product.restoreProduct');
	Route::resource('product', 'ProductController');

	Route::get('checkout', 'OrderController@checkout')->name('order.checkout');
	Route::post('checkout', 'OrderController@createOrder')->name('order.store');
	Route::get('order', 'OrderController@index')->name('order.index');
	Route::get('order/show/{id}', 'OrderController@show')->name('order.show');
	Route::post('order/changeStatus', 'OrderController@changeStatus')->name('order.changeStatus')->middleware('can:isAdmin,App\User');
});

Route::prefix('admin')->middleware(['auth'])->group(function () {

	//	USER
	Route::get('users', 'UserController@index')->name('user.index')->middleware('can:isAdmin,App\User');
	Route::delete('users/{id}', 'UserController@destroy')->name('user.destroy')->middleware('can:isAdmin,App\User');;
	Route::get('users/{id}/edit', 'UserController@edit')->name('user.edit')->middleware('can:isAdmin,App\User');;
	Route::patch('users/{id}/edit', 'UserController@update')->name('user.update')->middleware('can:isAdmin,App\User');;
});