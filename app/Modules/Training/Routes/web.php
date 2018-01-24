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

Route::group(['prefix' => 'training', 'middleware' => 'auth'], function () {

    Route::get('/{id?}', 'TrainingController@index')->name('training_index')->middleware('read_access');
    Route::get('recruit/create/{id}', 'TrainingController@create')->name('training_create')->middleware('create_access');
    Route::get('recruit/file/{id}', 'TrainingController@training_file_download')->name('training_file_download')->middleware('read_access');
    Route::post('recruit/store/{id}', 'TrainingController@store')->name('training_store')->middleware('create_access');
    Route::get('recruit/edit/{id}', 'TrainingController@edit')->name('training_edit')->middleware('read_access');
    Route::post('recruit/update/{id}', 'TrainingController@update')->name('training_update')->middleware('update_access');
    Route::get('recruit/delete/{id}', 'TrainingController@delete')->name('training_delete')->middleware('delete_access');

});