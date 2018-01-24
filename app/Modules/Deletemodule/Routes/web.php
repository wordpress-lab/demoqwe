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

Route::group(['prefix' => 'module-delete','middleware' => 'auth'], function () {
   
    Route::get('/', 'ModuleDeleteController@index')->name('module_delete_index');
    Route::post('/update', 'ModuleDeleteController@update')->name('module_delete_update');

});
