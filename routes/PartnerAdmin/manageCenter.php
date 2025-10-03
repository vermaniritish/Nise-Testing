<?php
Route::get('/manage-center', '\App\Http\Controllers\PartnerAdmin\CenterController@index')
    ->name('partnerAdmin.manageCenter');

Route::get('/manage-center/add', '\App\Http\Controllers\PartnerAdmin\CenterController@add')
    ->name('partnerAdmin.manageCenter.add');

Route::post('/manage-center/add', '\App\Http\Controllers\PartnerAdmin\CenterController@add')
    ->name('partnerAdmin.manageCenter.add');

Route::get('/manage-center/{id}/edit', '\App\Http\Controllers\PartnerAdmin\CenterController@edit')
    ->name('partnerAdmin.manageCenter.edit');

Route::post('/manage-center/{id}/edit', '\App\Http\Controllers\PartnerAdmin\CenterController@edit')
    ->name('partnerAdmin.manageCenter.edit');

Route::get('/manage-center/{id}/delete', '\App\Http\Controllers\PartnerAdmin\CenterController@delete')
    ->name('partnerAdmin.manageCenter.delete');

Route::get('/districts/by-state/{id}', '\App\Http\Controllers\PartnerAdmin\CenterController@districtsByState')
    ->name('partnerAdmin.manageCenter.districts.by-state');