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
                'payrollManager_id' => '2',
                'employee_id' => rand(1,10),
                'deduction_name' => 'Loan',
                'deduction_amount' => rand(1000,10000) + mt_rand(0.01 * $div, 0.05 * $div) / $div,
                'deduction_date' => $faker->date($format = 'Y-m-d', $max = 'now')
            ]);
        }
    }
}
