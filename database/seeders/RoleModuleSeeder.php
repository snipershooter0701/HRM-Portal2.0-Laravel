<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //super admin
        for($i = 0; $i < 53; $i ++) {
            DB::table('role_modules')->insert([
                'role_id' => '1',
                'module_id' => $i+1,
            ]);
        }
    }
}
