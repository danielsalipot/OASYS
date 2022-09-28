<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Assessment;
use App\Models\Audit;
use App\Models\EmployeeDetail;
use App\Models\Learners;
use App\Models\notification_message;
use App\Models\Video;
use Illuminate\Http\Request;

class AdminInsertController extends Controller
{
    public function insertLesson(Request $request){
        try {
            //FILE NAMES user id + file extension
            $videoFileName =  $request->title.".".$request->file('video_file')->getClientOriginalExtension();

            // saves the picture into storage/public
            $request->file('video_file')->storeAs('videos/'.$request->category, $videoFileName,'public_uploads');

            $count = Video::where('category',$request->category)->count();

            Video::create([
                'title' => $request->title,
                'category' => $request->category,
                'order' => $count + 1,
                'description' => $request->description,
                'path' => 'videos/'.$request->category.'/'.$videoFileName
            ]);

            session()->flash('insert', 'The lesson has been successfully added to this module');
            return "upload success";

            Audit::create(['activity_type' => 'admin',
                'payroll_manager_id' => session()->get('user_id'),
                'type' => $request->category,

                'activity' => 'Added a new lesson on '. $request->category,
                'amount' => '',

            ]);

        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function enrollEmployee(Request $request){
        $employee_ids = explode(';',$request->emp_ids);
        $videos = Video::where('category',$request->module)->get();
        foreach ($videos as $key => $video) {
            for ($i=0; $i < count($employee_ids) - 1 ; $i++){
                Learners::create([
                    'video_id'=>$video->id,
                    'module' => $request->module,
                    'employee_id' => $employee_ids[$i],
                    'progress' => '0',
                    'start_date' => $request->start_date_input,
                    'end_date' => $request->end_date_input
                ]);
            }
        }

        for ($i=0; $i < count($employee_ids) - 1 ; $i++){
            $employee = EmployeeDetail::with('UserDetail')->where('employee_id',$employee_ids[$i])->first();
            Audit::create(['activity_type' => 'admin',
                'payroll_manager_id' => session()->get('user_id'),
                'type' => $request->module,
                'employee' =>  $employee->UserDetail->fname . ' ' . $employee->UserDetail->mname . ' ' . $employee->UserDetail->fname,
                'activity' => 'Enrolled'. $request->category,
                'amount' => 'Employee enrolled on ' . $request->module,

            ]);

            $head = 'You have been enrolled on '.$request->module;
            $text = $employee->UserDetail->fname . ' ' . $employee->UserDetail->mname . ' ' . $employee->UserDetail->fname .
            " you have been enrolled on " . $request->module . " on ". date('Y-m-d');

            $notif = notification_message::create([
                'sender_id' => session('user_id'),
                'title' => $head,
                'message' => $text
            ]);

            $notif->receivers()->createMany([
                ['receiver_id' => $employee->login_id]
            ]);

            app('App\Http\Controllers\EmailSendingController')->sendNotifEmail($head,$text,
                [['email' => $employee->userDetail->email, 'name' => $employee->userDetail->fname . ' ' . $employee->userDetail->lname]]
            );
        }


        $message = "Employees have been successfully enrolled in " . ucfirst($request->module);
        return back()->with(['insert'=>$message ]);
    }

    public function addAssessment(Request $request){
        $types = ['attendance','performance','character','cooperation'];
        $scores = [[],[],[],[]];
        foreach ($types as $key => $type) {
            $score = 0;
            for ($i=0; $i < 5; $i++) {
                $score += $request[$type . '_' . $i];
            }

            array_push($scores[$key],$score);
            if(!$key){
                array_push($scores[$key],3);
            }else{
                array_push($scores[$key],5);
            }
        }

        $feedbacks = [$request->attendance_feedback,$request->performance_feedback,$request->character_feedback,$request->cooperation_feedback,];

        for ($i=0; $i < 4; $i++) {
            Assessment::create([
                'employee_id' => $request->employee_id,
                'assessment_type' => $types[$i],
                'score' => ($scores[$i][0] / (5 * $scores[$i][1])) * 100,
                'feedback' => isset($feedbacks[$i]) ? true : '' ,
                'year' => date('Y'),
                'quarter'=> $request->quarter,
                'start_date' => $request->start_date,
                'end_date'=> $request->end_date
            ]);
        }


        $employee = EmployeeDetail::with('UserDetail')->where('employee_id',$request->employee_id)->first();

        Audit::create(['activity_type' => 'admin',
            'payroll_manager_id' => session()->get('user_id'),
            'type' => 'Assessment',
            'employee' =>  $employee->UserDetail->fname . ' ' . $employee->UserDetail->mname . ' ' . $employee->UserDetail->lname,
            'activity' => 'Created Assessment on employee',
            'amount' => $request->start_date . ' - ' . $request->end_date,

        ]);

        $head = 'Quarterly assessment created';
        $text = $employee->UserDetail->fname . ' ' . $employee->UserDetail->mname . ' ' . $employee->UserDetail->fname .
        " your quarterly assessment for ". $request->start_date . ' - ' . $request->end_date . "has been created";

        $notif = notification_message::create([
            'sender_id' => session('user_id'),
            'title' => $head,
            'message' => $text
        ]);

        $notif->receivers()->createMany([
            ['receiver_id' => $employee->login_id]
        ]);

        app('App\Http\Controllers\EmailSendingController')->sendNotifEmail($head,$text,
            [['email' => $employee->userDetail->email, 'name' => $employee->userDetail->fname . ' ' . $employee->userDetail->lname]]
        );

        return back()->with(['insert'=>'New assessment has been added']);
    }

    public function uploadLegalFormFiles(Request $request){
        //Upload file
        try {
            $filname = $request->file('file_input')->getClientOriginalName();
            $request->file('file_input')->storeAs('LegalForms/'. $request->form_type . '/upload', $filname,'public_uploads');
        } catch (\Throwable $th) {
            return back();
        }

        return back()->with(['insert' => 'The file has been uploaded']);
    }
}
