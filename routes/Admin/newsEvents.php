<?php
Route::get('/news-events', '\App\Http\Controllers\Admin\NewsEventsController@index')
    ->name('admin.newsEvents');

Route::get('/news-events/add', '\App\Http\Controllers\Admin\NewsEventsController@add')
    ->name('admin.newsEvents.add');

Route::post('/news-events/add', '\App\Http\Controllers\Admin\NewsEventsController@add')
    ->name('admin.newsEvents.add');

Route::get('/news-events/{id}/view', '\App\Http\Controllers\Admin\NewsEventsController@view')
    ->name('admin.newsEvents.view');

Route::get('/news-events/{id}/edit', '\App\Http\Controllers\Admin\NewsEventsController@edit')
    ->name('admin.newsEvents.edit');

Route::post('/news-events/{id}/edit', '\App\Http\Controllers\Admin\NewsEventsController@edit')
    ->name('admin.newsEvents.edit');

Route::post('/news-events/bulkActions/{action}', '\App\Http\Controllers\Admin\NewsEventsController@bulkActions')
    ->name('admin.newsEvents.bulkActions');

Route::get('/news-events/{id}/delete', '\App\Http\Controllers\Admin\NewsEventsController@delete')
    ->name('admin.newsEvents.delete');