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

Route::group(['prefix' => 'payment-received', 'middleware' => 'auth'], function () {

    Route::get('/', 'PaymentReceivedWebController@index')->name('payment_received')->middleware('read_access');
    Route::post('/', 'PaymentReceivedWebController@search')->name('payment_received_search')->middleware('read_access');
    Route::get('create', 'PaymentReceivedWebController@create')->name('payment_received_create')->middleware('create_access');
    Route::get('download/{id}', 'PaymentReceivedWebController@download')->name('payment_received_download')->middleware('read_access');
    Route::post('store', 'PaymentReceivedWebController@store')->name('payment_received_store')->middleware('create_access');
    Route::get('show/{id}', 'PaymentReceivedWebController@show')->name('payment_received_show')->middleware('read_access');
    Route::post('show/{id}', 'PaymentReceivedWebController@showupload')->name('payment_received_show_upload');
    Route::get('edit/{id}', 'PaymentReceivedWebController@edit')->name('payment_received_edit')->middleware('update_access');
    Route::post('update/{id}', 'PaymentReceivedWebController@update')->name('payment_received_update')->middleware('update_access');
    Route::get('delete/{id}', 'PaymentReceivedWebController@destroy')->name('payment_received_delete')->middleware('delete_access');
    
    Route::get('delete-payment-receive-entry/{id}', 'PaymentReceivedWebController@deletePaymentReceiveEntry')->name('payment_received_entry_delete')->middleware('delete_access');

    Route::get('paxid/autosuggest', 'PaymentReceivedWebController@autosuggest')->name('paxid_autosuggest');

});


Route::group(['prefix' => 'api/payment-receive', 'middleware' => 'auth'], function () {

    Route::get('/get-customer-list', 'PaymentReceivedApiController@getCustomerList')->middleware('auth');
    Route::get('/get-customer-invoice/{id}', 'PaymentReceivedApiController@getCustomerInvoice')->middleware('auth');
    Route::get('/get-customer-invoice-edit/{id}', 'PaymentReceivedApiController@getCustomerInvoiceEdit')->middleware('auth');
    Route::get('/get-payment-receive-entry/{id}', 'PaymentReceivedApiController@getPaymentReceiveEntry')->middleware('auth');
    Route::get('/get-paid-receive-account', 'PaymentReceivedApiController@getPaidReceiveAccount')->middleware('auth');

});

