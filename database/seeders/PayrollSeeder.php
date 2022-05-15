<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\UserCredential;
use App\Models\UserDetail;

use Faker\Factory as Faker;

class PayrollSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i=0; $i < 3; $i++){
            $login_id = UserCredential::create([
                'username' => 'HRPayroll' .$i,
                'password' => md5(md5('password123')),
                'user_type' => 'payroll'
            ]);

            UserDetail::create([
                'login_id' => $login_id->id,
                'fname' => $faker->FirstName,
                'mname' => $faker->LastName,
                'lname' => $faker->LastName,
                'sex' =>  'male',
                'age' => '20',
                'bday' => $faker->date($format = 'Y-m-d'),
                'cnum' => $faker->e164PhoneNumber,
                'email' => $faker->email,
                'picture' => 'pictures/temp.png',
            ]);
        }
    }
}
