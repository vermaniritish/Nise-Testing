<?php
Route::get('/test-management', '\App\Http\Controllers\Admin\TestManagementsController@index')
    ->name('admin.testManagements');

Route::post('/test-management', '\App\Http\Controllers\Admin\TestManagementsController@index')
    ->name('admin.testManagements');

Route::get('/test-management/add', '\App\Http\Controllers\Admin\TestManagementsController@add')
    ->name('admin.testManagements.add');

Route::post('/test-management/add', '\App\Http\Controllers\Admin\TestManagementsController@add')
    ->name('admin.testManagements.add');

Route::get('/test-management/{id}/view', '\App\Http\Controllers\Admin\TestManagementsController@view')
    ->name('admin.testManagements.view');

// Route::post('/ notices/{id}/view', '\App\Http\Controllers\Admin\TestManagementsController@view')
//     ->name('admin.testManagements.view');

Route::get('/test-management/{id}/edit', '\App\Http\Controllers\Admin\TestManagementsController@edit')
    ->name('admin.testManagements.edit');

Route::post('/test-management/{id}/edit', '\App\Http\Controllers\Admin\TestManagementsController@edit')
    ->name('admin.testManagements.edit');

Route::post('/test-management/bulkActions/{action}', '\App\Http\Controllers\Admin\TestManagementsController@bulkActions')
    ->name('admin.testManagements.bulkActions');

Route::get('/test-management/{id}/delete', '\App\Http\Controllers\Admin\TestManagementsController@delete')
    ->name('admin.testManagements.delete');

Route::post('/test-order-remark', '\App\Http\Controllers\Admin\TestManagementsController@testOrderRemark')
    ->name('admin.testOrder.remark');

Route::post('/test-order/mark-disclose', '\App\Http\Controllers\Admin\TestManagementsController@markDisclose')
    ->name('admin.mark.disclose');

Route::post('/test-order/mark-disclose-upload-file', '\App\Http\Controllers\Admin\TestManagementsController@markDiscloseUploadFile')
    ->name('admin.mark.disclose.uploadFile');