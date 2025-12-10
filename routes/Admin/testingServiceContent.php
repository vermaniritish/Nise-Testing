<?php
Route::get('/testing-service-content/{slug}', '\App\Http\Controllers\Admin\TestingServiceContentController@edit')
    ->name('admin.testingServiceContent.edit');

Route::post('/testing-service-content/{slug}', '\App\Http\Controllers\Admin\TestingServiceContentController@edit')
    ->name('admin.testingServiceContent.edit');
