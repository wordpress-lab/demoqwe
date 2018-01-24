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

Route::group(['prefix' => 'visastamp' , 'middleware' => 'auth'], function () {

    Route::get('/{id?}', 'VisaStampingController@index')->name('visastamp')->middleware('read_access');
    Route::get('recruit/create', 'VisaStampingController@create')->name('visastamp_create')->middleware('create_access');
    Route::post('recruit/store', 'VisaStampingController@store')->name('visastamp_store')->middleware('create_access');
    Route::get('recruit/edit/{id}', 'VisaStampingController@edit')->name('visastamp_edit')->middleware('read_access');
    Route::get('recruit/file/{id}', 'VisaStampingController@visa_stamp_download')->name('visa_stamp_download')->middleware('read_access');
    Route::get('recruit/show/{id}', 'VisaStampingController@show')->name('visastamp_show')->middleware('read_access');
    Route::post('recruit/update/{id}', 'VisaStampingController@update')->name('visastamp_update')->middleware('update_access');
    Route::get('recruit/delete/{id}', 'VisaStampingController@delete')->name('visastamp_delete')->middleware('delete_access');
    Route::get('api/recruit', 'VisaStampingController@recruitJson')->name('visa_stamp_recruitJson');
    Route::get('api/recruit/details/{id}', 'VisaStampingController@recruitDetailsJson')->name('visa_stamp_recruitDetailsJson');


    Route::post('test/', 'VisaStampingController@test')->name('visastamp_test')->middleware('delete_access');


    Route::get('bill/create/{order}', 'VisaStampController@billCreate')->name('visa_stamp_bill_create')->middleware('create_access');
    Route::post('bill/store/', 'VisaStampController@billStore')->name('visa_stamp_bill_store')->middleware('create_access');
    Route::get('bill/show/{id}/{order}', 'VisaStampController@billShow')->name('visa_stamp_bill_show')->middleware('read_access');





});
