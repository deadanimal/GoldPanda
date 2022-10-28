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
use App\Models\Invoice;
use App\Models\Payment;

class EnhanceController extends Controller
{
    public function home(Request $request)
    {
        $user_id = $request->user()->id;
        $enhances = enhance::where('user_id', $user_id)->get();

        if ($request->ajax()) {
            return DataTables::collection($enhances)
                ->addIndexColumn()
                ->addColumn('amount_', function (Enhance $enhance) {                    
                    $html_button = 'RM '.number_format((int)($enhance->loan + $enhance->interest)  / 100, 2, '.', '');
                    return $html_button;
                })                
                ->addColumn('gold_', function (Enhance $enhance) {                    
                    $html_button = number_format((int)$enhance->amount / 1000000, 3, '.', '').'g';
                    return $html_button;
                })
                ->addColumn('link', function (Enhance $enhance) {                    
                    $url = '/enhance/'. $enhance->id;
                    $html_button = '<a href="' . $url . '"><button class="btn btn-primary">View</button></a>';
                    return $html_button;  
                })   
                ->addColumn('status', function (Enhance $enhance) {                    
                    $html_statement = ucwords($enhance->status);
                    return $html_statement;
                })                                               
                ->editColumn('created_at', function (Enhance $enhance) {
                    return [
                        'display' => ($enhance->created_at && $enhance->created_at != '0000-00-00 00:00:00') ? with(new Carbon($enhance->created_at))->format('d F Y') : '',
                        'timestamp' => ($enhance->created_at && $enhance->created_at != '0000-00-00 00:00:00') ? with(new Carbon($enhance->created_at))->timestamp : ''
                    ];
                })
                ->rawColumns(['gold_', 'amount_', 'link', 'status'])
                ->make(true);
        } else {
            return view('enhance.home', compact('enhances'));
        }

    }

    public function admin_home(Request $request)
    {
        return view('enhance.admin_home');
    }    

    public function cipta(Request $request)
    {        

        $validatedData = $request->validate([
            'fiat_amount' => ['required', 'gte:100.00', 'lte:20000.00'],
        ]);        

        $fiat_flow = $request->fiat_amount * 100; // in cent
        $fiat_leased = $fiat_flow * $request->leverage;
        $fiat_fee = ($fiat_flow + $fiat_leased) / 20;
    
        
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
        $enhance->status = 'Waiting For Payment';
        $enhance->interest = (int)($fiat_leased/20);
        $enhance->price = (int)($gold_price * $myr_price /100);
        $enhance->user_id = $user_id;
        $enhance->save();

        $invoice = New Invoice;
        $invoice->payable_type = 'App\Models\Enhance';
        $invoice->payable_id = $enhance->id;
        $invoice->user_id = $user_id;
        $invoice->status = 'Waiting For Payment';
        $invoice->amount = $enhance->capital;
        $invoice->currency = $enhance->currency;
        $invoice->save();        

        Alert::success('Gold Booked', 'Gold has successfully been booked. Please proceed to make payment for the invoice');
        return back();
    }    

    public function satu(Request $request)
    {
        $id = (int)$request->route('id');
        $enhance = Enhance::find($id);
        $payment = Payment::where([
            ['payable_type', '=', 'App\Models\Enhance'],
            ['payable_id', '=', $id],
        ])->first();
        $invoice = Invoice::where([
            ['payable_type', '=', 'App\Models\Enhance'],
            ['payable_id', '=', $id],
        ])->first();

        $fee = 0;
        $total_amount = 0;

        if ($enhance->status == 'Active') {
            $now = time();
            $start = strtotime($enhance->created_at);
            $datediff = $now - $start;
            $no_of_years = ceil($datediff / (60 * 60 * 24)) / 365;
            $fee = $enhance->loan * $no_of_years;
            $total_amount = $enhance->loan+ $fee;
        }        
        return view('enhance.satu', compact('enhance', 'fee', 'total_amount'));
    }
}
