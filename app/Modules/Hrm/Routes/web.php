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

Route::group(['prefix' => 'hrm/reception' , 'middleware' => 'auth'], function () {
    Route::get('/', 'Reception\WebController@index')->name('reception_category_index');
    Route::get('create', 'Reception\WebController@create')->name('reception_category_create');
    Route::post('store', 'Reception\WebController@store')->name('reception_category_store');
    Route::get('show/{id}', 'Reception\WebController@show')->name('reception_category_show');
    Route::get('edit/{id}', 'Reception\WebController@edit')->name('reception_category_edit');
    Route::post('update/{id}', 'Reception\WebController@update')->name('reception_category_update');
    Route::get('delete/{id}', 'Reception\WebController@destroy')->name('reception_category_delete');

    Route::get('logbook', 'Reception\LogbookWebController@index')->name('reception_logbook_index');
    Route::get('logbook/create', 'Reception\LogbookWebController@create')->name('reception_logbook_create');
    Route::post('logbook/store', 'Reception\LogbookWebController@store')->name('reception_logbook_store');
    Route::get('logbook/show/{id}', 'Reception\LogbookWebController@show')->name('reception_logbook_show');
    Route::get('logbook/edit/{id}', 'Reception\LogbookWebController@edit')->name('reception_logbook_edit');
    Route::post('logbook/update/{id}', 'Reception\LogbookWebController@update')->name('reception_logbook_update');
    Route::get('logbook/delete/{id}', 'Reception\LogbookWebController@destroy')->name('reception_logbook_delete');

    Route::get('info/{id}', 'Reception\LogbookWebController@info')->name('contact_info');
});
