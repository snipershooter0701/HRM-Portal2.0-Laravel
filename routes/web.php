<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    
    // Dashboard
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::post('/home/gen', [App\Http\Controllers\HomeController::class, 'genEmailPwd']);

    // Employee
    Route::get('/employee', [App\Http\Controllers\EmployeeController::class, 'index']);
    Route::post('/employee/get-employees', [App\Http\Controllers\EmployeeController::class, 'getEmployees']);
    Route::post('/employee/get-add-histories', [App\Http\Controllers\EmployeeController::class, 'getAddHistories']);
    Route::post('/employee/get-add-placements', [App\Http\Controllers\EmployeeController::class, 'getAddPlacements']);
    Route::post('/employee/get-request-details', [App\Http\Controllers\EmployeeController::class, 'getRequestDetails']);

    // Client
    Route::get('/client', [App\Http\Controllers\ClientController::class, 'index']);
    Route::post('/client/get_clients', [App\Http\Controllers\ClientController::class, 'getClients']);
    // Add client
    Route::post('/client/get_business_info', [App\Http\Controllers\ClientController::class, 'getBusinessInfo']);
    Route::post('/client/get_contact_info', [App\Http\Controllers\ClientController::class, 'getContactInfo']);
    Route::post('/client/get_add_confidential', [App\Http\Controllers\ClientController::class, 'getAddConfidential']);
    Route::post('/client/get_placements', [App\Http\Controllers\ClientController::class, 'getPlacements']);
    Route::post('/client/get_activities', [App\Http\Controllers\ClientController::class, 'getActivities']);
    Route::post('/client/get_addplacement_activities', [App\Http\Controllers\ClientController::class, 'getActivities']);
    Route::post('/client/get_invoices', [App\Http\Controllers\ClientController::class, 'getInvoices']);
    Route::post('/client/get_documents', [App\Http\Controllers\ClientController::class, 'getDocuments']);
    // All Placements
    Route::get('/client/all_placements', [App\Http\Controllers\ClientController::class, 'index_all_placements']);
    Route::post('/client/get_all_placement', [App\Http\Controllers\ClientController::class, 'getAllPlacements']);
    // All Documents
    Route::get('/client/all_documents', [App\Http\Controllers\ClientController::class, 'index_all_documents']);
    Route::post('/client/get_all_document', [App\Http\Controllers\ClientController::class, 'getAllDocuments']);
    
    // Timesheet
    Route::get('/timesheets', [App\Http\Controllers\TimesheetsController::class, 'index']);
    Route::post('/timesheets/all-timesheets/get-timesheets', [App\Http\Controllers\TimesheetsController::class, 'getAllTimesheets']);
    Route::post('/timesheets/due-timesheets/get-timesheets', [App\Http\Controllers\TimesheetsController::class, 'getDueTimesheets']);
    Route::post('/timesheets/await-invoices/get-invoices', [App\Http\Controllers\TimesheetsController::class, 'getAwaitInvoices']);
    Route::post('/timesheets/submit-timesheet/get-timesheets', [App\Http\Controllers\TimesheetsController::class, 'getSubmitTimesheets']);

    // Settings
    Route::get('/settings', [App\Http\Controllers\SettingController::class, 'index']);
    Route::get('/settings/role_permission', [App\Http\Controllers\SettingController::class, 'index_role_permission']);
    Route::get('/settings/module_security', [App\Http\Controllers\SettingController::class, 'index_module_security']);
    Route::get('/settings/create_new_company', [App\Http\Controllers\SettingController::class, 'index_create_new_company']);
    Route::get('/settings/application_setting', [App\Http\Controllers\SettingController::class, 'index_application_setting']);
    Route::get('/settings/backup_download', [App\Http\Controllers\SettingController::class, 'index_backup_download']);

    Route::post('/settings/get_level_list', [App\Http\Controllers\SettingController::class, 'getLevelList']);
    Route::post('/settings/get_role_permission', [App\Http\Controllers\SettingController::class, 'getRolePermission']);
    Route::post('/settings/get_module_security', [App\Http\Controllers\SettingController::class, 'getModuleSecurity']);
    Route::post('/settings/get_create_new_company', [App\Http\Controllers\SettingController::class, 'getCreateNewCompany']);
    Route::post('/settings/get_application_setting', [App\Http\Controllers\SettingController::class, 'getApplicationSetting']);
    Route::post('/settings/get_backup_download', [App\Http\Controllers\SettingController::class, 'getBackupDownload']);
    Route::post('/settings/level_list/get_activities', [App\Http\Controllers\SettingController::class, 'getActivity']);
    
});