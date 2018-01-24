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

Route::group(['prefix' => 'price-list' , 'middleware' => 'auth'], function () {

    Route::get('/', 'PriceList\WebController@index')->name('price_list')->middleware('read_access');
    Route::get('/show/{item_id}/{contact_id}', 'PriceList\WebController@show')->name('price_list_show')->middleware('read_access');
    Route::get('/create', 'PriceList\WebController@create')->name('price_list_create')->middleware('create_access');
    Route::post('/store', 'PriceList\WebController@store')->name('price_list_store')->middleware('create_access');
    Route::get('/edit/{id}', 'PriceList\WebController@edit')->name('price_list_edit')->middleware('read_access');
    Route::post('/update/{id}', 'PriceList\WebController@update')->name('price_list_update')->middleware('update_access');
    Route::get('/delete/{id}', 'PriceList\WebController@destroy')->name('price_list_delete')->middleware('delete_access');

});
