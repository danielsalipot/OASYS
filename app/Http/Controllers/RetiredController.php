<?php

namespace App\Http\Controllers;

use App\Models\Retired;
use App\Http\Requests\StoreRetiredRequest;
use App\Http\Requests\UpdateRetiredRequest;

class RetiredController extends Controller
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
     * @param  \App\Http\Requests\StoreRetiredRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRetiredRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Retired  $retired
     * @return \Illuminate\Http\Response
     */
    public function show(Retired $retired)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Retired  $retired
     * @return \Illuminate\Http\Response
     */
    public function edit(Retired $retired)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRetiredRequest  $request
     * @param  \App\Models\Retired  $retired
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRetiredRequest $request, Retired $retired)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Retired  $retired
     * @return \Illuminate\Http\Response
     */
    public function destroy(Retired $retired)
    {
        //
    }
}
