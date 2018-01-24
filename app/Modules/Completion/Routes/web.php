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

Route::group(['prefix' => 'completion', 'middleware' => 'auth'], function () {

    Route::get('/{id?}', 'CompletionController@index')->name('completion_index')->middleware('read_access');
    Route::get('recruit/create/{id}', 'CompletionController@create')->name('completion_create')->middleware('create_access');
    Route::get('recruit/file/{id}', 'CompletionController@recruit_filedownload')->name('completion_file_download')->middleware('read_access');
    Route::post('recruit/store/{id}', 'CompletionController@store')->name('completion_store')->middleware('create_access');
    Route::get('recruit/edit/{id}', 'CompletionController@edit')->name('completion_edit')->middleware('read_access');
    Route::post('recruit/update/{id}', 'CompletionController@update')->name('completion_update')->middleware('update_access');
    Route::get('recruit/delete/{id}', 'CompletionController@delete')->name('completion_delete')->middleware('delete_access');


});
