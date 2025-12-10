<?php
Route::get('/dashboard', '\App\Http\Controllers\User\DashboardController@userDashboard')
    ->name('user.dashboard');