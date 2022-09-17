<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePayInRequest;
use App\Http\Requests\UpdatePayInRequest;
use App\Models\PayIn;

class PayInController extends Controller
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
     * @param  \App\Http\Requests\StorePayInRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePayInRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PayIn  $payIn
     * @return \Illuminate\Http\Response
     */
    public function show(PayIn $payIn)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PayIn  $payIn
     * @return \Illuminate\Http\Response
     */
    public function edit(PayIn $payIn)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePayInRequest  $request
     * @param  \App\Models\PayIn  $payIn
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePayInRequest $request, PayIn $payIn)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PayIn  $payIn
     * @return \Illuminate\Http\Response
     */
    public function destroy(PayIn $payIn)
    {
        //
    }
}
