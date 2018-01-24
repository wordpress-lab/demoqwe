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

Route::group(['prefix' => 'credit-note', 'middleware' => 'auth'], function () {

    Route::get('/', 'CreditNoteWebController@index')->name('credit_note');
    Route::post('/', 'CreditNoteWebController@search')->name('credit_note_search');
    Route::get('create', 'CreditNoteWebController@create')->name('credit_note_create')->middleware('create_access');
    Route::post('store', 'CreditNoteWebController@store')->name('credit_note_store')->middleware('create_access');
    Route::get('show/{id}', 'CreditNoteWebController@show')->name('credit_note_show')->middleware('read_access');
    Route::post('show/{id}', 'CreditNoteWebController@showupload')->name('credit_note_show_upload');
    Route::get('edit/{id}', 'CreditNoteWebController@edit')->name('credit_note_edit')->middleware('update_access');
    Route::post('update/{id}', 'CreditNoteWebController@update')->name('credit_note_update')->middleware('update_access');
    Route::get('delete/{id}', 'CreditNoteWebController@destroy')->name('credit_note_delete')->middleware('delete_access');

});

Route::get('invoice/{id}/create-credit', 'InvoiceToCreditNoteController@createCreditNote')->middleware('read_access');
Route::post('invoice/{id}/create-credit', 'InvoiceToCreditNoteController@storeCreditNote')->name('store_invoice_to_credit_note')->middleware('read_access');

Route::group(['prefix' => 'credit-note/refund', 'middleware' => 'auth'], function () {

    Route::get('/', 'CreditNoteRefundWebController@index')->name('credit_note_refund')->middleware('read_access');
    Route::get('create/{id}', 'CreditNoteRefundWebController@create')->name('credit_note_refund_create')->middleware('create_access');
    Route::post('store', 'CreditNoteRefundWebController@store')->name('credit_note_refund_store')->middleware('create_access');
    Route::get('show/{id}', 'CreditNoteRefundWebController@show')->name('credit_note_refund_show')->middleware('read_access');
    Route::get('edit/{id}', 'CreditNoteRefundWebController@edit')->name('credit_note_refund_edit')->middleware('update_access');
    Route::post('update/{id}', 'CreditNoteRefundWebController@update')->name('credit_note_refund_update')->middleware('update_access');
    Route::get('delete/{id}', 'CreditNoteRefundWebController@destroy')->name('credit_note_refund_delete')->middleware('delete_access');

});


