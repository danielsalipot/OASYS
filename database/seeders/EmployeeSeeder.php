<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\UserCredential;
use App\Models\UserDetail;
use App\Models\EmployeeDetail;

use Faker\Factory as Faker;

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
        
        UserCredential::create([
            'username' => $username,
            'password' => 'password123',
            'user_type' => 'employee'
        ]);
    
        
        $login_id = UserCredential::where('username',$username)
                    ->first('login_id')
                    ->login_id;

        UserDetail::create([
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
    
        $info_id = UserDetail::where('login_id',$login_id)
                    ->first('information_id')
                    ->information_id;

        EmployeeDetail::create([
            'login_id' => $login_id, 
            'information_id' =>$info_id,
            'educ' => 'College',  
            'position' => 'Teacher',
            'department' => 'Faculty',
            'rate' => rand(1000,10000),  
            'employment_status' => 'regular',
            'resume' => 'resume/1.pdf'
        ]);
    }
}
