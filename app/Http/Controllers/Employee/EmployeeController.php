<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Assessment;
use App\Models\Attendance;
use App\Models\EmployeeDetail;
use App\Models\HealthCheck;
use App\Models\Holiday;
use App\Models\holiday_attendance;
use App\Models\Learners;
use App\Models\leave_approval;
use App\Models\Message;
use App\Models\notification_acknowledgements;
use App\Models\notification_receiver;
use App\Models\overtime_approval;
use App\Models\Payslips;
use App\Models\Resigned;
use App\Models\UserCredential;
use App\Models\UserDetail;
use App\Models\Video;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    //Employee Functions
    function employeehome(){
        $employee = EmployeeDetail::with("UserDetail")->where('login_id',session('user_id'))->first();
        $employee->today = !in_array(date("w",strtotime(Carbon::now())), json_decode($employee->schedule_days));

        $attendance = Attendance::join('employee_details','employee_details.employee_id','=','attendances.employee_id')
            ->join('user_details','user_details.information_id','=','employee_details.information_id')
            ->where('attendance_date',date('Y-m-d'))
            ->where('attendances.employee_id', $employee->employee_id)
            ->first();

        if(isset($attendance)){
            $health_check = HealthCheck::where('attendance_id',$attendance->attendance_id)->first();
            $health_check_count = HealthCheck::where('attendance_id',$attendance->attendance_id)->count();
        }else{
            $health_check = null;
            $health_check_count = null;
        }


        $attendance_history = Attendance::join('employee_details','employee_details.employee_id','=','attendances.employee_id')
            ->join('user_details','user_details.information_id','=','employee_details.information_id')
            ->where('attendances.employee_id', $employee->employee_id)
            ->orderBy('attendance_date','desc')
            ->paginate(10);

        $notif = notification_receiver::with('message')
            ->where('receiver_id',session('user_id'))
            ->orderBy('created_at','desc')
            ->paginate(10);

        foreach ($notif as $key => $value) {
            $value->sender = UserDetail::where('login_id',$value->message->sender_id)->first();
        }

        foreach ($notif as $key => $value) {
            $value->acknowledgements = notification_acknowledgements::where('notification_receiver_id',$value->id)->count();
        }

        $now = Carbon::now();
        $weekStartDate = $now->startOfWeek(Carbon::SUNDAY)->format('Y-m-d');
        $weekEndDate = $now->endOfWeek(Carbon::SATURDAY)->format('Y-m-d');
        $period = CarbonPeriod::create($weekStartDate, $weekEndDate);
        $sched_arr = [];
        $holidays = Holiday::all();
        foreach ($holidays as $key => $value) {
            array_push($sched_arr,[
                'title'=>$value->holiday_name,
                'start'=> $value->holiday_start_date,
                'end'=> $value->holiday_end_date,
                'color' => 'Blue'
            ]);
        }

        foreach ($period as $key => $value) {
            $date = $value->format('Y-m-d');
            $schedule = json_decode($employee->schedule_days);
            if(in_array(date('w',strtotime($date)),$schedule)){
                array_push($sched_arr,[
                    'title'=>'Scheduled',
                    'start'=> $date,
                    'color' => 'Green'
                ]);

                array_push($sched_arr,[
                    'title'=>'Time in',
                    'start'=> $date . ' ' . $employee->schedule_Timein,
                ]);

                array_push($sched_arr,[
                    'title'=>'Time out',
                    'start'=> $date . ' ' . $employee->schedule_Timeout,
                ]);

            }
        }

        $payslips = Payslips::where('employee_id',session('user_id'))->get();
        return view('pages.employee.employeehome')->with([
            'attendance' => $attendance,
            'employee' => $employee,
            'attendance_history' => $attendance_history,
            'payslips' => $payslips,
            'notif'=>$notif,
            'sched_arr' => $sched_arr,
            'health_check' => $health_check,
            'health_check_count' => $health_check_count
        ]);
    }

    function employeeorientation(){
        $category = 'orientation';
        $videos = Video::where('category',$category)->orderBy('order','ASC')->get();

        foreach ($videos as $key => $video) {
            $employee_id = EmployeeDetail::where('login_id',Session('user_id'))->first()->employee_id;
            $video->learner = Learners::where('employee_id',$employee_id)->where('video_id',$video->id)->first();
        }

        if(isset($videos[0]->learner)){
            $progress = 0;
            foreach ($videos as $key => $value) {
                $progress += $value->learner->progress;
            }

            return view('pages.employee.employee_module')->with([
                'progress' => $progress,
                'learner' => $videos,
                'category' => $category
            ]);
        }
        else{
            return view('pages.employee.notenrolled')->with([
                'category' => $category
            ]);
        }
    }

    function employeetraining(){
        $category = 'training';
        $videos = Video::where('category',$category)->orderBy('order','ASC')->get();

        foreach ($videos as $key => $video) {
            $employee_id = EmployeeDetail::where('login_id',Session('user_id'))->first()->employee_id;
            $video->learner = Learners::where('employee_id',$employee_id)->where('video_id',$video->id)->first();
        }

        if(isset($videos[0]->learner)){
            $progress = 0;
            foreach ($videos as $key => $value) {
                $progress += $value->learner->progress;
            }

            return view('pages.employee.employee_module')->with([
                'progress' => $progress,
                'learner' => $videos,
                'category' => $category
            ]);
        }
        else{
            return view('pages.employee.notenrolled')->with([
                'category' => $category
            ]);
        }
    }

    function employeecorrection(){
        $category = 'correction';
        $videos = Video::where('category',$category)->orderBy('order','ASC')->get();

        foreach ($videos as $key => $video) {
            $employee_id = EmployeeDetail::where('login_id',Session('user_id'))->first()->employee_id;
            $video->learner = Learners::where('employee_id',$employee_id)->where('video_id',$video->id)->first();
        }

        if(isset($videos[0]->learner)){
            $progress = 0;
            foreach ($videos as $key => $value) {
                $progress += $value->learner->progress;
            }

            return view('pages.employee.employee_module')->with([
                'progress' => $progress,
                'learner' => $videos,
                'category' => $category
            ]);
        }
        else{
            return view('pages.employee.notenrolled')->with([
                'category' => $category
            ]);
        }
    }

    function overtime(){
        $employee = EmployeeDetail::where('login_id',session('user_id'))->first();
        $overtime = overtime_approval::join('attendances','attendances.attendance_id','=','overtime_approvals.attendance_id')
            ->join('employee_details','employee_details.employee_id','=','overtime_approvals.employee_id')
            ->where('overtime_approvals.employee_id',$employee->employee_id)
            ->orderBy('overtime_date','DESC')
            ->get();

        foreach ($overtime as $key => $value) {
            $timeout = $this->timeCalculator($value->time_out);
            $stimeout = $this->timeCalculator($value->schedule_Timeout);

            $value->total_overtime_hours = round(($timeout - $stimeout) / 3600,2);
            if(isset($value->approver_id)){
                $value->approver = UserDetail::where('login_id',$value->approver_id)->first();
            }
        }

        $employee = EmployeeDetail::with('UserDetail')->where('employee_id',session('user_id'))->first();

        return view('pages.employee.overtime')->with([
            'overtime' => $overtime,
            'employee' => $employee
        ]);
    }

    function leave(){
        $employee = EmployeeDetail::with('UserDetail')->where('login_id',session('user_id'))->first();
        $applications = leave_approval::where('employee_id',$employee->employee_id)->orderBy('created_at','DESC')->get();
        foreach ($applications as $key => $value) {
            $value->manager = UserDetail::where('login_id',$value->approver_id)->first();
        }
        return view('pages.employee.leave')->with([
            'employee' => $employee,
            'applications' => $applications
        ]);
    }

    function profile(){
        $profile = EmployeeDetail::with('UserDetail')->where('login_id',session('user_id'))->first();
        $profile->age = Carbon::parse($profile->userDetail->bday)->age;
        $profile->resign = Resigned::where('employee_id',$profile->employee_id)->first();

        if(isset($profile->resign)){
            $profile->resign->manager = UserDetail::where('login_id',$profile->resign->manager_id)->first();
        }

        $types = Assessment::groupBy('assessment_type')->get('assessment_type');
        foreach ($types as $key => $type) {
            $assessment = Assessment::where('assessment_type',$type->assessment_type)->where('employee_id',$profile->employee_id)->get();

            $type->average = 0;
            foreach ($assessment as $key => $value) {
                $type->average += $value->score;
            }
            $type->average = round($type->average / count($assessment),2);
        }

        $attendance_display_arr = [];
        $attendance = Attendance::where('employee_id',$profile->employee_id)->get();
        foreach ($attendance as $key => $value) {
            if(count(holiday_attendance::where('attendance_id',$value->attendance_id)->get())){
                array_push($attendance_display_arr,[
                    'title'=>' Paid Holiday',
                    'start'=> $value->attendance_date,
                    'color' => 'Blue'
                ]);
            }else{
                if($this->timeCalculator($profile->schedule_Timein) >= $this->timeCalculator($value->time_in))
                {
                    if($this->timeCalculator($profile->schedule_Timeout) > $this->timeCalculator($value->time_out)){
                        array_push($attendance_display_arr,[
                            'title'=>'ON TIME (Under Time)',
                            'start'=> $value->attendance_date,
                            'color' => 'Orange'
                        ]);

                        array_push($attendance_display_arr,[
                            'title'=>'Time in',
                            'start'=> $value->attendance_date . ' ' . $value->time_in,
                        ]);

                        array_push($attendance_display_arr,[
                            'title'=>'Time out',
                            'start'=>$value->attendance_date . ' ' . $value->time_out,
                        ]);
                    }else{
                        array_push($attendance_display_arr,[
                            'title'=>'ON TIME',
                            'start'=> $value->attendance_date,
                            'color' => 'Green'
                        ]);

                        array_push($attendance_display_arr,[
                            'title'=>'Time in',
                            'start'=> $value->attendance_date . ' ' . $value->time_in,
                        ]);

                        array_push($attendance_display_arr,[
                            'title'=>'Time out',
                            'start'=>$value->attendance_date . ' ' . $value->time_out,
                        ]);
                    }
                }else
                {
                    array_push($attendance_display_arr,
                    [
                        'title'=>'LATE',
                        'start'=> $value->attendance_date,
                        'color' => 'Red'
                    ]);

                    array_push($attendance_display_arr,[
                        'title'=>'Time in',
                        'start'=> $value->attendance_date . ' ' . $value->time_in,
                    ]);

                    array_push($attendance_display_arr,[
                        'title'=>'Time out',
                        'start'=>$value->attendance_date . ' ' . $value->time_out,
                    ]);
                }
            }
        }

        $years = Assessment::where('employee_id',$profile->employee_id)
            ->groupBy('year')
            ->orderBy('year','DESC')
            ->get('year');

        foreach ($years as $key => $value) {
            $value->quarter = Assessment::where('year',$value->year)
                ->where('employee_id',$profile->employee_id)
                ->groupBy('quarter')
                ->orderBy('quarter','DESC')
                ->get('quarter');

            foreach ($value->quarter as $key => $qtr) {
                $qtr->qrt_display = $this->ordinal($qtr->quarter);
                $qtr->assessments = Assessment::where('employee_id',$profile->employee_id)
                    ->where('quarter',$qtr->quarter)
                    ->where('year',$value->year)
                    ->get();
            }
        }

        return view('pages.employee.employeeprofile')->with([
            'profile' => $profile,
            'types' => $types,
            'attendance_display_arr' => $attendance_display_arr,
            'years' => $years
        ]);
    }

    function updateProfile(){
        $profile = EmployeeDetail::with('UserDetail')->where('login_id',session('user_id'))->first();
        $profile->age = Carbon::parse($profile->userDetail->bday)->age;
        $profile->password = UserCredential::where('login_id',session('user_id'))->first();

        return view('pages.employee.employee_update')->with([
            'profile' => $profile
        ]);
    }

    public function timeCalculator($time){
        list($hours, $minutes, $seconds) = explode(':',$time);
        return $hours * 3600 + $minutes * 60 + $seconds;
    }

    function ordinal($number) {
        $ends = array('th','st','nd','rd','th','th','th','th','th','th');
        if ((($number % 100) >= 11) && (($number%100) <= 13))
            return $number. 'th';
        else
            return $number. $ends[$number % 10];
    }

}
