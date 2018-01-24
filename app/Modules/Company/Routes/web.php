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

Route::group(['prefix' => 'company', 'middleware' => 'auth'], function () {

    Route::get('/{id?}', 'CompanyController@index')->name('company_index')->middleware('read_access');
    Route::get('branch/create', 'CompanyController@create')->name('company_create')->middleware('create_access');
    Route::post('branch/store', 'CompanyController@store')->name('company_store')->middleware('create_access');
    Route::get('branch/edit/{id}', 'CompanyController@edit')->name('company_edit')->middleware('read_access');
    Route::post('branch/update/{id}', 'CompanyController@update')->name('company_update')->middleware('update_access');
    Route::get('branch/delete/{id}', 'CompanyController@delete')->name('company_delete')->middleware('delete_access');


});


