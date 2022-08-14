<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\HealthCheck;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HealthCheckSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $attendance = Attendance::all();
        foreach ($attendance as $key => $value) {
            HealthCheck::create([
                'employee_id' => $value->employee_id,
                'score' => rand(0,6),
                'attendance_id' => $value->attendance_id
            ]);
        }
    }
}
