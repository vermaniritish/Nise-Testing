<?php
Route::get('/dashboard', '\App\Http\Controllers\PartnerAdmin\DashboardController@index')
    ->name('partner.dashboard');