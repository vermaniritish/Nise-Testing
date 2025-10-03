<?php
Route::get('/home-page', '\App\Http\Controllers\Admin\HomePageController@edit')
    ->name('admin.editHomePage');

Route::post('/home-page', '\App\Http\Controllers\Admin\HomePageController@edit')
    ->name('admin.editHomePage');

