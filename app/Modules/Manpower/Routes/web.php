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

Route::group(['prefix' => 'manpowers', 'middleware' => 'auth'], function () {

    Route::get('/{id?}', 'ManpowerController@index')->name('manpower_index')->middleware('read_access');
    Route::get('recruit/create/', 'ManpowerController@create')->name('manpower_create')->middleware('create_access');
    Route::post('recruit/store', 'ManpowerController@store')->name('manpower_store')->middleware('create_access');
    Route::get('recruit/edit/{id}', 'ManpowerController@edit')->name('manpower_edit')->middleware('read_access');
    Route::post('recruit/update/{id}', 'ManpowerController@update')->name('manpower_update')->middleware('update_access');
    Route::get('recruit/delete/{id}', 'ManpowerController@delete')->name('manpower_delete')->middleware('delete_access');

    //challan route

    Route::get('challan/create/{id}', 'ManpowerController@challanCreate')->name('challan_create')->middleware('create_access');
    Route::post('challan/store/', 'ManpowerController@challanStore')->name('challan_store')->middleware('create_access');
    Route::get('challan/edit/{id}', 'ManpowerController@challanEdit')->name('challan_edit')->middleware('read_access');
    Route::post('challan/update/{id}', 'ManpowerController@challanUpdate')->name('challan_update')->middleware('read_access');

    //challan Pdf
    Route::get('challan/pdf/{id}', 'ManpowerController@challanPdf')->name('challan_pdf')->middleware('read_access');

});

