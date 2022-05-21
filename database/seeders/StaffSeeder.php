<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\UserCredential;
use App\Models\UserDetail;

use Faker\Factory as Faker;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $login_id = UserCredential::create([
            'username' => 'HRStaff',
            'password' => md5(md5('password123')),
            'user_type' => 'staff'
        ]);

        UserDetail::create([
            'login_id' => $login_id->id,
            'fname' => $faker->FirstName,
            'mname' => $faker->LastName,
            'lname' => $faker->LastName,
            'sex' =>  (rand(0,1)) ? 'Male' : 'Female',
            'age' => rand(21,55),
            'bday' => $faker->date($format = 'Y-m-d'),
            'cnum' => $faker->e164PhoneNumber,
            'email' => $faker->email,
            'picture' => 'pictures/temp'.rand(1,9).'.jpg',
        ]);
    }
}
