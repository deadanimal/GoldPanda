<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use DataTables;
use DateTime;
use Carbon\Carbon;
use Alert;
use App\Http\Controllers\RewardController;


use App\Models\GoldPrice;
use App\Models\ForexPrice;
use App\Models\Trade;

use Billplz\Client;


class TradeController extends Controller
{


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
        return $lol;
    }

    public function api_calculate()
    {
        $lol = $_GET['lol'];
        return response()->json([
            'lol' => $lol,
            'timestamp' => time()
        ]);
    }

    public function senarai(Request $request)
    {
        $user = $request->user();
        $trades = Trade::where('user_id', $user->id)->get();
        if ($request->ajax()) {
            return DataTables::collection($trades)
                ->addColumn('gold_', function (Trade $trade) {
                    $amount = number_format($trade->gold / 1000000, 3, '.', ',');
                    if ($trade->buy) {                        
                        $html_badge = '<span class="badge rounded-pill bg-success">Buy '. $amount .'g</span>';
                    } else {
                        $html_badge = '<span class="badge rounded-pill bg-danger">Sell '. $amount .'g</span>';
                    }
                    return $html_badge;
                })
                ->addColumn('fiat_', function (Trade $trade) {
                    $amount = number_format($trade->fiat / 100, 2, '.', ',');
                    // $html_statement = $trade->fiat_currency . 'RM ' . $amount;
                    $html_statement = 'RM ' . $amount;
                    return $html_statement;
                })         
                ->addColumn('status_', function (Trade $trade) {
                    $html_statement = ucwords($trade->status);
                    return $html_statement;
                })                           
                ->addColumn('link',function (Trade $trade) {
                    $url = '/trade/'. $trade->id;
                    $html_button = '<a href="' . $url . '"><button class="btn btn-primary">View</button></a>';
                    return $html_button;
                })
                ->editColumn('created_at', function (Trade $trade) {
                    return [
                        'display' => ($trade->created_at && $trade->created_at != '0000-00-00 00:00:00') ? with(new Carbon($trade->created_at))->format('d/m/Y') : '',
                        'timestamp' => ($trade->created_at && $trade->created_at != '0000-00-00 00:00:00') ? with(new Carbon($trade->created_at))->timestamp : ''
                    ];
                })
                ->rawColumns(['fiat_','gold_','link'])
                ->make(true);
        }
    }

    public function cipta(Request $request)
    {
        $user = $request->user();

        if($user->bank_account_verified == false) {
            Alert::error('Unverified Account', 'Please verify your identity, mobile number, and bank account before you make a trade.');
            return back();
        }

        $fiat = (int)$request->fiat * 100;
        $nature = (int)$request->nature;
        $gold_price = GoldPrice::latest()->first();
        $ringgit = ForexPrice::where('currency', 'MYR')->latest()->first();
        $gold_in_ringgit = $gold_price->price * $ringgit->price;

        if ($nature == 1) {
            $fee = $fiat / 20; # 5% fee on buy
            $nett = $fiat - $fee;
            $gold = $nett * 100000000 / $gold_in_ringgit;
            if($fiat < 2000) {
                Alert::error('Minimum Amount Not Met', 'Gold purchased must be more than RM 20.00');
                return back();
            }
        } else {
            $fee = 0; # 0% fee on sell
            $nett = $fiat;
            $gold = $nett * 100000000 / $gold_in_ringgit;

            if ($gold >= $user->balance) {
                Alert::error('Sell Gold', 'Insuffiecient gold balance to sell gold');
                return back();
            }
            if($fiat < 10000) {
                Alert::error('Minimum Amount Not Met', 'Gold sold must be more than RM 100.00');
                return back();
            }            
        }

        $trade = new Trade;
        $trade->fiat = $fiat;
        $trade->buy = $nature;
        $trade->fee = $fee;
        $trade->nett = $nett;
        $trade->gold = $gold;
        $trade->fiat_currency = 'MYR';
        $trade->status = 'created';
        $trade->user_id = $user->id;
        $trade->save();

        if ($trade->buy) {
            Alert::success('Gold Bought', 'Gold purchase has successfully been created. Please proceed to next step');
        } else {
            $user->balance -= $trade->gold;
            $user->save();
            Alert::success('Gold Sold', 'Gold  has successfully been sold. Please wait to receive the pay-out');
        }

        return back();
    }
}


    // public function buy_gold(Request $request)
    // {

    //     $validatedData = $request->validate([
    //         'in_fiat_amount' => ['required', 'gte:20.00', 'lte:50000.00'],
    //     ]);

    //     $fiat_flow = $request->in_fiat_amount * 100; // in cent
    //     $fiat_fee = $request->in_fiat_amount * 5;

    //     $gold_price = GoldPrice::latest()->first()->buy_price;
    //     $myr_price = ForexPrice::where('currency', 'MYR')->latest()->first()->buy_price;

    //     $fiat_nett = $fiat_flow - $fiat_fee;
    //     $gold_amount = $fiat_nett * 100000000 / ($gold_price * $myr_price);
    //     $gold_amount_string = substr(number_format((string)($gold_amount / 1000000), 7, '.', ''), 0, -1);

    //     $user_id = $request->user()->id;

    //     $trade = new Bought;

    //     $trade->fiat_inflow = (int)$fiat_flow;
    //     $trade->gold_amount = (int)$gold_amount;
    //     $trade->fiat_fee = (int)$fiat_fee;
    //     $trade->fiat_nett = (int)$fiat_nett;
    //     $trade->fiat_currency = 'MYR';
    //     $trade->status = 'CRT';
    //     $trade->user_id = $user_id;

    //     $trade->save();

    //     $reward_controller = new RewardController;
    //     $reward_controller->distribute_sell_reward($user_id, $trade->fiat_fee, $trade->fiat_currency, $trade->id, 1);

    //     $billplz = Client::make(env('BILLPLZ_API_KEY'));
    //     $bill = $billplz->bill();

    //     $redirect_url = 'https://goldpanda.pipeline.com.my/app/bought/' . (string)$trade->id;

    //     $response = $bill->create(
    //         'cvteldue',
    //         $request->user()->email,
    //         null,
    //         $request->user()->name,
    //         \Duit\MYR::given($fiat_flow),
    //         'https://goldpanda.pipeline.com.my/billplz-webhook',
    //         'Purchase of ' . $gold_amount_string . ' gram of gold',
    //         [
    //             'redirect_url' => $redirect_url,
    //             // 'reference_1_label' => 'Gold Amount, gram',
    //             // 'reference_1' => $gold_amount_string
    //         ],
    //     );

    //     $billplz_response = $response->toArray();

    //     $pay_in = new PayIn;

    //     $pay_in->amount = $trade->fiat_inflow;
    //     $pay_in->currency = $trade->fiat_currency;
    //     $pay_in->method = 'BLP';
    //     $pay_in->status = 'CRT';

    //     $pay_in->payable_id = $trade->id;
    //     $pay_in->payable_type = 'App\Models\Bought';

    //     $pay_in->note_1 = $billplz_response['id'];
    //     $pay_in->note_2 = '';
    //     $pay_in->note_3 = '';

    //     $pay_in->save();

    //     $billplz_url = 'https://billplz.com/bills/' . $billplz_response['id'];
    //     return Redirect::to($billplz_url);
    //     //return view('trade.created', compact('trade', 'pay_in'));
    // }

    // public function sell_gold(Request $request)
    // {

    //     $validatedData = $request->validate([
    //         'in_gold_amount' => ['required', 'gte:0.1'],
    //     ]);


    //     $gold_amount = $request->in_gold_amount;
    //     $gold_price = GoldPrice::latest()->first()->sell_price;
    //     $myr_price = ForexPrice::where('currency', 'MYR')->latest()->first()->sell_price;

    //     $fiat_flow = $gold_amount * ($gold_price * $myr_price) / 100;
    //     $fiat_fee = 0;
    //     $fiat_nett = $fiat_flow - $fiat_fee;

    //     $gold_balance = $request->user()->alloted_gold;
    //     if ($gold_amount * 1000000 > $gold_balance) {
    //         $gold_balance_string = number_format($gold_balance / 1000000, 6, '.', ',');
    //         $statement = 'You do not enough gold balance. Your current available gold balance is ' . $gold_balance_string . ' g';
    //         return Redirect::back()->withErrors(['msg' => $statement]);
    //     }

    //     $trade = new Sold;

    //     $trade->fiat_outflow = $fiat_flow;
    //     $trade->gold_amount = $gold_amount * 1000000;
    //     $trade->fiat_fee = $fiat_fee;
    //     $trade->fiat_nett = $fiat_nett;
    //     $trade->fiat_currency = 'MYR';
    //     $trade->status = 'CRT';
    //     $trade->user_id = $request->user()->id;

    //     $trade->save();

    //     $pay_out = new PayOut;

    //     $pay_out->amount = $trade->fiat_outflow;
    //     $pay_out->currency = $trade->fiat_currency;
    //     $pay_out->method = 'MAN';
    //     $pay_out->status = 'CRT';

    //     $pay_out->payable_id = $trade->id;
    //     $pay_out->payable_type = 'App\Models\Sold';

    //     $pay_out->note_1 = '';
    //     $pay_out->note_2 = '';
    //     $pay_out->note_3 = '';

    //     $pay_out->save();

    //     $url = '/app/sold/' . $trade->id;

    //     return redirect($url);
    // }