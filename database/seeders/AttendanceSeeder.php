<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Attendance;
use App\Models\EmployeeDetail;
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
        $employees = EmployeeDetail::all();
        foreach ($employees as $key => $employee) {
            for ($j=1; $j < 30; $j++) {
                if(!rand(0,20)){
                    continue;
                }

                $date = date("Y-m-").$j;
                if(!in_array(date("w",strtotime($date)), json_decode($employee->schedule_days))){
                    continue;
                }
                Attendance::create([
                    'employee_id' => $employee->employee_id,
                    'time_in' => date('H:i:s', rand(24200  - 28800, 25500  - 28800)),
                    'time_out' => date('H:i:s', rand(66000 + 28800 + 21600, 72000 + 28800 + 21600)),
                    'attendance_day' =>date("w", strtotime($date)),
                    'attendance_date'=> $date
                ]);

                $date1 = "2022-09-".$j;
                if(!in_array(date("w",strtotime($date1)), json_decode($employee->schedule_days))){
                    continue;
                }
                Attendance::create([
                    'employee_id' => $employee->employee_id,
                    'time_in' => date('H:i:s', rand(24200  - 28800, 25500  - 28800)),
                    'time_out' => date('H:i:s', rand(66000 + 28800 + 21600, 72000 + 28800 + 21600)),
                    'attendance_day' =>date("w", strtotime($date1)),
                    'attendance_date'=> $date1
                ]);
            }
        }
    }
}
