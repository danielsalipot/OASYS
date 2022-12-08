<?php

namespace App\Http\Controllers;

use App\Models\leave_cashout;
use App\Http\Requests\Storeleave_cashoutRequest;
use App\Http\Requests\Updateleave_cashoutRequest;

class LeaveCashoutController extends Controller
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
     * @param  \App\Http\Requests\Storeleave_cashoutRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storeleave_cashoutRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\leave_cashout  $leave_cashout
     * @return \Illuminate\Http\Response
     */
    public function show(leave_cashout $leave_cashout)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\leave_cashout  $leave_cashout
     * @return \Illuminate\Http\Response
     */
    public function edit(leave_cashout $leave_cashout)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updateleave_cashoutRequest  $request
     * @param  \App\Models\leave_cashout  $leave_cashout
     * @return \Illuminate\Http\Response
     */
    public function update(Updateleave_cashoutRequest $request, leave_cashout $leave_cashout)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\leave_cashout  $leave_cashout
     * @return \Illuminate\Http\Response
     */
    public function destroy(leave_cashout $leave_cashout)
    {
        //
    }
}
