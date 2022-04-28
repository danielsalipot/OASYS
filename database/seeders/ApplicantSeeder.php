<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\UserCredential;
use App\Models\UserDetail;
use App\Models\ApplicantDetail;

use Faker\Factory as Faker;

class ApplicantSeeder extends Seeder
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
            'user_type' => 'applicant'
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

        ApplicantDetail::create([
            'login_id' => $login_id,
            'information_id' =>$info_id,
            'Applyingfor' => 'Teacher',
            'educ' => 'College',
            'resume' => 'resume/1.pdf'
        ]);
    }
}
