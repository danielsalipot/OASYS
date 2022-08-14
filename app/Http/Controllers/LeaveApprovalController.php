<?php

namespace App\Http\Controllers;

use App\Models\leave_approval;
use App\Http\Requests\Storeleave_approvalRequest;
use App\Http\Requests\Updateleave_approvalRequest;

class LeaveApprovalController extends Controller
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
     * @param  \App\Http\Requests\Storeleave_approvalRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storeleave_approvalRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\leave_approval  $leave_approval
     * @return \Illuminate\Http\Response
     */
    public function show(leave_approval $leave_approval)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\leave_approval  $leave_approval
     * @return \Illuminate\Http\Response
     */
    public function edit(leave_approval $leave_approval)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updateleave_approvalRequest  $request
     * @param  \App\Models\leave_approval  $leave_approval
     * @return \Illuminate\Http\Response
     */
    public function update(Updateleave_approvalRequest $request, leave_approval $leave_approval)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\leave_approval  $leave_approval
     * @return \Illuminate\Http\Response
     */
    public function destroy(leave_approval $leave_approval)
    {
        //
    }
}
