<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Faker\Factory as Faker;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        if(!Position::where('position_title','Teacher')->count()){
            Position::create([
                'position_title' => 'Teacher',
                'position_description' => $faker->realText($maxNbChars = 200, $indexSize = 2)
            ]);
        }

        if(!Position::where('position_title','Manager')->count()){
            Position::create([
                'position_title' => 'Manager',
                'position_description' => $faker->realText($maxNbChars = 200, $indexSize = 2)
            ]);
        }

        Position::create([
            'position_title' => $faker->jobTitle,
            'position_description' => $faker->realText($maxNbChars = 200, $indexSize = 2)
        ]);
    }
}
