<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your module. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::group(['prefix' => 'manual-journal'], function () {

    //Manual Journal Routes
    //Route::get('/contact-account-tax-list/{id}', 'ManualJournalApiController@getContactAccountTaxList')->name('account_tax')->middleware('auth:api');

});
