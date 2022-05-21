<?php

namespace App\Http\Controllers;

use App\Models\Clearance;
use App\Http\Requests\StoreClearanceRequest;
use App\Http\Requests\UpdateClearanceRequest;

class ClearanceController extends Controller
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
     * @param  \App\Http\Requests\StoreClearanceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClearanceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Clearance  $clearance
     * @return \Illuminate\Http\Response
     */
    public function show(Clearance $clearance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Clearance  $clearance
     * @return \Illuminate\Http\Response
     */
    public function edit(Clearance $clearance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClearanceRequest  $request
     * @param  \App\Models\Clearance  $clearance
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClearanceRequest $request, Clearance $clearance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Clearance  $clearance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Clearance $clearance)
    {
        //
    }
}
