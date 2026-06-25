<?php
Route::get('/menu', '\App\Http\Controllers\Admin\MenuController@index')
    ->name('admin.menu');

Route::get('/menu/add', '\App\Http\Controllers\Admin\MenuController@add')
    ->name('admin.menu.add');

Route::post('/header/menu/add', '\App\Http\Controllers\Admin\MenuController@add')
    ->name('admin.hedaerMenu.add');

Route::get('/menu/getMenuItems', '\App\Http\Controllers\Admin\MenuController@getMenuItems')
    ->name('admin.menu.getMenuItems');

Route::post('/menu/{id}/view', '\App\Http\Controllers\Admin\MenuController@view')
    ->name('admin.menu.view');

Route::post('/footer-menu/add', '\App\Http\Controllers\Admin\MenuController@addFooterMenu')
    ->name('admin.footerMenu.add');

Route::post('/courses-menu/add', '\App\Http\Controllers\Admin\MenuController@addCoursesMenu')
    ->name('admin.coursesMenu.add');

Route::post('/information-menu/add', '\App\Http\Controllers\Admin\MenuController@addInformationMenu')
    ->name('admin.informationMenu.add');

Route::post('/other-links-menu/add', '\App\Http\Controllers\Admin\MenuController@addOtherLinksMenu')
    ->name('admin.otherLinksMenu.add');

Route::get('menu/delete/{id}', '\App\Http\Controllers\Admin\MenuController@deleteMenuItem')->name('menu.delete');

