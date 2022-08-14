<?php

namespace App\Http\Controllers;

use App\Models\HealthCheck;
use App\Http\Requests\StoreHealthCheckRequest;
use App\Http\Requests\UpdateHealthCheckRequest;

class HealthCheckController extends Controller
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
     * @param  \App\Http\Requests\StoreHealthCheckRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHealthCheckRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HealthCheck  $healthCheck
     * @return \Illuminate\Http\Response
     */
    public function show(HealthCheck $healthCheck)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HealthCheck  $healthCheck
     * @return \Illuminate\Http\Response
     */
    public function edit(HealthCheck $healthCheck)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateHealthCheckRequest  $request
     * @param  \App\Models\HealthCheck  $healthCheck
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHealthCheckRequest $request, HealthCheck $healthCheck)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HealthCheck  $healthCheck
     * @return \Illuminate\Http\Response
     */
    public function destroy(HealthCheck $healthCheck)
    {
        //
    }
}
