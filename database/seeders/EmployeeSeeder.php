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
            'password' => md5(md5('password123')),
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
            'sex' =>  (rand(0,1)) ? 'female' : 'male',
            'age' => rand(20,65),
            'bday' => $faker->date($format = 'Y-m-d'),
            'cnum' => $faker->e164PhoneNumber,
            'email' => $faker->email,
            'picture' => 'pictures/1.png',
        ]);

        $info_id = UserDetail::where('login_id',$login_id)
                    ->first('information_id')
                    ->information_id;

        $decimals = 2; // number of decimal places
	    $div = pow(10, $decimals);

        EmployeeDetail::create([
            'login_id' => $login_id,
            'information_id' =>$info_id,
            'educ' => 'College',
            'position' => (rand(0,1)) ? 'Manager' : 'Teacher',
            'department' => (rand(0,1)) ? 'Faculty' : 'Marketing',
            'rate' => rand(500,1500) + mt_rand(0.01 * $div, 0.05 * $div) / $div,
            'employment_status' => (rand(0,1)) ? 'Onboardee' : 'regular',
            'resume' => 'resume/1.pdf',
            'start_date' => $faker->date('Y-m-d','now'),
            'schedule_Timein' => date('H:i:s', 25200),
            'schedule_Timeout' => date('H:i:s', 68400)
        ]);
    }
}
