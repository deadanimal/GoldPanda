<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMYRPriceRequest;
use App\Http\Requests\UpdateMYRPriceRequest;
use App\Models\MYRPrice;

class MYRPriceController extends Controller
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
     * @param  \App\Http\Requests\StoreMYRPriceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMYRPriceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MYRPrice  $mYRPrice
     * @return \Illuminate\Http\Response
     */
    public function show(MYRPrice $mYRPrice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MYRPrice  $mYRPrice
     * @return \Illuminate\Http\Response
     */
    public function edit(MYRPrice $mYRPrice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMYRPriceRequest  $request
     * @param  \App\Models\MYRPrice  $mYRPrice
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMYRPriceRequest $request, MYRPrice $mYRPrice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MYRPrice  $mYRPrice
     * @return \Illuminate\Http\Response
     */
    public function destroy(MYRPrice $mYRPrice)
    {
        //
    }
}
