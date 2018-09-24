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

Route::get('/home', 'HomeController@index')->name('home');

/** Route Product, Customer, Sales Order with middleware Auth */
Route::group(['middleware' => 'auth'], function() {
    /** Customer */
    Route::post('/api/customer', 'CustomerController@store');
    Route::put('/api/customer/{id}', 'CustomerController@update');
    Route::get('/api/customer/{id}', 'CustomerController@show');
    Route::delete('/api/customer/{id}', 'CustomerController@destroy');
    Route::get('/api/customer', 'CustomerController@paginate');

    /** Product */
    Route::post('/api/product', 'ProductController@store');
    Route::put('/api/product/{id}', 'ProductController@update');
    Route::get('/api/product/{id}', 'ProductController@show');
    Route::get('/api/product', 'ProductController@paginate');
    Route::delete('/api/product/{id}', 'ProductController@destroy');

    /** Sales Order */
    Route::get('/api/sales-order', 'SalesOrderController@paginate');
    Route::post('/api/sales-order', 'SalesOrderController@store');

    /** Helpers */
    Route::get('/api/customers', 'HelperController@fetchCustomers');
    Route::get('/api/products', 'HelperController@fetchProducts');
});
