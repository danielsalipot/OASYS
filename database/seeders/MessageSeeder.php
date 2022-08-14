<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Faker\Factory as Faker;
use App\Models\Message;
use App\Models\UserCredential;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $users = UserCredential::join('user_details','user_details.login_id','=','user_credentials.login_id')
            ->where('user_credentials.user_type','!=','applicant')
            ->where('user_credentials.login_id','!=',session('user_id'))
            ->get();

        foreach ($users as $key => $value) {
            $except = $key;

            do {
                $rand = rand(0, count($users) - 1);
            } while ($rand == $except);

            Message::create([
                'sender_id' => $value->login_id,
                'receiver_id' => $rand,
                'message' => $faker->realText(500)
            ]);
        }
    }
}
