<?php
Route::get('/test-management', '\App\Http\Controllers\PartnerAdmin\TestManagementsController@index')
    ->name('partnerAdmin.testManagements');

Route::post('/test-management', '\App\Http\Controllers\PartnerAdmin\TestManagementsController@index')
    ->name('partnerAdmin.testManagements');

Route::get('/test-management/add', '\App\Http\Controllers\PartnerAdmin\TestManagementsController@add')
    ->name('partnerAdmin.testManagements.add');

Route::post('/test-management/add', '\App\Http\Controllers\PartnerAdmin\TestManagementsController@add')
    ->name('partnerAdmin.testManagements.add');

Route::get('/test-management/{id}/view', '\App\Http\Controllers\PartnerAdmin\TestManagementsController@view')
    ->name('partnerAdmin.testManagements.view');

// Route::post('/ notices/{id}/view', '\App\Http\Controllers\PartnerAdmin\TestManagementsController@view')
//     ->name('partnerAdmin.testManagements.view');

Route::get('/test-management/{id}/edit', '\App\Http\Controllers\PartnerAdmin\TestManagementsController@edit')
    ->name('partnerAdmin.testManagements.edit');

Route::post('/test-management/{id}/edit', '\App\Http\Controllers\PartnerAdmin\TestManagementsController@edit')
    ->name('partnerAdmin.testManagements.edit');

Route::post('/test-management/bulkActions/{action}', '\App\Http\Controllers\PartnerAdmin\TestManagementsController@bulkActions')
    ->name('partnerAdmin.testManagements.bulkActions');

Route::get('/test-management/{id}/delete', '\App\Http\Controllers\PartnerAdmin\TestManagementsController@delete')
    ->name('partnerAdmin.testManagements.delete');

Route::post('/test-order-remark', '\App\Http\Controllers\PartnerAdmin\TestManagementsController@testOrderRemark')
    ->name('partnerAdmin.testOrder.remark');