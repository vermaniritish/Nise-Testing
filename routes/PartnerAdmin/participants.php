<?php
Route::get('/manage-participant', '\App\Http\Controllers\PartnerAdmin\ParticipantsController@index')
    ->name('partnerAdmin.participant');

Route::get('/manage-participant/add', '\App\Http\Controllers\PartnerAdmin\ParticipantsController@add')
    ->name('partnerAdmin.participant.add');

Route::post('/manage-participant/add', '\App\Http\Controllers\PartnerAdmin\ParticipantsController@add')
    ->name('partnerAdmin.participant.add');

Route::get('/manage-participant/{id}/edit', '\App\Http\Controllers\PartnerAdmin\ParticipantsController@edit')
    ->name('partnerAdmin.participant.edit');

Route::post('/manage-participant/{id}/edit', '\App\Http\Controllers\PartnerAdmin\ParticipantsController@edit')
    ->name('partnerAdmin.participant.edit');

Route::get('/get-districts/{state_id}', '\App\Http\Controllers\PartnerAdmin\ParticipantsController@getDistricts')
    ->name('districts.get');

Route::get('/manage-participant/{id}/delete', '\App\Http\Controllers\PartnerAdmin\ParticipantsController@delete')
    ->name('partnerAdmin.participant.delete');

Route::get('/participant/export-excel', '\App\Http\Controllers\PartnerAdmin\ParticipantsController@exportExcel')
    ->name('participant.export.excel');

Route::get('/participant/export-csv', '\App\Http\Controllers\PartnerAdmin\ParticipantsController@exportCSV')
    ->name('participant.export.csv');

Route::get('/participant/export-pdf', '\App\Http\Controllers\PartnerAdmin\ParticipantsController@exportPDF')
    ->name('participant.export.pdf');
