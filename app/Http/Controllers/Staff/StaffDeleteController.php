<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\ApplicantDetail;
use App\Models\notification_receiver;
use App\Models\UserCredential;
use App\Models\UserDetail;
use Illuminate\Http\Request;

class StaffDeleteController extends Controller
{
    public function staffDeleteApplicant(Request $request){
        UserCredential::where('login_id',$request->login_id)->delete();
        UserDetail::where('login_id',$request->login_id)->delete();
        ApplicantDetail::where('login_id',$request->login_id)->delete();
        notification_receiver::where('receiver_id',$request->login_id)->delete();

        return back()->with('success','The action was recorded successfully');
    }
}
