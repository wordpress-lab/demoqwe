<?php


Route::group(['prefix' => 'pms/report' , 'middleware' => 'auth'], function () {
    Route::get('/', 'Report\WebController@index')->name('pms_report_all');

    Route::get('/employeewise', 'Report\Contact\EmployeeWiseController@index')->name('pms_report_employee_wise');
    Route::post('/employeewise', 'Report\Contact\EmployeeWiseController@indexFilter')->name('pms_report_employee_wise_filter');
    Route::get('/employeewise/details/{id}/{start}/{end}', 'Report\Contact\EmployeeWiseController@details')->name('pms_report_employee_wise_details');
    Route::post('/employeewise/details/{id}', 'Report\Contact\EmployeeWiseController@detailsFilter')->name('pms_report_employee_wise_details_filter');
    Route::get('/employeewise/details/{id}', 'Report\Contact\EmployeeWiseController@detailsFilter')->name('pms_report_employee_wise_details_filter_get');

});