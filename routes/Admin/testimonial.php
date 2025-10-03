<?php
Route::get('/testimonial', '\App\Http\Controllers\Admin\TestimonialController@index')
    ->name('admin.testimonial');

Route::get('/testimonial/add', '\App\Http\Controllers\Admin\TestimonialController@add')
    ->name('admin.testimonial.add');

Route::post('/testimonial/add', '\App\Http\Controllers\Admin\TestimonialController@add')
    ->name('admin.testimonial.add');

Route::get('/testimonial/{id}/view', '\App\Http\Controllers\Admin\TestimonialController@view')
    ->name('admin.testimonial.view');

Route::post('/testimonial/{id}/view', '\App\Http\Controllers\Admin\TestimonialController@view')
    ->name('admin.testimonial.view');


Route::post('/testimonial/import', '\App\Http\Controllers\Admin\TestimonialController@import')
    ->name('admin.testimonial.import');

Route::get('/testimonial/{id}/edit', '\App\Http\Controllers\Admin\TestimonialController@edit')
    ->name('admin.testimonial.edit');

Route::post('/testimonial/{id}/edit', '\App\Http\Controllers\Admin\TestimonialController@edit')
    ->name('admin.testimonial.edit');

Route::post('/testimonial/bulkActions/{action}', '\App\Http\Controllers\Admin\TestimonialController@bulkActions')
    ->name('admin.testimonial.bulkActions');

Route::get('/testimonial/{id}/delete', '\App\Http\Controllers\Admin\TestimonialController@delete')
    ->name('admin.testimonial.delete');