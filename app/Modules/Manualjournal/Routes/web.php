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

Route::group(['prefix' => 'manual-journal', 'middleware' => 'auth'], function () {

    //Manual Journal Routes
    Route::get('/', 'ManualJournalWebController@index')->name('journal')->middleware('read_access');
    Route::post('/', 'ManualJournalWebController@search')->name('journal_search')->middleware('read_access');
    Route::get('/create', 'ManualJournalWebController@create')->name('journal_create')->middleware('create_access');
    Route::post('/store', 'ManualJournalWebController@store')->name('journal_store')->middleware('create_access');
    Route::get('/show/{id}', 'ManualJournalWebController@show')->name('journal_show')->middleware('read_access');
    Route::get('/edit/{id}', 'ManualJournalWebController@edit')->name('journal_edit')->middleware('update_access');
    Route::post('/update/{id}', 'ManualJournalWebController@update')->name('journal_update')->middleware('update_access');
    Route::get('/delete/{id}', 'ManualJournalWebController@destroy')->name('journal_delete')->middleware('delete_access');
    
});

Route::group(['prefix' => 'api/manual-journal'], function () {

    //Manual Journal Routes
    Route::get('/contact-account-tax-list/{id}', 'ManualJournalApiController@getContactAccountTaxList')->name('contact-account-tax')->middleware('auth');
    Route::get('/contact-account-tax-list2/{id}', 'ManualJournalApiController@getContactAccountTaxList2')->name('contact-account-tax2')->middleware('auth');

    Route::get('/contact-account-tax-name', 'ManualJournalApiController@getContactAccountTaxName')->name('contact-account-tax-name')->middleware('auth');
});





