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

Route::group(['prefix' => 'recruitdashboard' , 'middleware' => 'auth'], function () {


    Route::get('/', 'WebController@index')->name('recruitdashboard')->middleware('read_access');
    Route::post('/search', 'WebController@search')->name('recruitdashboard_search')->middleware('read_access');
    Route::get('/show', 'WebController@show')->name('recruitdashboard_show')->middleware('read_access');


    /*Route::get('/', function () {
        dd('This is the Recruitdashboard module index page. Build something great!');*/

});
