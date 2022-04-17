<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Attendance;

use Faker\Factory as Faker;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $decimals = 5; // number of decimal places
	    $div = pow(10, $decimals);

        for ($i=1; $i <= 20; $i++) {
            for ($j=0; $j < 15; $j++) {
                Attendance::create([
                    'employee_id' => $i,
                    'time_in' => date('H:i:s', rand(24200,25200)),
                    'time_out' => date('H:i:s', rand(64800,72000)),
                    'total_hours' => 7 + mt_rand(0.01 * $div, 0.05 * $div) / $div,
                    'attendance_date'=> $faker->dateTimeInInterval('-7 weeks', '+14 weeks')
                ]);
            }
        }
    }
}
