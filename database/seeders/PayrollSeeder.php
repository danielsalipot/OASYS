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

        for ($i=0; $i < 5; $i++){
            UserCredential::create([
                'username' => 'HRPayroll' .$i,
                'password' => md5(md5('password123')),
                'user_type' => 'payroll'
            ]);

            $login_id = UserCredential::where('username','HRPayroll'.$i)
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
                'picture' => 'pictures/'.$login_id. '.png',
            ]);
        }
    }
}
