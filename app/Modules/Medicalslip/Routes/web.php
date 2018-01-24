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

Route::group(['prefix' => 'medicalslip', 'middleware' => 'auth'], function () {

    Route::get('report/{id?}', 'MedicalSlipController@index')->name('medicalslip')->middleware('read_access');
    Route::get('report/recruit/create/{id}', 'MedicalSlipController@create')->name('medicalslip_create')->middleware('create_access');
    Route::post('report/recruit/store', 'MedicalSlipController@store')->name('medicalslip_store')->middleware('create_access');
    Route::get('report/recruit/edit/{id}', 'MedicalSlipController@edit')->name('medicalslip_edit')->middleware('read_access');
    Route::get('report/recruit/show/{id}', 'MedicalSlipController@show')->name('medicalslip_show')->middleware('read_access');
    Route::post('report/recruit/update/{id}', 'MedicalSlipController@update')->name('medicalslip_update')->middleware('update_access');
    Route::get('report/recruit/delete/{id}', 'MedicalSlipController@delete')->name('medicalslip_delete')->middleware('delete_access');
    Route::get('report/file/{id}', 'MedicalSlipController@file_download')->name('medicalslip_file_download')->middleware('read_access');

});
