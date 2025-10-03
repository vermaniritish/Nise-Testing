<?php
Route::get('/home-categories', '\App\Http\Controllers\Admin\HomeCategoriesController@index')
    ->name('admin.homeCategories');

Route::get('/home-categories/add', '\App\Http\Controllers\Admin\HomeCategoriesController@add')
    ->name('admin.homeCategories.add');

Route::post('/home-categories/add', '\App\Http\Controllers\Admin\HomeCategoriesController@add')
    ->name('admin.homeCategories.add');

Route::get('/home-categories/{id}/view', '\App\Http\Controllers\Admin\HomeCategoriesController@view')
    ->name('admin.homeCategories.view');

// Route::post('/ home-categories/{id}/view', '\App\Http\Controllers\Admin\HomeCategoriesController@view')
//     ->name('admin.homeCategories.view');

Route::get('/home-categories/{id}/edit', '\App\Http\Controllers\Admin\HomeCategoriesController@edit')
    ->name('admin.homeCategories.edit');

Route::post('/home-categories/{id}/edit', '\App\Http\Controllers\Admin\HomeCategoriesController@edit')
    ->name('admin.homeCategories.edit');

Route::post('/home-categories/bulkActions/{action}', '\App\Http\Controllers\Admin\HomeCategoriesController@bulkActions')
    ->name('admin.homeCategories.bulkActions');

Route::get('/home-categories/{id}/delete', '\App\Http\Controllers\Admin\HomeCategoriesController@delete')
    ->name('admin.homeCategories.delete');

