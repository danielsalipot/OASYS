<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\UserCredential;
use App\Models\UserDetail;
use App\Models\ApplicantDetail;
use App\Models\coe;
use App\Models\EmployeeDetail;
use App\Models\LoginLogs;
use App\Models\notification_message;
use App\Models\notification_acknowledgements;
use Carbon\Carbon;
use Illuminate\Validation\Rules\Password;


class PagesController extends Controller
{
    function index(){
        return view('pages.index');
    }
    function about(){
        return view('pages.about');
    }
    function features(){
        return view('pages.features');
    }

    function login(){
        if(session('user_id')){
            LoginLogs::create([
                'user_id' => session('user_id'),
                'user_type' => session('user_type')
            ]);

            //check user type then redirect
            if(session('user_type') == 'payroll'){
                return redirect('/payroll/home');
            }

            if(session('user_type') == 'admin'){
                return redirect('/admin/home');
            }

            if(session('user_type') == 'staff'){
                return redirect('/staff/home');
            }

            if(session('user_type') == 'employee'){
                return redirect('/employee/home');
            }

            if(session('user_type') == 'applicant'){
                return redirect('/applicant/home');
            }
        }
        return view('pages.login');
    }

    function logout(){
        session()->flush();
        return redirect('/');
    }

    function view_notif(){
        $notif = notification_message::with('receivers')
            ->where('sender_id',session()->get('user_id'))
            ->paginate(10);

        foreach ($notif as $key => $value) {
            foreach ($value->receivers as $key => $receiver) {
                $receiver->data = UserDetail::where('information_id',$receiver->receiver_id)->first();
                $receiver->acknowledgement = notification_acknowledgements::where('notification_receiver_id',$receiver->id)->count();
            }
        }

        $profile = UserDetail::where('login_id',session('user_id'))->first();

        return view('pages.view_notif',compact('notif'))->with(['profile'=>$profile]);
    }

    function change_picture(){
        $profile = UserDetail::where('login_id',session('user_id'))->first();
        return view('pages.change_picture')->with(['profile'=>$profile]);
    }

    function hrProfile(){
        $details = UserDetail::where('login_id',session('user_id'))->first();
        $details->age = Carbon::parse($details->bday)->age;
        return view('pages.hr_profile')->with([
            'details' => $details,
            'profile' => $details
        ]);
    }

    function change_pass(){
        $profile = UserDetail::where('login_id',session('user_id'))->first();
        return view('pages.change_pass')->with(['
            profile' => $profile
        ]);
    }

    function changePassword(Request $request){
        $request->validate([
            'currentpass' =>'required',
            'newpass' =>['required',
                Password::min(8)
                    ->mixedCase() // allows both uppercase and lowercase
                    ->letters() //accepts letter
                    ->numbers() //accepts numbers
                    ->symbols() //accepts special character
                    ->uncompromised(),//check to be sure that there is no data leak
                ],
            'confirmpass' =>'required',
        ]);

        $password = UserCredential::where('login_id',session('user_id'))->first(['password'])->password;
        if(md5(md5($request->currentpass)) == $password){
            if ($request->newpass == $request->confirmpass) {
                UserCredential::where('login_id',session('user_id'))->update([
                    'password' => md5(md5($request->newpass))
                ]);

                return back()->with([
                    'success' => 'Password has been changed'
                ]);
            }
            else{
                return back()->with([
                    'confirmation' => 'The new password and confirmation does not match'
                ]);
            }
        }else{
            return back()->with([
                'incorrect' => "Incorrect current password"
            ]);
        }
    }

    function managerUpdateAccount(Request $request){
        $request->validate([
            'fname' => ['required','alpha'],
            'mname' => ['required','alpha'],
            'lname' => ['required','alpha'],
            'email'=>'required|email',
            'cnum'=>['required','regex:/^(09|\+639)\d{9}$/u'],
            'bday'=>'required',
        ]);

        UserDetail::where('login_id',session('user_id'))->update([
            'fname' => $request->fname,
            'mname' => $request->mname,
            'lname' => $request->lname,
            'email' => $request->email,
            'cnum' => $request->cnum,
            'bday' => $request->bday,
            'sex' => $request->sex
        ]);

        return back()->with([
            'success' => 'Account has been updated'
        ]);
    }

    function submit_change_picture(Request $request){
        $request->validate([
            'picinput'=>'required'
        ]);

        $current_pic = UserDetail::where('login_id',session('user_id'))->first();

        if(str_contains($current_pic->picture,'temp.png')){
            //upload
            $picfilename =  session('user_id').".".$request->file('picinput')->getClientOriginalExtension();
            $request->file('picinput')->storeAs('pictures', $picfilename,'public_uploads');

            UserDetail::where('login_id',session('user_id'))->update([
                'picture' => 'pictures/'. $picfilename
            ]);
        }
        else{
            // replace its file with new file
            File::delete('pictures/'. $current_pic->picture);

            $picfilename =  session('user_id').".".$request->file('picinput')->getClientOriginalExtension();
            $request->file('picinput')->storeAs('pictures', $picfilename,'public_uploads');
            // update db
            UserDetail::where('login_id',session('user_id'))->update([
                'picture' => 'pictures/'. $picfilename
            ]);
        }

        return redirect('/change_picture');
    }

    function test(){
        $notif = notification_message::with('receivers')
        ->where('sender_id','2')
        ->get();

        foreach ($notif as $key => $value) {
            foreach ($value->receivers as $key => $receiver) {
                $receiver->data = UserDetail::where('information_id',$receiver->receiver_id)->first();
                $receiver->acknowledgement = notification_acknowledgements::where('notification_receiver_id',$receiver->id)->count();
            }
        }

        return $notif;
    }

    function notification_acknowledgement_insert(Request $request){
        notification_acknowledgements::create([
            'notification_receiver_id' => $request->notif_receiver_id
        ]);
        return back();
    }

    function display_resume(Request $request){
        $path =  str_replace('\\','',$request->path);
        echo '<iframe src="/'.$path .'" width="100%" style="height:100%"></iframe>';
    }

    public function employee_profile_list(){
        $profile = UserDetail::where('login_id',session('user_id'))->first();

        $employees = EmployeeDetail::with('UserDetail')->get();
        return view('pages.employee_profile_list')->with([
            'profile' => $profile,
            'employees' => $employees
        ]);
    }

    public function signatureUpload(Request $request){

        $request->validate([
            'signature_input'=>'required'
        ]);

        $signatureFile =  session('user_id').".".$request->file('signature_input')->getClientOriginalExtension();
        $request->file('signature_input')->storeAs('signature', $signatureFile,'public_uploads');

        return back()->with(['signature' => 'Signature has been uploaded']);
    }
}
