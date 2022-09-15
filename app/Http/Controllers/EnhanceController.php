<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEnhanceRequest;
use App\Http\Requests\UpdateEnhanceRequest;
use App\Models\Enhance;

class EnhanceController extends Controller
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
     * @param  \App\Http\Requests\StoreEnhanceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEnhanceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Enhance  $enhance
     * @return \Illuminate\Http\Response
     */
    public function show(Enhance $enhance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Enhance  $enhance
     * @return \Illuminate\Http\Response
     */
    public function edit(Enhance $enhance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEnhanceRequest  $request
     * @param  \App\Models\Enhance  $enhance
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEnhanceRequest $request, Enhance $enhance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Enhance  $enhance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Enhance $enhance)
    {
        //
    }
}
