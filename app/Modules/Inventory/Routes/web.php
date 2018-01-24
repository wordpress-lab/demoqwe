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

Route::group(['prefix' => 'inventory', 'middleware' => 'auth'], function () {

    //Inventory Routes
    Route::get('/', 'InventoryWebController@index')->name('inventory')->middleware('read_access');
    Route::get('/create', 'InventoryWebController@create')->name('inventory_create')->middleware('create_access');
    Route::post('/store', 'InventoryWebController@store')->name('inventory_store')->middleware('create_access');
    Route::get('/show/{id}', 'InventoryWebController@show')->name('inventory_show')->middleware('read_access');
    Route::get('/edit/{id}', 'InventoryWebController@edit')->name('inventory_edit')->middleware('update_access');
    Route::post('/update/{id}', 'InventoryWebController@update')->name('inventory_update')->middleware('update_access');
    Route::get('/delete/{id}', 'InventoryWebController@destroy')->name('inventory_delete')->middleware('delete_access');
     //api ajax
    Route::get('/api/all/list', 'InventoryWebController@apiAllInventory')->name('inventory_api_all_inventory_list');


    // item search
    Route::get('/search/{id}', 'InventorySearchController@index')->name('inventory_search')->middleware('read_access');

    
});

Route::group(['prefix' => 'inventory/category', 'middleware' => 'auth'], function () {

    Route::get('/', 'CategoryWebController@index')->name('inventory_category')->middleware('read_access');
    Route::get('/create', 'CategoryWebController@create')->name('inventory_category_create')->middleware('create_access');
    Route::post('/store', 'CategoryWebController@store')->name('inventory_category_store')->middleware('create_access');
    Route::get('/edit/{id}', 'CategoryWebController@edit')->name('inventory_category_edit')->middleware('update_access');
    Route::post('/update/{id}', 'CategoryWebController@update')->name('inventory_category_update')->middleware('update_access');
    Route::get('/delete/{id}', 'CategoryWebController@destroy')->name('inventory_category_delete')->middleware('delete_access');
});


