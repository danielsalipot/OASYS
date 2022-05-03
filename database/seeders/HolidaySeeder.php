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
            'start_date' => '2022-5-4',
            'end_date' => '2022-5-6',
        ]);
    }
}
