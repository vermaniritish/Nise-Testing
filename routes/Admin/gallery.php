
<?php
//    Route::get('/gallery', '\App\Http\Controllers\Admin\SettingsController@galleryIndex')
//    ->name('admin.gallery');
//    Route::post('/gallery/add', '\App\Http\Controllers\Admin\SettingsController@storeGallery')
//    ->name('admin.gallery.add');




Route::get('/gallery', '\App\Http\Controllers\Admin\GalleryController@index')
    ->name('admin.gallery');

Route::get('/gallery/{id}/view', '\App\Http\Controllers\Admin\GalleryController@view')
    ->name('admin.gallery.view');

    Route::get('/gallery/{id}/update-status/{status}', '\App\Http\Controllers\Admin\GalleryController@updateStatus')
    ->name('admin.gallery.updateStatus');


Route::post('/gallery/import', '\App\Http\Controllers\Admin\GalleryController@import')
    ->name('admin.gallery.import');

Route::get('/gallery/{id}/edit', '\App\Http\Controllers\Admin\GalleryController@edit')
    ->name('admin.gallery.edit');

Route::post('/gallery/{id}/edit', '\App\Http\Controllers\Admin\GalleryController@edit')
    ->name('admin.gallery.edit');

Route::post('/gallery/bulkActions/{action}', '\App\Http\Controllers\Admin\GalleryController@bulkActions')
    ->name('admin.gallery.bulkActions');

Route::get('/gallery/{id}/delete', '\App\Http\Controllers\Admin\GalleryController@delete')
    ->name('admin.gallery.delete');

    Route::get('/gallery/add', '\App\Http\Controllers\Admin\GalleryController@add')
    ->name('admin.gallery.add');

Route::post('/gallery/add', '\App\Http\Controllers\Admin\GalleryController@add')
    ->name('admin.gallery.add');
