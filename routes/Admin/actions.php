<?php
Route::post('/actions/uploadFile', '\App\Http\Controllers\Admin\ActionsController@uploadFile')
    ->name('admin.actions.uploadFile');

Route::post('/actions/removeFile', '\App\Http\Controllers\Admin\ActionsController@removeFile')
    ->name('admin.actions.removeFile');

Route::post('/actions/{relation}/switchUpdate/{field}/{id}', '\App\Http\Controllers\Admin\ActionsController@switchUpdate')
    ->name('admin.actions.switchUpdate');

Route::get('/actions/stations/{id}', '\App\Http\Controllers\Admin\ActionsController@stations')
    ->name('admin.actions.stations');

Route::match(['get', 'post'], '/actions/districts/{id}', '\App\Http\Controllers\Admin\ActionsController@getDistrictsByStateId')
    ->name('admin.actions.getDistrictsByStateId');

Route::match(['get', 'post'], '/actions/center/{id}', '\App\Http\Controllers\Admin\ActionsController@getCenterByInstituteId')
    ->name('admin.actions.getCenterByInstituteId');

Route::match(['get', 'post'], '/actions/batch/{id}', '\App\Http\Controllers\Admin\ActionsController@getBatchByCenterId')
    ->name('admin.actions.getBatchByCenterId');