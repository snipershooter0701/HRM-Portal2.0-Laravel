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
    // Client - (Add client)
    Route::post('/client/get_business_info', [App\Http\Controllers\ClientController::class, 'getBusinessInfo']);
    Route::post('/client/get_contact_info', [App\Http\Controllers\ClientController::class, 'getContactInfo']);
    Route::post('/client/get_add_confidential', [App\Http\Controllers\ClientController::class, 'getAddConfidential']);
    Route::post('/client/get_placements', [App\Http\Controllers\ClientController::class, 'getPlacements']);
    Route::post('/client/get_activities', [App\Http\Controllers\ClientController::class, 'getActivities']);
    Route::post('/client/get_addplacement_activities', [App\Http\Controllers\ClientController::class, 'getActivities']);
    Route::post('/client/get_invoices', [App\Http\Controllers\ClientController::class, 'getInvoices']);
    Route::post('/client/get_documents', [App\Http\Controllers\ClientController::class, 'getDocuments']);
    // Client - (All Placements)
    Route::get('/client/all_placements', [App\Http\Controllers\ClientController::class, 'index_all_placements']);
    Route::post('/client/get_all_placement', [App\Http\Controllers\ClientController::class, 'getAllPlacements']);
    // Client - (All Documents)
    Route::get('/client/all_documents', [App\Http\Controllers\ClientController::class, 'index_all_documents']);
    Route::post('/client/get_all_document', [App\Http\Controllers\ClientController::class, 'getAllDocuments']);
    Route::post('/client/get_old_confidentials', [App\Http\Controllers\ClientController::class, 'getOldConfidentials']);

    // Timesheet
    Route::get('/timesheets', [App\Http\Controllers\TimesheetsController::class, 'index']);
    Route::post('/timesheets/all-timesheets/get-timesheets', [App\Http\Controllers\TimesheetsController::class, 'getAllTimesheets']);
    Route::post('/timesheets/due-timesheets/get-timesheets', [App\Http\Controllers\TimesheetsController::class, 'getDueTimesheets']);
    Route::post('/timesheets/await-invoices/get-invoices', [App\Http\Controllers\TimesheetsController::class, 'getAwaitInvoices']);
    Route::post('/timesheets/submit-timesheet/get-timesheets', [App\Http\Controllers\TimesheetsController::class, 'getSubmitTimesheets']);

    // Expenses
    Route::get('/expenses', [App\Http\Controllers\ExpensesController::class, 'index']);
    Route::post('/expenses/get-expenses', [App\Http\Controllers\ExpensesController::class, 'getExpenses']);
    Route::post('/expenses/get-expenses-activities', [App\Http\Controllers\ExpensesController::class, 'getExpenseActvities']);
    Route::post('/expenses/get-add-expenses', [App\Http\Controllers\ExpensesController::class, 'getAddExpenses']);

    // Invoices - (All Invoices)
    Route::get('/invoices/all-inv', [App\Http\Controllers\InvoiceAllController::class, 'index']);
    Route::post('/invoices/all-inv/get-invs', [App\Http\Controllers\InvoiceAllController::class, 'getInvoices']);
    Route::post('/invoices/all-inv/get-svc-smrys', [App\Http\Controllers\InvoiceAllController::class, 'getSvcSmrys']);
    Route::post('/invoices/all-inv/get-note-totals', [App\Http\Controllers\InvoiceAllController::class, 'getNoteTotals']);
    
    // Invoices - (Due Invoices)
    Route::get('/invoices/due-inv', [App\Http\Controllers\InvoiceDueController::class, 'index']);
    Route::post('/invoices/due-inv/get-activities', [App\Http\Controllers\InvoiceDueController::class, 'getActivities']);

    // Invoices - (Awaiting Invoices)
    Route::get('/invoices/await-inv', [App\Http\Controllers\InvoiceAwaitController::class, 'index']);
    Route::post('/invoices/await-inv/get-invs', [App\Http\Controllers\InvoiceAwaitController::class, 'getInvoices']);

    // Invoices - (Client Payments)
    Route::get('/invoices/client-pay', [App\Http\Controllers\InvoiceCliPayController::class, 'index']);
    Route::post('/invoices/client-pay/get_payments', [App\Http\Controllers\InvoiceCliPayController::class, 'getPayments']);

    // Invoices - (Employee Payments)
    Route::get('/invoices/employee-pay', [App\Http\Controllers\InvoiceEmpPayController::class, 'index']);
    Route::post('/invoices/employee-pay/get_payments', [App\Http\Controllers\InvoiceEmpPayController::class, 'getPayments']);

    // Tickets
    Route::get('/tickets', [App\Http\Controllers\TicketController::class, 'index']);
    Route::post('/tickets/get-all-tickets', [App\Http\Controllers\TicketController::class, 'getAllTickets']);
    Route::post('/tickets/get-emp-tickets', [App\Http\Controllers\TicketController::class, 'getEmpTickets']);

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
   
    // Documentation
    Route::get('/documentation', [App\Http\Controllers\DocumentationController::class, 'index']);
    Route::post('/documentation/get-org-docs', [App\Http\Controllers\DocumentationController::class, 'getOrgDocs']);
    Route::post('/documentation/get-emp-docs', [App\Http\Controllers\DocumentationController::class, 'getEmpDocs']);
    Route::post('/documentation/get-exp-docs', [App\Http\Controllers\DocumentationController::class, 'getExpDocs']);
    Route::post('/documentation/get-group-docs', [App\Http\Controllers\DocumentationController::class, 'getGroupDocs']);
});