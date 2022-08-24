<?php

namespace App\Http\Controllers;

use App\Models\employee_activity;
use App\Http\Requests\Storeemployee_activityRequest;
use App\Http\Requests\Updateemployee_activityRequest;

class EmployeeActivityController extends Controller
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
     * @param  \App\Http\Requests\Storeemployee_activityRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storeemployee_activityRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\employee_activity  $employee_activity
     * @return \Illuminate\Http\Response
     */
    public function show(employee_activity $employee_activity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\employee_activity  $employee_activity
     * @return \Illuminate\Http\Response
     */
    public function edit(employee_activity $employee_activity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updateemployee_activityRequest  $request
     * @param  \App\Models\employee_activity  $employee_activity
     * @return \Illuminate\Http\Response
     */
    public function update(Updateemployee_activityRequest $request, employee_activity $employee_activity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\employee_activity  $employee_activity
     * @return \Illuminate\Http\Response
     */
    public function destroy(employee_activity $employee_activity)
    {
        //
    }
}
