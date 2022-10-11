<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Assessment;
use App\Models\Attendance;
use App\Models\Department;
use App\Models\EmployeeDetail;
use App\Models\HealthCheck;
use App\Models\Learners;
use App\Models\Position;
use App\Models\UserDetail;
use App\Models\Video;
use App\Spiders\BIRWebSpider;
use App\Spiders\PagibigWebSpider;
use App\Spiders\PhilHealthWebSpider;
use App\Spiders\SSSWebSpider;
use Carbon\Carbon;
use DateInterval;
use DateTime;
use RoachPHP\Roach;
use Throwable;

class AdminController extends Controller
{
   //HR Admin Functions
    public function adminhome(){
        $profile = UserDetail::where('login_id',session('user_id'))->first();
        $attendance_today = Attendance::where('attendance_date',date('Y-m-d'))
            ->join('employee_details','employee_details.employee_id','=','attendances.employee_id')
            ->join('user_details','user_details.information_id','=','employee_details.information_id')
            ->get();

        $employees = EmployeeDetail::all();
        $employee_scheduled_count = 0;
        foreach ($employees as $key => $employee) {
            if(in_array(date('w',strtotime(date('Y-m-d'))), json_decode($employee->schedule_days))){
                $employee_scheduled_count += 1;
            }
        }

        foreach ($attendance_today as $key => $value) {
            if($this->timeCalculator($value->schedule_Timein) > $this->timeCalculator($value->time_in)){
                $value->time_in_status = 'On Time';
            }else{
                $value->time_in_status = 'Late';
            }

            $value->healthCheck = HealthCheck::where('attendance_id',$value->attendance_id)->first('score');
        }

        $category = [
            ['category'=>'orientation'],
            ['category'=>'training'],
            ['category'=>'correction']
        ];

        foreach ($category as $key => $value) {
            $category[$key]['learners'] = Learners::where('module',$value['category'])->get();
            $category[$key]['videos'] = Video::where('category',$value['category'])->get();
        }

        $onboardees = EmployeeDetail::with('UserDetail')->where('employment_status','onboardee')->orderBy('start_date','ASC')->get();
        foreach ($onboardees as $key => $value) {
            $days = Carbon::parse($value->start_date)->diffInDays(Carbon::now());
            $start_date = new DateTime();
            $end_date = (new $start_date)->add(new DateInterval("P{$days}D") );
            $value->duration = date_diff($start_date,$end_date);
        }

        return view('pages.HR_admin.adminhome')->with([
            'attendance_today' => $attendance_today,
            'employee_scheduled_count' => $employee_scheduled_count,
            'videos' => $category,
            'onboardees' => $onboardees,
            'profile' => $profile
        ]);
    }

    public function attendance(){
        $profile = UserDetail::where('login_id',session('user_id'))->first();
        $employee = EmployeeDetail::join('user_details','user_details.information_id','=','employee_details.information_id')
            ->get();

        $time_in = [0,[0,0,0],0,[0,0,0],[0,0,0],0,0,[0,0,0]];
        foreach ($employee as $key => $value) {
            $value->attendance_today = Attendance::where('employee_id',$value->employee_id)
                ->where('attendance_date',date('Y-m-d'))
                ->first();

            if(isset($value->attendance_today->time_in)){
                if($this->timeCalculator($value->schedule_Timein) >= $this->timeCalculator($value->attendance_today->time_in) && $this->timeCalculator($value->schedule_Timeout) <= $this->timeCalculator($value->attendance_today->time_out))
                {
                    $value->time_in_status = 'On Time';
                    if($value->employment_status == 'onboardee'){
                        $time_in[1][0] += 1;
                    }
                    if($value->employment_status == 'Regular'){
                        $time_in[1][1] += 1;
                    }
                    if($value->employment_status == 'Offboardee'){
                        $time_in[1][2] += 1;
                    }
                    $time_in[0] += 1;
                }elseif($this->timeCalculator($value->schedule_Timein) >= $this->timeCalculator($value->attendance_today->time_in) && $this->timeCalculator($value->schedule_Timeout) > $this->timeCalculator($value->attendance_today->time_out)){
                    $value->time_in_status = 'Under time';

                    if($value->employment_status == 'onboardee'){
                        $time_in[7][0] += 1;
                    }
                    if($value->employment_status == 'Regular'){
                        $time_in[7][1] += 1;
                    }
                    if($value->employment_status == 'Offboardee'){
                        $time_in[7][2] += 1;
                    }

                    $time_in[6] += 1;
                }
                else{
                    $value->time_in_status = 'Late Time';

                    if($value->employment_status == 'onboardee'){
                        $time_in[3][0] += 1;
                    }
                    if($value->employment_status == 'Regular'){
                        $time_in[3][1] += 1;
                    }
                    if($value->employment_status == 'Offboardee'){
                        $time_in[3][2] += 1;
                    }

                    $time_in[2] += 1;
                }
            }else{
                if(in_array(date('w',strtotime(Carbon::now())),json_decode($value->schedule_days))){
                    if($value->employment_status == 'onboardee'){
                        $time_in[4][0] += 1;
                    }
                    if($value->employment_status == 'Regular'){
                        $time_in[4][1] += 1;
                    }
                    if($value->employment_status == 'Offboardee'){
                        $time_in[4][2] += 1;
                    }
                    $time_in[5] += 1;
                }
            }
        }

        $health_check = [0,0,0,0,0,0,0];
        $attendance_today = Attendance::join('health_checks','health_checks.attendance_id','=','attendances.attendance_id')
            ->where('attendance_date',date('Y-m-d'))
            ->get();

        foreach ($attendance_today as $key => $value) {
            $health_check[$value->score] += 1;
        }

        $all_time_attendance = $this->getAttendance();

        return view('pages.HR_admin.attendance')->with([
            'date_filter' => $all_time_attendance->date_filter,
            'profile' => $profile,
            'employee' => $employee,
            'time_in' => $time_in,
            'health_check' => $health_check,
            'health_check_all' => $this->getAttendance(4),
            'totals' => $this->getAttendance(1),
            'deparment_attendance' =>  $this->getAttendance(2),
            'position_attendance' =>  $this->getAttendance(3),
            'all_date' => array_column($all_time_attendance->toArray(),"attendance_date"),
            'all_ontime' => array_column($all_time_attendance->toArray(),"on_time_count"),
            'all_late' => array_column($all_time_attendance->toArray(),"late_count"),
            'all_absent' => array_column($all_time_attendance->toArray(),"absent"),
        ]);
    }

    function getAttendance($i = 0){
        $total_attendance = 0;
        $total_ontime = 0;
        $total_absent = 0;
        $total_late = 0;

        $departments = Department::groupBy('department_name')->orderBy('department_name')->get('department_name');
        foreach ($departments as $key => $dept) {
            $dept->ontime = 0;
            $dept->absent = 0;
            $dept->late = 0;
        }

        $positions = Position::groupBy('position_title')->orderBy('position_title')->get('position_title');
        foreach ($positions as $key => $pos) {
            $pos->ontime = 0;
            $pos->absent = 0;
            $pos->late = 0;
        }

        if(date('d') > 15){
            $all_time_attendance = Attendance::groupBy('attendance_date')
            ->whereBetween('attendance_date',[date('Y-m-').'16', date('Y-m-').'31'])
            ->get('attendance_date');
            $all_time_attendance->date_filter = [date('Y-m-').'16', date('Y-m-').'31'];

        }else{
            $all_time_attendance = Attendance::groupBy('attendance_date')
            ->whereBetween('attendance_date',[date('Y-m-').'1', date('Y-m-').'15'])
            ->get('attendance_date');

            $all_time_attendance->date_filter = [date('Y-m-').'1', date('Y-m-').'15'];
        }

        $health_check_all = [[],[],[],[],[],[],[],[]];

        $employees = EmployeeDetail::all();

        foreach ($all_time_attendance as $key => $date) {
            $date->on_time_count = 0;
            $date->late_count = 0;
            $date->absent = 0;

            array_push($health_check_all[0],$date->attendance_date);
            array_push($health_check_all[1],0);
            array_push($health_check_all[2],0);
            array_push($health_check_all[3],0);
            array_push($health_check_all[4],0);
            array_push($health_check_all[5],0);
            array_push($health_check_all[6],0);
            array_push($health_check_all[7],0);

            foreach ($employees as $key => $employee) {
                $attendance = Attendance::where('employee_id',$employee->employee_id)
                    ->where('attendance_date',$date->attendance_date)
                    ->first();

                if(isset($attendance)){
                    $health_score = HealthCheck::where('attendance_id',$attendance->attendance_id)->first('score');
                    if($health_score){
                        $health_check_all[$health_score->score + 1][count($health_check_all[$health_score->score + 1]) -1 ] += 1;
                    }


                    $total_attendance += 1;
                    if($this->timeCalculator($employee->schedule_Timein) >= $this->timeCalculator($attendance->time_in) && $this->timeCalculator($employee->schedule_Timeout) <= $this->timeCalculator($attendance->time_out)){
                        $total_ontime += 1;
                        $date->on_time_count += 1;

                        foreach ($departments as $key => $dept) {
                            if($dept->department_name == $employee->department){
                                $dept->ontime += 1;
                            }
                        }
                        foreach ($positions as $key => $pos) {
                            if($pos->position_title == $employee->position){
                                $pos->ontime += 1;
                            }
                        }
                    }else{
                        $total_late += 1;
                        $date->late_count += 1;

                        foreach ($departments as $key => $dept) {
                            if($dept->department_name == $employee->department){
                                $dept->late += 1;
                            }
                        }
                        foreach ($positions as $key => $pos) {
                            if($pos->position_title == $employee->position){
                                $pos->late += 1;
                            }
                        }
                    }
                }else{
                    if(in_array(date('w',strtotime($date->attendance_date)),json_decode($employee->schedule_days))){
                        $total_absent += 1;
                        $date->absent += 1;

                        foreach ($departments as $key => $dept) {
                            if($dept->department_name == $employee->department){
                                $dept->absent += 1;
                            }
                        }

                        foreach ($positions as $key => $pos) {
                            if($pos->position_title == $employee->position){
                                $pos->absent += 1;
                            }
                        }
                    }
                }
            }
        }

        if($i == 1){
            return [$total_attendance, $total_ontime, $total_absent, $total_late];
        }
        if($i == 2){
            return $departments;
        }
        if($i == 3){
            return $positions;
        }
        if($i == 4){
            return $health_check_all;
        }


        return $all_time_attendance;
    }

    public function regularization(){
        $profile = UserDetail::where('login_id',session('user_id'))->first();
        return view('pages.HR_admin.regularization')->with([
            'profile' => $profile,
        ]);
    }

    public function regularization_main($name){
        $profile = UserDetail::where('login_id',session('user_id'))->first();
        return view('pages.HR_admin.regularization')->with([
            'profile' => $profile,
            'name' => $name
        ]);
    }

    public function performance(){
        $profile = UserDetail::where('login_id',session('user_id'))->first();
        return view('pages.HR_admin.performance')->with([
            'profile' => $profile
        ]);
    }


/*=============================================================================
|                                 START
|                        Orientation Controllers
|
*==============================================================================*/

    public function moduleorientation(){
        $category = 'orientation';
        $profile = UserDetail::where('login_id',session('user_id'))->first();

        $employees = EmployeeDetail::join('user_details','user_details.information_id','=','employee_details.information_id')->get();

        $learners = [];
        foreach ($employees as $key => $employee) {
            $employee->module = Learners::where('employee_id',$employee->employee_id)
                ->where('module',$category)
                ->get();

            if(count($employee->module)){
                array_push($learners,$employees[$key]);
            }
        }

        $inprogress = [];
        $completed = [];

        foreach ($learners as $key => $learner) {
            $learner->progress = 0;
            foreach ($learner->module as $key => $value) {
                $learner->progress += $value->progress;
            }

            $learner->progress = ($learner->progress / count($learner->module)) * 100;

            if($learner->module[0]->completion_status == NULL){
                array_push($inprogress,$learner);
            }
            else{
                array_push($completed,$learner);
            }
        }

        $videos = Video::where('category',$category)
            ->orderBy('order','ASC')
            ->get();

        return view('pages.HR_admin.module')->with([
            'videos'=>$videos,
            'category' => $category,
            'inprogress'=>$inprogress,
            'completed' => $completed,
            'profile' => $profile
        ]);
    }

    public function addorientation(){
        $category = 'orientation';
        $profile = UserDetail::where('login_id',session('user_id'))->first();
        return view('pages.HR_admin.addlesson')->with([
            'category'=>$category,
            'profile' => $profile
        ]);
    }

    public function editlessonorientation($id){
        $category = 'orientation';
        $profile = UserDetail::where('login_id',session('user_id'))->first();
        $video = Video::find($id);
        return view('pages.HR_admin.edit_lesson')->with([
            'category'=>$category,
            'video'=>$video,
            'profile' => $profile
        ]);
    }

/*=============================================================================
|                                   END
*==============================================================================*/




/*=============================================================================
|                                 START
|                        Correction Controllers
|
*==============================================================================*/
    public function modulecorrection(){
        $category = 'correction';
        $profile = UserDetail::where('login_id',session('user_id'))->first();

        $employees = EmployeeDetail::join('user_details','user_details.information_id','=','employee_details.information_id')->get();

        $learners = [];
        foreach ($employees as $key => $employee) {
            $employee->module = Learners::where('employee_id',$employee->employee_id)
                ->where('module',$category)
                ->get();

            if(count($employee->module)){
                array_push($learners,$employees[$key]);
            }
        }

        $inprogress = [];
        $completed = [];

        foreach ($learners as $key => $learner) {
            $learner->progress = 0;
            foreach ($learner->module as $key => $value) {
                $learner->progress += $value->progress;
            }

            $learner->progress = ($learner->progress / count($learner->module)) * 100;

            if($learner->module[0]->completion_status == NULL){
                array_push($inprogress,$learner);
            }
            else{
                array_push($completed,$learner);
            }
        }

        $videos = Video::where('category',$category)->get();
        return view('pages.HR_admin.module')->with([
            'videos'=>$videos,
            'category' => $category,
            'inprogress'=>$inprogress,
            'completed' => $completed,
            'profile' => $profile
        ]);
    }

    public function addcorrection(){
        $category = 'correction';
        $profile = UserDetail::where('login_id',session('user_id'))->first();
        return view('pages.HR_admin.addlesson')->with([
            'category'=>$category,
            'profile' => $profile
        ]);
    }

    public function editlessoncorrection($id){
        $category = 'correction';
        $profile = UserDetail::where('login_id',session('user_id'))->first();
        $video = Video::find($id);
        return view('pages.HR_admin.edit_lesson')->with([
            'category'=>$category,
            'video'=>$video,
            'profile' => $profile
        ]);
    }



/*=============================================================================
|                                   END
*==============================================================================*/




/*=============================================================================
|                                 START
|                        Training Controllers
|
*==============================================================================*/

    public function moduletraining(){
        $category = 'training';
        $profile = UserDetail::where('login_id',session('user_id'))->first();

        $employees = EmployeeDetail::join('user_details','user_details.information_id','=','employee_details.information_id')->get();

        $learners = [];
        foreach ($employees as $key => $employee) {
            $employee->module = Learners::where('employee_id',$employee->employee_id)
                ->where('module',$category)
                ->get();

            if(count($employee->module)){
                array_push($learners,$employees[$key]);
            }
        }

        $inprogress = [];
        $completed = [];

        foreach ($learners as $key => $learner) {
            $learner->progress = 0;
            foreach ($learner->module as $key => $value) {
                $learner->progress += $value->progress;
            }

            $learner->progress = ($learner->progress / count($learner->module)) * 100;

            if($learner->module[0]->completion_status == NULL){
                array_push($inprogress,$learner);
            }
            else{
                array_push($completed,$learner);
            }
        }

        $videos = Video::where('category',$category)->get();
        return view('pages.HR_admin.module')->with([
            'videos'=>$videos,
            'category' => $category,
            'inprogress'=>$inprogress,
            'completed' => $completed,
            'profile' => $profile
        ]);
    }

    public function addtraining(){
        $category = 'training';
        $profile = UserDetail::where('login_id',session('user_id'))->first();
        return view('pages.HR_admin.addlesson')->with([
            'category'=>$category,
            'profile' => $profile
        ]);
    }

    public function editlessontraining($id){
        $category = 'training';
        $profile = UserDetail::where('login_id',session('user_id'))->first();
        $video = Video::find($id);
        return view('pages.HR_admin.edit_lesson')->with([
            'category'=>$category,
            'video'=>$video,
            'profile' => $profile
        ]);
    }

/*=============================================================================
|                                   END
*==============================================================================*/

    public function assessment($id){
        $profile = UserDetail::where('login_id',session('user_id'))->first();
        $employee = EmployeeDetail::with('UserDetail')
            ->where('employee_id',$id)
            ->first();

        $employee->assessment = Assessment::where('employee_id',$employee->employee_id)->where('year',date("Y"))->get(['quarter']);
        $recorded_assessment =[
            Assessment::where('employee_id',$employee->employee_id)->where('year',date("Y"))->where('quarter','1')->get(),
            Assessment::where('employee_id',$employee->employee_id)->where('year',date("Y"))->where('quarter','2')->get(),
            Assessment::where('employee_id',$employee->employee_id)->where('year',date("Y"))->where('quarter','3')->get(),
            Assessment::where('employee_id',$employee->employee_id)->where('year',date("Y"))->where('quarter','4')->get(),
        ];

        $quarters = [];
        foreach ($employee->assessment as $key => $value) {
            if(!in_array($value->quarter, $quarters)){
                array_push($quarters, $value->quarter);
            }
        }
        return view('pages.HR_admin.assessment')->with([
            'employee'=> $employee,
            'profile' => $profile,
            'quarters' => $quarters,
            'recorded_assessment' => $recorded_assessment,
            'carbon' => Carbon::now()
        ]);
    }

    public function assessment_history($id){
        $profile = UserDetail::where('login_id',session('user_id'))->first();
        $employee = EmployeeDetail::with('UserDetail')
            ->where('employee_id',$id)
            ->first();

        $years = Assessment::where('employee_id',$employee->employee_id)
            ->groupBy('year')
            ->orderBy('year','DESC')
            ->get('year');

        foreach ($years as $key => $value) {
            $value->quarter = Assessment::where('year',$value->year)
                ->where('employee_id',$employee->employee_id)
                ->groupBy('quarter')
                ->orderBy('quarter','DESC')
                ->get('quarter');

            foreach ($value->quarter as $key => $qtr) {
                $qtr->qrt_display = $this->ordinal($qtr->quarter);
                $qtr->assessments = Assessment::where('employee_id',$employee->employee_id)
                    ->where('quarter',$qtr->quarter)
                    ->where('year',$value->year)
                    ->get();
            }
        }

        $employee->assessments = $years;
        return view('pages.HR_admin.assessment_history')->with([
            'employee'=> $employee,
            'profile' => $profile
        ]);
    }

    public function audittrail(){
        $profile = UserDetail::where('login_id',session('user_id'))->first();

        $files_arr = ["files" =>[]];
        foreach ($files_arr as $key => $value) {
            if ($handle = opendir("audits/".session('user_type')."/")) {
                while (false !== ($entry = readdir($handle))) {
                    if ($entry != "." && $entry != ".." && $entry != 'upload' && $entry != '.gitkeep') {
                        array_push($files_arr["files"],["name" => "$entry","path"=> "audits/".session('user_type')."/" . $entry]);
                    }
                }
                closedir($handle);
            }
        }

        $files_arr['files'] = array_reverse($files_arr['files']);

        return view('pages.HR_admin.audittrail')->with([
            'profile' => $profile,
            'files_arr' => $files_arr
        ]);
    }

    public function employee_activities(){
        $profile = UserDetail::where('login_id',session('user_id'))->first();

        $files_arr = ["files" =>[]];
        foreach ($files_arr as $key => $value) {
            if ($handle = opendir("employee_activities/")) {
                while (false !== ($entry = readdir($handle))) {
                    if ($entry != "." && $entry != ".." && $entry != 'upload' && $entry != '.gitkeep') {
                        array_push($files_arr["files"],["name" => "$entry","path"=> "employee_activities/" . $entry]);
                    }
                }
                closedir($handle);
            }
        }

        return view('pages.HR_admin.employee_activities')->with([
            'profile' => $profile,
            'files_arr' => $files_arr
        ]);
    }

    public function LegalForms(){
        $profile = UserDetail::where('login_id',session('user_id'))->first();

        try{
            Roach::startSpider(SSSWebSpider::class);
            $items = Roach::collectSpider(SSSWebSpider::class);
            $sss = str_replace('/sss/DownloadContent','https://www.sss.gov.ph/sss/DownloadContent', $items[0]->get('subtitle'));
            $sss = str_replace('<a','<a class="text-decoration-none btn btn-outline-primary border-0" style="font-size:13px;"', $sss);
        }
        catch(\Throwable $th){
            $sss = 0;
        }


        try{
            Roach::startSpider(PhilHealthWebSpider::class);
            $items = Roach::collectSpider(PhilHealthWebSpider::class);
            $philhealth = str_replace('href="','href="https://www.philhealth.gov.ph/downloads/', $items[0]->get('html'));
            $philhealth = str_replace('<a','<a class="text-decoration-none btn btn-outline-primary border-0" style="font-size:13px;margin-left:80px;"', $philhealth);
            $philhealth = str_replace('h5','h4', $philhealth);
        }
        catch(\Throwable $th){
            $philhealth = 0;
        }

        try {
            Roach::startSpider(PagibigWebSpider::class);
            $items = Roach::collectSpider(PagibigWebSpider::class);
            $pagibig = "<table class='table'>";
            $pagibig .= str_replace('href="','href="https://www.pagibigfund.gov.ph/', $items[0]->get('html'));
            $pagibig = str_replace('images/PDF-icon.gif"','https://t4.ftcdn.net/jpg/03/80/53/35/360_F_380533515_CWsTHnDBMVgtNt3eCdHvdBkWgxNkTm9W.jpg" height="20px" width="20px" ', $pagibig);
            $pagibig = str_replace('<img src="images/excel-icon.png" alt="" height="20" width="20" border="0">','<img src="https://findicons.com/files/icons/2795/office_2013_hd/2000/excel.png" alt="" height="20" width="20" border="0">', $pagibig);
            $pagibig = str_replace('<img src="images/word-icon.png">','<img src="https://cdn.icon-icons.com/icons2/2397/PNG/512/microsoft_office_word_logo_icon_145724.png" height="20" width="20" border="0">', $pagibig);
            $pagibig .= "</table>";
        } catch (\Throwable $th) {
            $pagibig = 0;
        }

        try {
            Roach::startSpider(BIRWebSpider::class);
            $items = Roach::collectSpider(BIRWebSpider::class);
            $bir = str_replace('href="/index.php/bir-forms','target="blank" href="https://www.bir.gov.ph/index.php/bir-forms', $items[0]->get('html'));
            $bir = str_replace('<table','<table class="table table-striped"', $bir);
        } catch (\Throwable $th) {
            $bir = 0;
        }

        $files_arr = ["SSS" => [ "files" =>[] ], "Pagibig" => [ "files" =>[] ], "Philhealth" => [ "files" =>[] ], "BIR" => [ "files" =>[] ]];
        foreach ($files_arr as $key => $value) {
            if ($handle = opendir("LegalForms/$key/")) {
                while (false !== ($entry = readdir($handle))) {
                    if ($entry != "." && $entry != ".." && $entry != 'upload' && $entry != '.gitkeep') {
                        array_push($files_arr[$key]['files'],["name" => "$entry","path"=>"LegalForms/$key/".$entry]);
                    }
                }
                closedir($handle);
            }
        }

        $accomplished_files_arr = ["SSS" => [ "files" =>[] ], "Pagibig" => [ "files" =>[] ], "Philhealth" => [ "files" =>[] ], "BIR" => [ "files" =>[] ]];
        foreach ($accomplished_files_arr as $key => $value) {
            if ($handle = opendir("LegalForms/$key/upload/")) {
                while (false !== ($entry = readdir($handle))) {
                    if ($entry != "." && $entry != ".." && $entry != 'upload' && $entry != '.gitkeep') {
                        array_push($accomplished_files_arr[$key]['files'],["name" => "$entry","path"=>"LegalForms/$key/upload/".$entry]);
                    }
                }
                closedir($handle);
            }
        }

        return view('pages.HR_admin.legal_forms')->with([
            'profile' => $profile,
            'sss' => $sss,
            'philhealth' => $philhealth,
            'pagibig' => $pagibig,
            'bir' => $bir,
            'files_arr' => $files_arr,
            'accomplished_files_arr' => $accomplished_files_arr
        ]);
    }

    public function adminManual(){
        return view('pages.Admin.manual');
    }

    function ordinal($number) {
        $ends = array('th','st','nd','rd','th','th','th','th','th','th');
        if ((($number % 100) >= 11) && (($number%100) <= 13))
            return $number. 'th';
        else
            return $number. $ends[$number % 10];
    }

    public function timeCalculator($time){
        list($hours, $minutes, $seconds) = explode(':',$time);
        return $hours * 3600 + $minutes * 60 + $seconds;
    }
}
