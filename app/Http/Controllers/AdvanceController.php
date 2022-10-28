<?php

namespace App\Http\Controllers;

use DataTables;
use DateTime;
use Carbon\Carbon;
use Alert;



use Illuminate\Http\Request;
use App\Models\Advance;
use App\Models\GoldPrice;
use App\Models\ForexPrice;
use App\Models\Payment;
use App\Models\Invoice;

class AdvanceController extends Controller
{
    public function home(Request $request) {
        $user_id = auth()->user()->id;
        $advances = Advance::where('user_id', $user_id)->get();

        if ($request->ajax()) {
            return DataTables::collection($advances)
                ->addIndexColumn()
                ->addColumn('amount_', function (Advance $advance) {                    
                    $html_button = 'RM '.number_format((int)($advance->fiat_leased + $advance->interest)  / 100, 2, '.', '');
                    return $html_button;
                })                
                ->addColumn('gold_', function (Advance $advance) {                    
                    $html_button = number_format((int)$advance->gold_amount / 1000000, 3, '.', '').'g';
                    return $html_button;
                })
                ->addColumn('link', function (Advance $advance) {                    
                    $url = '/advance/'. $advance->id;
                    $html_button = '<a href="' . $url . '"><button class="btn btn-primary">View</button></a>';
                    return $html_button;  
                })   
                ->addColumn('status', function (Advance $advance) {                    
                    $html_statement = ucwords($advance->status);
                    return $html_statement;
                })                                               
                ->editColumn('created_at', function (Advance $advance) {
                    return [
                        'display' => ($advance->created_at && $advance->created_at != '0000-00-00 00:00:00') ? with(new Carbon($advance->created_at))->format('d F Y') : '',
                        'timestamp' => ($advance->created_at && $advance->created_at != '0000-00-00 00:00:00') ? with(new Carbon($advance->created_at))->timestamp : ''
                    ];
                })
                ->rawColumns(['gold_', 'amount_', 'link', 'status'])
                ->make(true);
        } else {            
            return view('advance.home', compact('advances'));
        }
    }

    public function admin(Request $request) {
        $advances = Advance::all();
        if ($request->ajax()) {
            return DataTables::collection($advances)
                ->addIndexColumn()
                ->make(true);
        } else {
            return view('advance.admin', compact('advances'));
        }
    }


    public function cipta(Request $request)
    {
        $validated = $request->validate([
            'gold_amount' => ['required', 'gte:1'],
        ]);

        $user = $request->user();


        $gold_amount = (int)$request->gold_amount * 1000000;
        if( $gold_amount > $user->balance) {
            Alert::error('Gold Advanced', 'You have insufficient amount of gold to lease');
            return back();
        }


        $gold_price = GoldPrice::latest()->first()->price;
        $myr_price = ForexPrice::where('currency', 'MYR')->latest()->first()->price;

        $fiat_flow = $gold_amount * ($gold_price * $myr_price) / 100000000;
        $fiat_nett = (int)$fiat_flow;
        $amount_lent = (int)($fiat_nett * 85 / 100);



        $advance = new Advance;
        $advance->gold_amount = $gold_amount;
        $advance->fiat_leased = $amount_lent;
        $advance->currency = 'MYR';
        $advance->status = 'Pending Transfer';
        $advance->user_id = $request->user()->id;
        $advance->save();

        $payment = New Payment;
        $payment->payable_type = 'App\Models\Advance';
        $payment->payable_id = $advance->id;
        $payment->user_id = $request->user()->id;
        $payment->status = 'Pending Transfer';
        $payment->amount = $advance->fiat_leased;
        $payment->currency = $advance->currency;            
        $payment->save();

        $user->balance -= $gold_amount;
        $user->advanced += $gold_amount;
        $user->save();

        Alert::success('Gold Advanced', 'Your gold has been successfully been leased. You will receive a payment within two to three working days');
        return back();
    }


    public function satu(Request $request)
    {
        $id = (int)$request->route('id');
        $advance = Advance::find($id);
        $payment = Payment::where([
            ['payable_type', '=', 'App\Models\Advance'],
            ['payable_id', '=', $id],
        ])->first();
        $invoice = Invoice::where([
            ['payable_type', '=', 'App\Models\Advance'],
            ['payable_id', '=', $id],
        ])->first();

        $fee = 0;
        $total_amount = 0;

        if ($advance->status == 'Active') {
            $now = time();
            $start = strtotime($advance->created_at);
            $datediff = $now - $start;
            $no_of_days = round($datediff / (60 * 60 * 24));
            $fee = $advance->fiat_leased * $no_of_days * 137 / 1000000; 
            $total_amount = $advance->fiat_leased + $fee;
        }
     


        return view('advance.satu', compact('advance', 'payment', 'invoice', 'fee', 'total_amount'));
    }
}
