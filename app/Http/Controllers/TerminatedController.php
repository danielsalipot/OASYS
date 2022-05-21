<?php

namespace App\Http\Controllers;

use App\Models\Terminated;
use App\Http\Requests\StoreTerminatedRequest;
use App\Http\Requests\UpdateTerminatedRequest;

class TerminatedController extends Controller
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
     * @param  \App\Http\Requests\StoreTerminatedRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTerminatedRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Terminated  $terminated
     * @return \Illuminate\Http\Response
     */
    public function show(Terminated $terminated)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Terminated  $terminated
     * @return \Illuminate\Http\Response
     */
    public function edit(Terminated $terminated)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTerminatedRequest  $request
     * @param  \App\Models\Terminated  $terminated
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTerminatedRequest $request, Terminated $terminated)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Terminated  $terminated
     * @return \Illuminate\Http\Response
     */
    public function destroy(Terminated $terminated)
    {
        //
    }
}
