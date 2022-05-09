<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\UserCredential;
use App\Models\UserDetail;
use App\Models\ApplicantDetail;
use App\Models\notification_message;


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
        // check if a user is logged in, redirect them accourdingly
        if(session()->has('user_id') && session('user_type') == 'applicant'){
            return redirect('/applicant/home');
        }
        if(session()->has('user_id') && session('user_type') == 'payroll'){
            return redirect('/payroll/home');
        }
        return view('pages.login');
    }

    function logout(Request $request){
        session()->flush();
        return redirect('/');
    }

    function view_notif(){
        $notif = notification_message::with('receivers')
            ->where('sender_id',session()->get('user_id'))
            ->get();

        foreach ($notif as $key => $value) {
            foreach ($value->receivers as $key => $receiver) {
                $receiver->data = UserDetail::where('information_id',$receiver->receiver_id)->first();
            }
        }

        $profile = UserDetail::where('login_id',session('user_id'))->first();
        return view('pages.view_notif',compact('notif'))->with(['profile'=>$profile]);
    }

    function change_picture(){
        $profile = UserDetail::where('login_id',session('user_id'))->first();
        return view('pages.change_picture')->with(['profile'=>$profile]);
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

    function test($x,$y){
        return $x . $y;
    }
}

