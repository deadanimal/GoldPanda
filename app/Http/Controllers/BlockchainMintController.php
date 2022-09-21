<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Redirect;


use App\Models\GoldPrice;
use App\Models\ForexPrice;
use App\Models\Bought;
use App\Models\Sold;
use App\Models\PayIn;
use App\Models\PayOut;
use App\Models\BlockchainMint;

class BlockchainMintController extends Controller
{

    public function home(Request $request)
    {
        $user_id = $request->user()->id;
        $mints = BlockchainMint::where([
            ['user_id', '=', $user_id]
        ])->get();        
        return view('blockchain.home', compact('mints'));
    }

    public function admin_home()
    {
        return view('blockchain.admin_home');
    } 

    public function create()
    {
        //
    }

    public function mint(Request $request)
    {
        $mint = new BlockchainMint;        

        $mint->amount = $request->amount * 1000000;
        $mint->status =	'CRT';
        $mint->user_id = $request->user()->id;

        $mint->save();

        $url = '/app/blockchain/mint/'.$mint->id;
       
        return redirect($url);                
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BlockchainMint  $blockchainMint
     * @return \Illuminate\Http\Response
     */
    public function show_mint(Request $request)
    {
        $id = (int)$request->route('id');
        $user_id = $request->user()->id;
        $mint = BlockchainMint::where([
            ['id','=', $id],
            ['user_id', '=', $user_id]
        ])->first();
        return view('blockchain.mint', compact('mint'));
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
