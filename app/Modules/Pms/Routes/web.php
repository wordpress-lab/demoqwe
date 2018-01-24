<?php
include("report.php");
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

Route::group(['prefix' => 'pms/settings' , 'middleware' => 'auth'], function () {
    Route::get('/', 'Settings\Monthlyworkingdays\WebController@index')->name('pms_settings_index');
    Route::post('/store', 'Settings\Monthlyworkingdays\WebController@store')->name('pms_settings_store');
});
Route::group(['prefix' => 'pms/employee' , 'middleware' => 'auth'], function () {
    Route::get('/', 'Employees\PostController@index')->name('pms_employees_index')->middleware('read_access');
    Route::get('/create', 'Employees\PostController@create')->name('pms_employees_create')->middleware('create_access');
    Route::post('/store', 'Employees\PostController@store')->name('pms_employees_store')->middleware('create_access');
    Route::get('/edit/{id}', 'Employees\PostController@edit')->name('pms_employees_edit')->middleware('read_access');
    Route::post('/update/{id}', 'Employees\PostController@update')->name('pms_employees_update')->middleware('update_access');
    Route::get('/delete/{id?}', 'Employees\PostController@destroy')->name('pms_employees_destory')->middleware('delete_access');
    Route::get('/newcode', 'Employees\PostController@newCodeave')->name('pms_employees_newCode')->middleware('read_access');
    Route::get('/download/{id}/{type}', 'Employees\PostController@download')->name('pms_employees_download')->middleware('read_access');

});

Route::group(['prefix' => 'pms/site' , 'middleware' => 'auth'], function () {

    Route::get('/', 'Sites\PostController@index')->name('pms_sites_index')->middleware('read_access');
    Route::get('/create', 'Sites\PostController@create')->name('pms_sites_create')->middleware('create_access');
    Route::post('/store', 'Sites\PostController@store')->name('pms_sites_store')->middleware('create_access');
    Route::get('/edit/{id}', 'Sites\PostController@edit')->name('pms_sites_edit')->middleware('read_access');
    Route::post('/update/{id}', 'Sites\PostController@update')->name('pms_sites_update')->middleware('update_access');
    Route::get('/delete/{id?}', 'Sites\PostController@destroy')->name('pms_sites_destroy')->middleware('delete_access');
    Route::get('/download/{id}', 'Sites\PostController@download')->name('pms_sites_download')->middleware('read_access');
});

Route::group(['prefix' => 'pms/assign/sites' , 'middleware' => 'auth'], function () {

    Route::get('/', 'AssignSite\PostController@index')->name('pms_assign_sites_index')->middleware('read_access');
    Route::get('/create', 'AssignSite\PostController@create')->name('pms_assign_sites_create')->middleware('create_access');
    Route::post('/store', 'AssignSite\PostController@store')->name('pms_assign_sites_store')->middleware('create_access');
    Route::get('/edit/{id}', 'AssignSite\PostController@edit')->name('pms_assign_sites_edit')->middleware('read_access');
    Route::post('/update/{id}', 'AssignSite\PostController@update')->name('pms_assign_sites_update')->middleware('update_access');
    Route::get('/delete/{id?}', 'AssignSite\PostController@destroy')->name('pms_assign_sites_destroy')->middleware('delete_access');

});

Route::group(['prefix' => 'pms/attendance' , 'middleware' => 'auth'], function () {

    Route::get('/', 'Attendance\PostController@index')->name('pms_attendance_index')->middleware('read_access');
    Route::get('/create', 'Attendance\PostController@create')->name('pms_attendance_create')->middleware('create_access');
    Route::post('/store', 'Attendance\PostController@store')->name('pms_attendance_store')->middleware('create_access');
    Route::get('/show/{id}', 'Attendance\PostController@show')->name('pms_attendance_show')->middleware('read_access');
    Route::get('/edit/{id}/{date}', 'Attendance\PostController@edit')->name('pms_attendance_edit')->middleware('read_access');
    Route::post('/update/{id}/{date}', 'Attendance\PostController@update')->name('pms_attendance_update')->middleware('update_access');
    Route::get('/delete/{id?}/{date?}', 'Attendance\PostController@destroy')->name('pms_attendance_destroy')->middleware('delete_access');
    Route::get('/pdf/{id}/{date}', 'Attendance\PostController@pdf')->name('pms_attendance_pdf')->middleware('read_access');

});

Route::group(['prefix' => 'pms/payroll' , 'middleware' => 'auth'], function () {

    Route::get('/', 'Payroll\SectorsController@index')->name('pms_sectors_index')->middleware('read_access');
    Route::get('/create', 'Payroll\SectorsController@create')->name('pms_sectors_create')->middleware('create_access');
    Route::post('/store', 'Payroll\SectorsController@store')->name('pms_sectors_store')->middleware('create_access');
    Route::get('/show/{id}', 'Payroll\SectorsController@show')->name('pms_sectors_show')->middleware('read_access');
    Route::get('/edit/{id}', 'Payroll\SectorsController@edit')->name('pms_sectors_edit')->middleware('read_access');
    Route::post('/update/{id}', 'Payroll\SectorsController@update')->name('pms_sectors_update')->middleware('update_access');
    Route::get('/delete/{id}', 'Payroll\SectorsController@destroy')->name('pms_sectors_destroy')->middleware('delete_access');

    Route::get('/pdf', 'Payroll\SectorsController@pdf')->name('pms_sectors_pdf');
    Route::get('/payrollPdf', 'Payroll\SectorsController@payrollPdf')->name('pms_sectors_payrollPdf');

});

Route::group(['prefix' => 'pms/leave' , 'middleware' => 'auth'], function () {
    Route::get('/settings', 'Leave\LeaveController@index')->name('pms_leave_settings_index')->middleware('read_access');
    Route::post('/settings', 'Leave\LeaveController@store')->name('pms_leave_settings_store')->middleware('create_access');

    Route::get('/leave-day', 'Leave\ApiController@index')->name('pms_leave_day');
    Route::get('/allow-leave-day/{id}', 'Leave\ApiController@create')->name('pms_allow_leave_day')->middleware('read_access');

    Route::get('/assign', 'Leave\AssignController@index')->name('pms_leave_assign_index')->middleware('read_access');
    Route::get('/assign/create', 'Leave\AssignController@create')->name('pms_leave_assign_create')->middleware('create_access');
    Route::post('/assign/store', 'Leave\AssignController@store')->name('pms_leave_assign_store')->middleware('create_access');
    Route::get('/assign/edit/{id}', 'Leave\AssignController@edit')->name('pms_leave_assign_edit')->middleware('read_access');
    Route::post('/assign/update/{id}', 'Leave\AssignController@update')->name('pms_leave_assign_update')->middleware('update_access');

    Route::get('/assign/delete/{id}', 'Leave\AssignController@destroy')->name('pms_leave_assign_delete')->middleware('delete_access');
});

Route::group(['prefix' => 'pms/payroll/assign/allowance' , 'middleware' => 'auth'], function () {

    Route::get('/', 'PayrollAssign\AllowanceController@index')->name('pms_assign_allowance_index')->middleware('read_access');
    Route::get('/create', 'PayrollAssign\AllowanceController@create')->name('pms_assign_allowance_create')->middleware('create_access');
    Route::post('/store', 'PayrollAssign\AllowanceController@store')->name('pms_assign_allowance_store')->middleware('create_access');
    Route::get('/show/{id}', 'PayrollAssign\AllowanceController@show')->name('pms_assign_allowance_show')->middleware('read_access');
    Route::get('/edit/{id}', 'PayrollAssign\AllowanceController@edit')->name('pms_assign_allowance_edit')->middleware('read_access');
    Route::post('/update/{id}', 'PayrollAssign\AllowanceController@update')->name('pms_assign_allowance_update')->middleware('update_access');
    Route::get('/delete/{id}', 'PayrollAssign\AllowanceController@destroy')->name('pms_assign_allowance_destroy')->middleware('delete_access');

});

Route::group(['prefix' => 'pms/payroll/assign/deduction' , 'middleware' => 'auth'], function () {

    Route::get('/', 'PayrollAssign\DeductionController@index')->name('pms_assign_deduction_index')->middleware('read_access');
    Route::get('/create', 'PayrollAssign\DeductionController@create')->name('pms_assign_deduction_create')->middleware('create_access');
    Route::post('/store', 'PayrollAssign\DeductionController@store')->name('pms_assign_deduction_store')->middleware('create_access');
    Route::get('/show/{id}', 'PayrollAssign\DeductionController@show')->name('pms_assign_deduction_show')->middleware('read_access');
    Route::get('/edit/{id}', 'PayrollAssign\DeductionController@edit')->name('pms_assign_deduction_edit')->middleware('read_access');
    Route::post('/update/{id}', 'PayrollAssign\DeductionController@update')->name('pms_assign_deduction_update')->middleware('update_access');
    Route::get('/delete/{id}', 'PayrollAssign\DeductionController@destroy')->name('pms_assign_deduction_destroy')->middleware('delete_access');

});

Route::group(['prefix' => 'pms/payroll/sheet' , 'middleware' => 'auth'], function () {

    Route::get('/', 'Payroll\SheetController@index')->name('pms_payroll_sheet_index')->middleware('read_access');
    Route::get('/create', 'Payroll\SheetController@create')->name('pms_payroll_sheet_create')->middleware('create_access');
    Route::post('/store', 'Payroll\SheetController@store')->name('pms_payroll_sheet_store')->middleware('create_access');
    Route::get('/show/{id}', 'Payroll\SheetController@show')->name('pms_payroll_sheet_show')->middleware('read_access');
    Route::get('/edit/{id}', 'Payroll\SheetController@edit')->name('pms_payroll_sheet_edit')->middleware('read_access');
    Route::post('/update/{id}', 'Payroll\SheetController@update')->name('pms_payroll_sheet_update')->middleware('update_access');
    Route::get('/delete/{id}', 'Payroll\SheetController@destroy')->name('pms_payroll_sheet_destroy')->middleware('delete_access');
    Route::get('/pdf/{id}', 'Payroll\SheetController@pdf')->name('pms_payroll_sheet_pdf')->middleware('read_access');
    Route::get('/pdf/sector/{id}', 'Payroll\SheetController@pdfSectorWise')->name('pms_payroll_sheet_pdf_sector_wise');

});

Route::group(['prefix' => 'pms/payroll/sheet/approval' , 'middleware' => 'auth'], function () {
    Route::get('/confirm/{id}', 'Payroll\SheetController@confirm')->name('pms_payroll_sheet_confirm');
});


//Payslip Route

Route::group(['prefix' => 'pms/payroll/payslip' , 'middleware' => 'auth'], function () {

    Route::get('/', 'PayrollPayslip\PayslipController@index')->name('pms_payroll_payslip_index')->middleware('read_access');

    // Route::get('/create', 'PayrollPayslip\PayslipController@create')->name('pms_payroll_payslip_create');
    // Route::post('/store', 'PayrollPayslip\PayslipController@store')->name('pms_payroll_payslip_store');
    Route::get('/delete/{id}', 'PayrollPayslip\PayslipController@destroy')->name('pms_payroll_payslip_destroy')->middleware('delete_access');
    Route::get('/pdf/{id}', 'PayrollPayslip\PayslipController@pdf')->name('pms_payroll_payslip_pdf')->middleware('read_access');

});

//Payment Payment

Route::group(['prefix' => 'pms/payroll/payslip/payment' , 'middleware' => 'auth'], function () {

    Route::get('/', 'PayrollPayslip\PaymentController@index')->name('pms_payroll_payment_index');
    Route::get('/create/{id}', 'PayrollPayslip\PaymentController@create')->name('pms_payroll_payment_create');
    Route::post('/store', 'PayrollPayslip\PaymentController@store')->name('pms_payroll_payment_store');
    Route::get('/show/{id}', 'PayrollPayslip\PaymentController@show')->name('pms_payroll_payment_show');
    Route::get('/edit/{id}', 'PayrollPayslip\PaymentController@edit')->name('pms_payroll_payment_edit');
    Route::post('/update/{id}', 'PayrollPayslip\PaymentController@update')->name('pms_payroll_payment_update');
    Route::get('/delete/{id}', 'PayrollPayslip\PaymentController@destroy')->name('pms_payroll_payment_destroy');
    Route::get('/pdf/{id}', 'PayrollPayslip\PaymentController@pdf')->name('pms_payroll_payment_pdf');

});

//Invoice

Route::group(['prefix' => 'pms/invoice' , 'middleware' => 'auth'], function () {

    Route::get('/', 'Invoice\InvoiceController@index')->name('pms_invoice_index');
    Route::get('/create', 'Invoice\InvoiceController@create')->name('pms_invoice_create');
    Route::post('/store', 'Invoice\InvoiceController@store')->name('pms_invoice_store');
    Route::get('/show/{id}', 'Invoice\InvoiceController@show')->name('pms_invoice_show');
    Route::get('/edit/{id}', 'Invoice\InvoiceController@edit')->name('pms_invoice_edit');
    Route::post('/update/{id}', 'Invoice\InvoiceController@update')->name('pms_invoice_update');
    Route::get('/delete/{id}', 'Invoice\InvoiceController@destroy')->name('pms_invoice_destroy');

});

//Invoice Payment Receive

Route::group(['prefix' => 'pms/payroll/invoice/payment-receive' , 'middleware' => 'auth'], function () {

    Route::get('/', 'Invoice\PaymentController@index')->name('pms_invoice_payment_receive_index');
    Route::get('/create/{id}', 'Invoice\PaymentController@create')->name('pms_invoice_payment_receive_create');
    Route::post('/store', 'Invoice\PaymentController@store')->name('pms_invoice_payment_receive_store');
    Route::get('/show/{id}', 'Invoice\PaymentController@show')->name('pms_invoice_payment_receive_show');
    Route::get('/edit/{id}', 'Invoice\PaymentController@edit')->name('pms_invoice_payment_receive_edit');
    Route::post('/update/{id}', 'Invoice\PaymentController@update')->name('pms_invoice_payment_receive_update');
    Route::get('/delete/{id}', 'Invoice\PaymentController@destroy')->name('pms_invoice_payment_receive_destroy');
    Route::get('/pdf/{id}', 'Invoice\PaymentController@pdf')->name('pms_invoice_payment_receive_pdf');

});

Route::group(['prefix' => 'pms/payroll/company' , 'middleware' => 'auth'], function () {

    Route::get('/', 'Payroll\CompanyController@index')->name('pms_payroll_company_index');
    Route::get('/create', 'Payroll\CompanyController@create')->name('pms_payroll_company_create');
    Route::post('/store', 'Payroll\CompanyController@store')->name('pms_payroll_company_store');
    Route::get('/show/{id}', 'Payroll\CompanyController@show')->name('pms_payroll_company_show');
    Route::get('/edit/{id}', 'Payroll\CompanyController@edit')->name('pms_payroll_company_edit');
    Route::post('/update/{id}', 'Payroll\CompanyController@update')->name('pms_payroll_company_update');
    Route::get('/delete/{id}', 'Payroll\CompanyController@destroy')->name('pms_payroll_company_destroy');

});

//expense sector

Route::group(['prefix' => 'pms/expense/sector' , 'middleware' => 'auth'], function () {

    Route::get('/', 'Expense\SectorController@index')->name('pms_expense_sector_index');
    Route::get('/create', 'Expense\SectorController@create')->name('pms_expense_sector_create');
    Route::post('/store', 'Expense\SectorController@store')->name('pms_expense_sector_store');

    Route::get('/edit/{id}', 'Expense\SectorController@edit')->name('pms_expense_sector_edit');
    Route::post('/update/{id}', 'Expense\SectorController@update')->name('pms_expense_sector_update');
    Route::get('/delete/{id}', 'Expense\SectorController@destroy')->name('pms_expense_sector_destroy');

});
//end expense sector
//expense

Route::group(['prefix' => 'pms/expense' , 'middleware' => 'auth'], function () {

    Route::get('/', 'Expense\WebController@index')->name('pms_expense_index');
    Route::get('/create', 'Expense\WebController@create')->name('pms_expense_create');
    Route::post('/store', 'Expense\WebController@store')->name('pms_expense_store');

    Route::get('/edit/{id}', 'Expense\WebController@edit')->name('pms_expense_edit');
    Route::post('/update/{id}', 'Expense\WebController@update')->name('pms_expense_update');
    Route::get('/pdf/{id}', 'Expense\WebController@pdf')->name('pms_expense_pdf');
    Route::get('/history/{id}', 'Expense\WebController@history')->name('pms_expense_history');
    Route::get('/pay/{id}', 'Expense\WebController@pay')->name('pms_expense_pay');
    Route::get('/delete/{id}', 'Expense\WebController@destroy')->name('pms_expense_destroy');

});
//end expense

//Expense Payment

Route::group(['prefix' => 'pms/expense/payment' , 'middleware' => 'auth'], function () {

    Route::get('/', 'Expense\PaymentController@index')->name('pms_expense_payment_index');
    Route::get('/create/{id}', 'Expense\PaymentController@create')->name('pms_expense_payment_create');
    Route::post('/store', 'Expense\PaymentController@store')->name('pms_expense_payment_store');
    Route::get('/show/{id}', 'Expense\PaymentController@show')->name('pms_expense_payment_show');
    Route::get('/edit/{id}', 'Expense\PaymentController@edit')->name('pms_expense_payment_edit');
    Route::post('/update/{id}', 'Expense\PaymentController@update')->name('pms_expense_payment_update');
    Route::get('/delete/{id}', 'Expense\PaymentController@destroy')->name('pms_expense_payment_destroy');

});


Route::get('/ajax-attendance-site/{id}/{date}', 'Attendance\PostController@site');
Route::get('ajax-invoice/{id}/{from}/{to}', 'Invoice\InvoiceController@totalHour')->name('total_hour');