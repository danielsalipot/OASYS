<?php

namespace App\Http\Controllers;

use App\Models\notification_message;
use App\Http\Requests\Storenotification_messageRequest;
use App\Http\Requests\Updatenotification_messageRequest;

class NotificationMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Storenotification_messageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storenotification_messageRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\notification_message  $notification_message
     * @return \Illuminate\Http\Response
     */
    public function show(notification_message $notification_message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\notification_message  $notification_message
     * @return \Illuminate\Http\Response
     */
    public function edit(notification_message $notification_message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatenotification_messageRequest  $request
     * @param  \App\Models\notification_message  $notification_message
     * @return \Illuminate\Http\Response
     */
    public function update(Updatenotification_messageRequest $request, notification_message $notification_message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\notification_message  $notification_message
     * @return \Illuminate\Http\Response
     */
    public function destroy(notification_message $notification_message)
    {
        //
    }
}
