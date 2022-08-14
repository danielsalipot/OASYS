<?php

namespace App\Http\Controllers;

use App\Models\overtime_approval;
use App\Http\Requests\Storeovertime_approvalRequest;
use App\Http\Requests\Updateovertime_approvalRequest;

class OvertimeApprovalController extends Controller
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
     * @param  \App\Http\Requests\Storeovertime_approvalRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storeovertime_approvalRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\overtime_approval  $overtime_approval
     * @return \Illuminate\Http\Response
     */
    public function show(overtime_approval $overtime_approval)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\overtime_approval  $overtime_approval
     * @return \Illuminate\Http\Response
     */
    public function edit(overtime_approval $overtime_approval)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updateovertime_approvalRequest  $request
     * @param  \App\Models\overtime_approval  $overtime_approval
     * @return \Illuminate\Http\Response
     */
    public function update(Updateovertime_approvalRequest $request, overtime_approval $overtime_approval)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\overtime_approval  $overtime_approval
     * @return \Illuminate\Http\Response
     */
    public function destroy(overtime_approval $overtime_approval)
    {
        //
    }
}
