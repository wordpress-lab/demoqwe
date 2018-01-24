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

Route::group(['prefix' => 'musaned' , 'middleware' => 'auth'], function () {

    Route::get('/{id?}', 'MusanedController@index')->name('musaned')->middleware('read_access');
    Route::get('recruit/create/{id}', 'MusanedController@create')->name('musaned_create')->middleware('create_access');
    Route::post('recruit/store', 'MusanedController@store')->name('musaned_store')->middleware('create_access');
    Route::get('recruit/edit/{id}', 'MusanedController@edit')->name('musaned_edit')->middleware('read_access');
    Route::get('recruit/show/{id}', 'MusanedController@show')->name('musaned_show')->middleware('read_access');
    Route::post('recruit/update/{id}', 'MusanedController@update')->name('musaned_update')->middleware('update_access');
    Route::get('recruit/delete/{id}', 'MusanedController@delete')->name('musaned_delete')->middleware('delete_access');

    /*Route::get('/', function () {
        dd('This is the Musaned module index page. Build something great!');
    });*/
});
