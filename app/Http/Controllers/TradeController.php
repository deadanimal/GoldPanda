<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bought;
use App\Models\Sold;

class TradeController extends Controller
{

    public function home(Request $request)
    {
        $user_id = 1;//$request->user()->id;
        $boughts = Bought::where('user_id', $user_id)->get();
        $solds = Sold::where('user_id', $user_id)->get();
        return view('trade.home', compact('boughts', 'solds'));
    }

    public function create(Request $request)
    {        

        $fiat_flow = $request->amount;
        $fiat_fee = $request->amount * 0.05;
        $fiat_nett = $fiat_flow - $fiat_fee;

        if($request->flow == 'buy') {
            $trade = new Bought;

            $gold_amount = $fiat_nett / $gold_price;
            $trade->fiat_inflow = $fiat_flow;
            $trade->gold_amount = $gold_amount;

        } else {
            $trade = new Sold;

            $gold_amount = $fiat_nett * $gold_price;
            $trade->fiat_outflow = $fiat_flow;
            $trade->gold_amount = 123.45;           
        }

        $trade->fiat_fee = $fiat_fee;
        $trade->fiat_nett = $fiat_nett;
        $trade->gold_amount = $gold_amount;
        $trade->fiat_currency = 'MYR';
        $trade->status = 'CRT';
        $trade->user_id = $request->user()->id;
        $trade->save();
       
        return view('trade.created', compact('trade'));
    }    

    public function show_bought(Bought $trade)
    {
        return view('trade.detail', compact('trade'));
    }

    public function show_sold(Sold $trade)
    {
        return view('trade.detail', compact('trade'));
    }    

}