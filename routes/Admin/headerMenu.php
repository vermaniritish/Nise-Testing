<?php
Route::get('/header-menu', '\App\Http\Controllers\Admin\HeaderMenuController@index')
    ->name('admin.headerMenu');

Route::get('/header-menu/add', '\App\Http\Controllers\Admin\HeaderMenuController@add')
    ->name('admin.headerMenu.add');

Route::post('/header-menu/add', '\App\Http\Controllers\Admin\HeaderMenuController@add')
    ->name('admin.headerMenu.add');

Route::get('/header-menu/{id}/view', '\App\Http\Controllers\Admin\HeaderMenuController@view')
    ->name('admin.headerMenu.view');

Route::post('/header-menu/{id}/view', '\App\Http\Controllers\Admin\HeaderMenuController@view')
    ->name('admin.headerMenu.view');


Route::post('/header-menu/import', '\App\Http\Controllers\Admin\HeaderMenuController@import')
    ->name('admin.headerMenu.import');

Route::get('/header-menu/{id}/edit', '\App\Http\Controllers\Admin\HeaderMenuController@edit')
    ->name('admin.headerMenu.edit');

Route::post('/header-menu/{id}/edit', '\App\Http\Controllers\Admin\HeaderMenuController@edit')
    ->name('admin.headerMenu.edit');

Route::post('/header-menu/bulkActions/{action}', '\App\Http\Controllers\Admin\HeaderMenuController@bulkActions')
    ->name('admin.headerMenu.bulkActions');

Route::get('/header-menu/{id}/delete', '\App\Http\Controllers\Admin\HeaderMenuController@delete')
    ->name('admin.headerMenu.delete');
