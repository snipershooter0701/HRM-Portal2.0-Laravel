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
        // super admin
    	DB::table('users')->insert([
            'name' => 'Revanth',
            'email' => 'revanthx@gmail.com',
            'password' => '$2y$10$PpeLP4p6ODvDm.RZi8hDAOth/fQhEUAcyHh5UQYxVxanpfgj517B6',   //123456789
            'employee_id' => '1'
        ]);
    }
}
