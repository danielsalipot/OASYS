<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\notification_message;
use App\Models\UserDetail;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    function message(){
        $profile = UserDetail::where('login_id',session('user_id'))->first();
        return view('pages.message')->with(['profile'=>$profile]);
    }

    function notification(){
        $profile = UserDetail::where('login_id',session('user_id'))->first();
        return view('pages.notification')->with(['profile'=>$profile]);
    }

    public function InsertMessage(Request $request)
    {
        Message::create([
            'sender_id' => $request->sid,
            'receiver_id' => $request->rid,
            'message' => $request->msg
        ]);
        return $request->rid;
    }

    public function InsertNotification(Request $request)
    {
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
}
