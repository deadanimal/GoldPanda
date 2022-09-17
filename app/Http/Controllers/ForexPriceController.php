<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreForexPriceRequest;
use App\Http\Requests\UpdateForexPriceRequest;
use App\Models\ForexPrice;

class ForexPriceController extends Controller
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
     * @param  \App\Http\Requests\StoreForexPriceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreForexPriceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ForexPrice  $forexPrice
     * @return \Illuminate\Http\Response
     */
    public function show(ForexPrice $forexPrice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ForexPrice  $forexPrice
     * @return \Illuminate\Http\Response
     */
    public function edit(ForexPrice $forexPrice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateForexPriceRequest  $request
     * @param  \App\Models\ForexPrice  $forexPrice
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateForexPriceRequest $request, ForexPrice $forexPrice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ForexPrice  $forexPrice
     * @return \Illuminate\Http\Response
     */
    public function destroy(ForexPrice $forexPrice)
    {
        //
    }
}
