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
 


Route::group(['prefix' => 'account-chart', 'middleware' => 'auth'], function () {

    //Account Charts Routes
    Route::get('/', 'AccountChartWebController@index')->name('account_chart')->middleware('read_access');
    Route::get('/create', 'AccountChartWebController@create')->name('account_chart_create')->middleware('create_access');
    Route::post('/store', 'AccountChartWebController@store')->name('account_chart_store')->middleware('create_access');
    Route::get('/show/{id}', 'AccountChartWebController@show')->name('account_chart_show')->middleware('read_access');
    Route::get('/edit/{id}', 'AccountChartWebController@edit')->name('account_chart_edit')->middleware('update_access');
    Route::post('/update/{id}', 'AccountChartWebController@update')->name('account_chart_update')->middleware('update_access');
    Route::get('/delete/{id}', 'AccountChartWebController@destroy')->name('account_chart_delete')->middleware('delete_access');

});
