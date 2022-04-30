<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Faker\Factory as Faker;
use App\Models\Message;

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

        Message::create([
            'sender_id' => rand(1,50),
            'receiver_id' => rand(1,50),
            'message' => $faker->realText(500)
        ]);

        Message::create([
            'sender_id' => rand(1,50),
            'receiver_id' => '2',
            'message' => $faker->realText(500)
        ]);

        Message::create([
            'sender_id' => '2',
            'receiver_id' => rand(1,50),
            'message' => $faker->realText(500)
        ]);
    }
}
