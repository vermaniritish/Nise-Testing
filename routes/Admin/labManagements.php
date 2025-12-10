<?php
Route::get('/lab-management', '\App\Http\Controllers\Admin\LabManagementsController@index')
    ->name('admin.labManagements');

Route::get('/lab-management/add', '\App\Http\Controllers\Admin\LabManagementsController@add')
    ->name('admin.labManagements.add');

Route::post('/lab-management/add', '\App\Http\Controllers\Admin\LabManagementsController@add')
    ->name('admin.labManagements.add');

Route::get('/lab-management/{id}/view', '\App\Http\Controllers\Admin\LabManagementsController@view')
    ->name('admin.labManagements.view');

// Route::post('/ notices/{id}/view', '\App\Http\Controllers\Admin\LabManagementsController@view')
//     ->name('admin.labManagements.view');

Route::get('/lab-management/{id}/edit', '\App\Http\Controllers\Admin\LabManagementsController@edit')
    ->name('admin.labManagements.edit');

Route::post('/lab-management/{id}/edit', '\App\Http\Controllers\Admin\LabManagementsController@edit')
    ->name('admin.labManagements.edit');

Route::post('/lab-management/bulkActions/{action}', '\App\Http\Controllers\Admin\LabManagementsController@bulkActions')
    ->name('admin.labManagements.bulkActions');

Route::get('/lab-management/{id}/delete', '\App\Http\Controllers\Admin\LabManagementsController@delete')
    ->name('admin.labManagements.delete');
