<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Bonus;
use Faker\Factory as Faker;

class BonusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        Bonus::create([
            'payrollManager_id' => '2',
            'employee_id' => rand(1,10),
            'bonus_amount' => $faker->randomFloat(2, 1,50000),
            'bonus_date' => $faker->dateTimeInInterval('-7 weeks', '+14 weeks')
        ]);
    }
}
