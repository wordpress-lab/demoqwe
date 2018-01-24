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

Route::group(['prefix' => 'estimate' , 'middleware' => 'auth'], function () {
    Route::get('/', 'EstimateWebController@index')->name('estimate')->middleware('read_access');
    Route::post('/', 'EstimateWebController@search')->name('estimate_search')->middleware('read_access');
    Route::get('/create', 'EstimateWebController@create')->name('estimate_create')->middleware('create_access');
    Route::post('/store', 'EstimateWebController@store')->name('estimate_store')->middleware('create_access');
    Route::get('/show/{id}', 'EstimateWebController@show')->name('estimate_show')->middleware('read_access');
    Route::get('/edit/{id}', 'EstimateWebController@edit')->name('estimate_edit')->middleware('read_access');
    Route::post('/update/{id}', 'EstimateWebController@update')->name('estimate_update')->middleware('update_access');
    Route::get('/delete/{id}', 'EstimateWebController@destroy')->name('estimate_destroy')->middleware('delete_access');
    Route::get('/pdf/{id}', 'EstimateWebController@pdf')->name('estimate_pdf')->middleware('read_access');
    Route::get('/print/{id}', 'EstimateWebController@Toprint')->name('estimate_print')->middleware('read_access');
    Route::get('/entry/terms', 'EstimateEntryWebController@terms')->name('estimateentry_pdf')->middleware('read_access');
    Route::get('/convert/to/invoice/{id}', 'EstimateWebController@invoice')->name('estimateentry_invoice')->middleware('create_access');
    Route::post('/convert/to/invoice/{id}', 'EstimateWebController@invoice_store')->name('estimateentry_invoice_store')->middleware('create_access');
});

Route::group(['prefix' => 'api/estimate', 'middleware' => 'auth'], function () {

    Route::get('/get-item-rate/{id}', 'EstimateApiController@getItemRate')->middleware('auth');
    Route::get('/get-invoice-entry/{id}', 'EstimateApiController@getInvoiceEntry')->middleware('auth');
    Route::get('/get-due-balance/{id}', 'EstimateApiController@getDueBalance')->middleware('auth');
    Route::get('/get-credit-available/{invoice_id}/{credit_note_id}', 'EstimateApiController@creditAvailable')->middleware('auth');

});
