<?php
Route::get('/slider-menu', '\App\Http\Controllers\Admin\SliderMenuController@index')
    ->name('admin.sliderMenu');

Route::get('/slider-menu/add', '\App\Http\Controllers\Admin\SliderMenuController@add')
    ->name('admin.sliderMenu.add');

Route::post('/slider-menu/add', '\App\Http\Controllers\Admin\SliderMenuController@add')
    ->name('admin.sliderMenu.add');

Route::get('/slider-menu/{id}/view', '\App\Http\Controllers\Admin\SliderMenuController@view')
    ->name('admin.sliderMenu.view');

// Route::post('/ slider-menu/{id}/view', '\App\Http\Controllers\Admin\SliderMenuController@view')
//     ->name('admin.sliderMenu.view');

Route::get('/slider-menu/{id}/edit', '\App\Http\Controllers\Admin\SliderMenuController@edit')
    ->name('admin.sliderMenu.edit');

Route::post('/slider-menu/{id}/edit', '\App\Http\Controllers\Admin\SliderMenuController@edit')
    ->name('admin.sliderMenu.edit');

Route::post('/slider-menu/bulkActions/{action}', '\App\Http\Controllers\Admin\SliderMenuController@bulkActions')
    ->name('admin.sliderMenu.bulkActions');

Route::get('/slider-menu/{id}/delete', '\App\Http\Controllers\Admin\SliderMenuController@delete')
    ->name('admin.sliderMenu.delete');
