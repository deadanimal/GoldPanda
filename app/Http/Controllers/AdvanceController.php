<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Advance;
use App\Models\GoldPrice;
use App\Models\ForexPrice;
use App\Models\PayIn;
use App\Models\PayOut;

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


    public function advance(Request $request)
    {        

       
        $validatedData = $request->validate([
            'gold_amount' => ['required', 'gte:0.1'],
        ]);              
            

        $gold_amount = $request->gold_amount;
        $gold_price = GoldPrice::latest()->first()->sell_price;
        $myr_price = ForexPrice::where('currency', 'MYR')->latest()->first()->sell_price;

        $fiat_flow = $gold_amount  * ( $gold_price * $myr_price) / 100;
        $fiat_fee = 0;
        $fiat_nett = $fiat_flow - $fiat_fee;  
        $amount_lent = $fiat_nett * 85 / 100;
        
        // $gold_balance = $request->user()->alloted_gold;
        // if($gold_amount * 1000000 > $gold_balance) {
        //     $gold_balance_string = number_format($gold_balance / 1000000, 6, '.', ',');
        //     $statement = 'You do not enough gold balance. Your current available gold balance is '.$gold_balance_string.' g';
        //     return Redirect::back()->withErrors(['msg' => $statement]);
        // }

        $advance = new Advance;
        $advance->gold_amount = $request->gold_amount * 1000000;
        $advance->fiat_leased = $amount_lent;
        $advance->currency = 'MYR';
        $advance->status = 'CRT';
        $advance->user_id = $request->user()->id;
        $advance->save();

        $pay_out = new PayOut;

        $pay_out->amount = $advance->fiat_leased;
        $pay_out->currency = $advance->currency;
        $pay_out->method = 'MAN';
        $pay_out->status = 'CRT';

        $pay_out->payable_id = $advance->id;
        $pay_out->payable_type = 'App\Models\Advance';

        $pay_out->note_1 = '';
        $pay_out->note_2 = '';
        $pay_out->note_3 = '';
        
        $pay_out->save();       
        
        $url = '/app/advance/'.$advance->id;
       
        return redirect($url);
    }    


    public function show(Request $request)
    {
        $id = (int)$request->route('id');
        $advance = Advance::find($id);
        $pay_out = PayOut::where([
            ['payable_id', '=', $id],
            ['payable_type', '=', 'App\Models\Advance'],
        ])->first();
        return view('advance.detail', compact('advance', 'pay_out'));
    }    
}
