<?php
Route::get('/manage-center', '\App\Http\Controllers\Admin\CenterController@index')
    ->name('admin.manageCenter');

Route::get('/manage-center/add', '\App\Http\Controllers\Admin\CenterController@add')
    ->name('admin.manageCenter.add');

Route::post('/manage-center/add', '\App\Http\Controllers\Admin\CenterController@add')
    ->name('admin.manageCenter.add');

Route::get('/manage-center/{id}/edit', '\App\Http\Controllers\Admin\CenterController@edit')
    ->name('admin.manageCenter.edit');

Route::post('/manage-center/{id}/edit', '\App\Http\Controllers\Admin\CenterController@edit')
    ->name('admin.manageCenter.edit');

Route::get('/manage-center/{id}/delete', '\App\Http\Controllers\Admin\CenterController@delete')
    ->name('admin.manageCenter.delete');