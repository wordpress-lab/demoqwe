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

Route::group(['prefix' => 'payment-made', 'middleware' => 'auth'], function () {
    Route::get('/', 'PaymentMadeWebController@index')->name('payment_made')->middleware('read_access');
    Route::post('/', 'PaymentMadeWebController@search')->name('payment_made_search')->middleware('read_access');
    Route::get('create', 'PaymentMadeWebController@create')->name('payment_made_create')->middleware('create_access');
    Route::get('download/{id}', 'PaymentMadeWebController@download')->name('payment_made_download')->middleware('read_access');
    Route::post('store', 'PaymentMadeWebController@store')->name('payment_made_store')->middleware('create_access');
    Route::get('show/{id}', 'PaymentMadeWebController@show')->name('payment_made_show')->middleware('read_access');
    Route::post('show/{id}', 'PaymentMadeWebController@showupload')->name('payment_made_show_upload');
    Route::get('edit/{id}', 'PaymentMadeWebController@edit')->name('payment_made_edit')->middleware('update_access');
    Route::post('update/{id}', 'PaymentMadeWebController@update')->name('payment_made_update')->middleware('update_access');
    Route::get('delete/{id}', 'PaymentMadeWebController@destroy')->name('payment_made_delete')->middleware('delete_access');

    Route::get('delete-payment-made-entry/{id}', 'PaymentMadeWebController@deletePaymentMadeEntry')->name('payment_made_entry_delete')->middleware('delete_access');

});

Route::group(['prefix' => 'api/payment-made', 'middleware' => 'auth'], function () {

    Route::get('/get-vendor-list', 'PaymentMadeApiController@getVendorList')->middleware('auth');
    Route::get('/get-vendor-bill/{id}', 'PaymentMadeApiController@getVendorBill')->middleware('auth');
    Route::get('/get-vendor-bill-edit/{id}', 'PaymentMadeApiController@getVendorBillEdit')->middleware('auth');
    Route::get('/get-payment-made-entry/{id}', 'PaymentMadeApiController@getPaymentMadeEntry')->middleware('auth');
    Route::get('/get-paid-through-account', 'PaymentMadeApiController@getPaidThroughAccount')->middleware('auth');

});
