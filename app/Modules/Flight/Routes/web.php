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
Route::group(['prefix' => 'flight', 'middleware' => 'auth'], function () {

    Route::get('/{id?}', 'FlightController@index')->name('flight_index')->middleware('read_access');
    Route::get('recruit/create', 'FlightController@create')->name('flight_create')->middleware('create_access');
    Route::post('recruit/store', 'FlightController@store')->name('flight_store')->middleware('create_access');
    Route::get('recruit/edit/{id}', 'FlightController@edit')->name('flight_edit')->middleware('read_access');
    Route::post('recruit/update/{id}', 'FlightController@update')->name('flight_update')->middleware('update_access');
    Route::get('recruit/delete/{id}', 'FlightController@delete')->name('flight_delete')->middleware('delete_access');
    Route::get('card/pdf/{id?}', 'FlightController@flightcard')->name('flight_card_pdf');


});
