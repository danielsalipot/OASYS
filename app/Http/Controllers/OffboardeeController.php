<?php

namespace App\Http\Controllers;

use App\Models\Offboardee;
use App\Http\Requests\StoreOffboardeeRequest;
use App\Http\Requests\UpdateOffboardeeRequest;

class OffboardeeController extends Controller
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
     * @param  \App\Http\Requests\StoreOffboardeeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOffboardeeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Offboardee  $offboardee
     * @return \Illuminate\Http\Response
     */
    public function show(Offboardee $offboardee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Offboardee  $offboardee
     * @return \Illuminate\Http\Response
     */
    public function edit(Offboardee $offboardee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOffboardeeRequest  $request
     * @param  \App\Models\Offboardee  $offboardee
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOffboardeeRequest $request, Offboardee $offboardee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Offboardee  $offboardee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Offboardee $offboardee)
    {
        //
    }
}
