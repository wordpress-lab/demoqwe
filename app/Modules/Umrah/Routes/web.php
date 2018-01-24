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

Route::group(['prefix' => 'umrah'], function () {
    //dashboard start
    Route::get('/', function (){

        dd("Welcome To Umrah Dashboard");
    });
    //dashboard end

    //police  start
    Route::group(['prefix' => 'police/clearence'], function (){
        Route::get('/', 'Police\ClearenceController@index')->name('Umrah_Police_Clearence');
        Route::get('/edit/{id}', 'Police\ClearenceController@edit')->name('Umrah_Police_Clearence_edit');
        Route::post('/update', 'Police\ClearenceController@update')->name('Umrah_Police_Clearence_update');
    });

    //police  end
    //medical  start
    Route::group(['prefix' => 'medical/certificate'], function (){
        Route::get('/', 'Medical\CertificateController@index')->name('Umrah_Medicale_Certificate');
        Route::get('/edit/{id}', 'Medical\CertificateController@edit')->name('Umrah_Medical_Certificate_edit');
        Route::post('/update', 'Medical\CertificateController@update')->name('Umrah_Medical_Certificate_update');
    });

    //medical  end

    //Visa  start
    Route::group(['prefix' => 'visa/processing'], function (){
        Route::get('/', 'Visa\ProcessingController@index')->name('Umrah_Visa_Processing');
        Route::get('/create', 'Visa\ProcessingController@create')->name('Umrah_Visa_Processing_create');
        Route::post('/store', 'Visa\ProcessingController@store')->name('Umrah_Visa_Processing_store');
        Route::get('/edit/{id}', 'Visa\ProcessingController@edit')->name('Umrah_Visa_Processing_edit');
        Route::post('/update', 'Visa\ProcessingController@update')->name('Umrah_Visa_Processing_update');
    });

    //Visa  end
    //Flight  start
    Route::group(['prefix' => 'flight'], function (){
        Route::get('/', 'Flight\PostController@index')->name('Umrah_Flight');
        Route::get('/edit/{id}', 'Flight\PostController@edit')->name('Umrah_Flight_edit');
        Route::post('/update', 'Flight\PostController@update')->name('Umrah_Flight_update');
    });

    //Flight  end
    //Gift pack  start
    Route::group(['prefix' => 'giftpack'], function (){
        Route::get('/', 'GiftPack\PostController@index')->name('Umrah_GiftPack');

        Route::post('/store', 'GiftPack\PostController@create')->name('Umrah_GiftPack_store');
        Route::get('/edit/{id}', 'GiftPack\PostController@edit')->name('Umrah_GiftPack_edit');
        Route::post('/update', 'GiftPack\PostController@update')->name('Umrah_GiftPack_update');
    });

    //Gift pack  end

    //Gift pack  start
    Route::group(['prefix' => 'training'], function (){
        Route::get('/', 'Training\PostController@index')->name('Umrah_Training');
        Route::get('/edit/{id}', 'Training\PostController@edit')->name('Umrah_Training_edit');
        Route::get('/create', 'Training\PostController@create')->name('Umrah_Training_create');
        Route::post('/store', 'Training\PostController@store')->name('Umrah_Training_store');
        Route::post('/update', 'Training\PostController@update')->name('Umrah_Training_update');
    });

    //Gift pack  end



});
