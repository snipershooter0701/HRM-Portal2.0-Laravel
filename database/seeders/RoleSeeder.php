<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('roles')->insert([
            'name' => "Super Administrator",
            'department_id' => "1",
            'permission' => '0',
            'access_view' => '4',
            'access_add' => '1',
            'access_edit' => '4',
            'access_delete' => '4',
        ]);
        DB::table('roles')->insert([
            'name' => "Administrator",
            'department_id' => "1",
            'permission' => '0',
            'access_view' => '4',
            'access_add' => '1',
            'access_edit' => '4',
            'access_delete' => '4',
        ]);
        DB::table('roles')->insert([
            'name' => "Employee",
            'department_id' => "1",
            'permission' => '1',
            'access_view' => '0',
            'access_add' => '0',
            'access_edit' => '0',
            'access_delete' => '0',
        ]);
    }
}
