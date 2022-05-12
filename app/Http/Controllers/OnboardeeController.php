<?php

namespace App\Http\Controllers;

use App\Models\Onboardee;
use App\Http\Requests\StoreOnboardeeRequest;
use App\Http\Requests\UpdateOnboardeeRequest;

class OnboardeeController extends Controller
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
     * @param  \App\Http\Requests\StoreOnboardeeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOnboardeeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Onboardee  $onboardee
     * @return \Illuminate\Http\Response
     */
    public function show(Onboardee $onboardee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Onboardee  $onboardee
     * @return \Illuminate\Http\Response
     */
    public function edit(Onboardee $onboardee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOnboardeeRequest  $request
     * @param  \App\Models\Onboardee  $onboardee
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOnboardeeRequest $request, Onboardee $onboardee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Onboardee  $onboardee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Onboardee $onboardee)
    {
        //
    }
}
