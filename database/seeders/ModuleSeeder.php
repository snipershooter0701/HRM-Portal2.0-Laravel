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
            'url' => '/employee'
        ]);
        DB::table('modules')->insert([
            'name' => 'All Employees',
            'level' => '1',
            'url' => '/employee/all_employees'
        ]);
        DB::table('modules')->insert([
            'name' => 'All Request Details',
            'level' => '1',
            'url' => '/employee/all_request_details'
        ]);
        DB::table('modules')->insert([
            'name' => 'Pay Classification',
            'level' => '2'
        ]);


        DB::table('modules')->insert([
            'name' => 'Clients',
            'level' => '0',
            'url' => '/client'
        ]);
        DB::table('modules')->insert([
            'name' => 'All Clients',
            'level' => '1',
            'url' => '/client/list'
        ]);
        DB::table('modules')->insert([
            'name' => 'All Placements',
            'level' => '1',
            'url' => '/client/all_placements'
        ]);
        DB::table('modules')->insert([
            'name' => 'All Documents',
            'level' => '1',
            'url' => '/client/all_documents'
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
            'url' => '/vendor'
        ]);
        DB::table('modules')->insert([
            'name' => 'All Vendor',
            'level' => '1',
            'url' => '/vendor/list'
        ]);
        DB::table('modules')->insert([
            'name' => 'All Placement',
            'level' => '1',
            'url' => '/vendor/all_placements'
        ]);
        DB::table('modules')->insert([
            'name' => 'All Documents',
            'level' => '1',
            'url' => '/vendor/all_documents'
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
            'url' => '/timesheets'
        ]);
        DB::table('modules')->insert([
            'name' => 'All Timesheets',
            'level' => '1',
            'url' => '/timesheets/all'
        ]);
        DB::table('modules')->insert([
            'name' => 'Due Timesheets',
            'level' => '1',
            'url' => '/timesheets/due'
        ]);
        DB::table('modules')->insert([
            'name' => 'Awaiting Timesheets',
            'level' => '1',
            'url' => '/timesheets/awaiting'
        ]);
        DB::table('modules')->insert([
            'name' => 'Timesheet Approver',
            'level' => '2'
        ]);


        DB::table('modules')->insert([
            'name' => 'Expenses',
            'level' => '0',
            'url' => '/expenses'
        ]);
        DB::table('modules')->insert([
            'name' => 'Expense List',
            'level' => '1',
            'url' => '/expenses/expense_list'
        ]);


        DB::table('modules')->insert([
            'name' => 'Invoice',
            'level' => '0',
            'url' => '/invoices'
        ]);
        DB::table('modules')->insert([
            'name' => 'All Invoices',
            'level' => '1',
            'url' => '/invoices/all_inv'
        ]);
        DB::table('modules')->insert([
            'name' => 'Due Invoices',
            'level' => '1',
            'url' => '/invoices/due_inv'
        ]);
        DB::table('modules')->insert([
            'name' => 'Awaiting Invoices',
            'level' => '1',
            'url' => '/invoices/await_inv'
        ]);
        DB::table('modules')->insert([
            'name' => 'Client Payment',
            'level' => '1',
            'url' => '/invoices/client_pay'
        ]);
        DB::table('modules')->insert([
            'name' => 'Employee Payment',
            'level' => '1',
            'url' => '/invoices/employee_pay'
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
            'url' => '/documentation'
        ]);
        DB::table('modules')->insert([
            'name' => 'Organization Document',
            'level' => '1',
            'url' => '/documentation/organization'
        ]);
        DB::table('modules')->insert([
            'name' => 'Employee Documents',
            'level' => '1',
            'url' => '/documentation/employee'
        ]);
        DB::table('modules')->insert([
            'name' => 'Expiring Documents',
            'level' => '1',
            'url' => '/documentation/expiring'
        ]);
        DB::table('modules')->insert([
            'name' => 'Group Documents',
            'level' => '1',
            'url' => '/documentation/group'
        ]);


        DB::table('modules')->insert([
            'name' => 'Tickets',
            'level' => '0',
            'url' => '/tickets'
        ]);
        DB::table('modules')->insert([
            'name' => 'All Tickets',
            'level' => '1',
            'url' => '/tickets/ticket_list'
        ]);


        DB::table('modules')->insert([
            'name' => 'Settings',
            'level' => '0',
            'url' => '/settings'
        ]);
        DB::table('modules')->insert([
            'name' => 'Organization Hierarchy',
            'level' => '1',
            'url' => '/settings/org_hierarchy'
        ]);
        DB::table('modules')->insert([
            'name' => 'Role Permission',
            'level' => '1',
            'url' => '/settings/role_perm'
        ]);
        DB::table('modules')->insert([
            'name' => 'Module Security',
            'level' => '1',
            'url' => '/settings/module_sec'
        ]);
        DB::table('modules')->insert([
            'name' => 'General Module',
            'level' => '1',
            'url' => '/settings/general'
        ]);
        DB::table('modules')->insert([
            'name' => 'Invoice Settings',
            'level' => '1',
            'url' => '/settings/invoice'
        ]);
        DB::table('modules')->insert([
            'name' => 'Create New Company',
            'level' => '1',
            'url' => '/settings/new_company'
        ]);
        DB::table('modules')->insert([
            'name' => 'Application Setting',
            'level' => '1',
            'url' => '/settings/application'
        ]);
        DB::table('modules')->insert([
            'name' => 'Backup and Download',
            'level' => '1',
            'url' => '/settings/backup'
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
