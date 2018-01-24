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

Route::group(['prefix' => 'stock-management', 'middleware' => 'auth'], function () {
    
    //Stock Management Routes
    Route::get('/', 'StockManagementWebController@index')->name('stock')->middleware('read_access');
    Route::get('/create', 'StockManagementWebController@create')->name('stock_create')->middleware('create_access');
    Route::post('/store', 'StockManagementWebController@store')->name('stock_store')->middleware('create_access');
    Route::get('/show/{id}', 'StockManagementWebController@show')->name('stock_show')->middleware('read_access');
    Route::get('/edit/{id}', 'StockManagementWebController@edit')->name('stock_edit')->middleware('update_access');
    Route::post('/update/{id}', 'StockManagementWebController@update')->name('stock_update')->middleware('update_access');
    Route::get('/delete/{id}', 'StockManagementWebController@destroy')->name('stock_delete')->middleware('delete_access');
    
    
    

    // stock history
    Route::get('/history/{id}', 'StockManagementHistoryWebController@index')->name('stock_history')->middleware('read_access');
    Route::get('/history/create/{id}', 'StockManagementHistoryWebController@create')->name('stock_history_create')->middleware('create_access');

    
    Route::post('/history/store/{id}', 'StockManagementHistoryWebController@store')->name('stock_history_store')->middleware('create_access');
    // Route::post('/history/edit/{id}', 'StockManagementHistoryWebController@edit')->name('stock_history_edit')->middleware('auth');
    Route::get('/history/{item}/delete/{id}', 'StockManagementHistoryWebController@destroy')->name('stock_history_delete')->middleware('delete_access');

});
