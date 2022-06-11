<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Attendance;
use DateTime;
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
        for ($i=1; $i <= 20; $i++) {
            for ($j=0; $j< 30; $j++) {
                Attendance::create([
                    'employee_id' => $i,
                    'time_in' => date('H:i:s', rand(24200,25200)),
                    'time_out' => date('H:i:s', rand(64800,72000)),
                    'attendance_date'=> $faker->dateTimeInInterval('-'. (31 - $j) .' days', '+0 days')
                ]);
            }
        }
    }
}
