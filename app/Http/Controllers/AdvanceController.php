<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Advance;

class AdvanceController extends Controller
{
    public function home(Request $request)
    {
        $user_id = 1;//$request->user()->id;
        $advances = advance::where('user_id', $user_id)->get();
        return view('advance.home', compact('boughts', 'solds'));
    }

    public function create(Request $request)
    {        

        $advance = new Advance;
        $advance->gold_amount = $request->gold_amount;
        $advance->fiat_leased = 1;
        $advance->currency = 'MYR';
        $advance->status = 'CRT';
        $advance->user_id = $request->user()->id;
        $advance->save();
       
        return view('advance.created', compact('advance'));
    }    

    public function show(Advance $advance)
    {
        return view('advance.detail', compact('advance'));
    }
}
