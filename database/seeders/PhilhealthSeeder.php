<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\philhealth;

class PhilhealthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        philhealth::create([
            'ee_rate' => '50',
            'er_rate' => '50',
            'ph_rate' => '4',
            'ph_cap' => '3200',
            'minimum_contribution' => '400',
            'minimum' => '10000',
            'maximum' => '80000',
        ]);
    }
}
