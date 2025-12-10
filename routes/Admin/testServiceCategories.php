<?php
Route::get('/testing-service-category', '\App\Http\Controllers\Admin\TestServiceCategoriesController@index')
    ->name('admin.testServiceCategories');

Route::get('/testing-service-category/add', '\App\Http\Controllers\Admin\TestServiceCategoriesController@add')
    ->name('admin.testServiceCategories.add');

Route::post('/testing-service-category/add', '\App\Http\Controllers\Admin\TestServiceCategoriesController@add')
    ->name('admin.testServiceCategories.add');

Route::get('/testing-service-category/{id}/view', '\App\Http\Controllers\Admin\TestServiceCategoriesController@view')
    ->name('admin.testServiceCategories.view');

// Route::post('/ notices/{id}/view', '\App\Http\Controllers\Admin\TestServiceCategoriesController@view')
//     ->name('admin.testServiceCategories.view');

Route::get('/testing-service-category/{id}/edit', '\App\Http\Controllers\Admin\TestServiceCategoriesController@edit')
    ->name('admin.testServiceCategories.edit');

Route::post('/testing-service-category/{id}/edit', '\App\Http\Controllers\Admin\TestServiceCategoriesController@edit')
    ->name('admin.testServiceCategories.edit');

Route::post('/testing-service-category/bulkActions/{action}', '\App\Http\Controllers\Admin\TestServiceCategoriesController@bulkActions')
    ->name('admin.testServiceCategories.bulkActions');

Route::get('/testing-service-category/{id}/delete', '\App\Http\Controllers\Admin\TestServiceCategoriesController@delete')
    ->name('admin.testServiceCategories.delete');
