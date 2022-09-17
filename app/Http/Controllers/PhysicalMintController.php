<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePhysicalMintRequest;
use App\Http\Requests\UpdatePhysicalMintRequest;
use App\Models\PhysicalMint;

class PhysicalMintController extends Controller
{

    public function home()
    {
        return view('physical.home');
    }

    public function admin_home()
    {
        return view('physical.admin_home');
    } 

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
     * @param  \App\Http\Requests\StorePhysicalMintRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePhysicalMintRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PhysicalMint  $physicalMint
     * @return \Illuminate\Http\Response
     */
    public function show(PhysicalMint $physicalMint)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PhysicalMint  $physicalMint
     * @return \Illuminate\Http\Response
     */
    public function edit(PhysicalMint $physicalMint)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePhysicalMintRequest  $request
     * @param  \App\Models\PhysicalMint  $physicalMint
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePhysicalMintRequest $request, PhysicalMint $physicalMint)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PhysicalMint  $physicalMint
     * @return \Illuminate\Http\Response
     */
    public function destroy(PhysicalMint $physicalMint)
    {
        //
    }
}
