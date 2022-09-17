<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlockchainMintRequest;
use App\Http\Requests\UpdateBlockchainMintRequest;
use App\Models\BlockchainMint;

class BlockchainMintController extends Controller
{

    public function home()
    {
        return view('blockchain.home');
    }

    public function admin_home()
    {
        return view('blockchain.admin_home');
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
     * @param  \App\Http\Requests\StoreBlockchainMintRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBlockchainMintRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BlockchainMint  $blockchainMint
     * @return \Illuminate\Http\Response
     */
    public function show(BlockchainMint $blockchainMint)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BlockchainMint  $blockchainMint
     * @return \Illuminate\Http\Response
     */
    public function edit(BlockchainMint $blockchainMint)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBlockchainMintRequest  $request
     * @param  \App\Models\BlockchainMint  $blockchainMint
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBlockchainMintRequest $request, BlockchainMint $blockchainMint)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BlockchainMint  $blockchainMint
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlockchainMint $blockchainMint)
    {
        //
    }
}
