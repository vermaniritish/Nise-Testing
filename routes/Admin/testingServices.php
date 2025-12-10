<?php
Route::get('/testing-services', '\App\Http\Controllers\Admin\TestingServicesController@index')
    ->name('admin.testingService');

Route::get('/testing-services/add', '\App\Http\Controllers\Admin\TestingServicesController@add')
    ->name('admin.testingService.add');

Route::post('/testing-services/add', '\App\Http\Controllers\Admin\TestingServicesController@add')
    ->name('admin.testingService.add');

Route::get('/testing-services/{id}/view', '\App\Http\Controllers\Admin\TestingServicesController@view')
    ->name('admin.testingService.view');

Route::get('/testing-services/{id}/edit', '\App\Http\Controllers\Admin\TestingServicesController@edit')
    ->name('admin.testingService.edit');

Route::post('/testing-services/{id}/edit', '\App\Http\Controllers\Admin\TestingServicesController@edit')
    ->name('admin.testingService.edit');

Route::post('/testing-services/bulkActions/{action}', '\App\Http\Controllers\Admin\TestingServicesController@bulkActions')
    ->name('admin.testingService.bulkActions');

Route::get('/testing-services/{id}/delete', '\App\Http\Controllers\Admin\TestingServicesController@delete')
    ->name('admin.testingService.delete');
