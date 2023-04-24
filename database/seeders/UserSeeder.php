<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'snipershooter',
            'email' => 'snipershooter@gmail.com',
            'password' => '$2y$10$PpeLP4p6ODvDm.RZi8hDAOth/fQhEUAcyHh5UQYxVxanpfgj517B6',   //123456789
            'employee_id' => '1'
        ]);
    }
}
