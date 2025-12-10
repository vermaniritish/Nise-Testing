<?php
Route::get('/service-category-wise-test', '\App\Http\Controllers\Admin\ServiceCategoryWiseTestsController@index')
    ->name('admin.serviceCategoryWiseTests');

Route::get('/service-category-wise-test/add', '\App\Http\Controllers\Admin\ServiceCategoryWiseTestsController@add')
    ->name('admin.serviceCategoryWiseTests.add');

Route::post('/service-category-wise-test/add', '\App\Http\Controllers\Admin\ServiceCategoryWiseTestsController@add')
    ->name('admin.serviceCategoryWiseTests.add');

Route::get('/service-category-wise-test/{id}/view', '\App\Http\Controllers\Admin\ServiceCategoryWiseTestsController@view')
    ->name('admin.serviceCategoryWiseTests.view');

// Route::post('/ notices/{id}/view', '\App\Http\Controllers\Admin\ServiceCategoryWiseTestsController@view')
//     ->name('admin.serviceCategoryWiseTests.view');

Route::get('/service-category-wise-test/{id}/edit', '\App\Http\Controllers\Admin\ServiceCategoryWiseTestsController@edit')
    ->name('admin.serviceCategoryWiseTests.edit');

Route::post('/service-category-wise-test/{id}/edit', '\App\Http\Controllers\Admin\ServiceCategoryWiseTestsController@edit')
    ->name('admin.serviceCategoryWiseTests.edit');

Route::post('/service-category-wise-test/bulkActions/{action}', '\App\Http\Controllers\Admin\ServiceCategoryWiseTestsController@bulkActions')
    ->name('admin.serviceCategoryWiseTests.bulkActions');

Route::get('/service-category-wise-test/{id}/delete', '\App\Http\Controllers\Admin\ServiceCategoryWiseTestsController@delete')
    ->name('admin.serviceCategoryWiseTests.delete');
