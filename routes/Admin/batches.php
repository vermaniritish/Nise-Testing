<?php
Route::get('/manage-batche', '\App\Http\Controllers\Admin\BatchesController@index')
    ->name('admin.manageBatche');

Route::get('/batche/allocation', '\App\Http\Controllers\Admin\BatchesController@batchAllocation')
    ->name('admin.batche.allocation');

Route::post('/admin/batches/save-allocation', '\App\Http\Controllers\Admin\BatchesController@saveBatchAllocation')
    ->name('admin.saveBatchAllocation');

Route::get('/manage-batche/add', '\App\Http\Controllers\Admin\BatchesController@add')
    ->name('admin.manageBatche.add');

Route::post('/manage-batche/add', '\App\Http\Controllers\Admin\BatchesController@add')
    ->name('admin.manageBatche.add');

Route::get('/manage-batche/{id}/edit', '\App\Http\Controllers\Admin\BatchesController@edit')
    ->name('admin.manageBatche.edit');

Route::post('/manage-batche/{id}/edit', '\App\Http\Controllers\Admin\BatchesController@edit')
    ->name('admin.manageBatche.edit');