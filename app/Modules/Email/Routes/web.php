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

Route::group(['prefix' => 'invoice', 'middleware' => 'auth'], function () {

    Route::get('/mail/view/{id}','MailController@mailView')->name('invoice_mail_send_view');
    Route::post('mail/send/{id}', 'MailController@mailSend')->name('invoice_mail_send');

});


Route::group(['prefix' => 'payment/receive', 'middleware' => 'auth'], function () {

    Route::get('/mail/view/{id}','MailController@paymentReceiveMailView')->name('payment_receive_send_view');
    Route::post('mail/send/{id}', 'MailController@paymentMailSend')->name('payment_receive_mail_send');

});


Route::group(['prefix' => 'credit/note', 'middleware' => 'auth'], function () {

    Route::get('/mail/view/{id}','MailController@creditNoteMailView')->name('credit_note_send_view');
    Route::post('mail/send/{id}', 'MailController@creditMailSend')->name('credit_note_mail_send');

});

Route::group(['prefix' => 'expence', 'middleware' => 'auth'], function () {

    Route::get('/mail/view/{id}','MailController@expenceMailView')->name('expence_send_view');
    Route::post('mail/send/{id}', 'MailController@expenceMailSend')->name('expence_mail_send');

});


Route::group(['prefix' => 'bill', 'middleware' => 'auth'], function () {

    Route::get('/mail/view/{id}','MailController@billMailView')->name('bill_send_view');
    Route::post('mail/send/{id}', 'MailController@billMailSend')->name('bill_mail_send');

});

Route::group(['prefix' => 'paymentmade', 'middleware' => 'auth'], function () {

    Route::get('/mail/view/{id}','MailController@paymentMadeMailView')->name('payment_made_send_view');
    Route::post('mail/send/{id}', 'MailController@paymentMadeMailSend')->name('payment_made_mail_send');

});
Route::group(['prefix' => 'commission', 'middleware' => 'auth'], function () {

    Route::get('/mail/view/{id}','MailController@commissionMailView')->name('commission_mail_send_view');
    Route::post('mail/send/{id}', 'MailController@commissionMailSend')->name('commission_mail_send');

});


Route::group(['prefix' => 'estimate', 'middleware' => 'auth'], function () {

    Route::get('/mail/view/{id}','MailController@estimateMailView')->name('estimate_mail_send_view');
    Route::post('mail/send/{id}', 'MailController@estimateMailSend')->name('estimate_mail_send');

});


