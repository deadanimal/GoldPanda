<?php

namespace App\Http\Controllers;

use DataTables;
use DateTime;
use Carbon\Carbon;
use Alert;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Redirect;

use App\Http\Controllers\RewardController;

use App\Models\Enhance;
use App\Models\GoldPrice;
use App\Models\ForexPrice;
use App\Models\PayIn;
use App\Models\Invoice;

use Billplz\Client;

class EnhanceController extends Controller
{
    public function home(Request $request)
    {
        $user_id = $request->user()->id;
        $enhances = enhance::where('user_id', $user_id)->get();

        if ($request->ajax()) {
            return DataTables::collection($enhances)
                ->addIndexColumn()
                ->editColumn('created_at', function (Enhance $enhance) {
                    return [
                        'display' => ($enhance->created_at && $enhance->created_at != '0000-00-00 00:00:00') ? with(new Carbon($enhance->created_at))->format('d F Y') : '',
                        'timestamp' => ($enhance->created_at && $enhance->created_at != '0000-00-00 00:00:00') ? with(new Carbon($enhance->created_at))->timestamp : ''
                    ];
                })
                ->make(true);
        } else {
            return view('enhance.home', compact('enhances'));
        }

    }

    public function admin_home(Request $request)
    {
        return view('enhance.admin_home');
    }    

    public function create(Request $request)
    {        

        $validatedData = $request->validate([
            'fiat_amount' => ['required', 'gte:20.00', 'lte:50000.00'],
        ]);        

        $fiat_flow = $request->fiat_amount * 100; // in cent
        $fiat_leased = $fiat_flow * $request->leverage;
        $fiat_fee = ($fiat_flow + $fiat_leased) * 3 / 100;
    
        
        $gold_price = GoldPrice::latest()->first()->price;
        $myr_price = ForexPrice::where('currency', 'MYR')->latest()->first()->price;

        $user_id = $request->user()->id;

        $fiat_nett = ($fiat_flow + $fiat_leased) - $fiat_fee;
        $gold_amount = $fiat_nett * 100000000 / ($gold_price * $myr_price);
        $gold_amount_string = substr(number_format((string)($gold_amount / 1000000), 7, '.', ''), 0, -1);        

        $enhance = new Enhance;                
        $enhance->amount = (int)$gold_amount;
        $enhance->loan = (int)$fiat_leased;
        $enhance->capital = (int)$fiat_flow;
        $enhance->leverage = (int)$request->leverage;
        $enhance->currency = 'MYR';
        $enhance->status = 'created';
        $enhance->interest = (int)($fiat_leased/20);
        $enhance->price = (int)($gold_price * $myr_price /100);
        $enhance->user_id = $user_id;
        $enhance->save();

        $invoice = New Invoice;
        $invoice->payable_type = 'App\Models\Enhance';
        $invoice->payable_id = $enhance->id;
        $invoice->user_id = $user_id;
        $invoice->status = 'created';
        $invoice->amount = $enhance->capital;
        $invoice->currency = $enhance->currency;
        $invoice->save();        

        Alert::success('Gold Booked', 'Gold has successfully been booked. Please proceed to make payment for the invoice');
        return back();
    }    

    public function show(Request $request)
    {
        $id = (int)$request->route('id');
        $enhance = Enhance::find($id);
        $pay_in = PayIn::where([
            ['payable_id', '=', $enhance->id],
            ['payable_type', '=', 'App\Models\Enhance'],
        ])->first();
        return view('enhance.detail', compact('enhance', 'pay_in'));
    }
}
