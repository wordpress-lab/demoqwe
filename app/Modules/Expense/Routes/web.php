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

Route::group(['prefix' => 'expense' , 'middleware' => 'auth'], function () {
    Route::get('/', 'ExpenseWebController@index')->name('expense')->middleware('read_access');
    Route::post('/', 'ExpenseWebController@search')->name('expense_search')->middleware('read_access');
    Route::get('create', 'ExpenseWebController@create')->name('expense_create')->middleware('create_access');
    Route::post('store', 'ExpenseWebController@store')->name('expense_store')->middleware('create_access');
    Route::get('show/{id}', 'ExpenseWebController@show')->name('expense_show')->middleware('read_access');
    Route::post('show/{id}', 'ExpenseWebController@showupload')->name('expense_show_upload');
    Route::get('edit/{id}', 'ExpenseWebController@edit')->name('expense_edit')->middleware('update_access');
    Route::post('update/{id}', 'ExpenseWebController@update')->name('expense_update')->middleware('update_access');
    Route::get('delete/{id}', 'ExpenseWebController@destroy')->name('expense_delete')->middleware('delete_access');
    Route::get('expense_update_mark/{id}', 'ExpenseWebController@expense_update_mark')->name('expense_update_mark')->middleware('delete_access');
});

Route::group(['prefix' => 'api/expense'], function () {
    Route::get('/get-expense-contact-account-tax-name/{id}', 'ExpenseApiController@getExpenseContactAccountTaxName')->middleware('auth');
});

