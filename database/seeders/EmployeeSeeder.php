<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $username = $faker->username;
        DB::table('login_tbl')->insert([      
            'username' => $username,
            'password' => 'password123',
            'user_type' => 'employee'
        ]);
    
        $login_id = DB::table('login_tbl')->where('username',$username)->first('login_id')->login_id;
        DB::table('information_tbl')->insert([
            'login_id' => $login_id, 
            'fname' => $faker->FirstName, 
            'mname' => $faker->LastName, 
            'lname' => $faker->LastName, 
            'sex' =>  'male', 
            'age' => '20',
            'bday' => $faker->date($format = 'Y-m-d'),  
            'educ' => 'College',  
            'cnum' => $faker->e164PhoneNumber, 
            'email' => $faker->email, 
        ]);
    
        $info_id = DB::table('information_tbl')->where('login_id',  $login_id)->first('information_id')->information_id;
        DB::table('employee_tbl')->insert([
            'login_id' => $login_id, 
            'information_id' =>$info_id,
            'position' => 'Teacher',
            'department' => 'Faculty',  
            'employment_status' => 'regular',
            'picture' => 'pictures/1.png',  
            'resume' => 'resume/1.pdf'
        ]); 
    }
}
