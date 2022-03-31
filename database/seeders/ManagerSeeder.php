<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class ManagerSeeder extends Seeder
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
            'username' => 'HRAdmin',
            'password' => 'password123',
            'user_type' => 'admin'
        ]);
    
        $login_id = DB::table('login_tbl')->where('username','HRAdmin')->first('login_id')->login_id;
        DB::table('information_tbl')->insert([
            'login_id' => $login_id, 
            'fname' => $faker->FirstName, 
            'mname' => $faker->LastName, 
            'lname' => $faker->LastName, 
            'sex' =>  'male', 
            'age' => '20',
            'bday' => $faker->date($format = 'Y-m-d'),  
            'cnum' => $faker->e164PhoneNumber, 
            'email' => $faker->email, 
            'picture' => 'pictures/1.png',  
        ]);
    }
}
