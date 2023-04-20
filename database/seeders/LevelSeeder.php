<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('levels')->insert([
            // 'role_id' => 1,
            'name' => 1
        ]);
        DB::table('levels')->insert([
            // 'role_id' => 2,
            'name' => 2
        ]);
    }
}
