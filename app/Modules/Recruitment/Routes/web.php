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

Route::group(['prefix' => 'form_basis', 'middleware' => 'auth'], function () {

    Route::get('/edit', 'BasisController@edit')->name('form_basis_edit')->middleware('read_access');
    Route::post('/update/{id}', 'BasisController@update')->name('form_basis_update')->middleware('update_access');

});




Route::group(['prefix' => 'gamca', 'middleware' => 'auth'], function () {

    Route::get('/', 'MedicalslipController@index')->name('medical_slip_form_index')->middleware('read_access');
    Route::get('/create', 'MedicalslipController@create')->name('medical_slip_form_create')->middleware('create_access');
    Route::post('/store', 'MedicalslipController@store')->name('medical_slip_form_store')->middleware('create_access');
    Route::get('/edit/{id}', 'MedicalslipController@edit')->name('medical_slip_form_edit')->middleware('read_access');
    Route::post('/update/{id}', 'MedicalslipController@update')->name('medical_slip_form_update')->middleware('update_access');
    Route::get('/delete/{id?}', 'MedicalslipController@delete')->name('medical_slip_form_delete');
    Route::get('/download/{id}', 'MedicalslipController@download')->name('medical_slip_form_download')->middleware('read_access');
    Route::get('/gamca_download/{id}', 'MedicalslipController@gamca_download')->name('gamca_download')->middleware('read_access');

});


Route::group(['prefix' => 'agreement', 'middleware' => 'auth'], function () {

    Route::get('/', 'AgreementController@index')->name('agreement_index')->middleware('read_access');
    Route::get('/create', 'AgreementController@create')->name('agreement_create')->middleware('create_access');
    Route::post('/store', 'AgreementController@store')->name('agreement_store')->middleware('create_access');
    Route::get('/edit/{id}', 'AgreementController@edit')->name('agreement_edit')->middleware('read_access');
    Route::post('/update/{id}', 'AgreementController@update')->name('agreement_update')->middleware('update_access');
    Route::get('/delete/{id?}', 'AgreementController@delete')->name('agreement_delete')->middleware('delete_access');
    Route::get('/download/{id}', 'AgreementController@download')->name('agreement_download')->middleware('read_access');


});

Route::group(['prefix' => 'noobjection', 'middleware' => 'auth'], function () {

    Route::get('/', 'NoObjectionController@index')->name('objection_index')->middleware('read_access');
    Route::post('/match', 'NoObjectionController@match')->name('objection_match')->middleware('read_access');

});


Route::group(['prefix' => 'visaprocess', 'middleware' => 'auth'], function () {

    Route::get('/', 'VisaProcessController@index')->name('visa_process_index')->middleware('read_access');
    Route::get('/create', 'VisaProcessController@create')->name('visa_process_create')->middleware('create_access');
    Route::post('/store', 'VisaProcessController@store')->name('visa_process_store')->middleware('create_access');
    Route::get('/edit/{id}', 'VisaProcessController@edit')->name('visa_process_edit')->middleware('read_access');
    Route::post('/update/{id}', 'VisaProcessController@update')->name('visa_process_update')->middleware('update_access');
    Route::get('/delete/{id?}', 'VisaProcessController@delete')->name('visa_process_delete')->middleware('delete_access');
    Route::get('/download/{id}', 'VisaProcessController@download')->name('visa_process_download')->middleware('read_access');


});



Route::group(['prefix' => 'immigration', 'middleware' => 'auth'], function () {

    Route::get('/', 'ImmigrationController@index')->name('immigration_index')->middleware('read_access');
    Route::get('/create', 'ImmigrationController@create')->name('immigration_create')->middleware('create_access');
    Route::post('/store', 'ImmigrationController@store')->name('immigration_store')->middleware('create_access');
    Route::get('/edit/{id}', 'ImmigrationController@edit')->name('immigration_edit')->middleware('read_access');
    Route::post('/update/{id}', 'ImmigrationController@update')->name('immigration_update')->middleware('update_access');
    Route::get('/delete/{id?}', 'ImmigrationController@delete')->name('immigration_delete')->middleware('delete_access');

    Route::get('/download/{id}', 'ImmigrationController@download')->name('immigration_download')->middleware('read_access');

});



//Note Sheet Route

Route::group(['prefix' => 'note_sheet', 'middleware' => 'auth'], function () {

    Route::get('/', 'NoteSheetController@index')->name('note_sheet_index')->middleware('read_access');
    Route::get('/create', 'NoteSheetController@create')->name('note_sheet_create')->middleware('create_access');
    Route::post('/store', 'NoteSheetController@store')->name('note_sheet_store')->middleware('create_access');
    Route::get('/edit/{id}', 'NoteSheetController@edit')->name('note_sheet_edit')->middleware('read_access');
    Route::post('/update/{id}', 'NoteSheetController@update')->name('note_sheet_update')->middleware('update_access');
    Route::get('/delete/{id?}', 'NoteSheetController@delete')->name('note_sheet_delete')->middleware('delete_access');

    Route::get('/download/{id}', 'NoteSheetController@download')->name('note_sheet_download')->middleware('read_access');

});



//arrival Recruit Route

Route::group(['prefix' => 'arrival', 'middleware' => 'auth'], function () {

    Route::get('/{id?}', 'ArrivalRecruitController@index')->name('arrival_recruit_index')->middleware('read_access');
    Route::get('recruit/create/{id}', 'ArrivalRecruitController@create')->name('arrival_recruit_create')->middleware('create_access');
    Route::post('recruit/store', 'ArrivalRecruitController@store')->name('arrival_recruit_store')->middleware('create_access');
    Route::get('recruit/edit/{id}', 'ArrivalRecruitController@edit')->name('arrival_recruit_edit')->middleware('read_access');
    Route::post('recruit/update/{id}', 'ArrivalRecruitController@update')->name('arrival_recruit_update')->middleware('update_access');
    Route::get('recruit/delete/{id?}', 'ArrivalRecruitController@delete')->name('arrival_recruit_delete')->middleware('delete_access');

    Route::get('recruit/download/{id}', 'ArrivalRecruitController@download')->name('arrival_file_download')->middleware('read_access');

});



