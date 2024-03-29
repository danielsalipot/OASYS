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
            for ($j=1; $j < 20; $j++) {
                $date = date("2022-09-".$j);
                if(!in_array(date("w",strtotime("2022-09-".$j)), json_decode($employee->schedule_days))){
                    continue;
                }
                Attendance::create([
                    'employee_id' => $employee->employee_id,
                    'time_in' => date('H:i:s', rand(24200,25500)),
                    'time_out' => date('H:i:s', rand(66000,72000)),
                    'attendance_day' =>date("w", strtotime("2022-09-".$j)),
                    'attendance_date'=> $date
                ]);
            }
        }
    }
}
