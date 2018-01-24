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

Route::group(['prefix' => 'product-track', 'middleware' => 'auth'], function () {

    //Product Tracking Routes
    Route::get('/', 'ProductTrackWebController@index')->name('track')->middleware('read_access');
    Route::get('/create', 'ProductTrackWebController@create')->name('track_create')->middleware('create_access');
    Route::post('/store', 'ProductTrackWebController@store')->name('track_store')->middleware('create_access');
    Route::get('/show/{id}', 'ProductTrackWebController@show')->name('track_show')->middleware('read_access');
    Route::get('/edit/{id}', 'ProductTrackWebController@edit')->name('track_edit')->middleware('update_access');
    Route::post('/update/{id}', 'ProductTrackWebController@update')->name('track_update')->middleware('update_access');
    Route::get('/delete/{id}', 'ProductTrackWebController@destroy')->name('track_delete')->middleware('delete_access');

    //Product Phase Routes
    Route::get('/phase', 'ProductPhaseWebController@index')->name('phase')->middleware('read_access');
    Route::get('/phase/create', 'ProductPhaseWebController@create')->name('phase_create')->middleware('create_access');
    Route::post('/phase/store', 'ProductPhaseWebController@store')->name('phase_store')->middleware('create_access');
    Route::get('/phase/show/{id}', 'ProductPhaseWebController@show')->name('phase_show')->middleware('read_access');
    Route::get('/phase/edit/{id}', 'ProductPhaseWebController@edit')->name('phase_edit')->middleware('update_access');
    Route::post('/phase/update/{id}', 'ProductPhaseWebController@store')->name('phase_update')->middleware('update_access');
    Route::get('/phase/delete/{id}', 'ProductPhaseWebController@destroy')->name('phase_delete')->middleware('delete_access');

    //Product item Routes
    Route::get('/item/{id}/list', 'ProductItemWebController@index')->name('product_item_list')->middleware('read_access');
    Route::get('/item/{id}/create', 'ProductItemWebController@create')->name('product_item_add')->middleware('create_access');
    Route::get('/item/{id}/show', 'ProductItemWebController@show')->name('product_phase_item_show')->middleware('read_access');

    

    Route::post('/item/store', 'ProductItemWebController@store')->name('product_item_store')->middleware('create_access');
    Route::get('/item/phase/{id}/edit', 'ProductItemWebController@edit')->name('product_phase_item_edit')->middleware('update_access');
    Route::post('/item/phase/{id}/update', 'ProductItemWebController@update')->name('product_phase_item_update')->middleware('update_access');
    Route::get('/item/phase/{id}/delate', 'ProductItemWebController@destroy')->name('product_phase_item_delete')->middleware('delete_access');



});

Route::group(['prefix' => 'api/product-track'], function () {
    Route::get('/get-product-phase-item/{id}', 'ProductItemWebController@getProductPhaseItem')->name('get_product_phase_item')->middleware('auth');
});

Route::group(['prefix' => 'api/product-track'], function () {
    Route::get('/get-product/{id}', 'ProductTrackWebController@getProduct')->name('get_product')->middleware('auth');
    Route::get('/item/phase/{phase_id}', 'ProductItemWebController@index_1')->name('product_item_list_1')->middleware('auth');
});


Route::group(['prefix' => 'api/item'], function () {
    Route::get('/get-item-category-name', 'ProductItemApiController@getItemCategory')->name('item_category_name')->middleware('auth');
    Route::get('/get-item-name/{category_id}', 'ProductItemApiController@getItemName')->name('item_name')->middleware('auth');
    
});

Route::get('/test',function(){
    return view('producttrack::item.test');
});
