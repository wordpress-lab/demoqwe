<?php
Route::group(['prefix' => 'iqama/api/deshboard/summery', 'middleware' => 'auth'], function () {

    Route::get('/list', 'ApiPostController@summery')->name('iqama_summery_deshboard_api');
});

Route::group(['prefix' =>'iqama/approval', 'middleware' => 'auth'], function (){
   Route::get('/{id?}', 'Approval\WebController@index')->name('iqama_approval_index')->middleware('read_access');
   Route::get('/submission/{id}', 'Approval\WebController@submission')->name('iqama_approval_submission')->middleware('read_access');
   Route::get('/confirm/{id}/{code}', 'Approval\WebController@confirm')->name('iqama_approval_confirm')->middleware('read_access');

});

Route::group(['prefix' => 'iqama/insurance', 'middleware' => 'auth'], function (){

    Route::get('/{id?}', 'Insurance\PostController@index')->name('iqama_insurance_index')->middleware('read_access');
    Route::get('/create', 'Insurance\PostController@create')->name('iqama_insurance_create')->middleware('create_access');
    Route::post('/store', 'Insurance\PostController@store')->name('iqama_insurance_store')->middleware('create_access');
    Route::get('/edit/{id}', 'Insurance\PostController@edit')->name('iqama_insurance_edit')->middleware('read_access');
    Route::post('/update/{id}', 'Insurance\PostController@update')->name('iqama_insurance_update')->middleware('update_access');
    Route::get('/delete/{id}', 'Insurance\PostController@destroy')->name('iqama_insurance_destroy')->middleware('delete_access');

});

Route::group(['prefix' => 'iqama/submission', 'middleware' => 'auth'], function (){

    Route::get('/{id?}', 'Submission\PostController@index')->name('iqama_submission_index')->middleware('read_access');
    Route::get('/create', 'Submission\PostController@create')->name('iqama_submission_create')->middleware('create_access');
    Route::post('/store', 'Submission\PostController@store')->name('iqama_submission_store')->middleware('create_access');
    Route::get('/edit/{id}', 'Submission\PostController@edit')->name('iqama_submission_edit')->middleware('read_access');
    Route::post('/update/{id}', 'Submission\PostController@update')->name('iqama_submission_update')->middleware('update_access');
    Route::get('/delete/{id}', 'Submission\PostController@destroy')->name('iqama_submission_destroy')->middleware('delete_access');

});

Route::group(['prefix' => 'iqama/receive', 'middleware' => 'auth'], function (){

    Route::get('/{id?}', 'Receive\PostController@index')->name('iqama_receive_index')->middleware('read_access');
    Route::get('/create', 'Receive\PostController@create')->name('iqama_receive_create')->middleware('create_access');
    Route::post('/store', 'Receive\PostController@store')->name('iqama_receive_store')->middleware('create_access');
    Route::get('/download/{id}', 'Receive\PostController@download')->name('iqama_receive_download')->middleware('read_access');
    Route::get('/edit/{id}', 'Receive\PostController@edit')->name('iqama_receive_edit')->middleware('read_access');
    Route::post('/update/{id}', 'Receive\PostController@update')->name('iqama_receive_update')->middleware('update_access');
    Route::get('/delete/{id}', 'Receive\PostController@destroy')->name('iqama_receive_destroy')->middleware('delete_access');

});

Route::group(['prefix' => 'iqama/delivery/clearance', 'middleware' => 'auth'], function (){

    Route::get('/{id?}', 'Delivery\Clearance\PostController@index')->name('iqama_Delivery_Clearance_index')->middleware('read_access');
    Route::get('/create', 'Delivery\Clearance\PostController@create')->name('iqama_Delivery_Clearance_create')->middleware('create_access');
    Route::get('/approval/{id}', 'Delivery\Clearance\PostController@approval')->name('iqama_Delivery_Approval_create')->middleware('create_access');
    Route::post('/approval/{id}/update/{status}', 'Delivery\Clearance\PostController@approvalUpdate')->name('iqama_Delivery_Approval_update')->middleware('update_access');
    Route::post('/store', 'Delivery\Clearance\PostController@store')->name('iqama_Delivery_Clearance_store')->middleware('create_access');
    Route::get('/download/{id}', 'Delivery\Clearance\PostController@download')->name('iqama_delivery_clearance_download')->middleware('read_access');



});

Route::group(['prefix' => 'iqama/delivery/receipient', 'middleware' => 'auth'], function (){

    Route::get('/{id?}', 'Delivery\Receipient\PostController@index')->name('iqama_Delivery_receipient_index')->middleware('read_access');
    Route::get('/create', 'Delivery\Receipient\PostController@create')->name('iqama_Delivery_receipient_create')->middleware('create_access');
    Route::get('/recipientname/{id}', 'Delivery\Receipient\PostController@recipientName')->name('iqama_Delivery_receipient_name')->middleware('read_access');
    Route::get('/recipientname/{id}/update/{status}', 'Delivery\Receipient\PostController@recipientNameUpdate')->name('iqama_Delivery_receipient_update')->middleware('update_access');
    Route::post('/store', 'Delivery\Receipient\PostController@store')->name('iqama_Delivery_receipient_store')->middleware('create_access');
    Route::post('/name', 'Delivery\Receipient\PostController@recipientNameUpdate')->name('iqama_Delivery_receipient_update')->middleware('update_access');



});

Route::group(['prefix' => 'iqama/delivery/acknowledgement', 'middleware' => 'auth'], function (){
    Route::get('/{id?}', 'Delivery\Acknowledgement\PostController@index')->name('iqama_Delivery_acknowledgement_index')->middleware('read_access');
    Route::get('/add/{id}', 'Delivery\Acknowledgement\PostController@add')->name('iqama_Delivery_acknowledgement_add')->middleware('create_access');
    Route::post('/add/{id}', 'Delivery\Acknowledgement\PostController@addAndUpdate')->name('iqama_Delivery_acknowledgement_add_store')->middleware('create_access');
    Route::get('/pdf/{id}', 'Delivery\Acknowledgement\PostController@pdf')->name('iqama_Delivery_acknowledgement_pdf')->middleware('read_access');
    Route::post('/store', 'Delivery\Acknowledgement\PostController@store')->name('iqama_Delivery_acknowledgement_store')->middleware('create_access');
    Route::get('/file/{id}', 'Delivery\Acknowledgement\PostController@download')->name('iqama_Delivery_acknowledgement_download')->middleware('read_access');
});