<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LevelRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('level_roles')->insert([
            'level_id' => 1,
            'role_id' => 1,
        ]);
        DB::table('level_roles')->insert([
            'level_id' => 2,
            'role_id' => 2,
        ]);
    }
}
