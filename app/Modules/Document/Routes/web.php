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

Route::group(['prefix' => 'document', 'middleware' => 'auth'], function () {
    //
    Route::get('/', 'document\WebController@index')->name('document')->middleware('read_access');
    Route::get('/create/{id}', 'document\WebController@create')->name('document_create')->middleware('create_access');
    Route::get('/download', 'document\WebController@download')->name('document_download')->middleware('read_access');
    Route::post('/store', 'document\WebController@store')->name('document_store')->middleware('create_access');
    Route::get('/edit/{id}', 'document\WebController@edit')->name('document_edit')->middleware('read_access');
    Route::post('/update/{id}', 'document\WebController@update')->name('document_update')->middleware('update_access');
    Route::get('/delete/{id?}', 'document\WebController@destroy')->name('document_delete')->middleware('delete_access');
});

Route::group(['prefix' => 'document/category', 'middleware' => 'auth'], function () {

    //Category Routes
    Route::get('/', 'category\WebController@index')->name('document_category')->middleware('read_access');
    Route::get('/search/{id}', 'category\WebController@search')->name('document_category_search')->middleware('read_access');

    Route::get('/create', 'category\WebController@create')->name('document_category_create')->middleware('create_access');
    Route::post('/store', 'category\WebController@store')->name('document_cateregory_store')->middleware('create_access');
    Route::get('/edit/{id}', 'category\WebController@edit')->name('document_category_edit')->middleware('read_access');
    Route::post('/update/{id}', 'category\WebController@update')->name('document_cateregory_update')->middleware('update_access');
    Route::get('/delete/{id?}', 'category\WebController@destroy')->name('document_cateregory_delete')->middleware('delete_access');

});
