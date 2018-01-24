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

Route::group(['prefix' => 'fitcard' , 'middleware' => 'auth'], function () {

    Route::get('/{id?}', 'FitCardController@index')->name('fit_card')->middleware('read_access');
    Route::get('recruit/create/{id}', 'FitCardController@create')->name('fit_card_create')->middleware('create_access');
    Route::get('recruit/fitcardfile/{id}', 'FitCardController@fitcard_download')->name('fit_card_download')->middleware('read_access');
    Route::post('recruit/store', 'FitCardController@store')->name('fit_card_store')->middleware('create_access');
    Route::get('recruit/edit/{id}', 'FitCardController@edit')->name('fit_card_edit')->middleware('read_access');
    Route::post('recruit/update/{id}', 'FitCardController@update')->name('fit_card_update')->middleware('update_access');
    Route::get('recruit/delete/{id?}', 'FitCardController@delete')->name('fit_card_delete')->middleware('delete_access');
    Route::get('recruit/pdf/{id?}', 'FitCardController@pdf')->name('fit_card_pdf')->middleware('read_access');

});
