<?php

// use App\Http\Middleware\CheckRole;
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

Route::post('/user_signup', [App\Http\Controllers\Auth\UserSignupController::class, 'signup']);

Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::post('/home/gen', [App\Http\Controllers\HomeController::class, 'genEmailPwd']);
    Route::post('/home/by_id', [App\Http\Controllers\HomeController::class, 'getReqById']);
    Route::post('/home/response_doc', [App\Http\Controllers\HomeController::class, 'responseDoc']);

    // Common
    Route::post('/notifications', [App\Http\Controllers\NotificationController::class, 'getNotifications']);

    Route::prefix("employee")->middleware(['checkrole:/employee'])->group(function () {
        // Employee - All Employees
        Route::prefix('all_employees')->middleware(['checkrole:/employee/all_employees'])->group(function () {
            Route::get('/', [App\Http\Controllers\EmployeeController::class, 'index']);
            Route::post('/list', [App\Http\Controllers\EmployeeController::class, 'getEmployeeList']);
            Route::post('/by_id', [App\Http\Controllers\EmployeeController::class, 'getEmployeeByID']);
            Route::post('/add', [App\Http\Controllers\EmployeeController::class, 'addEmployee']);
            Route::post('/view', [App\Http\Controllers\EmployeeController::class, 'viewEmployee']);
            Route::post('/update', [App\Http\Controllers\EmployeeController::class, 'updateEmployee']);
            Route::post('/del', [App\Http\Controllers\EmployeeController::class, 'deleteEmployee']);
            Route::post('/act', [App\Http\Controllers\EmployeeController::class, 'getEmpAct']);
            Route::post('/get-add-placements', [App\Http\Controllers\EmployeeController::class, 'getAddPlacements']);
            Route::post('/do_mult_action', [App\Http\Controllers\EmployeeController::class, 'doMultAction']);
        });

        // Employee - All Request Details
        Route::prefix('all_request_details')->middleware(['checkrole:/employee/all_request_details'])->group(function () {
            Route::get('/', [App\Http\Controllers\EmployeeRequestController::class, 'index']);
            Route::post('/list', [App\Http\Controllers\EmployeeRequestController::class, 'getRequestDetailsList']);
            Route::post('/by_id', [App\Http\Controllers\EmployeeRequestController::class, 'getRequestDetailsByID']);
            Route::post('/add', [App\Http\Controllers\EmployeeRequestController::class, 'addRequestDetails']);
            Route::post('/update', [App\Http\Controllers\EmployeeRequestController::class, 'updateRequestDetails']);
            Route::post('/del', [App\Http\Controllers\EmployeeRequestController::class, 'deleteRequestDetails']);
            Route::post('/approv', [App\Http\Controllers\EmployeeRequestController::class, 'requestApprov']);
            Route::post('/reject', [App\Http\Controllers\EmployeeRequestController::class, 'requestReject']);
            Route::post('/act', [App\Http\Controllers\EmployeeRequestController::class, 'getReqAct']);
        });
    });

    // Client
    Route::prefix('client')->middleware(['checkrole:/client'])->group(function () {
        // List Page
        Route::prefix('list')->middleware(['checkrole:/client/list'])->group(function () {
            Route::get('/', [App\Http\Controllers\ClientListController::class, 'index']);
            Route::post('/get_tbl_client_list', [App\Http\Controllers\ClientListController::class, 'getTableClientList']);
            Route::post('/get_tbl_client_acts_list', [App\Http\Controllers\ClientListController::class, 'getTableClientActsList']);
            Route::get('/get_client', [App\Http\Controllers\ClientListController::class, 'getClientById']);
            Route::get('/get_new', [App\Http\Controllers\ClientListController::class, 'getNewClientInfo']);
            Route::post('/get_states', [App\Http\Controllers\ClientListController::class, 'getStatesByCountryId']);
            Route::post('/do_muti_action', [App\Http\Controllers\ClientListController::class, 'doMultiAction']);

            // Client (Business Info)
            Route::post('/create_business_info', [App\Http\Controllers\ClientListController::class, 'createBusinessInfo']);
            Route::post('/update_business_info', [App\Http\Controllers\ClientListController::class, 'updateBusinessInfoById']);
            Route::post('/delete', [App\Http\Controllers\ClientListController::class, 'delete']);
        });

        // Client (Contact Info)
        Route::prefix('/contact_info')->group(function () {
            Route::post('/get_tbl_list', [App\Http\Controllers\ClientContactController::class, 'getTableContactInfoList']);
            Route::post('/get_by_id', [App\Http\Controllers\ClientContactController::class, 'getContactById']);
            Route::post('/create', [App\Http\Controllers\ClientContactController::class, 'create']);
            Route::post('/update', [App\Http\Controllers\ClientContactController::class, 'update']);
            Route::post('/delete', [App\Http\Controllers\ClientContactController::class, 'delete']);
            Route::post('/set_primary', [App\Http\Controllers\ClientContactController::class, 'setPrimary']);
            Route::post('/send_notify', [App\Http\Controllers\ClientContactController::class, 'sendNotify']);
        });

        // Client (Confidential)
        Route::prefix('confidential')->group(function () {
            Route::post('/get_tbl_list', [App\Http\Controllers\ClientConfidentialController::class, 'getTableConfidentialList']);
            Route::post('/create', [App\Http\Controllers\ClientConfidentialController::class, 'create']);
            Route::post('/update', [App\Http\Controllers\ClientConfidentialController::class, 'update']);
            Route::post('/delete', [App\Http\Controllers\ClientConfidentialController::class, 'delete']);
        });

        // Client (Placement)
        Route::prefix('placement')->group(function () {
            Route::post('/get_ones_placement_tbl_list', [App\Http\Controllers\ClientPlacementController::class, 'getTableOnesPlacementList']);
            Route::post('/get_activities_tbl_list', [App\Http\Controllers\ClientPlacementController::class, 'getTableActivitiesList']);
            Route::post('/get_invoices_tbl_list', [App\Http\Controllers\ClientPlacementController::class, 'getTableInvoicesList']);
            Route::post('/create', [App\Http\Controllers\ClientPlacementController::class, 'create']);
            Route::post('/delete', [App\Http\Controllers\ClientPlacementController::class, 'delete']);
            Route::post('/get_new', [App\Http\Controllers\ClientPlacementController::class, 'getNew']);
            Route::post('/get_employee', [App\Http\Controllers\ClientPlacementController::class, 'getEmployeeById']);
        });

        // Client (Placement Activities)
        Route::prefix('document')->group(function () {
            Route::post('/get_tbl_list', [App\Http\Controllers\ClientDocumentController::class, 'getTableDocumentList']);
            Route::post('/create', [App\Http\Controllers\ClientDocumentController::class, 'create']);
        });

        // Client (All Placements)
        Route::prefix('all_placements')->middleware(['checkrole:/client/all_placements'])->group(function () {
            Route::get('/', [App\Http\Controllers\ClientAllPlacementController::class, 'index']);
            Route::post('/get_placements_tbl_list', [App\Http\Controllers\ClientAllPlacementController::class, 'getTablePlacementList']);
            Route::post('/get_acts_tbl_list', [App\Http\Controllers\ClientAllPlacementController::class, 'getTableActivitieList']);
            Route::post('/create', [App\Http\Controllers\ClientAllPlacementController::class, 'create']);
            Route::post('/delete', [App\Http\Controllers\ClientAllPlacementController::class, 'delete']);
        });

        // Client (All Documents)
        Route::prefix('all_documents')->middleware(['checkrole:/client/all_documents'])->group(function () {
            Route::get('/', [App\Http\Controllers\ClientAllDocumentController::class, 'index']);
            Route::post('/get_tbl_list', [App\Http\Controllers\ClientAllDocumentController::class, 'getTableDocumentList']);
            Route::post('/create', [App\Http\Controllers\ClientAllDocumentController::class, 'create']);
        });
    });

    // Timesheet
    Route::prefix('timesheets')->middleware(['checkrole:/timesheets'])->group(function () {
        Route::prefix('all')->middleware(['checkrole:/timesheets/all'])->group(function () {
            Route::get('/', [App\Http\Controllers\TimesheetsController::class, 'index']);
            Route::post('/get_tbl_list', [App\Http\Controllers\TimesheetsController::class, 'getAllTimesheets']);
            Route::post('/create', [App\Http\Controllers\TimesheetsController::class, 'create']);
            Route::post('/delete', [App\Http\Controllers\TimesheetsController::class, 'delete']);
        });

        Route::prefix('due')->middleware(['checkrole:/timesheets/due'])->group(function () {
            Route::get('/', [App\Http\Controllers\TimesheetDueController::class, 'index']);
            Route::post('/get_tbl_list', [App\Http\Controllers\TimesheetDueController::class, 'getDueTimesheets']);
        });

        Route::prefix('awaiting')->middleware(['checkrole:/timesheets/awaiting'])->group(function () {
            Route::get('/', [App\Http\Controllers\TimesheetAwaitInvController::class, 'index']);
            Route::post('/get_tbl_list', [App\Http\Controllers\TimesheetAwaitInvController::class, 'getAwaitInvoices']);
        });
    });

    // Expenses
    Route::prefix('expenses')->middleware(['checkrole:/expenses'])->group(function () {
        Route::get('/', [App\Http\Controllers\ExpensesController::class, 'index']);
        Route::post('/list', [App\Http\Controllers\ExpensesController::class, 'getExpenseList']);
        Route::post('/act', [App\Http\Controllers\ExpensesController::class, 'getExpenseAct']);
        Route::post('/by_id', [App\Http\Controllers\ExpensesController::class, 'getExpenseById']);
        Route::post('/add', [App\Http\Controllers\ExpensesController::class, 'addExpense']);
        Route::post('/update', [App\Http\Controllers\ExpensesController::class, 'updateExpense']);
        Route::post('/del', [App\Http\Controllers\ExpensesController::class, 'delExpense']);
    });

    // Invoices
    Route::prefix('invoices')->middleware(['checkrole:/invoices'])->group(function () {
        // Invoices - (All Invoices)
        Route::prefix('all_inv')->middleware(['checkrole:/invoices/all_inv'])->group(function () {
            Route::get('/', [App\Http\Controllers\InvoiceAllController::class, 'index']);
            Route::post('/get_tbl_list', [App\Http\Controllers\InvoiceAllController::class, 'getInvoices']);
            Route::post('/get_tbl_act_list', [App\Http\Controllers\InvoiceAllController::class, 'getInvoiceActs']);
            Route::post('/get_tbl_svc_smrys', [App\Http\Controllers\InvoiceAllController::class, 'getSvcSmrys']);
            Route::post('/get_tbl_note_totals', [App\Http\Controllers\InvoiceAllController::class, 'getNoteTotals']);
            Route::post('/create', [App\Http\Controllers\InvoiceAllController::class, 'create']);
            Route::post('/delete', [App\Http\Controllers\InvoiceAllController::class, 'delete']);
        });

        // Invoices - (Due Invoices)
        Route::prefix('due_inv')->middleware(['checkrole:/invoices/due_inv'])->group(function() {
            Route::get('/', [App\Http\Controllers\InvoiceDueController::class, 'index']);
            Route::post('/get_tbl_list', [App\Http\Controllers\InvoiceDueController::class, 'getInvoices']); 
            Route::post('/get_tbl_act_list', [App\Http\Controllers\InvoiceDueController::class, 'getInvoiceActs']); 
            Route::post('/delete', [App\Http\Controllers\InvoiceDueController::class, 'delete']); 
        });

        // Invoices - (Awaiting Invoices)
        Route::prefix('await_inv')->middleware(['checkrole:/invoices/await_inv'])->group(function() {
            Route::get('/', [App\Http\Controllers\InvoiceAwaitController::class, 'index']);
            Route::post('/get_tbl_list', [App\Http\Controllers\InvoiceAwaitController::class, 'getInvoices']);
            Route::post('/get_tbl_act_list', [App\Http\Controllers\InvoiceAwaitController::class, 'getInvoiceActs']); 
            Route::post('/delete', [App\Http\Controllers\InvoiceAwaitController::class, 'delete']); 
        });

        // Invoices - (Client Payments)
        Route::prefix('client_pay')->middleware(['checkrole:/invoices/client_pay'])->group(function() {
            Route::get('/', [App\Http\Controllers\InvoiceCliPayController::class, 'index']);
            Route::post('/get_tbl_list', [App\Http\Controllers\InvoiceCliPayController::class, 'getPayments']);
            Route::post('/get_tbl_act_list', [App\Http\Controllers\InvoiceCliPayController::class, 'getPaymentActs']);
            Route::post('/create', [App\Http\Controllers\InvoiceCliPayController::class, 'create']);
            Route::post('/delete', [App\Http\Controllers\InvoiceCliPayController::class, 'delete']);
        });

        // Invoices - (Employee Payments)
        Route::prefix('employee_pay')->middleware(['checkrole:/invoices/employee_pay'])->group(function() {
            Route::get('/', [App\Http\Controllers\InvoiceEmpPayController::class, 'index']);
            Route::post('/get_tbl_list', [App\Http\Controllers\InvoiceEmpPayController::class, 'getPayments']);
            Route::post('/get_tbl_act_list', [App\Http\Controllers\InvoiceEmpPayController::class, 'getPaymentActs']);
        });
    });

    // Tickets
    Route::prefix('tickets')->middleware(['checkrole:/tickets'])->group(function () {
        Route::get('/', [App\Http\Controllers\TicketController::class, 'index']);
        Route::post('/list', [App\Http\Controllers\TicketController::class, 'getTicketList']);
        Route::post('/by_id', [App\Http\Controllers\TicketController::class, 'getTicketById']);
        Route::post('/add', [App\Http\Controllers\TicketController::class, 'addTicket']);
        Route::post('/update', [App\Http\Controllers\TicketController::class, 'updateTicket']);
        Route::post('/del', [App\Http\Controllers\TicketController::class, 'delTicket']);
        Route::post('/get-emp-tickets', [App\Http\Controllers\TicketController::class, 'getEmpTickets']);
    });

    // Settings
    Route::prefix("settings")->middleware(['checkrole:/settings'])->group(function () {
        // Settings - (Organization Hierarchy)
        Route::prefix('org_hierarchy')->middleware(['checkrole:/settings/org_hierarchy'])->group(function () {
            Route::get('/', [App\Http\Controllers\SettingOrgHichyController::class, 'index']);
            Route::post('/get_tbl_list', [App\Http\Controllers\SettingOrgHichyController::class, 'getTableRoles']);
            Route::post('/get_tbl_act_list', [App\Http\Controllers\SettingOrgHichyController::class, 'getTableLevelActs']);
            Route::post('/get_level', [App\Http\Controllers\SettingOrgHichyController::class, 'getLevelById']);
            Route::post('/create', [App\Http\Controllers\SettingOrgHichyController::class, 'create']);
            Route::post('/update', [App\Http\Controllers\SettingOrgHichyController::class, 'update']);
            Route::post('/delete', [App\Http\Controllers\SettingOrgHichyController::class, 'delete']);
        });

        // Settings - (Role Permission)
        Route::prefix('role_perm')->middleware(['checkrole:/settings/role_perm'])->group(function () {
            Route::get('/', [App\Http\Controllers\SettingRoleController::class, 'index']);
            Route::post('/get_tbl_list', [App\Http\Controllers\SettingRoleController::class, 'getTableRoles']);
            Route::post('/get_tbl_act_list', [App\Http\Controllers\SettingRoleController::class, 'getTableRoleActs']);
            Route::post('/create', [App\Http\Controllers\SettingRoleController::class, 'create']);
            Route::post('/update', [App\Http\Controllers\SettingRoleController::class, 'update']);
            Route::post('/delete', [App\Http\Controllers\SettingRoleController::class, 'delete']);
        });

        // Settings - Module Security
        Route::prefix('module_sec')->middleware(['checkrole:/settings/module_sec'])->group(function () {
            Route::get('/', [App\Http\Controllers\SettingModuleSecController::class, 'index']);
            Route::post('/get_tbl_list', [App\Http\Controllers\SettingModuleSecController::class, 'getTableRoles']);
            Route::post('/get_tbl_act_list', [App\Http\Controllers\SettingModuleSecController::class, 'getTableRoleActs']);
            Route::post('/get_role', [App\Http\Controllers\SettingModuleSecController::class, 'getRoleById']);
            Route::post('/update', [App\Http\Controllers\SettingModuleSecController::class, 'update']);
        });

        // Settings - (General)
        Route::prefix("general")->middleware(['checkrole:/settings/general'])->group(function () {
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

        // Settings - (Invoice)
        Route::prefix('invoice')->middleware(['checkrole:/settings/invoice'])->group(function () {
            Route::get('/', [App\Http\Controllers\SettingInvoiceController::class, 'index']);
        });

        // Settings - (New Company)
        Route::prefix('new_company')->middleware(['checkrole:/settings/new_company'])->group(function () {
            Route::get('/', [App\Http\Controllers\SettingNewCompanyController::class, 'index']);
            Route::post('/get_tbl_list', [App\Http\Controllers\SettingNewCompanyController::class, 'getCompanyList']);
            Route::post('/get_company', [App\Http\Controllers\SettingNewCompanyController::class, 'getCompanyById']);
            Route::post('/create', [App\Http\Controllers\SettingNewCompanyController::class, 'create']);
            Route::post('/update', [App\Http\Controllers\SettingNewCompanyController::class, 'update']);
            Route::post('/delete', [App\Http\Controllers\SettingNewCompanyController::class, 'delete']);
        });

        // Settings - (Application)
        Route::prefix('application')->middleware(['checkrole:/settings/application'])->group(function () {
            Route::get('/', [App\Http\Controllers\SettingApplicationController::class, 'index']);
        });

        // Settings - (Backup & Download)
        Route::prefix('backup')->middleware(['checkrole:/settings/backup'])->group(function () {
            Route::get('/', [App\Http\Controllers\SettingBackupController::class, 'index']);
            Route::post('/download_current', [App\Http\Controllers\SettingBackupController::class, 'downloadCurrent']);
            Route::post('/set_auto', [App\Http\Controllers\SettingBackupController::class, 'changeAutoOption']);
        });
    });

    // Documentation - organization doc
    Route::prefix("documentation/organization")->group(function () {
        Route::get('/', [App\Http\Controllers\DocumentationOrgController::class, 'index']);
        Route::post('/all_list', [App\Http\Controllers\DocumentationOrgController::class, 'getAllDocList']);
        Route::post('/my_doc/list', [App\Http\Controllers\DocumentationOrgController::class, 'getMyDocList']);
        Route::post('/my_doc/create', [App\Http\Controllers\DocumentationOrgController::class, 'createMyDoc']);
        Route::post('/my_doc/share', [App\Http\Controllers\DocumentationOrgController::class, 'shareMyDoc']);
        Route::post('/my_doc/plus', [App\Http\Controllers\DocumentationOrgController::class, 'plusMyDoc']);
        Route::post('/share_doc/list', [App\Http\Controllers\DocumentationOrgController::class, 'getShareDocList']);
        Route::post('/share_doc/update', [App\Http\Controllers\DocumentationOrgController::class, 'updateShareDoc']);
        Route::post('/share_doc/del', [App\Http\Controllers\DocumentationOrgController::class, 'delSharedoc']);
    });

    // Documentation - employee doc
    Route::prefix("documentation/employee")->group(function () {
        Route::get('/', [App\Http\Controllers\DocumentationEmpController::class, 'index']);
        Route::post('/list', [App\Http\Controllers\DocumentationEmpController::class, 'getEmpDocList']);
    });

    // Documentation - expiring doc
    Route::prefix("documentation/expiring")->group(function () {
        Route::get('/', [App\Http\Controllers\DocumentationExpController::class, 'index']);
        Route::post('/list', [App\Http\Controllers\DocumentationExpController::class, 'getExpDocList']);
    });

    // Documentation - group doc
    Route::prefix("documentation/group")->group(function () {
        Route::get('/', [App\Http\Controllers\DocumentationGroupController::class, 'index']);
        Route::post('/list', [App\Http\Controllers\DocumentationGroupController::class, 'getGroupList']);
        Route::post('/create', [App\Http\Controllers\DocumentationGroupController::class, 'createGroup']);
        Route::post('/searchGroup', [App\Http\Controllers\DocumentationGroupController::class, 'getSearchGroupList']);
        
    });

});