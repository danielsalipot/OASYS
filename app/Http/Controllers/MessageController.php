<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\notification_message;
use App\Models\UserCredential;
use App\Models\UserDetail;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    function message(){
        $profile = UserDetail::where('login_id',session('user_id'))->first();
        return view('pages.message')->with(['profile'=>$profile]);
    }

    function message_search($name){
        $profile = UserDetail::where('login_id',session('user_id'))->first();
        return view('pages.message')->with(['profile'=>$profile,'name'=>$name]);
    }


    function notification(){
        $profile = UserDetail::where('login_id',session('user_id'))->first();
        return view('pages.notification')->with(['profile'=>$profile]);
    }

    public function InsertMessage(Request $request)
    {
        try {
            Message::create([
                'sender_id' => $request->sid,
                'receiver_id' => $request->rid,
                'message' => $request->msg
            ]);
            return $request->rid;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function InsertNotification(Request $request)
    {
        $request->validate([
            'ids' => 'required',
            'title' => 'required',
            'body' => 'required'
        ]);

        $ids = explode(';',$request->ids);

        $notif = notification_message::create([
            'sender_id' => session()->get('user_id'),
            'title' => $request->title,
            'message' => $request->body
        ]);

        for ($i=0; $i < count($ids) - 1; $i++) {
            $notif->receivers()->createMany([
                ['receiver_id' => $ids[$i]]
            ]);
        }
        return back();
    }

    public function markAsReadChat($sender_id){
        Message::where('sender_id',$sender_id)
            ->where('receiver_id', session('user_id'))
            ->where('read_status',null)
            ->update([
                'read_status' => 1,
                'read_date' => date('Y-m-d  h:i:s')
            ]);
    }

    // JSON
    public function ChatEmployeeDetails(){
        //all pwera lang sa applicants
        $users = UserCredential::join('user_details','user_details.login_id','=','user_credentials.login_id')
            ->where('user_credentials.user_type','!=','applicant')
            ->where('user_credentials.login_id','!=',session('user_id'))
            ->get();

        foreach ($users as $key => $user) {
            $user->userDetail = UserDetail::where("login_id", $user->login_id)->first();
            $user->unread = Message::where('receiver_id',session('user_id'))
                ->where('sender_id',$user->login_id)
                ->where('read_status',null)
                ->count();
        }

        return datatables()->of($users)
            ->addColumn('full_name',function($data){
                return $data->userDetail->fname . " " . $data->userDetail->mname . " " . $data->userDetail->lname;
            })
            ->addColumn('btn',function($data){
                $full_name = $data->userDetail->fname . " " . $data->userDetail->mname . " " . $data->userDetail->lname;

                if($data->unread){
                    $button ='
                    <button id="btn'.$data->information_id.'" onclick="chat_click(this,\''. addslashes($full_name) .'\',\'/'.$data->userDetail->picture.'\','.$data->login_id.')" class="text-dark card w-100 p-2 m-2 shadow-lg">
                        <div class="row w-100">
                            <div class="col-3">
                                <img src="/'.$data->userDetail->picture.'" class="rounded" width="50" height="50">
                            </div>

                            <div class="col text-center mt-3"><h5 style="font-size:11px;">'. $full_name .'</h5>'. $data->user_type .'
                            </div>

                            <div class="col-1">
                                <span class="badge badge-pill bg-danger p-2 ms-3 rounded" id="badge">'. $data->unread .'</span>
                            </div>
                        </div>
                    </button>';
                }else{
                    $button ='
                    <button id="btn'.$data->information_id.'" onclick="chat_click(this,\''. addslashes($full_name) .'\',\'/'.$data->userDetail->picture.'\','.$data->information_id.')" class="text-dark card w-100 p-2 m-2 shadow-lg">
                        <div class="row w-100">
                            <div class="col-3">
                                <img src="/'.$data->userDetail->picture.'" class="rounded" width="50" height="50">
                            </div>

                            <div class="col text-center mt-3"><h5 style="font-size:11px;">'. $full_name .'</h5>'. $data->user_type .'
                            </div>

                            <div class="col-1">
                            </div>
                        </div>
                    </button>';
                }

                return $button;
            })
            ->rawColumns(['full_name','btn'])
            ->make(true);
    }


    public function MessageJson($r_id){
        $send = Message::where(function ($query) use ($r_id) {
            $query->where('receiver_id',$r_id)
            ->where('sender_id',session('user_id'));
            })
            ->orWhere(function ($query) use ($r_id) {
                $query->where('sender_id',$r_id)
                ->where('receiver_id',session('user_id'));
                })
            ->orderBy('created_at','ASC')
            ->get();

        foreach ($send as $key => $value) {
            $value->sender = UserDetail::where('login_id',$value->sender_id)->first();
            $value->receiver = UserDetail::where('login_id',$value->receiver_id)->first();

            $value->sent_on = date('Y-m-d h:i:s', strtotime($value->created_at));
        }

        return $send;
    }

    function fetchNavBarMessageCount(){
        $message = Message::where('receiver_id',session('user_id'))
            ->where('read_status',null)
            ->count();

        return $message;
    }

}
