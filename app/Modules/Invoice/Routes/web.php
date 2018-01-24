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
Route::group(['prefix' => 'invoice/pdf', 'middleware' => 'auth'], function () {
    Route::get('/contractapplication', 'Pdf\PostController@contractApplication')->name('invoice_pdf_contact_application');

});
Route::group(['prefix' => 'invoice', 'middleware' => 'auth'], function () {

    Route::get('/', 'InvoiceWebController@index')->name('invoice')->middleware('read_access');
    Route::post('/', 'InvoiceWebController@search')->name('invoice_search')->middleware('read_access');
    Route::get('/create', 'InvoiceWebController@create')->name('invoice_create')->middleware('create_access');


    //checking route


    Route::post('/store', 'InvoiceWebController@store')->name('invoice_store')->middleware('create_access');
    Route::post('/check/item', 'InvoiceWebController@ajaxcheck')->name('check_item')->middleware('create_access');


    Route::post('/check/edit', 'InvoiceWebController@ajaxEditcheck')->middleware('create_access');


    Route::post('/ajax/check', 'InvoiceWebController@ajaxInvoicecheck')->middleware('create_access');

    Route::post('/ajax/show/item', 'InvoiceWebController@ajaxShowItem')->name('ajax_show_item')->middleware('create_access');


    Route::post('/ajax/create/stock', 'InvoiceWebController@ajaxCreateStock')->name('ajax_create_stock')->middleware('create_access');



    Route::get('/show/{id}', 'InvoiceWebController@show')->name('invoice_show')->middleware('read_access');
    Route::post('/show/{id}', 'InvoiceWebController@showupload')->name('invoice_show_upload');
    Route::get('/edit/{id}', 'InvoiceWebController@edit')->name('invoice_edit')->middleware('update_access');
    Route::post('/update/{id}', 'InvoiceWebController@update')->name('invoice_update')->middleware('update_access');
    Route::get('/delete/{id}', 'InvoiceWebController@destroy')->name('invoice_delete')->middleware('delete_access');
    
    Route::post('/use-credit', 'InvoiceWebController@useCredit')->name('post_use_credit')->middleware('auth');
    Route::post('/use-excess-payment', 'InvoiceWebController@useExcessPayment')->name('post_excess_payment')->middleware('auth');
    
    Route::get('/delete-credit/{id}', 'AppliedPaymentController@deleteCredit')->name('delete_credit')->middleware('auth');
    Route::get('/delete-excess/{id}', 'AppliedPaymentController@deleteExcess')->name('delete_excess')->middleware('auth');
    Route::get('/invoice-download/{id}', 'InvoiceWebController@download')->middleware('read_access');
    Route::get('/challan/{id}', 'InvoiceWebController@challan')->middleware('read_access');
    Route::post('/challan/update/{id}', 'InvoiceWebController@challanUpdate')->name('invoice_challan_update')->middleware('update_access');


    //shanto route create

    Route::get('/save/{id}', 'InvoiceWebController@saveUpdate')->name('invoice_update_save')->middleware('read_access');
   // Route::get('save2/{id}', 'InvoiceWebController@saveUpdate2')->name('invoice_update_save')->middleware('read_access');
    Route::post('/save/{id}', 'InvoiceWebController@showStock')->name('invoice_update_stock')->middleware('read_access');
    Route::post('/add/{id}', 'InvoiceWebController@addStock')->name('adding_stock')->middleware('read_access');

    Route::get('/sales-return/{id}' , 'SalesReturn\WebController@create')->name('sales_return');
    Route::post('/sales-return/update/{id}' , 'SalesReturn\WebController@update')->name('sales_return_update');

});


Route::group(['prefix' => 'api/invoice', 'middleware' => 'auth'], function () {

    Route::get('/get-item-rate/{id}', 'InvoiceApiController@getItemRate')->middleware('auth');
    Route::get('/get-item-rate2/{id}/{contact_id}', 'InvoiceApiController@getItemRate2')->middleware('auth');
    Route::get('/get-invoice-entry/{id}', 'InvoiceApiController@getInvoiceEntry')->middleware('auth');
    Route::get('/get-due-balance/{id}', 'InvoiceApiController@getDueBalance')->middleware('auth');
    Route::get('/get-credit-available/{invoice_id}/{credit_note_id}', 'InvoiceApiController@creditAvailable')->middleware('auth');

});
