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
        for ($i=1; $i <= 10; $i++) {
            Attendance::create([
                'employee_id' => $i,
                'time_in' => date('H:i:s', rand(24200,25200)),
                'time_out' => date('H:i:s', rand(64800,72000)),
            ]);
        }
    }
}
