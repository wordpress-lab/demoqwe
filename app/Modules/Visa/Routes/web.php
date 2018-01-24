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

Route::group(['prefix' => 'visa/embassy' , 'middleware' => 'auth'], function () {

    Route::get('/office-list', 'Embassy\PostController@officeList')->name('visa_emabassy_office_list');
    Route::get('/jobseeker', 'Embassy\PostController@jobSeeker')->name('visa_emabassy_office_list');



});
Route::group(['prefix' => 'visa' , 'middleware' => 'auth'], function () {

    Route::get('/{id?}', 'WebController@index')->name('visa')->middleware('read_access');
    Route::get('recruit/show/{id}', 'WebController@show')->name('visa_show')->middleware('read_access');
    Route::get('recruit/create', 'WebController@create')->name('visa_create')->middleware('create_access');
    Route::get('recruit/file{id}', 'WebController@Visa_Entry_File')->name('visa_order_file_download')->middleware('read_access');
    Route::post('recruit/store', 'WebController@store')->name('visa_store')->middleware('create_access');
    Route::get('recruit/edit/{id}', 'WebController@edit')->name('visa_edit')->middleware('read_access');
    Route::post('recruit/update/{id}', 'WebController@update')->name('visa_update')->middleware('update_access');
    Route::get('recruit/delete/{id?}', 'WebController@delete')->name('visa_delete')->middleware('delete_access');
    Route::get('recruit/contact', 'WebController@contact')->name('visa_contact')->middleware('read_access');


});
Route::group(['prefix' => 'visas/bill' , 'middleware' => 'auth'], function () {

    Route::get('/', 'BillWebController@index')->name('visa_bill')->middleware('read_access');
    Route::get('/create/{visa?}', 'BillWebController@create')->name('visa_bill_create')->middleware('create_access');
    Route::get('/show/{id}/{visa}', 'BillWebController@show')->name('visa_bill_show')->middleware('read_access');
    Route::post('/store', 'BillWebController@store')->name('visa_bill_store')->middleware('create_access');
    Route::get('/edit/{id}', 'BillWebController@edit')->name('visa_bill_edit')->middleware('read_access');
});

Route::group(['prefix' => 'visaacceptance' , 'middleware' => 'auth'], function () {
    Route::get('/', 'visaacceptance\WebController@index')->name('visaacceptance')->middleware('read_access');
    Route::get('/create', 'visaacceptance\WebController@create')->name('visaacceptance_create')->middleware('create_access');
    Route::post('/store', 'visaacceptance\WebController@store')->name('visaacceptance_store')->middleware('create_access');
    Route::get('/edit/{id}', 'visaacceptance\WebController@edit')->name('visaacceptance_edit')->middleware('read_access');
    Route::post('/update/{id}', 'visaacceptance\WebController@update')->name('visaacceptance_update')->middleware('update_access');
    Route::get('/delete/{id?}', 'visaacceptance\WebController@destroy')->name('visaacceptance_destroy')->middleware('delete_access');

    Route::get('/pdf/{id}', 'visaacceptance\WebController@pdf')->name('visaacceptance_pdf')->middleware('read_access');
    Route::get('/print/{id}', 'visaacceptance\WebController@visaPrint')->name('visaacceptance_print')->middleware('read_access');
});

Route::group(['prefix' => 'visaform' , 'middleware' => 'auth'], function () {

    //Route::get('/', 'visaform\WebController@index')->name('visaform')->middleware('read_access');
    Route::get('/create/{id}', 'visaform\WebController@create')->name('visaform_create')->middleware('create_access');
    Route::post('/store', 'visaform\WebController@store')->name('visaform_store')->middleware('create_access');
    Route::get('/edit/{id}', 'visaform\WebController@edit')->name('visaform_edit')->middleware('read_access');
    Route::post('/update/{id}', 'visaform\WebController@update')->name('visaform_update')->middleware('update_access');
    Route::get('/delete/{id?}', 'visaform\WebController@destroy')->name('visaform_destroy')->middleware('delete_access');

    Route::get('/pdf/{id}', 'visaform\WebController@pdf')->name('visaform_pdf')->middleware('read_access');

    Route::get('/print/{id}', 'visaform\WebController@visaPrint')->name('visaform_print')->middleware('read_access');

    Route::get('/statement/{id}', 'visaform\WebController@statement')->name('visaform_work_agreement')->middleware('read_access');
    Route::get('/paper/{id}', 'visaform\WebController@AgreementPaper')->name('visaform_agreement_paper')->middleware('read_access');

    Route::get('/pdf/{id}', 'visaform\WebController@pdf')->name('visaform_pdf')->middleware('read_access');
    Route::get('/pdf2/{id}', 'visaform\WebController@pdf2')->name('visa_pdf2')->middleware('read_access');
  });

