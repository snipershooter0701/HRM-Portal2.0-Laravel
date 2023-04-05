<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'name' => 'SacredDevKing',
            'email' => 'sacreddevking@gmail.com',
            'password' => '$2y$10$4XxgRb8pS/.qM8Ce2qV4N.k7VINYvKqwiHiUEnWNvgSn0VUx1SvRi'
        ]);
    }
}
