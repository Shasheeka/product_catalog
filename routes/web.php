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

Route::get('/products', 'ProductController@ListProducts')->name('products');

Route::get('/products/upload', 'ProductController@upload')->name('upload');

Route::post('/products/upload', 'ProductController@store')->name('store');

Route::get('/products/create', 'ProductController@createSingleProduct')->name('createSingleProduct');

Route::post('/products/save', 'ProductController@saveProduct')->name('saveProduct');


Route::get('/products/edit/{id}', 'ProductController@editProduct')->name('editSingleProduct');


Route::resource('/product-request', 'ProductRequestController');

Route::get('/agent', 'HomeController@agent')->name('agent');

Route::get('/info', 'HomeController@info')->name('info');

Route::get('/about', 'HomeController@about')->name('about');

Route::get('/multimedia', 'HomeController@multimedia')->name('multimedia');

Route::get('/products/category/{id}', 'ProductController@ListProductsByCat')->name('ListProductsByCat');
