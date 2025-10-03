<?php
Route::get('/header-ads', '\App\Http\Controllers\Admin\HeaderAdsController@index')
    ->name('admin.headerAds');

Route::get('/header-ads/add', '\App\Http\Controllers\Admin\HeaderAdsController@add')
    ->name('admin.headerAds.add');

Route::post('/header-ads/add', '\App\Http\Controllers\Admin\HeaderAdsController@add')
    ->name('admin.headerAds.add');

Route::get('/header-ads/{id}/view', '\App\Http\Controllers\Admin\HeaderAdsController@view')
    ->name('admin.headerAds.view');

// Route::post('/ notices/{id}/view', '\App\Http\Controllers\Admin\HeaderAdsController@view')
//     ->name('admin.headerAds.view');

Route::get('/header-ads/{id}/edit', '\App\Http\Controllers\Admin\HeaderAdsController@edit')
    ->name('admin.headerAds.edit');

Route::post('/header-ads/{id}/edit', '\App\Http\Controllers\Admin\HeaderAdsController@edit')
    ->name('admin.headerAds.edit');

Route::post('/header-ads/bulkActions/{action}', '\App\Http\Controllers\Admin\HeaderAdsController@bulkActions')
    ->name('admin.headerAds.bulkActions');

Route::get('/header-ads/{id}/delete', '\App\Http\Controllers\Admin\HeaderAdsController@delete')
    ->name('admin.headerAds.delete');
