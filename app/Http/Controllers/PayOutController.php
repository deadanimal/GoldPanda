<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePayOutRequest;
use App\Http\Requests\UpdatePayOutRequest;
use App\Models\PayOut;

class PayOutController extends Controller
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
     * @param  \App\Http\Requests\StorePayOutRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePayOutRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PayOut  $payOut
     * @return \Illuminate\Http\Response
     */
    public function show(PayOut $payOut)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PayOut  $payOut
     * @return \Illuminate\Http\Response
     */
    public function edit(PayOut $payOut)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePayOutRequest  $request
     * @param  \App\Models\PayOut  $payOut
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePayOutRequest $request, PayOut $payOut)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PayOut  $payOut
     * @return \Illuminate\Http\Response
     */
    public function destroy(PayOut $payOut)
    {
        //
    }
}
