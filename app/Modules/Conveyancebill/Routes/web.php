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

Route::group(['prefix' => 'conveyancebill' , 'middleware' => 'auth'], function () {
    Route::get('/', 'ConveyanceBill\WebController@index')->name('cnb');
    Route::get('/byuser', 'ConveyanceBill\WebController@byuser')->name('cnb_byuser');
    Route::post('/', 'ConveyanceBill\WebController@search')->name('cnb_search');
    Route::get('create', 'ConveyanceBill\WebController@create')->name('cnb_create');
    Route::post('store', 'ConveyanceBill\WebController@store')->name('cnb_store');
    Route::get('show/{id}', 'ConveyanceBill\WebController@show')->name('cnb_show')->middleware('read_access');
    Route::get('edit/{id}', 'ConveyanceBill\WebController@edit')->name('cnb_edit')->middleware('read_access');
    Route::post('update/{id}', 'ConveyanceBill\WebController@update')->name('cnb_update');
    Route::get('delete/{id}', 'ConveyanceBill\WebController@destroy')->name('cnb_delete');
    Route::get('my-bill', 'ConveyanceBill\WebController@myBill')->name('my_cnb_index');
    
    });

Route::group(['prefix' => 'conveyancebill/check' , 'middleware' => 'auth'], function () {
    Route::get('{id}', 'ConveyanceBill\WebController@checkBy')->name('cnb_check')->middleware('read_access');
    Route::post('update/{id}', 'ConveyanceBill\WebController@checkByUpdate')->name('cnb_check_update')->middleware('create_access');
});



Route::group(['prefix' => 'conveyancebill/expense' , 'middleware' => 'auth'], function () {
    Route::get('/create/{id}', 'ConveyanceBill\WebController@createExpense')->name('cnb_expense_create');
    Route::post('/store', 'ConveyanceBill\WebController@storeExpense')->name('cnb_expense_store');

});



Route::group(['prefix' => 'conveyancebill/approve' , 'middleware' => 'auth'], function () {
    Route::get('update/{id}/{value}', 'ConveyanceBill\WebController@approveByUpdate')->name('cnb_approve_update')->middleware('read_access');
});

Route::group(['prefix' => 'conveyancebill/approved-by-chairman' , 'middleware' => 'auth'], function () {
    Route::get('update/{id}/{value}', 'ConveyanceBill\WebController@approvedByChairmanUpdate')->name('cnb_approved_by_chairman_update')->middleware('read_access');

    Route::get('pdf/{id}', 'ConveyanceBill\WebController@pdf')->name('cnb_pdf');
});


