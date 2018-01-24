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

Route::group(['prefix' => 'hajj'], function (){
    //dashboard start
    Route::get('/', function (){

        dd("Welcome To Hajj Dashboard");
    });
    //dashboard end

     //police  start
    Route::group(['prefix' => 'police/clearence'], function (){
        Route::get('/', 'Police\ClearenceController@index')->name('Hajj_Police_Clearence');
        Route::get('/edit/{id}', 'Police\ClearenceController@edit')->name('Hajj_Police_Clearence_edit');
        Route::post('/update', 'Police\ClearenceController@update')->name('Hajj_Police_Clearence_update');
    });

    //police  end
    //medical  start
    Route::group(['prefix' => 'medical/certificate'], function (){
        Route::get('/', 'Medical\CertificateController@index')->name('Hajj_Medicale_Certificate');
        Route::get('/edit/{id}', 'Medical\CertificateController@edit')->name('Hajj_Medical_Certificate_edit');
        Route::post('/update', 'Medical\CertificateController@update')->name('Hajj_Medical_Certificate_update');
    });

    //medical  end

    //Visa  start
    Route::group(['prefix' => 'visa/processing'], function (){
        Route::get('/', 'Visa\ProcessingController@index')->name('Hajj_Visa_Processing');
        Route::get('/create', 'Visa\ProcessingController@create')->name('Hajj_Visa_Processing_create');
        Route::post('/store', 'Visa\ProcessingController@store')->name('Hajj_Visa_Processing_store');
        Route::get('/edit/{id}', 'Visa\ProcessingController@edit')->name('Hajj_Visa_Processing_edit');
        Route::post('/update', 'Visa\ProcessingController@update')->name('Hajj_Visa_Processing_update');
    });

    //Visa  end
    //Flight  start
    Route::group(['prefix' => 'flight'], function (){
        Route::get('/', 'Flight\PostController@index')->name('Hajj_Flight');
        Route::get('/edit/{id}', 'Flight\PostController@edit')->name('Hajj_Flight_edit');
        Route::post('/update', 'Flight\PostController@update')->name('Hajj_Flight_update');
    });

    //Flight  end
    //Gift pack  start
    Route::group(['prefix' => 'giftpack'], function (){
        Route::get('/', 'GiftPack\PostController@index')->name('Hajj_GiftPack');

        Route::post('/store', 'GiftPack\PostController@create')->name('Hajj_GiftPack_store');
        Route::get('/edit/{id}', 'GiftPack\PostController@edit')->name('Hajj_GiftPack_edit');
        Route::post('/update', 'GiftPack\PostController@update')->name('Hajj_GiftPack_update');
    });

    //Gift pack  end

    //Gift pack  start
    Route::group(['prefix' => 'training'], function (){
        Route::get('/', 'Training\PostController@index')->name('Hajj_Training');
        Route::get('/edit/{id}', 'Training\PostController@edit')->name('Hajj_Training_edit');
        Route::get('/create', 'Training\PostController@create')->name('Hajj_Training_create');
        Route::post('/store', 'Training\PostController@store')->name('Hajj_Training_store');
        Route::post('/update', 'Training\PostController@update')->name('Hajj_Training_update');
    });

    //Gift pack  end




});
