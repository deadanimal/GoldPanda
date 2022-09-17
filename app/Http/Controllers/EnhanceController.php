<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enhance;

class EnhanceController extends Controller
{
    public function home(Request $request)
    {
        $user_id = 1;//$request->user()->id;
        $enhances = enhance::where('user_id', $user_id)->get();
        return view('enhance.home', compact('enhances'));
    }

    public function admin_home(Request $request)
    {
        return view('enhance.admin_home');
    }    

    public function create(Request $request)
    {        

        $enhance = new enhance;
        $enhance->gold_amount = $request->gold_amount;
        $enhance->fiat_leased = 1;
        $enhance->currency = 'MYR';
        $enhance->status = 'CRT';
        $enhance->user_id = $request->user()->id;
        $enhance->save();
       
        return view('enhance.created', compact('enhance'));
    }    

    public function show(enhance $enhance)
    {
        return view('enhance.detail', compact('enhance'));
    }
}
