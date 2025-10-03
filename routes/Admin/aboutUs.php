<?php
Route::get('/about-us', '\App\Http\Controllers\Admin\AboutUsController@edit')
    ->name('admin.editAaboutUs');

Route::post('/about-us', '\App\Http\Controllers\Admin\AboutUsController@edit')
    ->name('admin.editAaboutUs');
