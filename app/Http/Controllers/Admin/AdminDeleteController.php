<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Assessment;
use App\Models\Audit;
use App\Models\EmployeeDetail;
use App\Models\notification_message;
use App\Models\Video;
use Illuminate\Http\Request;

class AdminDeleteController extends Controller
{
    public function deleteVideo(Request $request)
    {
        $video = json_decode($request->video);

        $video = Video::find($video->id);
        if(unlink($video->path))

        Audit::create(['activity_type' => 'admin',
            'payroll_manager_id' => session()->get('user_id'),
            'type' => 'Video',
            'employee' =>  '',
            'activity' => 'Remove a lesson on ' . $video->category,
            'amount' => $video->title,
            'tid' => $video->id,
        ]);

        $video->delete();

        return back()->with(['delete'=>'The lesson has been deleted on the module']);
    }

    public function deleteEmployeeAssessment(Request $request){
        foreach ($request->ids as $key => $value) {
            $assessment = Assessment::find($value);
            $employee = EmployeeDetail::with('UserDetail')->where('employee_id',$assessment->employee_id)->first();
            Audit::create(['activity_type' => 'admin',
                'payroll_manager_id' => session()->get('user_id'),
                'type' => 'Assessment',
                'employee' =>  $employee->userDetail->fname. ' ' . $employee->userDetail->mname . ' ' . $employee->userDetail->flname,
                'activity' => 'Remove ' . $assessment->assessment_type .' assessment' ,
                'amount' => $assessment->start_date . ' - ' . $assessment->end_date,
                'tid' => '',
            ]);
        }

        $head = 'Quarterly assessment on '. $assessment->start_date . ' - ' . $assessment->end_date;
        $text = $employee->UserDetail->fname . ' ' . $employee->UserDetail->mname . ' ' . $employee->UserDetail->fname .
        " your quarterly assessment on ". $assessment->start_date . ' - ' . $assessment->end_date ." was deleted on " . date('Y-m-d');

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

        return session()->flash('delete', 'The assessment has been deleted');
    }
}
