<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\CashAdvance;

use Faker\Factory as Faker;

class CashAdvanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        CashAdvance::create([
            'payrollManager_id' => '3',
            'employee_id' => rand(1,10),
            'deduction_amount' => $faker->randomFloat(2, 1,50000)
        ]);
    }
}
