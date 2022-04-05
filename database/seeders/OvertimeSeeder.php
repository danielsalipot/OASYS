<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Overtime;
use App\Models\EmployeeDetail;
use App\Models\Attendance;


class OvertimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i <= 10; $i++) {
            $employee = EmployeeDetail::where('employee_id',$i)->first();
            $attendance = Attendance::where('employee_id',$i)->first();
            Overtime::create([
                'employee_id' => $i,
                'schedule_Timein' => $employee->schedule_Timein,
                'schedule_Timeout' => $employee->schedule_Timeout,
                'Time_in' => $attendance->time_in,
                'Time_out' => $attendance->time_out,
            ]);
        }
    }
}
