<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('modules')->insert([
            'name' => 'Employee',
            'level' => '0',
            'url' => '/employee',
            'tagid' => 'page_employee',
            'icon' => 'fa fa-users'
        ]);
        DB::table('modules')->insert([
            'name' => 'All Employees',
            'level' => '1',
            'url' => '/employee/all_employees',
            'tagid' => 'page_employee_list'
        ]);
        DB::table('modules')->insert([
            'name' => 'All Request Details',
            'level' => '1',
            'url' => '/employee/all_request_details',
            'tagid' => 'page_request_list'
        ]);
        DB::table('modules')->insert([
            'name' => 'Pay Classification',
            'level' => '2',
            'tagid' => 'page_timesheets_all'
        ]);


        DB::table('modules')->insert([
            'name' => 'Clients',
            'level' => '0',
            'url' => '/client',
            'tagid' => 'page_client',
            'icon' => 'fa fa-user-secret'
        ]);
        DB::table('modules')->insert([
            'name' => 'All Clients',
            'level' => '1',
            'url' => '/client/list',
            'tagid' => 'page_client_list'
        ]);
        DB::table('modules')->insert([
            'name' => 'All Placements',
            'level' => '1',
            'url' => '/client/all_placements',
            'tagid' => 'page_client_all_placements'
        ]);
        DB::table('modules')->insert([
            'name' => 'All Documents',
            'level' => '1',
            'url' => '/client/all_documents',
            'tagid' => 'page_client_all_documents'
        ]);
        DB::table('modules')->insert([
            'name' => 'Add Client',
            'level' => '2'
        ]);
        DB::table('modules')->insert([
            'name' => 'Add Placement',
            'level' => '2'
        ]);
        DB::table('modules')->insert([
            'name' => 'Client Confidential Details',
            'level' => '2'
        ]);


        DB::table('modules')->insert([
            'name' => 'Vendor',
            'level' => '0',
            'url' => '/vendor',
            'tagid' => 'page_vendor',
            'icon' => 'fa fa-globe'
        ]);
        DB::table('modules')->insert([
            'name' => 'All Vendor',
            'level' => '1',
            'url' => '/vendor/list',
            'tagid' => 'page_vendor_list'
        ]);
        DB::table('modules')->insert([
            'name' => 'All Placement',
            'level' => '1',
            'url' => '/vendor/all_placements',
            'tagid' => 'page_vendor_all_placements'
        ]);
        DB::table('modules')->insert([
            'name' => 'All Documents',
            'level' => '1',
            'url' => '/vendor/all_documents',
            'tagid' => 'page_vendor_all_documents'
        ]);
        DB::table('modules')->insert([
            'name' => 'Add Vendor',
            'level' => '2'
        ]);
        DB::table('modules')->insert([
            'name' => 'Add Placement',
            'level' => '2'
        ]);
        DB::table('modules')->insert([
            'name' => 'Vendor Confidential Details',
            'level' => '2'
        ]);


        DB::table('modules')->insert([
            'name' => 'Timesheets',
            'level' => '0',
            'url' => '/timesheets',
            'tagid' => 'page_timesheets',
            'icon' => 'fa fa-calendar'
        ]);
        DB::table('modules')->insert([
            'name' => 'All Timesheets',
            'level' => '1',
            'url' => '/timesheets/all',
            'tagid' => 'page_timesheets_all'
        ]);
        DB::table('modules')->insert([
            'name' => 'Due Timesheets',
            'level' => '1',
            'url' => '/timesheets/due',
            'tagid' => 'page_timesheets_due'
        ]);
        DB::table('modules')->insert([
            'name' => 'Awaiting Timesheets',
            'level' => '1',
            'url' => '/timesheets/awaiting',
            'tagid' => 'page_timesheets_awaiting'
        ]);
        DB::table('modules')->insert([
            'name' => 'Timesheet Approver',
            'level' => '2'
        ]);


        DB::table('modules')->insert([
            'name' => 'Expenses',
            'level' => '0',
            'url' => '/expenses',
            'tagid' => 'page_expenses',
            'icon' => 'fa fa-dollar'
        ]);
        DB::table('modules')->insert([
            'name' => 'Expense List',
            'level' => '1',
            'url' => '/expenses/expense_list',
            'tagid' => 'page_expense_list'
        ]);


        DB::table('modules')->insert([
            'name' => 'Invoice',
            'level' => '0',
            'url' => '/invoices',
            'tagid' => 'page_invoices',
            'icon' => 'fa fa-sticky-note'
        ]);
        DB::table('modules')->insert([
            'name' => 'All Invoices',
            'level' => '1',
            'url' => '/invoices/all_inv',
            'tagid' => 'page_invoices_all_inv'
        ]);
        DB::table('modules')->insert([
            'name' => 'Due Invoices',
            'level' => '1',
            'url' => '/invoices/due_inv',
            'tagid' => 'page_invoices_due_inv'
        ]);
        DB::table('modules')->insert([
            'name' => 'Awaiting Invoices',
            'level' => '1',
            'url' => '/invoices/await_inv',
            'tagid' => 'page_invoices_await_inv'
        ]);
        DB::table('modules')->insert([
            'name' => 'Client Payment',
            'level' => '1',
            'url' => '/invoices/client_pay',
            'tagid' => 'page_invoices_client_pay'
        ]);
        DB::table('modules')->insert([
            'name' => 'Employee Payment',
            'level' => '1',
            'url' => '/invoices/employee_pay',
            'tagid' => 'page_invoices_employee_pay'
        ]);
        DB::table('modules')->insert([
            'name' => 'Add Invoice',
            'level' => '2'
        ]);
        DB::table('modules')->insert([
            'name' => 'Add Client Payment',
            'level' => '2'
        ]);
        DB::table('modules')->insert([
            'name' => 'Add Employee Payment',
            'level' => '2'
        ]);


        DB::table('modules')->insert([
            'name' => 'Documentation',
            'level' => '0',
            'url' => '/documentation',
            'tagid' => 'page_documentation',
            'icon' => 'fa fa-file-text'
        ]);
        DB::table('modules')->insert([
            'name' => 'Organization Document',
            'level' => '1',
            'url' => '/documentation/organization',
            'tagid' => 'page_org_document'
        ]);
        DB::table('modules')->insert([
            'name' => 'Employee Documents',
            'level' => '1',
            'url' => '/documentation/employee',
            'tagid' => 'page_emp_document'
        ]);
        DB::table('modules')->insert([
            'name' => 'Expiring Documents',
            'level' => '1',
            'url' => '/documentation/expiring',
            'tagid' => 'page_exp_document'
        ]);
        DB::table('modules')->insert([
            'name' => 'Group Documents',
            'level' => '1',
            'url' => '/documentation/group',
            'tagid' => 'page_group_document'
        ]);


        DB::table('modules')->insert([
            'name' => 'Tickets',
            'level' => '0',
            'url' => '/tickets',
            'tagid' => 'page_tickets',
            'icon' => 'fa fa-bookmark'
        ]);
        DB::table('modules')->insert([
            'name' => 'All Tickets',
            'level' => '1',
            'url' => '/tickets/ticket_list',
            'tagid' => 'page_ticket_list'
        ]);


        DB::table('modules')->insert([
            'name' => 'Settings',
            'level' => '0',
            'url' => '/settings',
            'tagid' => 'page_settings',
            'icon' => 'fa fa-cog'
        ]);
        DB::table('modules')->insert([
            'name' => 'Organization Hierarchy',
            'level' => '1',
            'url' => '/settings/org_hierarchy',
            'tagid' => 'page_settings_org_hierarchy'
        ]);
        DB::table('modules')->insert([
            'name' => 'Role Permission',
            'level' => '1',
            'url' => '/settings/role_perm',
            'tagid' => 'page_settings_role_perm'
        ]);
        DB::table('modules')->insert([
            'name' => 'Module Security',
            'level' => '1',
            'url' => '/settings/module_sec',
            'tagid' => 'page_settings_module_sec'
        ]);
        DB::table('modules')->insert([
            'name' => 'General Module',
            'level' => '1',
            'url' => '/settings/general',
            'tagid' => 'page_settings_general'
        ]);
        DB::table('modules')->insert([
            'name' => 'Invoice Settings',
            'level' => '1',
            'url' => '/settings/invoice',
            'tagid' => 'page_settings_invoice'
        ]);
        DB::table('modules')->insert([
            'name' => 'Create New Company',
            'level' => '1',
            'url' => '/settings/new_company',
            'tagid' => 'page_settings_new_company'
        ]);
        DB::table('modules')->insert([
            'name' => 'Application Setting',
            'level' => '1',
            'url' => '/settings/application',
            'tagid' => 'page_settings_application'
        ]);
        DB::table('modules')->insert([
            'name' => 'Backup and Download',
            'level' => '1',
            'url' => '/settings/backup',
            'tagid' => 'page_settings_backup'
        ]);
        DB::table('modules')->insert([
            'name' => 'Create New Company',
            'level' => '2'
        ]);
        DB::table('modules')->insert([
            'name' => 'Application Settings',
            'level' => '2'
        ]);
        DB::table('modules')->insert([
            'name' => 'Backup and Download',
            'level' => '2'
        ]);
    }
}
