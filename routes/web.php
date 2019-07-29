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



Route::get('/', 'HomeController@index')->name('home');
Route::get('/home/{id}', 'HomeController@homeShow')->name('homeShow');

// Route::get('/show', 'HomeController@show')->name('home_show');
// Route::get('/list/show', 'HomeController@ListShow')->name('show');



Auth::routes();
Route::put('/mylist/{id}/save-privacy', 'ListsController@privacy')->name('privacy.save');
Route::resource('/mylist', 'ListsController');

Route::get('/items/search', 'ItemController@search')->name('item.search');
Route::post('/items/search', 'ItemController@store')->name('item.search');





