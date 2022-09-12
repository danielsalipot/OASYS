<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Deduction;
use Faker\Factory as Faker;

class DeductionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $decimals = 2; // number of decimal places
	    $div = pow(10, $decimals);

        for ($i=1; $i <= 20 ; $i++) {
            Deduction::create([
                'payrollManager_id' => rand(2,4),
                'employee_id' => rand(1,10),
                'deduction_name' => 'deduction' . rand(1,3),
                'deduction_amount' => rand(1000,5000) + mt_rand(0.01 * $div, 0.05 * $div) / $div,
                'deduction_start_date' => $faker->dateTimeInInterval('-0 weeks', '+0 weeks'),
                'deduction_end_date' => $faker->dateTimeInInterval('-0 weeks', '+14 weeks')
            ]);
        }
    }
}
