<?php
Route::get('/partner-training', '\App\Http\Controllers\Admin\userManagementController@index')
    ->name('admin.userManagement.partnerTraining');

Route::get('/approve-center', '\App\Http\Controllers\Admin\userManagementController@approveCenter')
    ->name('admin.userManagement.approveCenter');

Route::get('/pending-center', '\App\Http\Controllers\Admin\userManagementController@pendingCenter')
    ->name('admin.userManagement.pendingCenter');

Route::get('/state-wise-center', '\App\Http\Controllers\Admin\userManagementController@stateWiseCenter')
    ->name('admin.userManagement.stateWiseCenter');

Route::get('/suryamitra-institute-passed-students-details', '\App\Http\Controllers\Admin\userManagementController@SuryaInstPasStuDetails')
    ->name('admin.userManagement.SuryaInstPasStuDetails');

Route::get('/center-wise-batch-details', '\App\Http\Controllers\Admin\userManagementController@CenterWiseBatchDetails')
    ->name('admin.userManagement.centerWiseBatchDetails');

Route::get('/partner-training/add', '\App\Http\Controllers\Admin\userManagementController@add')
    ->name('admin.userManagement.partnerTraining.add');

Route::post('/partner-training/add', '\App\Http\Controllers\Admin\userManagementController@add')
    ->name('admin.userManagement.partnerTraining.add');

Route::get('/partner-training/{id}/delete', '\App\Http\Controllers\Admin\userManagementController@delete')
    ->name('admin.userManagement.partnerTraining.delete');