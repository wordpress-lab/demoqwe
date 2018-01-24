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

Route::group(['prefix' => 'police-clearance', 'middleware' => 'auth'], function () {

    Route::get('/{id?}', 'PoliceClearanceController@index')->name('police_clearance_index')->middleware('read_access');
    Route::get('recruit/create/{id}', 'PoliceClearanceController@create')->name('police_clearance_create')->middleware('create_access');
    Route::get('recruit/police_clearence_download/{id}', 'PoliceClearanceController@police_clearence_download')->name('police_clearence_download')->middleware('read_access');
    Route::post('recruit/store/{id}', 'PoliceClearanceController@store')->name('police_clearance_store')->middleware('create_access');
    Route::get('recruit/edit/{id}', 'PoliceClearanceController@edit')->name('police_clearance_edit')->middleware('read_access');
    Route::post('recruit/update/{id}', 'PoliceClearanceController@update')->name('police_clearance_update')->middleware('update_access');
    Route::get('recruit/delete/{id}', 'PoliceClearanceController@delete')->name('police_clearance_delete')->middleware('delete_access');


});
