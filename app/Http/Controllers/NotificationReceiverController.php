<?php

namespace App\Http\Controllers;

use App\Models\notification_receiver;
use App\Http\Requests\Storenotification_receiverRequest;
use App\Http\Requests\Updatenotification_receiverRequest;

class NotificationReceiverController extends Controller
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
     * @param  \App\Http\Requests\Storenotification_receiverRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storenotification_receiverRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\notification_receiver  $notification_receiver
     * @return \Illuminate\Http\Response
     */
    public function show(notification_receiver $notification_receiver)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\notification_receiver  $notification_receiver
     * @return \Illuminate\Http\Response
     */
    public function edit(notification_receiver $notification_receiver)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatenotification_receiverRequest  $request
     * @param  \App\Models\notification_receiver  $notification_receiver
     * @return \Illuminate\Http\Response
     */
    public function update(Updatenotification_receiverRequest $request, notification_receiver $notification_receiver)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\notification_receiver  $notification_receiver
     * @return \Illuminate\Http\Response
     */
    public function destroy(notification_receiver $notification_receiver)
    {
        //
    }
}
