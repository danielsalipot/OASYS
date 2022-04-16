<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Taxes;

class TaxesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i <= 20; $i++) {
            Taxes::create([
                'payrollHR_id' => '2',
                'employee_id' => $i,
                'tax_amount' => '5%'
            ]);
        }
    }
}
