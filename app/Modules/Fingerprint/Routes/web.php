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

Route::group(['prefix' => 'fingerprint', 'middleware' => 'auth'], function () {

    Route::get('/{id?}', 'FingerprintController@index')->name('fingerprint_index')->middleware('read_access');
    Route::get('recruit/create/{id}', 'FingerprintController@create')->name('fingerprint_create')->middleware('create_access');
    Route::post('recruit/store/{id}', 'FingerprintController@store')->name('fingerprint_store')->middleware('create_access');
    Route::get('recruit/file/{id}', 'FingerprintController@fingerprint_file_download')->name('fingerprint_file_download')->middleware('read_access');
    Route::get('recruit/edit/{id}', 'FingerprintController@edit')->name('fingerprint_edit')->middleware('read_access');
    Route::post('recruit/update/{id}', 'FingerprintController@update')->name('fingerprint_update')->middleware('update_access');
    Route::get('recruit/delete/{id}', 'FingerprintController@delete')->name('fingerprint_delete')->middleware('delete_access');


});