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

Route::group(['prefix' => 'order' , 'middleware' => 'auth'], function () {

    Route::get('/{id?}', 'Order\WebController@index')->name('order')->middleware('read_access');
    Route::get('recruit/create', 'Order\WebController@create')->name('order_create')->middleware('create_access');
    Route::get('recruit/file/download/{id}', 'Order\WebController@download')->name('order_download')->middleware('create_access');
    Route::post('recruit/store', 'Order\WebController@store')->name('order_store')->middleware('create_access');
    Route::get('recruit/edit/{id}', 'Order\WebController@edit')->name('order_edit')->middleware('read_access');
    Route::post('recruit/update/{id}', 'Order\WebController@update')->name('order_update')->middleware('update_access');
    Route::get('recruit/delete/{id?}', 'Order\WebController@delete')->name('order_delete')->middleware('delete_access');
	Route::get('recruit/pdf', 'Order\WebController@pdf')->name('order_pdf')->middleware('read_access');

	Route::get('recruit/archive/{id}', 'Order\WebController@archive')->name('order_archive')->middleware('read_access');
	Route::get('recruit/archive/back/{id}', 'Order\WebController@archiveBack')->name('order_archive_back')->middleware('read_access');
	Route::get('recruit/archive_index/', 'Order\WebController@archiveIndex')->name('order_archive_index')->middleware('read_access');


});

Route::group(['prefix' => 'order/invoice' , 'middleware' => 'auth'], function () {

    Route::get('/', 'invoice\InvoiceWebController@index')->name('order_invoice')->middleware('read_access');
    Route::get('create/{order?}', 'invoice\InvoiceWebController@create')->name('order_invoice_create')->middleware('create_access');
    Route::post('store', 'invoice\InvoiceWebController@store')->name('order_invoice_store')->middleware('create_access');
    Route::get('show/{id}/{order}', 'invoice\InvoiceWebController@show')->name('order_invoice_show')->middleware('read_access');
    Route::get('edit/{id}', 'InvoiceWebController@edit')->name('order_invoice_edit')->middleware('read_access');
    Route::post('update/{id}', 'InvoiceWebController@update')->name('invoice_update')->middleware('update_access');
    Route::get('delete/{id}', 'InvoiceWebController@destroy')->name('invoice_delete')->middleware('delete_access');


});

Route::group(['prefix' => 'order/accounts' , 'middleware' => 'auth'], function () {

    Route::get('/', 'accounts\WebController@index')->name('order_accounts')->middleware('read_access');
    Route::get('/create', 'accounts\WebController@create')->name('order_accounts_create')->middleware('create_access');
    Route::post('/store', 'accounts\WebController@store')->name('order_accounts_store')->middleware('create_access');
    Route::get('/edit/{id}', 'accounts\WebController@edit')->name('order_accounts_edit')->middleware('read_access');
    Route::post('/update/{id}', 'accounts\WebController@update')->name('order_accounts_update')->middleware('update_access');
    Route::get('/delete/{id?}', 'accounts\WebController@destroy')->name('order_accounts_delete')->middleware('delete_access');


});

Route::group(['prefix' => 'order/recruit/expense' , 'middleware' => 'auth'], function () {

    Route::get('/', 'expense\WebController@index')->name('order_expense_accounts')->middleware('read_access');
    Route::get('/create', 'expense\WebController@create')->name('order_expense_accounts_create')->middleware('create_access');
    Route::post('/store', 'expense\WebController@store')->name('order_expense_accounts_store')->middleware('create_access');
    Route::post('/store/expense/{id}', 'expense\WebController@storeExpense')->name('order_expense_accounts_storeExpense')->middleware('create_access');
    Route::get('/edit/{id}', 'expense\WebController@edit')->name('order_expense_accounts_edit')->middleware('read_access');
    Route::post('/update/{id}', 'expense\WebController@update')->name('order_expense_accounts_update')->middleware('update_access');
    Route::get('/delete/{id?}/{ex?}', 'expense\WebController@destroy')->name('order_expenses_delete')->middleware('delete_access');
    Route::get('/expense/{id}/{ex?}', 'expense\WebController@expense')->name('order_from_expense')->middleware('read_access');
    Route::get('/api/journalentry', 'expense\WebController@apiJournal')->name('order_from_expense_journal_entry');
    Route::get('/api/apiPayable', 'expense\WebController@apiPayable')->name('order_from_expense_apiPayable');
    Route::get('/api/apiAgent', 'expense\WebController@apiAgent')->name('order_from_expense_apiAgent');
    Route::get('/api/sectorpax/filter', 'expense\WebController@expensSectorPax')->name('order_from_expense_api_expens_SectorPax');
    Route::get('/api/edit/single/filter', 'expense\WebController@recruitExpenseApi')->name('order_from_expense_edit_api_recruitExpenseApi');


});

Route::group(['prefix' => 'order/expense/sector' , 'middleware' => 'auth'], function () {

    Route::get('/', 'expensesector\WebController@index')->name('order_expense_sector')->middleware('read_access');
    Route::get('/create', 'expensesector\WebController@create')->name('order_expense_sector_create')->middleware('create_access');
    Route::post('/store', 'expensesector\WebController@store')->name('order_expense_sector_store')->middleware('create_access');
    Route::get('/edit/{id}', 'expensesector\WebController@edit')->name('order_expense_sector_edit')->middleware('read_access');
    Route::post('/update/{id}', 'expensesector\WebController@update')->name('order_expense_sector_update')->middleware('update_access');
    Route::get('/delete/{id?}', 'expensesector\WebController@destroy')->name('order_expense_sector_delete')->middleware('delete_access');
    Route::get('/search/{id?}', 'expensesector\WebController@search')->name('order_expense_sector_search')->middleware('read_access');


});