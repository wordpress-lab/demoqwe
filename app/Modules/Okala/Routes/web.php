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


Route::group(['prefix' => 'okala', 'middleware' => 'auth'], function () {

    Route::get('/{id?}', 'OkalaController@index')->name('okala_index')->middleware('read_access');
    Route::get('recruit/create/{id}', 'OkalaController@create')->name('okala_create')->middleware('create_access');
    Route::post('recruit/store', 'OkalaController@store')->name('okala_store')->middleware('create_access');
    Route::get('recruit/edit/{id}', 'OkalaController@edit')->name('okala_edit')->middleware('read_access');
    Route::post('recruit/update/{id}', 'OkalaController@update')->name('okala_update')->middleware('update_access');
    Route::get('recruit/delete/{id}', 'OkalaController@delete')->name('okala_delete')->middleware('delete_access');


});





