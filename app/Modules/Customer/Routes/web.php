<?php

Route::group(['prefix' => 'customer','middleware' => 'auth'], function () {

    Route::get('/{id?}', 'WebController@index')->name('customer')->middleware('read_access');
    Route::get('recruit/update/{id}', 'WebController@update')->name('customer_update')->middleware('update_access');
    Route::get('recruit/document/{id}', 'WebController@document')->name('customer_document')->middleware('read_access');
   // Route::get('recruit/flight/{id}', 'WebController@flight')->name('customer_flight')->middleware('read_access');

    Route::get('recruit/dashboard/{id}', 'WebController@customerDeshboard')->name('customer_dashboard')->middleware('read_access');
    Route::get('recruit/agent/{id}', 'WebController@customerAgent')->name('customer_agent')->middleware('read_access');

    Route::get('recruit/manpower/{id}', 'WebController@manpower')->name('customer_manpower')->middleware('read_access');
    Route::get('recruit/finger/{id}', 'WebController@finger')->name('customer_finger')->middleware('read_access');
    Route::get('recruit/stamping/{id}', 'WebController@stamping')->name('customer_stamping')->middleware('read_access');
    Route::get('recruit/order/{id}', 'WebController@order')->name('customer_order')->middleware('read_access');
    Route::get('recruit/okala/{id}', 'WebController@okala')->name('customer_okala')->middleware('read_access');
    Route::get('recruit/gamca/{id}', 'WebController@gamca')->name('customer_medicalSlip')->middleware('read_access');
    Route::get('recruit/mofa/{id}', 'WebController@mofa')->name('customer_mofa')->middleware('read_access');
    Route::get('recruit/musaned/{id}', 'WebController@musaned')->name('customer_musaned')->middleware('read_access');
    Route::get('recruit/report/{id}', 'WebController@report')->name('customer_report')->middleware('read_access');
    Route::get('recruit/fitcard/{id}', 'WebController@fitCard')->name('customer_fit_card')->middleware('read_access');
    Route::get('recruit/training/{id}', 'WebController@training')->name('customer_training')->middleware('read_access');
    Route::get('recruit/completion/{id}', 'WebController@completion')->name('customer_completion')->middleware('read_access');
    Route::get('recruit/submission/{id}', 'WebController@submission')->name('customer_submission')->middleware('read_access');
    Route::get('recruit/confirmation/{id}', 'WebController@confirmation')->name('customer_confirmation')->middleware('read_access');
    Route::get('recruit/police/clearance/{id}', 'WebController@policeClearance')->name('customer_police_clearance')->middleware('read_access');

});

Route::group(['prefix' => 'customer/information','middleware' => 'auth'], function () {
    Route::get('subreference/autosuggest', 'information\WebController@autosuggest')->name('customer_subreference_autosuggest')->middleware('read_access');

    Route::get('/', 'information\WebController@index')->name('customer_information')->middleware('read_access');
    Route::get('/edit/{id}', 'information\WebController@edit')->name('customer_information_edit')->middleware('read_access');
    Route::post('/update/{id}', 'information\WebController@update')->name('customer_information_update')->middleware('update_access');

});

Route::group(['prefix' => 'customer/account','middleware' => 'auth'], function () {

    Route::get('/{id}', 'account\WebController@index')->name('customer_account')->middleware('read_access');
    Route::get('/edit/{id}', 'account\WebController@edit')->name('customer_account_edit')->middleware('read_access');
    Route::post('/update/{id}', 'account\WebController@update')->name('customer_account_update')->middleware('update_access');

});
