<?php

namespace App\Http\Controllers;

use App\Models\Taxes;
use App\Http\Requests\StoreTaxesRequest;
use App\Http\Requests\UpdateTaxesRequest;

class TaxesController extends Controller
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
     * @param  \App\Http\Requests\StoreTaxesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaxesRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Taxes  $taxes
     * @return \Illuminate\Http\Response
     */
    public function show(Taxes $taxes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Taxes  $taxes
     * @return \Illuminate\Http\Response
     */
    public function edit(Taxes $taxes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTaxesRequest  $request
     * @param  \App\Models\Taxes  $taxes
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaxesRequest $request, Taxes $taxes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Taxes  $taxes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Taxes $taxes)
    {
        //
    }
}
