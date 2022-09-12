<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Contributions;

class ContributionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Contributions::create([
            'employee_contribution' => "4.5",
            'employer_contribution' => "8.5",
            'low_limit' => '14500',
            'high_limit' => '15000',
            'add_low' => "10",
            'add_high' => "30"
        ]);
    }
}
