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
Route::group(['prefix' => 'kafala/api', 'middleware' => 'auth'], function () {
    Route::get('/deshboard/summery/list', 'ApiPostController@summery')->name('iqama_kafala_summery_master_deshboard_api');
});
Route::group(['prefix' => 'kafala/before60days', 'middleware' => 'auth'], function () {

    Route::get('/', 'Beforesixtydays\PostController@index')->name('iqama_kafala_index')->middleware('read_access');
    Route::get('/create/{id}', 'Beforesixtydays\PostController@create')->name('iqama_kafala_create')->middleware('create_access');
    Route::post('/store/{id}', 'Beforesixtydays\PostController@store')->name('iqama_kafala_store')->middleware('create_access');
});
Route::group(['prefix' => 'kafala/after60days'], function () {
    Route::get('/', 'Aftersixtydays\PostController@index')->name('iqama_kafala_after_index')->middleware('read_access');
    Route::get('/create/{id}', 'Aftersixtydays\PostController@create')->name('iqama_kafala_after_create')->middleware('create_access');
    Route::post('/store/{id}', 'Aftersixtydays\PostController@store')->name('iqama_kafala_after_store')->middleware('create_access');
});
