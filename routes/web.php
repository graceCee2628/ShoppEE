<?php

use Illuminate\Support\Facades\Route;

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



Route::get('/', 'HomeController@index')->name('welcome');
Auth::routes();

Route::group(['middleware' => ['auth','user']], function () {

	Route::get('/home', 'ProductController@index');
	Route::get('/shop/{id}/view', 'ProductController@shop_view');
	Route::post('/add-to-cart/{id}','ProductController@getAddToCart');
	Route::get('/add-cart','ProductController@my_cart');
	Route::get('/checkout', 'ProductController@checkOut');	
	Route::get('/shop/{id}/reduceItem', 'ProductController@getReduceByOne');
	Route::get('/shop/{id}/removeItem', 'ProductController@getRemoveItem');
	Route::get('/shop/pay', 'ProductController@payment');

	
});

Route::group(['middleware' => ['auth','admin']], function () {
	Route::post('save-product', 'AdminController@store');
	Route::post('update-product', 'AdminController@update');
	Route::post('delete-product/{id}', 'AdminController@delete');
	Route::get('admin', 'AdminController@show');
	Route::get('admin/{id}','AdminController@edit_data');
});















	    


