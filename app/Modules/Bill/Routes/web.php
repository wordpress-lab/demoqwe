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

Route::group(['prefix' => 'bill' , 'middleware' => 'auth'], function () {
    Route::get('/', 'BillWebController@index')->name('bill')->middleware('read_access');
    Route::post('/', 'BillWebController@search')->name('bill_search')->middleware('read_access');
    Route::get('create', 'BillWebController@create')->name('bill_create')->middleware('create_access');
    Route::post('store', 'BillWebController@store')->name('bill_store')->middleware('create_access');
    Route::get('show/{id}', 'BillWebController@show')->name('bill_show')->middleware('read_access');
    Route::post('show/{id}', 'BillWebController@showupload')->name('bill_show_upload');
    Route::get('edit/{id}', 'BillWebController@edit')->name('bill_edit')->middleware('update_access');
    Route::post('update/{id}', 'BillWebController@update')->name('bill_update')->middleware('update_access');
    Route::get('mark/update/{id}', 'BillWebController@markupdate')->name('bill_update_mark')->middleware('update_access');
    Route::get('delete/{id}', 'BillWebController@destroy')->name('bill_delete')->middleware('delete_access');

    Route::post('use-bill-excess-payment', 'BillWebController@useExcessPayment')->name('post_bill_excess_payment')->middleware('auth');

    Route::get('/purchase-return/{id}' , 'PurchaseReturn\WebController@create')->name('purchase_return_index');
    Route::post('/purchase-return/update/{id}' , 'PurchaseReturn\WebController@update')->name('purchase_return_update');

});

Route::group(['prefix' => 'api/bill', 'middleware' => 'auth'], function () {

    Route::get('/get-item-rate/{id}', 'BillApiController@getItemRate')->middleware('auth');
    Route::get('/get-bill-entry/{id}', 'BillApiController@getBillEntry')->middleware('auth');
    Route::get('/get-due-balance/{id}', 'BillApiController@getDueBalance')->middleware('auth');

});
