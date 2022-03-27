<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\str;


class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            // DB::table('user_tbl')->insert([
            //     'username' => 'Manageradmin',
            //     'password' => 'Manageradmin',
            //     'user_type' => 'manager',
            // ],[
            //     'username' => 'Payrolladmin',
            //     'password' => 'Payrolladmin',
            //     'user_type' => 'payroll'
            // ],[
            //     'username' => 'Staffadmin',
            //     'password' => 'Stafffadmin',
            //     'user_type' => 'staff' 
            // ],[
            //     'username' => 'Employee',
            //     'password' => 'Employee',
            //     'user_type' => 'employee' 
            // ]);
    }
}
