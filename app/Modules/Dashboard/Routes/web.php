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

Route::group(['prefix' => 'dashboard'], function () {
    Route::get('/', 'DashboardWebController@index')->name('dashboard')->middleware('auth');
    Route::get('/todayreminder', 'DashboardWebController@todayreminder')->name('dashboard_todayreminder')->middleware('auth');
    Route::post('/reminder', 'ReminderWebController@index')->name('dashboard_reminder')->middleware('auth');
    Route::get('/all', 'ReminderWebController@All')->name('dashboard_reminder_all')->middleware('auth');
    Route::get('/delete/{id}', 'ReminderWebController@destroy')->name('dashboard_reminder_destroy')->middleware('auth');
    Route::get('/api/overduereceivable', 'DashboardApiController@overDueReceivable')->name('dashboard_overDueReceivable_api')->middleware('auth');
    Route::get('/api/overduereceivable/invoiceshow/{id}', 'DashboardApiController@overDueReceivableInvoiceShow')->name('dashboard_overDueReceivable_invoice_show_api')->middleware('auth');
    Route::get('/api/reorder/list', 'DashboardApiController@reOrder')->name('dashboard_reorder_list_api')->middleware('auth');
    Route::get('/api/overdue/payable/list', 'DashboardApiController@overduePayable')->name('dashboard_overduePayable_list_api')->middleware('auth');


});
