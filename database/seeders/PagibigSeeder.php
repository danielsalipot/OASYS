<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Pagibig;

class PagibigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pagibig::create([
            'ee_rate' => '1',
            'er_rate' => '2',
            'maximum' => '100',
            'divider'=> '1500'
        ]);
    }
}
