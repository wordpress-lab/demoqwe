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

Route::group(['prefix' => 'stamping/approval' , 'middleware' => 'auth'], function () {

    Route::get('/index/{id?}', 'StampingApprovalController@index')->name('stamp_approval_index')->middleware('read_access');


    Route::get('/owner/approval/{id}', 'StampingApprovalController@stampApproval')->name('stamp_approval')->middleware('read_access');
    Route::get('/owner/approval/confirm/{id}/{remarks?}', 'StampingApprovalController@stampApprovalConfirm')->name('stamp_approval_confirm')->middleware('update_access');
    Route::get('/owner/approval/not/confirm/{id}/{remarks?}', 'StampingApprovalController@stampApprovalNotConfirm')->name('stamp_approval_not_confirm')->middleware('update_access');

});
