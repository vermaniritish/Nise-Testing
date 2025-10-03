
<?php
Route::get('/video-gallery', '\App\Http\Controllers\Admin\VideoGalleryController@index')
    ->name('admin.videoGallery');

Route::get('/video-gallery/{id}/view', '\App\Http\Controllers\Admin\VideoGalleryController@view')
    ->name('admin.videoGallery.view');

Route::get('/video-gallery/{id}/update-status/{status}', '\App\Http\Controllers\Admin\VideoGalleryController@updateStatus')
    ->name('admin.videoGallery.updateStatus');


Route::post('/video-gallery/import', '\App\Http\Controllers\Admin\VideoGalleryController@import')
    ->name('admin.videoGallery.import');

Route::get('/video-gallery/{id}/edit', '\App\Http\Controllers\Admin\VideoGalleryController@edit')
    ->name('admin.videoGallery.edit');

Route::post('/video-gallery/{id}/edit', '\App\Http\Controllers\Admin\VideoGalleryController@edit')
    ->name('admin.videoGallery.edit');

Route::post('/video-gallery/bulkActions/{action}', '\App\Http\Controllers\Admin\VideoGalleryController@bulkActions')
    ->name('admin.videoGallery.bulkActions');

Route::get('/video-gallery/{id}/delete', '\App\Http\Controllers\Admin\VideoGalleryController@delete')
    ->name('admin.videoGallery.delete');

Route::get('/video-gallery/add', '\App\Http\Controllers\Admin\VideoGalleryController@add')
    ->name('admin.videoGallery.add');

Route::post('/video-gallery/add', '\App\Http\Controllers\Admin\VideoGalleryController@add')
    ->name('admin.videoGallery.add');
