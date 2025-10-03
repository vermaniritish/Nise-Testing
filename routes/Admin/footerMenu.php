<?php
Route::get('/footer-menu', '\App\Http\Controllers\Admin\FooterMenuController@index')
    ->name('admin.footerMenu');

Route::get('/footer-menu/add', '\App\Http\Controllers\Admin\FooterMenuController@add')
    ->name('admin.footerMenu.add');

Route::post('/footer-menu/add', '\App\Http\Controllers\Admin\FooterMenuController@add')
    ->name('admin.footerMenu.add');

Route::get('/footer-menu/{id}/view', '\App\Http\Controllers\Admin\FooterMenuController@view')
    ->name('admin.footerMenu.view');

Route::post('/footer-menu/{id}/view', '\App\Http\Controllers\Admin\FooterMenuController@view')
    ->name('admin.footerMenu.view');


Route::post('/footer-menu/import', '\App\Http\Controllers\Admin\FooterMenuController@import')
    ->name('admin.footerMenu.import');

Route::get('/footer-menu/{id}/edit', '\App\Http\Controllers\Admin\FooterMenuController@edit')
    ->name('admin.footerMenu.edit');

Route::post('/footer-menu/{id}/edit', '\App\Http\Controllers\Admin\FooterMenuController@edit')
    ->name('admin.footerMenu.edit');

Route::post('/footer-menu/bulkActions/{action}', '\App\Http\Controllers\Admin\FooterMenuController@bulkActions')
    ->name('admin.footerMenu.bulkActions');

Route::get('/footer-menu/{id}/delete', '\App\Http\Controllers\Admin\FooterMenuController@delete')
    ->name('admin.footerMenu.delete');
