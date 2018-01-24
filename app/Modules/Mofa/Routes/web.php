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

Route::group(['prefix' => 'mofa' , 'middleware' => 'auth'], function () {

    Route::get('/{id?}', 'mofa\WebController@index')->name('mofa')->middleware('read_access');
    Route::get('recruit/create/{id}', 'mofa\WebController@create')->name('mofa_create')->middleware('create_access');
    Route::get('recruit/file/{id}', 'mofa\WebController@mofa_download')->name('mofa_mofa_download')->middleware('read_access');
    Route::post('recruit/store', 'mofa\WebController@store')->name('mofa_store')->middleware('create_access');
    Route::get('recruit/edit/{id}', 'mofa\WebController@edit')->name('mofa_edit')->middleware('read_access');
    Route::post('recruit/update/{id}', 'mofa\WebController@update')->name('mofa_update')->middleware('update_access');
    Route::get('recruit/delete/{id?}', 'mofa\WebController@delete')->name('mofa_delete')->middleware('delete_access');

});
