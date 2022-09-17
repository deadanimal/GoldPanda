<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUSDPriceRequest;
use App\Http\Requests\UpdateUSDPriceRequest;
use App\Models\USDPrice;

class USDPriceController extends Controller
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
     * @param  \App\Http\Requests\StoreUSDPriceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUSDPriceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\USDPrice  $uSDPrice
     * @return \Illuminate\Http\Response
     */
    public function show(USDPrice $uSDPrice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\USDPrice  $uSDPrice
     * @return \Illuminate\Http\Response
     */
    public function edit(USDPrice $uSDPrice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUSDPriceRequest  $request
     * @param  \App\Models\USDPrice  $uSDPrice
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUSDPriceRequest $request, USDPrice $uSDPrice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\USDPrice  $uSDPrice
     * @return \Illuminate\Http\Response
     */
    public function destroy(USDPrice $uSDPrice)
    {
        //
    }
}
