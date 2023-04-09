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


    Route::prefix("employee")->group(function () {
        // Employee - All Employees
        Route::prefix('all_employees')->group(function () {
            Route::get('/', [App\Http\Controllers\EmployeeController::class, 'index']);
            Route::post('/list', [App\Http\Controllers\EmployeeController::class, 'getEmployeeList']);
            Route::post('/by_id', [App\Http\Controllers\EmployeeController::class, 'getEmployeeByID']);
            Route::post('/add', [App\Http\Controllers\EmployeeController::class, 'addEmployee']);
            Route::post('/view', [App\Http\Controllers\EmployeeController::class, 'viewEmployee']);
            Route::post('/update', [App\Http\Controllers\EmployeeController::class, 'updateEmployee']);
            Route::post('/del', [App\Http\Controllers\EmployeeController::class, 'deleteEmployee']);
            Route::post('/act', [App\Http\Controllers\EmployeeController::class, 'getEmpAct']);
            Route::post('/get-add-placements', [App\Http\Controllers\EmployeeController::class, 'getAddPlacements']);
        });
        // Employee - All Request Details
        Route::prefix('all_request_details')->group(function () {
            Route::get('/', [App\Http\Controllers\EmployeeRequestController::class, 'index']);
            Route::post('/list', [App\Http\Controllers\EmployeeRequestController::class, 'getRequestDetailsList']);
            Route::post('/by_id', [App\Http\Controllers\EmployeeRequestController::class, 'getRequestDetailsByID']);
            Route::post('/add', [App\Http\Controllers\EmployeeRequestController::class, 'addRequestDetails']);
            Route::post('/update', [App\Http\Controllers\EmployeeRequestController::class, 'updateRequestDetails']);
            Route::post('/del', [App\Http\Controllers\EmployeeRequestController::class, 'deleteRequestDetails']);
            Route::post('/act', [App\Http\Controllers\EmployeeRequestController::class, 'getReqAct']);
        });
    });

    // Client
    Route::prefix('client')->group(function () {
        // List Page
        Route::get('/list', [App\Http\Controllers\ClientListController::class, 'index']);
        Route::post('/list/get_tbl_client_list', [App\Http\Controllers\ClientListController::class, 'getTableClientList']);
        Route::post('/list/get_tbl_client_acts_list', [App\Http\Controllers\ClientListController::class, 'getTableClientActsList']);
        Route::get('/list/get_client', [App\Http\Controllers\ClientListController::class, 'getClientById']);

        // Client (Business Info)
        Route::post('/list/create_business_info', [App\Http\Controllers\ClientListController::class, 'createBusinessInfo']);
        Route::post('/list/update_business_info', [App\Http\Controllers\ClientListController::class, 'updateBusinessInfoById']);
        Route::post('/list/delete', [App\Http\Controllers\ClientListController::class, 'delete']);

        // Client (Contact Info)
        Route::post('/contact_info/get_tbl_list', [App\Http\Controllers\ClientContactController::class, 'getTableContactInfoList']);
        Route::post('/contact_info/get_by_id', [App\Http\Controllers\ClientContactController::class, 'getContactById']);
        Route::post('/contact_info/create', [App\Http\Controllers\ClientContactController::class, 'create']);
        Route::post('/contact_info/update', [App\Http\Controllers\ClientContactController::class, 'update']);
        Route::post('/contact_info/delete', [App\Http\Controllers\ClientContactController::class, 'delete']);

        // Client (Confidential)
        Route::post('/confidential/get_tbl_list', [App\Http\Controllers\ClientConfidentialController::class, 'getTableConfidentialList']);
        Route::post('/confidential/create', [App\Http\Controllers\ClientConfidentialController::class, 'create']);
        Route::post('/confidential/update', [App\Http\Controllers\ClientConfidentialController::class, 'update']);
        Route::post('/confidential/delete', [App\Http\Controllers\ClientConfidentialController::class, 'delete']);

        // Client (Placement)
        Route::post('/placement/get_ones_placement_tbl_list', [App\Http\Controllers\ClientPlacementController::class, 'getTableOnesPlacementList']);
        Route::post('/placement/get_activities_tbl_list', [App\Http\Controllers\ClientPlacementController::class, 'getTableActivitiesList']);
        Route::post('/placement/get_invoices_tbl_list', [App\Http\Controllers\ClientPlacementController::class, 'getTableInvoicesList']);
        Route::post('/placement/create', [App\Http\Controllers\ClientPlacementController::class, 'create']);
        Route::post('/placement/delete', [App\Http\Controllers\ClientPlacementController::class, 'delete']);

        // Client (Placement Activities)
        Route::post('/document/get_tbl_list', [App\Http\Controllers\ClientDocumentController::class, 'getTableDocumentList']);
        Route::post('/document/create', [App\Http\Controllers\ClientDocumentController::class, 'create']);

        // Client (All Placements)
        Route::get('/all_placements', [App\Http\Controllers\ClientAllPlacementController::class, 'index']);
        Route::post('/all_placements/get_placements_tbl_list', [App\Http\Controllers\ClientAllPlacementController::class, 'getTablePlacementList']);
        Route::post('/all_placements/get_acts_tbl_list', [App\Http\Controllers\ClientAllPlacementController::class, 'getTableActivitieList']);
        Route::post('/all_placements/create', [App\Http\Controllers\ClientAllPlacementController::class, 'create']);
        Route::post('/all_placements/delete', [App\Http\Controllers\ClientAllPlacementController::class, 'delete']);

        // Client (All Documents)
        Route::get('/all_documents', [App\Http\Controllers\ClientAllDocumentController::class, 'index']);
        Route::post('/all_documents/get_tbl_list', [App\Http\Controllers\ClientAllDocumentController::class, 'getTableDocumentList']);
        Route::post('/all_documents/create', [App\Http\Controllers\ClientAllDocumentController::class, 'create']);
    });

    // Timesheet
    Route::prefix('timesheets')->group(function () {
        Route::get('/', [App\Http\Controllers\TimesheetsController::class, 'index']);
        Route::post('/all/get_tbl_list', [App\Http\Controllers\TimesheetsController::class, 'getAllTimesheets']);
        Route::post('/all/create', [App\Http\Controllers\TimesheetsController::class, 'create']);
        Route::post('/all/delete', [App\Http\Controllers\TimesheetsController::class, 'delete']);

        Route::post('/due/get_tbl_list', [App\Http\Controllers\TimesheetDueController::class, 'getDueTimesheets']);

        Route::post('/await_inv/get_tbl_list', [App\Http\Controllers\TimesheetAwaitInvController::class, 'getAwaitInvoices']);
    });

    // Expenses
    Route::prefix('expenses')->group(function () {
        Route::get('/', [App\Http\Controllers\ExpensesController::class, 'index']);
        Route::post('/list', [App\Http\Controllers\ExpensesController::class, 'getExpenseList']);
        Route::post('/act', [App\Http\Controllers\ExpensesController::class, 'getExpenseAct']);
        Route::post('/by_id', [App\Http\Controllers\ExpensesController::class, 'getExpenseById']);
        Route::post('/add', [App\Http\Controllers\ExpensesController::class, 'addExpense']);
        Route::post('/update', [App\Http\Controllers\ExpensesController::class, 'updateExpense']);
        Route::post('/del', [App\Http\Controllers\ExpensesController::class, 'delExpense']);
    });
    
    // Invoices - (All Invoices)
    Route::prefix('invoices')->group(function () {
        Route::get('/all', [App\Http\Controllers\InvoiceAllController::class, 'index']);
        Route::post('/all/get_tbl_list', [App\Http\Controllers\InvoiceAllController::class, 'getInvoices']);
        Route::post('/all/get_tbl_svc_smrys', [App\Http\Controllers\InvoiceAllController::class, 'getSvcSmrys']);
        Route::post('/all/get_tbl_note_totals', [App\Http\Controllers\InvoiceAllController::class, 'getNoteTotals']);
        Route::post('/all/create', [App\Http\Controllers\InvoiceAllController::class, 'create']);
        Route::post('/all/delete', [App\Http\Controllers\InvoiceAllController::class, 'delete']);

        // Invoices - (Due Invoices)
        Route::get('/due-inv', [App\Http\Controllers\InvoiceDueController::class, 'index']);
        Route::post('/due-inv/get-activities', [App\Http\Controllers\InvoiceDueController::class, 'getActivities']);

        // Invoices - (Awaiting Invoices)
        Route::get('/await-inv', [App\Http\Controllers\InvoiceAwaitController::class, 'index']);
        Route::post('/await-inv/get-invs', [App\Http\Controllers\InvoiceAwaitController::class, 'getInvoices']);

        // Invoices - (Client Payments)
        Route::get('/client-pay', [App\Http\Controllers\InvoiceCliPayController::class, 'index']);
        Route::post('/client-pay/get_payments', [App\Http\Controllers\InvoiceCliPayController::class, 'getPayments']);

        // Invoices - (Employee Payments)
        Route::get('/employee-pay', [App\Http\Controllers\InvoiceEmpPayController::class, 'index']);
        Route::post('/employee-pay/get_payments', [App\Http\Controllers\InvoiceEmpPayController::class, 'getPayments']);
    });

    // Tickets
    Route::prefix('tickets')->group(function () {
        Route::get('/', [App\Http\Controllers\TicketController::class, 'index']);
        Route::post('/list', [App\Http\Controllers\TicketController::class, 'getTicketList']);
        Route::post('/by_id', [App\Http\Controllers\TicketController::class, 'getTicketById']);
        Route::post('/add', [App\Http\Controllers\TicketController::class, 'addTicket']);
        Route::post('/update', [App\Http\Controllers\TicketController::class, 'updateTicket']);
        Route::post('/del', [App\Http\Controllers\TicketController::class, 'delTicket']);
        Route::post('/get-emp-tickets', [App\Http\Controllers\TicketController::class, 'getEmpTickets']);
    });
    // Settings
    Route::prefix("settings")->group(function () {
        // Settings - (Organization Hierarchy)
        Route::prefix('org_hierarchy')->group(function () {
            Route::get('/', [App\Http\Controllers\SettingOrgHichyController::class, 'index']);
            Route::post('/get_tbl_list', [App\Http\Controllers\SettingOrgHichyController::class, 'getTableRoles']);
            Route::post('/get_tbl_act_list', [App\Http\Controllers\SettingOrgHichyController::class, 'getTableLevelActs']);
            Route::post('/create', [App\Http\Controllers\SettingOrgHichyController::class, 'create']);
            Route::post('/update', [App\Http\Controllers\SettingOrgHichyController::class, 'update']);
            Route::post('/delete', [App\Http\Controllers\SettingOrgHichyController::class, 'delete']);
        });

        // Settings - (Role Permission)
        Route::prefix('role_perm')->group(function () {
            Route::get('/', [App\Http\Controllers\SettingRoleController::class, 'index']);
            Route::post('/get_tbl_list', [App\Http\Controllers\SettingRoleController::class, 'getTableRoles']);
            Route::post('/get_tbl_act_list', [App\Http\Controllers\SettingRoleController::class, 'getTableRoleActs']);
            Route::post('/create', [App\Http\Controllers\SettingRoleController::class, 'create']);
            Route::post('/update', [App\Http\Controllers\SettingRoleController::class, 'update']);
            Route::post('/delete', [App\Http\Controllers\SettingRoleController::class, 'delete']);
        });

        // Settings - Module Security
        Route::prefix('module_sec')->group(function() {
            Route::get('/', [App\Http\Controllers\SettingModuleSecController::class, 'index']);
            Route::post('/get_tbl_list', [App\Http\Controllers\SettingModuleSecController::class, 'getTableRoles']);
            Route::post('/get_role', [App\Http\Controllers\SettingModuleSecController::class, 'getRoleById']);
            Route::post('/update', [App\Http\Controllers\SettingModuleSecController::class, 'update']);
        });

        // Settings - (General)
        Route::prefix("general")->group(function () {
            Route::get('/', [App\Http\Controllers\SettingGeneralController::class, 'index']);

            Route::post('/department/get_tbl_list', [App\Http\Controllers\SettingGeneralController::class, 'getDepartmentList']);
            Route::post('/department/create', [App\Http\Controllers\SettingGeneralController::class, 'createDepartment']);
            Route::post('/department/update', [App\Http\Controllers\SettingGeneralController::class, 'updateDepartment']);
            Route::post('/department/delete', [App\Http\Controllers\SettingGeneralController::class, 'deleteDepartment']);

            Route::post('/workauth/get_tbl_list', [App\Http\Controllers\SettingGeneralController::class, 'getWorkauthList']);
            Route::post('/workauth/create', [App\Http\Controllers\SettingGeneralController::class, 'createWorkAuth']);
            Route::post('/workauth/update', [App\Http\Controllers\SettingGeneralController::class, 'updateWorkAuth']);
            Route::post('/workauth/delete', [App\Http\Controllers\SettingGeneralController::class, 'deleteWorkAuth']);

            Route::post('/poc/get_tbl_list', [App\Http\Controllers\SettingGeneralController::class, 'getPocList']);
            Route::post('/poc/create', [App\Http\Controllers\SettingGeneralController::class, 'createPoc']);
            Route::post('/poc/update', [App\Http\Controllers\SettingGeneralController::class, 'updatePoc']);
            Route::post('/poc/delete', [App\Http\Controllers\SettingGeneralController::class, 'deletePoc']);

            Route::post('/jobtire/get_tbl_list', [App\Http\Controllers\SettingGeneralController::class, 'getJobtireList']);
            Route::post('/jobtire/create', [App\Http\Controllers\SettingGeneralController::class, 'createJobTire']);
            Route::post('/jobtire/update', [App\Http\Controllers\SettingGeneralController::class, 'updateJobTire']);
            Route::post('/jobtire/delete', [App\Http\Controllers\SettingGeneralController::class, 'deleteJobTire']);
        });


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

    // Documentation
    Route::get('/documentation', [App\Http\Controllers\DocumentationController::class, 'index']);
    Route::post('/documentation/get-org-docs', [App\Http\Controllers\DocumentationController::class, 'getOrgDocs']);
    Route::post('/documentation/get-org-docs-activity', [App\Http\Controllers\DocumentationController::class, 'getOrgDocsAct']);
    Route::post('/documentation/get-emp-docs', [App\Http\Controllers\DocumentationController::class, 'getEmpDocs']);
    Route::post('/documentation/get-emp-docs-activity', [App\Http\Controllers\DocumentationController::class, 'getOrgDocsAct']);
    Route::post('/documentation/get-exp-docs', [App\Http\Controllers\DocumentationController::class, 'getExpDocs']);
    Route::post('/documentation/get-group-docs', [App\Http\Controllers\DocumentationController::class, 'getGroupDocs']);
});