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

Route::group(['prefix' => 'income' , 'middleware' => 'auth'], function () {
    Route::get('/', 'IncomeWebController@index')->name('income')->middleware('read_access');
    Route::post('/', 'IncomeWebController@search')->name('income_search')->middleware('read_access');
    Route::get('create', 'IncomeWebController@create')->name('income_create')->middleware('create_access');
    Route::post('store', 'IncomeWebController@store')->name('income_store')->middleware('create_access');
    Route::get('show/{id}', 'IncomeWebController@show')->name('income_show')->middleware('read_access');
    Route::post('show/{id}', 'IncomeWebController@showupload')->name('income_show_upload')->middleware('content_length');
    Route::get('edit/{id}', 'IncomeWebController@edit')->name('income_edit')->middleware('read_access');
    Route::post('update/{id}', 'IncomeWebController@update')->name('income_update')->middleware('update_access');
    Route::get('delete/{id}', 'IncomeWebController@destroy')->name('income_delete')->middleware('delete_access');
});

Route::group(['prefix' => 'api/income'], function () {
    Route::get('/get-income-contact-account-tax-name/{id}', 'IncomeApiController@getIncomeContactAccountTaxName')->middleware('auth');
});
