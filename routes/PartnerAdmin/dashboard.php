<?php
Route::get('/userdasboard', '\App\Http\Controllers\PartnerAdmin\DashboardController@index')
    ->name('partner.dashboard');

Route::post('/profile/update/{id}', '\App\Http\Controllers\PartnerAdmin\DashboardController@update')
    ->name('profile.update');