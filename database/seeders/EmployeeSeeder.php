<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('employees')->insert([
            'first_name' => 'sniper',
            'last_name' => 'shooter',
            'title' => 'hgfhgfh',
            'email' => 'snipershooter@gmail.com',
            'phone_num' => '456489',
            'dateofbirth' => '2024-02-05',
            'dateofjoining' => '2023-05-08',
            'employment_type' => '0',
            'category' => '1',
            'employee_type' => '1',
            'role_id' => '1',
            'poc_id' => '0',
            'street' => 'dsfds',
            'suite_aptno' => 'tyty',
            'city_town' => 'sfdf',
            'state_id' => '0',
            'country_id' => '0',
            'zipcode' => '5656',
        ]);
    }
}


