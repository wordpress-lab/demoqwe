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

Route::group(['prefix' => 'accountinformationform', 'middleware' => 'auth'], function () {
    Route::get('/', 'AccountInformationForm\WebController@index')->name('aif')->middleware('read_access');
    Route::post('/', 'AccountInformationForm\WebController@search')->name('aif_search');
    Route::get('create', 'AccountInformationForm\WebController@create')->name('aif_create')->middleware('create_access');
    Route::post('store', 'AccountInformationForm\WebController@store')->name('aif_store')->middleware('create_access');
    Route::get('show/{id}', 'AccountInformationForm\WebController@show')->name('aif_show')->middleware('read_access');
    Route::get('edit/{id}', 'AccountInformationForm\WebController@edit')->name('aif_edit')->middleware('read_access');
    Route::post('update/{id}', 'AccountInformationForm\WebController@update')->name('aif_update')->middleware('update_access');
    Route::get('delete/{id}', 'AccountInformationForm\WebController@destroy')->name('aif_delete')->middleware('delete_access');

    Route::get('my-aif', 'AccountInformationForm\WebController@myAfi')->name('my_aif')->middleware('read_access');

    Route::get('aif-pdf/{id}', 'AccountInformationForm\WebController@aifPdf')->name('aif_pdf');
});

Route::group(['prefix' => 'execuitive', 'middleware' => 'auth'], function () {
    Route::get('execuitive/{id}', 'AccountInformationForm\WebController@execuitive')->name('aif_execuitive')->middleware('read_access');
    Route::post('execuitive/update/{id}', 'AccountInformationForm\WebController@execuitiveUpdate')->name('aif_execuitive_update')->middleware('create_access');
});

Route::group(['prefix' => 'manager', 'middleware' => 'auth'], function () {
    Route::get('manager/{id}', 'AccountInformationForm\WebController@manager')->name('aif_manager')->middleware('read_access');
    Route::post('manager/update/{id}', 'AccountInformationForm\WebController@managerUpdate')->name('aif_manager_update')->middleware('create_access');
});

Route::group(['prefix' => 'account', 'middleware' => 'auth'], function () {
    Route::get('account/{id}', 'AccountInformationForm\WebController@account')->name('aif_account')->middleware('read_access');
    Route::post('account/update/{id}', 'AccountInformationForm\WebController@accountUpdate')->name('aif_account_update')->middleware('create_access');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('admin/{id}', 'AccountInformationForm\WebController@admin')->name('aif_admin')->middleware('read_access');
    Route::post('admin/update/{id}', 'AccountInformationForm\WebController@adminUpdate')->name('aif_admin_update')->middleware('create_access');
});

Route::group(['prefix' => 'director', 'middleware' => 'auth'], function () {
    Route::get('director/{id}', 'AccountInformationForm\WebController@director')->name('aif_director')->middleware('read_access');
    Route::post('director/update/{id}', 'AccountInformationForm\WebController@directorUpdate')->name('aif_director_update')->middleware('create_access');
});

Route::group(['prefix' => 'officer', 'middleware' => 'auth'], function () {
    Route::get('officer/{id}', 'AccountInformationForm\WebController@officer')->name('aif_officer')->middleware('read_access');
    Route::post('officer/update/{id}', 'AccountInformationForm\WebController@officerUpdate')->name('aif_officer_update')->middleware('create_access');
});
