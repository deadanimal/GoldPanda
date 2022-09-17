<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlockchainTransactionRequest;
use App\Http\Requests\UpdateBlockchainTransactionRequest;
use App\Models\BlockchainTransaction;

class BlockchainTransactionController extends Controller
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
     * @param  \App\Http\Requests\StoreBlockchainTransactionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBlockchainTransactionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BlockchainTransaction  $blockchainTransaction
     * @return \Illuminate\Http\Response
     */
    public function show(BlockchainTransaction $blockchainTransaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BlockchainTransaction  $blockchainTransaction
     * @return \Illuminate\Http\Response
     */
    public function edit(BlockchainTransaction $blockchainTransaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBlockchainTransactionRequest  $request
     * @param  \App\Models\BlockchainTransaction  $blockchainTransaction
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBlockchainTransactionRequest $request, BlockchainTransaction $blockchainTransaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BlockchainTransaction  $blockchainTransaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlockchainTransaction $blockchainTransaction)
    {
        //
    }
}
