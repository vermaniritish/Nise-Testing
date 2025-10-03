<?php
Route::get('/manage-batche', '\App\Http\Controllers\PartnerAdmin\BatchesController@index')
    ->name('partnerAdmin.manageBatche');

Route::get('/manage-batche/add', '\App\Http\Controllers\PartnerAdmin\BatchesController@add')
    ->name('partnerAdmin.manageBatche.add');

Route::post('/manage-batche/add', '\App\Http\Controllers\PartnerAdmin\BatchesController@add')
    ->name('partnerAdmin.manageBatche.add');

Route::get('/manage-batche/{id}/edit', '\App\Http\Controllers\PartnerAdmin\BatchesController@edit')
    ->name('partnerAdmin.manageBatche.edit');

Route::post('/manage-batche/{id}/edit', '\App\Http\Controllers\PartnerAdmin\BatchesController@edit')
    ->name('partnerAdmin.manageBatche.edit');