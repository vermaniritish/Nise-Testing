<?php
Route::get('/notices', '\App\Http\Controllers\Admin\NoticesController@index')
    ->name('admin.notices');

Route::get('/notices/add', '\App\Http\Controllers\Admin\NoticesController@add')
    ->name('admin.notices.add');

Route::post('/notices/add', '\App\Http\Controllers\Admin\NoticesController@add')
    ->name('admin.notices.add');

Route::get('/notices/{id}/view', '\App\Http\Controllers\Admin\NoticesController@view')
    ->name('admin.notices.view');

// Route::post('/ notices/{id}/view', '\App\Http\Controllers\Admin\NoticesController@view')
//     ->name('admin.notices.view');

Route::get('/notices/{id}/edit', '\App\Http\Controllers\Admin\NoticesController@edit')
    ->name('admin.notices.edit');

Route::post('/notices/{id}/edit', '\App\Http\Controllers\Admin\NoticesController@edit')
    ->name('admin.notices.edit');

Route::post('/notices/bulkActions/{action}', '\App\Http\Controllers\Admin\NoticesController@bulkActions')
    ->name('admin.notices.bulkActions');

Route::get('/notices/{id}/delete', '\App\Http\Controllers\Admin\NoticesController@delete')
    ->name('admin.notices.delete');
