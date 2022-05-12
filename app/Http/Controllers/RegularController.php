<?php

namespace App\Http\Controllers;

use App\Models\Regular;
use App\Http\Requests\StoreRegularRequest;
use App\Http\Requests\UpdateRegularRequest;

class RegularController extends Controller
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
     * @param  \App\Http\Requests\StoreRegularRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRegularRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Regular  $regular
     * @return \Illuminate\Http\Response
     */
    public function show(Regular $regular)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Regular  $regular
     * @return \Illuminate\Http\Response
     */
    public function edit(Regular $regular)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRegularRequest  $request
     * @param  \App\Models\Regular  $regular
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRegularRequest $request, Regular $regular)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Regular  $regular
     * @return \Illuminate\Http\Response
     */
    public function destroy(Regular $regular)
    {
        //
    }
}
