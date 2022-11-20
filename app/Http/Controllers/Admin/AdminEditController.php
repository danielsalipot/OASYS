<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Assessment;
use App\Models\Audit;
use App\Models\EmployeeDetail;
use App\Models\Learners;
use App\Models\notification_message;
use App\Models\Video;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminEditController extends Controller
{
    public function editLesson(Request $request){
        if(isset($request->video_file)){
            //FILE NAMES user id + file extension
            $videoFileName =  $request->title.".".$request->file('video_file')->getClientOriginalExtension();
            // saves the picture into storage/public
            $request->file('video_file')->storeAs('videos/'.$request->category, $videoFileName,'public_uploads');

            Video::find($request->id)->update([
                'path' => 'videos/'.$request->category.'/'.$videoFileName,
            ]);
        }

        Audit::create(['activity_type' => 'admin',
            'payroll_manager_id' => session()->get('user_id'),
            'type' => 'Lesson',
            'activity' => 'Updated a lesson on ' . Video::find($request->id)->category,
            'amount' => Video::find($request->id)->title,

        ]);

        Video::find($request->id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'order' => $request->order
        ]);

        return 'edit success';
    }

    public function completeEmployeeModule(Request $request)
    {
        $learner_ids = explode(';',$request->learner_ids);

        for ($i=0; $i < count($learner_ids) - 1; $i++) {
            Learners::find($learner_ids[$i])->update([
                'completion_status' => 1
            ]);

            $employee = EmployeeDetail::with('UserDetail')->where('employee_id',Learners::find($learner_ids[$i])->employee_id)->first();

            Audit::create(['activity_type' => 'admin',
                'payroll_manager_id' => session()->get('user_id'),
                'type' => 'Module',
                'employee' =>  $employee->userDetail->fname . ' ' . $employee->userDetail->mname . ' ' . $employee->userDetail->lname,
                'activity' => 'Completion of '.Learners::find($learner_ids[$i])->module.' module',
                'amount' => Learners::find($learner_ids[$i])->completion_date,
                'tid' => $learner_ids[$i],
            ]);

            $head = 'Completion of ' .Learners::find($learner_ids[$i])->module;
            $text = $employee->UserDetail->fname . ' ' . $employee->UserDetail->mname . ' ' . $employee->UserDetail->fname .
            " your completion of " .Learners::find($learner_ids[$i])->module. " on ". Learners::find($learner_ids[$i])->completion_date ."  has been marked completed on " . date('Y-m-d');

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

        return back();
    }

    public function updateEmployeeAssessment(Request $request){
        for ($i=0; $i < 4; $i++) {
            Assessment::find($request->ids[$i])->update([
                'score' => $request->scores[$i],
                'feedback'=> $request->feedbacks[$i]
            ]);

            $employee = EmployeeDetail::with('UserDetail')->where('employee_id', Assessment::find($request->ids[$i])->employee_id)->first();
            Audit::create(['activity_type' => 'admin',
                'payroll_manager_id' => session()->get('user_id'),
                'type' => 'Assessment',
                'employee' =>  $employee->userDetail->fname . ' ' . $employee->userDetail->mname . ' ' . $employee->userDetail->lname,
                'activity' => 'Update an Assessment '.  Assessment::find($request->ids[$i])->assessment_type,
                'amount' => Assessment::find($request->ids[$i])->start_date . ' - ' . Assessment::find($request->ids[$i])->end_date,
                'tid' => $request->ids[$i],
            ]);

            $head = 'Quarterly Assessment on '. Assessment::find($request->ids[$i])->start_date . ' - ' . Assessment::find($request->ids[$i])->end_date . " has been update";
            $text =  $employee->UserDetail->fname . ' ' . $employee->UserDetail->mname . ' ' . $employee->UserDetail->fname .
            " your quarterly assessment for ". Assessment::find($request->ids[$i])->start_date . ' - ' . Assessment::find($request->ids[$i])->end_date . "has been update";

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
        };

        return session()->flash('update', 'The assessment has been updated');
    }

    public function updateEmploymentStatus($id){
        EmployeeDetail::where('employee_id',$id)->update([
            'employment_status' => 'Regular'
        ]);

        $employee = EmployeeDetail::with('UserDetail')->where('employee_id',$id)->first();
        Audit::create(['activity_type' => 'admin',
            'payroll_manager_id' => session()->get('user_id'),
            'type' => 'Regularization',
            'employee' =>  $employee->userDetail->fname . ' ' . $employee->userDetail->mname . ' ' . $employee->userDetail->lname,
            'activity' => 'Regularized employee '.  $id,
            'amount' => Carbon::now(),

        ]);

        $head = 'Employment status update';
        $text = $employee->UserDetail->fname . ' ' . $employee->UserDetail->mname . ' ' . $employee->UserDetail->fname .
        " you have been promoted to a regular employee on ". date('Y-m-d');

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

        return back()->with(['update'=>'The assessment has been updated']);
    }
}
