<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Holiday;

use Faker\Factory as Faker;

class HolidaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Holiday::create([
            'holiday_name' => 'Test Holiday',
            'holiday_start_date' => '2022-05-04',
            'holiday_end_date' => '2022-05-06',
        ]);
    }
}
