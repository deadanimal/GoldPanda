<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

use App\Models\Bought;
use App\Models\Sold;
use App\Models\PayIn;
use App\Models\PayOut;

use Billplz\Client;


class TradeController extends Controller
{

    public function home(Request $request)
    {
        $user_id = auth()->user()->id;
       
        $boughts = Bought::where('user_id', $user_id)->get();
        $solds = Sold::where('user_id', $user_id)->get();

        $original = new Collection($boughts);
        $latest = new Collection($solds);
        $trades = $original->merge($latest);  

        return view('trade.home', compact('trades'));
    }

    public function admin_home(Request $request)
    {
        $agg_boughts = '';
        $agg_solds = '';
        $agg_pay_ins = '';
        $agg_pay_outs = '';

        $agg_boughts_last_week = '';
        $agg_solds_last_week = '';
        $agg_pay_ins_last_week = '';
        $agg_pay_outs_last_week = '';        

        $lapsed_boughts = '';
        $lapsed_pay_ins = '';
        
        $pending_solds = '';
        $pending_pay_outs = '';

        $profit_sold = '';
        $profit_bought = '';

        $reward_sold = '';     
    
        // $billplz = Client::make(env('BILLPLZ_API_KEY'), env('BILLPLZ_X_SIGNATURE'));
        // $bill = $billplz->bill();
        // $response = $bill->create(
        //     'cvteldue',
        //     'afeezaziz@gmail.com',
        //     null,
        //     'Michael API V3',
        //     \Duit\MYR::given(12345.123456),
        //     'http://example.com/webook/',
        //     'Maecenas eu placerat ante.',
        //     ['redirect_url' => 'http://example.com/redirect/']
        // );
        
        // var_dump($response->toArray());


        return view('trade.admin_home');
    }    

    public function buy_gold(Request $request)
    {        

        $fiat_flow = $request->amount;
        $fiat_fee = $request->amount * 0.05;
        $fiat_nett = $fiat_flow - $fiat_fee;
        $gold_amount = $fiat_nett / $gold_price;

        $trade = new Bought;        

        $trade->fiat_inflow = $fiat_flow;
        $trade->gold_amount = $gold_amount;
        $trade->fiat_fee = $fiat_fee;
        $trade->fiat_nett = $fiat_nett;
        $trade->gold_amount = $gold_amount;
        $trade->fiat_currency = 'MYR';
        $trade->status = 'CRT';
        $trade->user_id = $request->user()->id;

        $trade->save();

        $pay_in = new PayIn;

        $pay_in->amount = $trade->fiat_inflow;
        $pay_in->currency = $trade->fiat_currency;
        $pay_in->method = 'billplz';
        $pay_in->status = 'CRT';

        $pay_in->payable_id = $trade->id;
        $pay_in->payable_type = 'App\Models\Bought';

        $pay_in->note_1 =
        $pay_in->note_2 =
        $pay_in->note_3 =
        
        $pay_in->save();
       
        return view('trade.created', compact('trade'));
    }      
    
    public function sell_gold(Request $request)
    {        

        $fiat_flow = $gold_amount * $gold_price;
        $fiat_fee = 0;
        $fiat_nett = $fiat_flow - $fiat_fee;
        $gold_amount = $request->amount;

        $trade = new Sold;

        $trade->fiat_outflow = $fiat_flow;
        $trade->gold_amount = $gold_amount;           
        $trade->fiat_fee = $fiat_fee;
        $trade->fiat_nett = $fiat_nett;
        $trade->fiat_currency = 'MYR';
        $trade->status = 'CRT';
        $trade->user_id = $request->user()->id;

        $trade->save();
       
        return view('trade.created', compact('trade'));
    }      

    public function trade_datatable(Request $request)
    {

            $data = User::select('*');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('status', function($row){
                         if($row->status){
                            return '<span class="badge badge-primary">Active</span>';
                         }else{
                            return '<span class="badge badge-danger">Deactive</span>';
                         }
                    })
                    ->filter(function ($instance) use ($request) {
                        if ($request->get('status') == '0' || $request->get('status') == '1') {
                            $instance->where('status', $request->get('status'));
                        }
                        if (!empty($request->get('search'))) {
                             $instance->where(function($w) use($request){
                                $search = $request->get('search');
                                $w->orWhere('name', 'LIKE', "%$search%")
                                ->orWhere('email', 'LIKE', "%$search%");
                            });
                        }
                    })
                    ->rawColumns(['status'])
                    ->make(true);

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