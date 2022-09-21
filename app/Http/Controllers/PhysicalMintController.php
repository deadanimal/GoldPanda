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
use App\Models\PhysicalMint;

class PhysicalMintController extends Controller
{

    public function home(Request $request)
    {
        $user_id = $request->user()->id;
        $mints = PhysicalMint::where([
            ['user_id', '=', $user_id]
        ])->get();        
        return view('physical.home', compact('mints'));
    }

    public function admin_home()
    {
        return view('physical.admin_home');
    } 

    public function create()
    {
        //
    }

    public function mint(Request $request)
    {
        $mint = new PhysicalMint;        

        $mint->amount = $request->amount * 1000000;
        $mint->status =	'CRT';
        $mint->user_id = $request->user()->id;

        $mint->save();

        $url = '/app/physical/mint/'.$mint->id;
       
        return redirect($url);                
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PhysicalMint  $physicalMint
     * @return \Illuminate\Http\Response
     */
    public function show_mint(Request $request)
    {
        $id = (int)$request->route('id');
        $user_id = $request->user()->id;
        $mint = PhysicalMint::where([
            ['id','=', $id],
            ['user_id', '=', $user_id]
        ])->first();
        return view('physical.mint', compact('mint'));
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
