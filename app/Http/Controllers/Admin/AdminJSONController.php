<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Assessment;
use App\Models\Attendance;
use App\Models\Audit;
use App\Models\EmployeeDetail;
use App\Models\HealthCheck;
use App\Models\Learners;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use DateInterval;
use DateTime;
use Illuminate\Http\Request;

class AdminJSONController extends Controller
{
    public function AdminJSONController(){
        $orientation = Learners::where('module','orientation')->get();
        return $orientation;
    }

    public function assessmentEmployeeList(){
        $employeeDetails = EmployeeDetail::with('UserDetail')->get();

        foreach ($employeeDetails as $key => $employee) {
            $employee->assessment = Assessment::where('employee_id',$employee->employee_id)
                ->where('year',date("Y"))
                ->get();
        }

        return datatables()->of($employeeDetails)
            ->rawColumns(['select'])
            ->make(true);
    }

    public function getEmployeeAssessment($quarter,$id){
        $assessment = Assessment::where('employee_id',$id)
            ->where('quarter',$quarter)
            ->where('year',date('Y'))
            ->get();

        return $assessment;
    }

    public function regularizationEmployeeList(){
        $employeeDetails = EmployeeDetail::with('UserDetail')->where('employment_status','onboardee')->get();
        $assessment_category = ['attendance','performance','character','cooperation'];

        foreach ($employeeDetails as $key => $employee) {
            $scores = [];
            foreach ($assessment_category as $key => $value) {
                $assessments = Assessment::where('employee_id',$employee->employee_id)
                    ->where('assessment_type',$value)
                    ->get('score');

                $score = 0;
                foreach ($assessments as $key => $assessment_score) {
                    $score +=  $assessment_score->score / count($assessments);
                }

                array_push($scores,$score);
            }

            $employee->assessment = $scores;

            $days = Carbon::parse($employee->start_date)->diffInDays(Carbon::now());
            $start_date = new DateTime();
            $end_date = (new $start_date)->add(new DateInterval("P{$days}D") );
            $employee->duration = date_diff($start_date,$end_date);
        }

        return datatables()->of($employeeDetails)
            ->rawColumns(['select'])
            ->make(true);
    }

    public function attendanceTodayJSON(){
        $employee = EmployeeDetail::join('user_details','user_details.information_id','=','employee_details.information_id')
        ->get();

        foreach ($employee as $key => $value) {
            $value->attendance_today = Attendance::where('employee_id',$value->employee_id)
                ->where('attendance_date',date('Y-m-d'))
                ->first();

            if(isset($value->attendance_today->time_in)){
                if($this->timeCalculator($value->schedule_Timein) >= $this->timeCalculator($value->attendance_today->time_in))
                {
                    $value->time_in_status = 'On Time';
                }else
                {
                    $value->time_in_status = 'Late';
                }
                $value->healthCheck = HealthCheck::where('attendance_id',$value->attendance_today->attendance_id)->first('score');
            }
        }


        return datatables()->of($employee)
            ->make(true);
    }

    public function getEmployeeOverallAttendance(){
        $employees = EmployeeDetail::with('UserDetail')->get();
        foreach ($employees as $key => $employee) {
            $sched = json_decode($employee->schedule_days);
            $employee->absent = 0;
            $employee->ontime = 0;
            $employee->late = 0;
            $employee->total = 0;

            $period = CarbonPeriod::create($employee->start_date, Carbon::now())->toArray();
            foreach ($period as $key => $value) {
                $period[$key] = [$value->format('Y-m-d')];
                $period[$key][1] = (int)date('w',strtotime($value));
            }

            foreach ($period as $key => $date) {
                $attendance = Attendance::where('employee_id',$employee->employee_id)
                    ->where('attendance_date',$date[0])
                    ->first();

                if(isset($attendance)){
                    if($this->timeCalculator($employee->schedule_Timein) >= $this->timeCalculator($attendance->time_in)){
                        $employee->ontime += 1;
                    }else{
                        $employee->late += 1;
                    }

                    $employee->total += 1;
                }
                else{
                    if(in_array($date[1],$sched)){
                        $employee->absent += 1;
                    }
                }
            }
        }
        return datatables()->of($employees)
            ->make(true);
    }

    public function getAuditJson(Request $request){
        $audit = Audit::with('payroll_manager','employee_detail')
        ->whereBetween('created_at',[$request->from_date,new DateTime($request->to_date ." ". "23:59")])
        ->where('activity_type','admin')
            ->get();

        return datatables()->of($audit)
        ->addColumn('date',function($data){
            $date = date($data->created_at);

            return $date;
        })
        ->addColumn('payroll',function($data){
            $payroll = '<h5>'. $data->payroll_manager->fname . ' ' . $data->payroll_manager->mname . ' '. $data->payroll_manager->lname .'</h5>';

            return $payroll;
        })
        ->addColumn('employee_detail',function($data){
            if(isset($data->employee)){
                $payroll = '<h5>'. $data->employee .'</h5>';

                return $payroll;
            }
            else{
                return ' - ';
            }
        })
        ->rawColumns(['payroll','employee_detail','date'])
        ->make(true);
    }

    public function timeCalculator($time){
        list($hours, $minutes, $seconds) = explode(':',$time);
        return $hours * 3600 + $minutes * 60 + $seconds;
    }
}
