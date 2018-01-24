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

Route::group(['prefix' => 'submission' , 'middleware' => 'auth'], function () {

    Route::get('/{id?}', 'SubmissionController@index')->name('submission')->middleware('read_access');
    Route::get('recruit/create/{id}', 'SubmissionController@create')->name('submission_create')->middleware('create_access');
    Route::get('recruit/file/{id}', 'SubmissionController@submission_file_download')->name('submission_file_download')->middleware('read_access');
    Route::post('recruit/store', 'SubmissionController@store')->name('submission_store')->middleware('create_access');
    Route::get('recruit/edit/{id}', 'SubmissionController@edit')->name('submission_edit')->middleware('read_access');
    Route::post('recruit/update/{id}', 'SubmissionController@update')->name('submission_update')->middleware('update_access');
    Route::get('recruit/delete/{id?}', 'SubmissionController@delete')->name('submission_delete')->middleware('delete_access');


    Route::get('recruit/owner/approval/{id}', 'SubmissionController@ownerApproval')->name('owner_approval');
    Route::get('recruit/owner/approval/confirm/{id}', 'SubmissionController@ownerApprovalConfirm')->name('submission_confirm');
    Route::get('recruit/owner/approval/not/confirm/{id}', 'SubmissionController@ownerApprovalNotConfirm')->name('submission_not_confirm');

    Route::get('recruit/ticket/approval/{id}', 'SubmissionController@ticketApproval')->name('ticket_approval');
    Route::get('recruit/ticket/approval/confirm/{id}', 'SubmissionController@ticketApprovalConfirm')->name('ticket_approval_confirm');
    Route::get('recruit/ticket/approval/not/confirm/{id}', 'SubmissionController@ticketApprovalNotConfirm')->name('ticket_approval_not_confirm');

});

Route::group(['prefix' => 'confirmation' , 'middleware' => 'auth'], function () {

    Route::get('/{id?}', 'ConfirmationController@index')->name('confirmation')->middleware('read_access');
    Route::get('recruit/create/{id}', 'ConfirmationController@create')->name('confirmation_create')->middleware('create_access');
    Route::get('recruit/file/{id}', 'ConfirmationController@confirmation_file_download')->name('confirmation_file_download')->middleware('read_access');
    Route::post('recruit/store/{id}', 'ConfirmationController@store')->name('confirmation_store')->middleware('create_access');
    Route::get('recruit/edit/{id}', 'ConfirmationController@edit')->name('confirmation_edit')->middleware('read_access');
    Route::post('recruit/update/{id}', 'ConfirmationController@update')->name('confirmation_update')->middleware('update_access');
    Route::get('recruit/delete/{id?}', 'ConfirmationController@delete')->name('confirmation_delete')->middleware('delete_access');

    Route::get('bill/create/{id}', 'BillWebController@create')->name('confirmation_bill_create')->middleware('create_access');
    Route::post('bill/store/{id}', 'BillWebController@store')->name('confirmation_bill_store')->middleware('create_access');
    Route::get('bill/show/{id}', 'BillWebController@show')->name('confirmation_bill_show')->middleware('read_access');

});