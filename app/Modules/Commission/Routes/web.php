<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your module. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::group(['prefix' => 'Commission/Sales' , 'middleware' => 'auth'], function () {
    Route::get('/', 'Sales\PostController@index')->name('sales_commission')->middleware('read_access');
    Route::post('/', 'Sales\PostController@search')->name('sales_commission_search')->middleware('read_access');
    Route::get('/create/{id}', 'Sales\PostController@create')->name('sales_commission_create')->middleware('create_access');
    Route::get('/show/{id}', 'Sales\PostController@show')->name('sales_commission_show')->middleware('read_access');
    Route::get('/edit/{id}', 'Sales\PostController@edit')->name('sales_commission_edit')->middleware('read_access');
    Route::post('/update/{id}', 'Sales\PostController@update')->name('sales_commission_update')->middleware('update_access');
    Route::get('/delete/{id?}', 'Sales\PostController@destroy')->name('sales_commission_delete')->middleware('delete_access');
    Route::post('/store/{agents_id}', 'Sales\PostController@store')->name('sales_commission_store')->middleware('create_access');
    Route::get('/select/agent', 'Sales\PostController@agent')->name('sales_commission_agent')->middleware('read_access');
});


