<?php
Route::get('/manage-participant', '\App\Http\Controllers\Admin\ParticipantsController@index')
    ->name('admin.participant');

Route::get('/manage-participant/add/{id?}', '\App\Http\Controllers\Admin\ParticipantsController@add')
    ->name('admin.participant.add');

Route::post('/manage-participant/add/{id?}', '\App\Http\Controllers\Admin\ParticipantsController@add')
    ->name('admin.participant.add');

Route::get('/manage-participant/{id}/edit', '\App\Http\Controllers\Admin\ParticipantsController@edit')
    ->name('admin.participant.edit');

Route::post('/manage-participant/{id}/edit', '\App\Http\Controllers\Admin\ParticipantsController@edit')
    ->name('admin.participant.edit');

Route::get('/get-districts/{state_id}', '\App\Http\Controllers\Admin\ParticipantsController@getDistricts')
    ->name('districts.get');

Route::get('/manage-participant/{id}/delete', '\App\Http\Controllers\Admin\ParticipantsController@delete')
    ->name('admin.participant.delete');

Route::get('/participant/export-excel', '\App\Http\Controllers\Admin\ParticipantsController@exportExcel')
    ->name('participant.export.excel');

Route::get('/participant/export-csv', '\App\Http\Controllers\Admin\ParticipantsController@exportCSV')
    ->name('participant.export.csv');

Route::get('/participant/export-pdf', '\App\Http\Controllers\Admin\ParticipantsController@exportPDF')
    ->name('participant.export.pdf');
