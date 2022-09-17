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

use Billplz\Client;


class TradeController extends Controller
{

    public function home(Request $request)
    {
        $user_id = auth()->user()->id;
       
        $boughts = Bought::where('user_id', $user_id)->get();
        $solds = Sold::where('user_id', $user_id)->get();

        $gold_price = GoldPrice::latest()->first();
        $myr_price = ForexPrice::where('currency', 'MYR')->latest()->first();        

        // $original = new Collection($boughts);
        // $latest = new Collection($solds);
        // $trades = $original->merge($latest);  

        return view('trade.home', compact('boughts', 'solds', 'gold_price', 'myr_price'));
    }

    public function api_home(Request $request) {
        $user_id = auth()->user()->id;
       
        $boughts = Bought::where('user_id', $user_id)->get();
        $solds = Sold::where('user_id', $user_id)->get();

        return response()->json([
            'boughts' => $boughts,
            'solds' => $solds,
            'timestamp' => time()
        ]);        
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
    
    public function calculate()
    {
        $lol = $_GET['lol'];

    }

    public function api_calculate()
    {
        $lol = $_GET['lol'];
        return response()->json([
            'lol' => $lol,
            'timestamp' => time()
        ]);            

    }    

    public function buy_gold(Request $request)
    {        

        $fiat_flow = $request->in_fiat_amount * 100; // in cent
        $fiat_fee = $request->in_fiat_amount * 5;
        
        $gold_price = GoldPrice::latest()->first()->buy_price;
        $myr_price = ForexPrice::where('currency', 'MYR')->latest()->first()->buy_price;

        $fiat_nett = $fiat_flow - $fiat_fee;
        $gold_amount = $fiat_nett * 100000000 / ($gold_price * $myr_price);
        $gold_amount_string = substr(number_format((string)($gold_amount / 1000000), 7, '.', ''), 0, -1);        

        $trade = new Bought;        

        $trade->fiat_inflow = (int)$fiat_flow;
        $trade->gold_amount = (int)$gold_amount;
        $trade->fiat_fee = (int)$fiat_fee;
        $trade->fiat_nett = (int)$fiat_nett;
        $trade->fiat_currency = 'MYR';
        $trade->status = 'CRT';
        $trade->user_id = $request->user()->id;

        $trade->save();

        $billplz = Client::make(env('BILLPLZ_API_KEY'));
        $bill = $billplz->bill();

        $redirect_url = 'https://goldpanda.pipeline.com.my/app/bought/'.(string)$trade->id;
        
        $response = $bill->create(
            'cvteldue',
            $request->user()->email,
            null,
            $request->user()->name,
            \Duit\MYR::given($fiat_flow),
            'https://goldpanda.pipeline.com.my/billplz-webhook',
            'Purchase of '.$gold_amount_string.' gram of gold',
            [
                'redirect_url' => $redirect_url,
                // 'reference_1_label' => 'Gold Amount, gram',
                // 'reference_1' => $gold_amount_string
            ], 
        );        

        $billplz_response = $response->toArray();

        $pay_in = new PayIn;

        $pay_in->amount = $trade->fiat_inflow;
        $pay_in->currency = $trade->fiat_currency;
        $pay_in->method = 'BLP';
        $pay_in->status = 'CRT';

        $pay_in->payable_id = $trade->id;
        $pay_in->payable_type = 'App\Models\Bought';

        $pay_in->note_1 = $billplz_response['id'];
        $pay_in->note_2 = '';
        $pay_in->note_3 = '';
        
        $pay_in->save();
       
        $billplz_url = 'https://billplz.com/bills/'.$billplz_response['id'];
        return Redirect::to($billplz_url);
        //return view('trade.created', compact('trade', 'pay_in'));
    }      
    
    public function sell_gold(Request $request)
    {        

        $gold_amount = $request->in_gold_amount;
        $gold_price = GoldPrice::latest()->first()->sell_price;
        $myr_price = ForexPrice::where('currency', 'MYR')->latest()->first()->sell_price;

        $fiat_flow = $gold_amount * ( $gold_price * $myr_price) / 100;
        $fiat_fee = 0;
        $fiat_nett = $fiat_flow - $fiat_fee;  
        
        $gold_balance = $request->user()->alloted_gold;
        if($gold_amount * 1000000 < $gold_balance) {
            return redirect('/app/trade')->with('error', 'Not enough gold');
        }

        $trade = new Sold;

        $trade->fiat_outflow = $fiat_flow;
        $trade->gold_amount = $gold_amount * 1000000;           
        $trade->fiat_fee = $fiat_fee;
        $trade->fiat_nett = $fiat_nett;
        $trade->fiat_currency = 'MYR';
        $trade->status = 'CRT';
        $trade->user_id = $request->user()->id;

        $trade->save();

        $pay_out = new PayOut;

        $pay_out->amount = $trade->fiat_outflow;
        $pay_out->currency = $trade->fiat_currency;
        $pay_out->method = 'MAN';
        $pay_out->status = 'CRT';

        $pay_out->payable_id = $trade->id;
        $pay_out->payable_type = 'App\Models\Sold';

        $pay_out->note_1 = '';
        $pay_out->note_2 = '';
        $pay_out->note_3 = '';
        
        $pay_out->save();       
        
        $url = '/app/sold/'.$trade->id;
       
        return redirect($url);
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


    public function show_bought(Request $request)
    {
        $id = (int)$request->route('id');
        $bought = Bought::find($id);
        $pay_in = PayIn::where([
            ['payable_id', '=', $id],
            ['payable_type', '=', 'App\Models\Bought'],
        ])->first();
        return view('trade.bought', compact('bought', 'pay_in'));
    }

    public function show_sold(Request $request)
    {
        $id = (int)$request->route('id');
        $sold = Sold::find($id);
        $pay_out = PayOut::where([
            ['payable_id', '=', $id],
            ['payable_type', '=', 'App\Models\Sold'],
        ])->first();
        return view('trade.sold', compact('sold', 'pay_out'));
    }    

}