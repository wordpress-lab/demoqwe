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

Route::group(['prefix' => 'manpower/service' , 'middleware' => 'auth'], function () {

    //dasboard
    Route::get('/dashboard', 'DashBoardController@dashboard')->name('manpower_service_dashboard')->middleware('read_access');
    Route::post('/dashboard', 'DashBoardController@dashboardfilter')->name('manpower_service_dashboard_filter')->middleware('read_access');
    Route::get('/vendor/status/{id}/{start}/{end}', 'DashBoardController@totalmanpowerOrderById')->name('manpower_service_total_show')->middleware('read_access');
    Route::get('/pdf/summery/{start}/{end}', 'DashBoardController@manpower_summery_pdf')->name('manpower_dashboard_ticket_summery_pdf')->middleware('read_access');
    Route::get('/vendorstatus/{start}/{end}', 'DashBoardController@vendor_pdf')->name('manpower_dashboard_vendor_pdf')->middleware('read_access');

    Route::get('/total/manpower/Order/pdf/{id}/{start}/{end}', 'DashBoardController@totalManpowerOrderpdf')->name('manpower_Order_total_pdf')->middleware('read_access');
    // end
    Route::get('/pending', 'ManpowerServiceController@pending')->name('manpower_service_pending')->middleware('read_access');
    Route::post('/pending', 'ManpowerServiceController@pending_search')->name('manpower_service_pending_search')->middleware('read_access');
    Route::get('/confirmed', 'ManpowerServiceController@confirmed')->name('manpower_service_confirmed')->middleware('read_access');
    Route::post('/confirmed', 'ManpowerServiceController@confirmed_search')->name('manpower_service_confirmed_search')->middleware('read_access');
    Route::get('/create', 'ManpowerServiceController@create')->name('manpower_service_create')->middleware('create_access');
    Route::post('/store', 'ManpowerServiceController@store')->name('manpower_service_store')->middleware('create_access');
    Route::get('/edit/{id}', 'ManpowerServiceController@edit')->name('manpower_service_edit')->middleware('update_access');
    Route::post('/update/{id}', 'ManpowerServiceController@update')->name('manpower_service_update')->middleware('update_access');
    Route::get('/destory/{id}/{bill}/{invoice}', 'ManpowerServiceController@destroy')->name('manpower_service_destroy')->middleware('delete_access');
    Route::get('/pendingupdate/{id}', 'ManpowerServiceController@pendinUpdate')->name('manpower_service_pendingUpdate')->middleware('update_access');

      //pdf

    Route::get('/pdf/{id}', 'ManpowerServiceController@orderPdf')->name('manpower_service_pdf')->middleware('read_access');


    //send mail to order

    Route::get('/mail/{id}', 'ManpowerServiceController@orderMail')->name('manpower_service_sendMail')->middleware('read_access');
    Route::post('/mail/store/{id}', 'ManpowerServiceController@orderMailStore')->name('manpower_service_sendMailStore')->middleware('create_access');
    Route::get('/sendmail/show/', 'ManpowerServiceController@SendMailShow')->name('manpower_service_mail_send_show')->middleware('read_access');
    Route::post('/sendmail/show/', 'ManpowerServiceController@SendMailShowbyfilter')->name('manpower_service_mail_send_show_filter')->middleware('read_access');
    Route::get('/sendmail/show/{id}', 'ManpowerServiceController@SendMailShowPerID')->name('manpower_service_mail_show_per_id')->middleware('read_access');

    //Ticket bill route

    Route::get('/bill/show/{id}/{progress}', 'ManpowerServiceBillInvoiceController@billShow')->name('manpower_service_bill_show')->middleware('read_access');
    Route::get('/bill/show/{progress}', 'ManpowerServiceBillInvoiceController@billCreate')->name('manpower_service_bill_create')->middleware('create_access');
    Route::post('/bill/store', 'ManpowerServiceBillInvoiceController@billStore')->name('manpower_service_bill_store')->middleware('create_access');



    //Ticket invoice route

    Route::get('/invoice/show/{id}/{progress}', 'ManpowerServiceBillInvoiceController@invoiceShow')->name('manpower_service_invoice_show')->middleware('read_access');
    Route::get('/invoice/show/{progress}', 'ManpowerServiceBillInvoiceController@invoiceCreate')->name('manpower_service_invoice_create')->middleware('create_access');
    Route::post('/invoice/store', 'ManpowerServiceBillInvoiceController@invoiceStore')->name('manpower_service_invoice_store')->middleware('create_access');

});

// Manpower Service document route

Route::group(['prefix' => 'manpower/service/document','middleware' => 'auth'], function () {

    Route::get('/', 'ManpowerServiceDocumentController@index')->name('manpower_service_document_index')->middleware('read_access');
    Route::post('/', 'ManpowerServiceDocumentController@search')->name('manpower_service_document_index_search')->middleware('read_access');
    Route::get('/create', 'ManpowerServiceDocumentController@create')->name('manpower_service_document_create')->middleware('create_access');
    Route::post('/store', 'ManpowerServiceDocumentController@store')->name('manpower_service_document_store')->middleware('create_access');
    Route::get('/edit/{id}', 'ManpowerServiceDocumentController@edit')->name('manpower_service_document_edit')->middleware('read_access');
    Route::post('/update/{id}', 'ManpowerServiceDocumentController@update')->name('manpower_service_document_update')->middleware('update_access');
    Route::get('/delete/{id?}', 'ManpowerServiceDocumentController@delete')->name('manpower_service_document_delete')->middleware('delete_access');

    //shanto Email send

    Route::get('/download/{id}', 'ManpowerServiceDocumentController@download')->name('manpower_service_document_download')->middleware('read_access');
    Route::get('/send/mail/{id}', 'ManpowerServiceDocumentController@sendMail')->name('manpower_service_document_sendMail')->middleware('read_access');
    Route::post('/send/mail/store/{id}', 'ManpowerServiceDocumentController@sendMailStore')->name('manpower_service_document_sendMail_store')->middleware('create_access');

});





// Manpower Service hotel route



Route::group(['prefix' => 'manpower/service/hotel','middleware' => 'auth'], function () {

    Route::get('/', 'ManpowerServiceTicketController@index')->name('manpower_service_hotel_index')->middleware('read_access');
    Route::get('/create', 'ManpowerServiceTicketController@create')->name('manpower_service_hotel_create')->middleware('create_access');
    Route::post('/store', 'ManpowerServiceTicketController@store')->name('manpower_service_hotel_store')->middleware('create_access');
    Route::get('/edit/{id}', 'ManpowerServiceTicketController@edit')->name('manpower_service_hotel_edit')->middleware('read_access');
    Route::post('/update/{id}', 'ManpowerServiceTicketController@update')->name('manpower_service_hotel_update')->middleware('update_access');
    Route::get('/delete/{id?}', 'ManpowerServiceTicketController@delete')->name('manpower_service_hotel_delete')->middleware('delete_access');

});

