<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Advance;

class AdvanceController extends Controller
{
    public function home(Request $request)
    {
        $user_id = auth()->user()->id;
        $advances = Advance::where('user_id', $user_id)->get();
        return view('advance.home', compact('advances'));
    }

    public function admin_home(Request $request)
    {

        $advances = Advance::all->get();
        return view('advance.admin_home', compact('advances'));
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
