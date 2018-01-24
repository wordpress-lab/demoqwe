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

Route::group(['prefix' => 'settlement', 'middleware' => 'auth'], function () {

    Route::get('/', 'SettlementController@index')->name('settlement_index')->middleware('read_access');
    Route::get('edit/{id}', 'SettlementController@edit')->name('settlement_edit')->middleware('update_access');

});
