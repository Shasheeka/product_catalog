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

Route::get('/', 'ProductController@ListProducts')->name('products');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/products', 'ProductController@ListProducts')->name('products');

Route::get('/products/upload', 'ProductController@upload')->name('upload');

Route::post('/products/upload', 'ProductController@store')->name('store');

Route::resource('/product-request', 'ProductRequestController');

Route::get('/agent', 'HomeController@agent')->name('agent');

Route::get('/info', 'HomeController@info')->name('info');

Route::get('/about', 'HomeController@about')->name('about');

Route::get('/multimedia', 'HomeController@multimedia')->name('multimedia');
