<?php
Route::get('/district', '\App\Http\Controllers\Admin\DistrictController@index')
    ->name('admin.district');

Route::match(['get', 'post'], '/district/add', '\App\Http\Controllers\Admin\DistrictController@add')
    ->name('admin.district.add');

Route::get('/district/{id}/view', '\App\Http\Controllers\Admin\DistrictController@view')
    ->name('admin.district.view');

Route::match(['get', 'post'], '/district/{id}/edit', '\App\Http\Controllers\Admin\DistrictController@edit')
    ->name('admin.district.edit');

Route::post('/district/bulkActions/{action}', '\App\Http\Controllers\Admin\DistrictController@bulkActions')
    ->name('admin.district.bulkActions');

Route::get('/district/{id}/delete', '\App\Http\Controllers\Admin\DistrictController@delete')
    ->name('admin.district.delete');