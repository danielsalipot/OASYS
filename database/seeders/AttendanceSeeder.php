<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Attendance;
use App\Models\employee_activity;
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
            for ($i=0; $i <= 2; $i++) {
                if(!$i){
                    $j_limit = date('d');
                }else{
                    $j_limit =  date("t", strtotime(date("Y-").date('m')-$i));
                }
                for ($j=1; $j < $j_limit; $j++) {
                    if(!rand(0,100)){
                        continue;
                    }


                    $date = date("Y-").date('m') - $i ."-". $j;
                    if(!in_array(date("w",strtotime($date)), json_decode($employee->schedule_days))){
                        continue;
                    }

                    $time_in_time = date('H:i:s', rand(24200  - 28800, 25500  - 28800));
                    $time_out_time = date('H:i:s', rand(66000 + 28800 + 21600, 72000 + 28800 + 21600));

                    Attendance::create([
                        'employee_id' => $employee->employee_id,
                        'time_in' => $time_in_time,
                        'time_out' => $time_out_time,
                        'attendance_day' =>date("w", strtotime($date)),
                        'attendance_date'=> $date
                    ]);

                    employee_activity::create([
                        'employee_id' => $employee->employee_id,
                        'description' => 'Time in',
                        'activity_date' => $date . ' ' . $time_in_time
                    ]);

                    employee_activity::create([
                        'employee_id' => $employee->employee_id,
                        'description' => 'Answered health check form',
                        'activity_date' => $date .' '. $time_in_time
                    ]);

                    employee_activity::create([
                        'employee_id' => $employee->employee_id,
                        'description' => 'Time out',
                        'activity_date' => $date .' '. $time_out_time
                    ]);

                }
            }
        }
    }
}
