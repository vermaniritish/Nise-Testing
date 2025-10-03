<?php

Route::get('/partner-admin/profile/{id}/update', '\App\Http\Controllers\PartnerAdmin\ProfileController@update')
    ->name('partnerAdmin.profile.update');

Route::post('/partner-admin/profile/{id}/update', '\App\Http\Controllers\PartnerAdmin\ProfileController@update')
    ->name('partnerAdmin.profile.update');