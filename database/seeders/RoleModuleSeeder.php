<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('role_modules')->insert([
            'role_id' => '1',
            'module_id' => '42',
        ]);
        DB::table('role_modules')->insert([
            'role_id' => '1',
            'module_id' => '45',
        ]);
    }
}
