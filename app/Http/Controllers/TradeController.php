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
use App\Models\Invoice;
use App\Models\Payment;

use Billplz\Client;

$billplz = Client::make(env('BILLPLZ_API_KEY'), env('BILLPLZ_X_SIGNATURE'));
$bill = $billplz->bill();

class TradeController extends Controller
{

    public function senarai(Request $request)
    {
        $user = $request->user();
        $trades = Trade::where('user_id', $user->id)->get();

        if ($request->ajax()) {
            return DataTables::collection($trades)
                ->addColumn('gold_', function (Trade $trade) {
                    $amount = number_format($trade->gold / 1000000, 3, '.', ',');
                    if ($trade->buy) {
                        $html_badge = '<span class="badge rounded-pill bg-success">Buy ' . $amount . 'g</span>';
                    } else {
                        $html_badge = '<span class="badge rounded-pill bg-danger">Sell ' . $amount . 'g</span>';
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
                ->addColumn('link', function (Trade $trade) {
                    if ($trade->status == "Waiting For Payment") {
                        $url = "https://billplz.com/bills/".$trade->invoice->billplz_id;
                        $html_button = '<a href="' . $url . '"><button class="btn btn-primary">Pay</button></a>';
                        return $html_button;
                    } else {
                        $url = '/trade/' . $trade->id;
                        $html_button = '<a href="' . $url . '"><button class="btn btn-primary">View</button></a>';
                        return $html_button;
                    }
                })
                ->editColumn('created_at', function (Trade $trade) {
                    return [
                        'display' => ($trade->created_at && $trade->created_at != '0000-00-00 00:00:00') ? with(new Carbon($trade->created_at))->format('d/m/Y') : '',
                        'timestamp' => ($trade->created_at && $trade->created_at != '0000-00-00 00:00:00') ? with(new Carbon($trade->created_at))->timestamp : ''
                    ];
                })
                ->rawColumns(['fiat_', 'gold_', 'link'])
                ->make(true);
        }
    }

    public function admin(Request $request)
    {
        $trades = Trade::all();
        if ($request->ajax()) {
            return DataTables::collection($trades)
                ->addIndexColumn()
                ->addColumn('user', function (Trade $trade) {
                    $html_button = $trade->user->name . '(' . $trade->user->mobile . ')';
                    return $html_button;
                })
                ->addColumn('gold_', function (Trade $trade) {
                    $amount = number_format($trade->gold / 1000000, 3, '.', ',');
                    if ($trade->buy) {
                        $html_badge = '<span class="badge rounded-pill bg-success">Buy ' . $amount . 'g</span>';
                    } else {
                        $html_badge = '<span class="badge rounded-pill bg-danger">Sell ' . $amount . 'g</span>';
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
                ->addColumn('link', function (Trade $trade) {
                    $url = '/trade/' . $trade->id;
                    $html_button = '<a href="' . $url . '"><button class="btn btn-primary">View</button></a>';
                    return $html_button;
                })
                ->editColumn('created_at', function (Trade $trade) {
                    return [
                        'display' => ($trade->created_at && $trade->created_at != '0000-00-00 00:00:00') ? with(new Carbon($trade->created_at))->format('d/m/Y') : '',
                        'timestamp' => ($trade->created_at && $trade->created_at != '0000-00-00 00:00:00') ? with(new Carbon($trade->created_at))->timestamp : ''
                    ];
                })

                ->editColumn('created_at', function (Trade $trade) {
                    return [
                        'display' => ($trade->created_at && $trade->created_at != '0000-00-00 00:00:00') ? with(new Carbon($trade->created_at))->format('d F Y') : '',
                        'timestamp' => ($trade->created_at && $trade->created_at != '0000-00-00 00:00:00') ? with(new Carbon($trade->created_at))->timestamp : ''
                    ];
                })
                ->rawColumns(['gold_', 'amount_', 'link', 'status', 'user'])
                ->make(true);
        } else {
            return view('trade.admin');
        }
    }

    public function satu(Request $request)
    {
        $id = (int)$request->route('id');
        $trade = Trade::find($id);
        return view('trade.satu', compact('trade'));
    }

    public function cipta(Request $request)
    {
        $user = $request->user();
        $nature = (int)$request->nature;

        if ($user->ic_verified == false) {
            Alert::error('Unverified Account', 'Please verify your identity and mobile number before you make a purchase.');
            return back();
        } else if ($user->bank_account_verified == false && $nature == false) {
            Alert::error('Unverified Account', 'Please verify your bank account before you sell gold.');
            return back();
        }

        $fiat = (int)$request->fiat * 100;
        $nature = (int)$request->nature;
        $gold_price = GoldPrice::latest()->first();
        $ringgit = ForexPrice::where('currency', 'MYR')->latest()->first();
        $gold_in_ringgit = $gold_price->price * $ringgit->price;

        /*
        BUSINESS LOGIC 

        If Buy:
            - 5% on trade
            - Minimum amount is RM20.00
        */
        if ($nature == 1) {
            $fee = $fiat / 20; # 5% fee on buy
            $nett = $fiat + $fee;
            $gold = $nett * 100000000 / $gold_in_ringgit;
            if ($fiat < 2000) {
                Alert::error('Minimum Amount Not Met', 'Gold purchased must be more than RM 20.00');
                return back();
            }

            /*
        BUSINESS LOGIC 

        If Sell:
            - 0% on trade
            - Minimum amount is RM100.00
        */
        } else {
            $fee = 0; # 0% fee on sell
            $nett = $fiat;
            $gold = $nett * 100000000 / $gold_in_ringgit;

            if ($gold >= $user->balance) {
                Alert::error('Sell Gold', 'Insuffiecient gold balance to sell gold');
                return back();
            }
            if ($fiat < 10000) {
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
        if ($nature == 1) {
            $trade->status = 'Waiting For Payment';
        } else {
            $trade->status = 'Pending Transfer';
        }
        $trade->user_id = $user->id;
        $trade->save();

        if ($trade->buy) {
            // Alert::success('Gold Bought', 'Gold purchase has successfully been created. Please proceed to make payment for the invoice');
            $invoice = new Invoice;
            $invoice->payable_type = 'App\Models\Trade';
            $invoice->payable_id = $trade->id;
            $invoice->user_id = $user->id;
            $invoice->status = 'Waiting For Payment';
            $invoice->amount = $trade->nett;
            $invoice->currency = $trade->fiat_currency;

            $datetime = new DateTime('tomorrow');
            $billplz_statement = 'Purchase of '.number_format(($gold / 1000000), 3, ".", ",").' gram of gold at the price of RM'.number_format(($gold_in_ringgit / 10000), 2, ".", ",").' per gram. Fee imposed on the purchased is RM'.number_format(($trade->fee / 100), 2, ".", ",");

            $billplz = Client::make(env('BILLPLZ_API_KEY'), env('BILLPLZ_X_SIGNATURE'));
            $bill = $billplz->bill();
            $response = $bill->create(
                'tzuppys4',
                $user->email,
                $user->mobile,
                'Easy Gold - Purchase of Gold',
                \Duit\MYR::given($trade->nett),
                'https://easygold.com.my/billplz-callback',
                $billplz_statement,
                [
                    "reference_1_label" => "Gold Amount",
                    "reference_1" => number_format(($gold / 1000000), 3, ".", ","),
                    "due_at" => new \DateTime($datetime->format('Y-m-d')),
                    "redirect_url" => 'https://easygold.com.my/billplz-redirect',
                    "callback_url" => 'https://easygold.com.my/billplz-callback',
                ]
            );

            $billplz_data = $response->toArray();

            $invoice->billplz_id = $billplz_data['id'];
            $invoice->save();
            return redirect($billplz_data['url']);
        } else {
            $user->balance -= $trade->gold;
            $user->save();
            Alert::success('Gold Sold', 'Gold  has successfully been sold. Please wait to receive the pay-out');
            $payment = new Payment;
            $payment->payable_type = 'App\Models\Trade';
            $payment->payable_id = $trade->id;
            $payment->user_id = $user->id;
            $payment->status = 'Pending Transfer';
            $payment->amount = $trade->fiat;
            $payment->currency = $trade->fiat_currency;
            $payment->save();
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