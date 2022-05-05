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
            'ph_rate' => '2.75',
            'ph_cap' => '1100',
            'minimum' => '10000',
            'maximum' => '40000',
            'ee_personal'=> '137.50'
        ]);
    }
}
