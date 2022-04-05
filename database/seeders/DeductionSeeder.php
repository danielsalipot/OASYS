<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Deduction;

class DeductionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i <= 10 ; $i++) {
            Deduction::create([
                'payrollManager_id' => '3',
                'employee_id' => $i,
                'deduction_name' => 'Tax',
                'deduction_amount' => '12%'
            ]);
        }
    }
}
