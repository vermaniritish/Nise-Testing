<?php
Route::match(['get', 'post'], '/actions/districts/{id}', '\App\Http\Controllers\PartnerAdmin\ActionsController@getDistrictsByStateId')
    ->name('partnerAdmin.actions.getDistrictsByStateId');

Route::match(['get', 'post'], '/actions/batch/{id}', '\App\Http\Controllers\PartnerAdmin\ActionsController@getBatchByCenterId')
    ->name('admin.actions.getBatchByCenterId');