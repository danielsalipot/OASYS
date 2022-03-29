<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

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
        DB::table('notif_tbl')->insert([
            'sender_id' => rand(1,10),
            'receiver_id' => rand(1,10),
            'title' => $faker->realText(100),
            'message' => $faker->realText(500)
        ]);
    }
}
