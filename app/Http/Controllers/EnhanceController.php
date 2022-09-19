<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Redirect;

use App\Models\Enhance;
use App\Models\GoldPrice;
use App\Models\ForexPrice;
use App\Models\PayIn;
use App\Models\PayOut;

use Billplz\Client;

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

        $validatedData = $request->validate([
            'fiat_amount' => ['required', 'gte:20.00', 'lte:50000.00'],
        ]);        

        $fiat_flow = $request->fiat_amount * 100; // in cent
        $fiat_leased = $fiat_flow * $request->leverage;
        $fiat_fee = ($fiat_flow + $fiat_leased) * 3 / 100;
    
        
        $gold_price = GoldPrice::latest()->first()->buy_price;
        $myr_price = ForexPrice::where('currency', 'MYR')->latest()->first()->buy_price;

        $fiat_nett = ($fiat_flow + $fiat_leased) - $fiat_fee;
        $gold_amount = $fiat_nett * 100000000 / ($gold_price * $myr_price);
        $gold_amount_string = substr(number_format((string)($gold_amount / 1000000), 7, '.', ''), 0, -1);        

        $enhance = new Enhance;        

        
        $enhance->amount = (int)$gold_amount;
        $enhance->loan = (int)$fiat_leased;
        $enhance->capital = (int)$fiat_flow;
        $enhance->leverage = (int)$request->leverage;
        $enhance->currency = 'MYR';
        $enhance->status = 'CRT';
        $enhance->user_id = $request->user()->id;

        $enhance->save();

        $billplz = Client::make(env('BILLPLZ_API_KEY'));
        $bill = $billplz->bill();

        $redirect_url = 'https://goldpanda.pipeline.com.my/app/enhance/'.(string)$enhance->id;
        
        $response = $bill->create(
            'cvteldue',
            $request->user()->email,
            null,
            $request->user()->name,
            \Duit\MYR::given($fiat_flow),
            'https://goldpanda.pipeline.com.my/billplz-webhook',
            'Booking of '.$gold_amount_string.' gram of gold',
            [
                'redirect_url' => $redirect_url,
                // 'reference_1_label' => 'Gold Amount, gram',
                // 'reference_1' => $gold_amount_string
            ], 
        );        

        $billplz_response = $response->toArray();

        $pay_in = new PayIn;

        $pay_in->amount = $enhance->capital;
        $pay_in->currency = $enhance->currency;
        $pay_in->method = 'BLP';
        $pay_in->status = 'CRT';

        $pay_in->payable_id = $enhance->id;
        $pay_in->payable_type = 'App\Models\Enhance';

        $pay_in->note_1 = $billplz_response['id'];
        $pay_in->note_2 = '';
        $pay_in->note_3 = '';
        
        $pay_in->save();
       
        $billplz_url = 'https://billplz.com/bills/'.$billplz_response['id'];
        return Redirect::to($billplz_url);
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
