<?php


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

// Auth::routes();

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

// Activation Routes
Route::get('user/activation/{token}', 'Auth\ActivationController@activateUser')->name('activation');
Route::get('resend/activation/{email}', 'Auth\ActivationController@resendActivation')->name('resend.activation');

// Application Routes
Route::get('/', 'MainController@index');
//Route::get('/test/{id}', 'MainController@test')->name('invoice_mail_send_view');






//pdf route
Route::get('pdf', 'PdfController@getPdf')->name('pdf');
Route::get('medical', 'PdfController@medical')->name('medical');
Route::get('potro_1', 'PdfController@potro_1')->name('potro_1');
Route::get('potro_2', 'PdfController@potro_2')->name('potro_2');
Route::get('potro_3', 'PdfController@potro_3')->name('potro_3');
Route::get('document', 'PdfController@document')->name('document');
Route::get('immegration_1', 'PdfController@immegration_1')->name('immegration_1');
Route::get('immegration_2', 'PdfController@immegration_2')->name('immegration_2');
Route::get('immegration_3', 'PdfController@immegration_3')->name('immegration_3');
Route::get('immegration_4', 'PdfController@immegration_4')->name('immegration_4');
Route::get('note_sheet2', 'PdfController@note_sheet')->name('note_sheet');
Route::get('check', 'PdfController@test')->name('test');
Route::get('visa/form/pdf', 'PdfController@visa')->name('visa_form');
Route::get('rabahinternational', 'PdfController@rabahinternational')->name('rabahinternational');
Route::get('workagreement', 'PdfController@work_agreement')->name('work_agreement');
Route::get('pdf/visa/acceptance', 'PdfController@visaacceptance')->name('visa_acceptance_form');
Route::get('pdf/visa/billing', 'PdfController@billing')->name('visa_billing');
Route::get('mail', 'PdfController@mail')->name('mail');
Route::get('boss', 'PdfController@getPdf')->name('getPdfboos');
Route::get('pdf2', 'PdfController@Pdf2')->name('getPdfboos');

Route::get('test2', 'PdfController@test2')->name('test2');
Route::get('group', 'PdfController@group')->name('group');