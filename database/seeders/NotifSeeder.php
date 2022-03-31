<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Notification;

use Faker\Factory as Faker;

class NotifSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        
        Notification::create([
            'sender_id' => rand(4,50),
            'receiver_id' => rand(1,10),
            'title' => $faker->realText(100),
            'message' => $faker->realText(500)
        ]);
    }
}
