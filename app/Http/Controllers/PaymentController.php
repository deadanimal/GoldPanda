<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use DataTables;
use DateTime;
use Carbon\Carbon;
use Alert;

use App\Http\Controllers\RewardController;
use App\Models\Payment;
use App\Models\User;
use App\Models\Enhance;
use App\Models\Trade;


class PaymentController extends Controller
{

    public function senarai(Request $request) {
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

    public function admin(Request $request)     {
        $payments = payment::all();
        if ($request->ajax()) {
            return DataTables::collection($payments)
                ->addIndexColumn()
                ->addColumn('amount_', function (payment $payment) {
                    $html_button = 'RM ' . number_format((int)($payment->amount)  / 100, 2, '.', '');
                    return $html_button;
                })
                ->addColumn('user', function (payment $payment) {                    
                    $html_button = $payment->user->name.'('.$payment->user->mobile.')';
                    return $html_button;  
                })                   
                ->addColumn('action', function (payment $payment) {
                    $html_button = '-';
                    if ($payment->status == "Pending Transfer") {
                        $url = '/payment/'.$payment->id.'/kemaskini?action=made';
                        $html_button = '<a href="' . $url . '"><button class="btn btn-success">Made</button></a>';
                    }
                    return $html_button;
                })
                ->addColumn('status', function (payment $payment) {
                    $html_statement = ucwords($payment->status);
                    return $html_statement;
                })
                ->editColumn('created_at', function (payment $payment) {
                    return [
                        'display' => ($payment->created_at && $payment->created_at != '0000-00-00 00:00:00') ? with(new Carbon($payment->created_at))->format('d F Y') : '',
                        'timestamp' => ($payment->created_at && $payment->created_at != '0000-00-00 00:00:00') ? with(new Carbon($payment->created_at))->timestamp : ''
                    ];
                })
                ->rawColumns([ 'amount_', 'status', 'user', 'action'])
                ->make(true);
        } else {
            return view('payment.admin');
        }
    }

    public function satu(Request $request) {
        $id = (int)$request->route('id');
        $payment = payment::find($id);
        return view('payment.satu', compact('payment'));
    }  

    public function kemaskini(Request $request) {
        $id = (int)$request->route('id');
        $payment = payment::find($id);

        if($request->jenis == 'paid') {
            $payment->status = 'Paid';
            $reward_controller = new RewardController;    
            if($payment->payable_type == 'App\Models\Trade') {
                $trade = Trade::find($payment->payable_id);
                $trade->status = 'Paid';
                $trade->save();
                $user = User::find($trade->user_id);
                $user->balance += $trade->gold;
                $user->save();
                $reward_controller->distribute_sell_reward(
                    $trade->user_id, 
                    $trade->fee, 
                    $trade->fiat_currency, 
                    $trade->id, 
                    1);                  
            } else {
                $enhance = Enhance::find($payment->payable_id);
                $enhance->status = 'Paid';
                $enhance->save();
                $user = User::find($enhance->user_id);
                $user->booked += $enhance->amount;
                $user->save();

                $fee_purchase = ($enhance->capital + $enhance->loan) / 20;
                $fee_loan = $enhance->loan / 20;
                $fee = $fee_purchase + $fee_loan;

                $reward_controller->distribute_sell_reward(
                    $enhance->user_id, 
                    $fee, 
                    $enhance->currency, 
                    $enhance->id, 
                    0);                  
            }
        } else if ($request->jenis == 'paid-partial') {
            $payment->status = 'Partial Payment';
        } else if ($request->jenis == 'paid-over') {
            $payment->status = 'Overpaid';
        } else {
            $payment->status = 'Expired';
            if($payment->payable_type == 'App\Models\Trade') {
                $trade = Trade::find($payment->payable_id);
                $trade->status = 'Expired';
                $trade->save();
            } else {
                $enhance = Enhance::find($payment->payable_id);
                $enhance->status = 'Expired';
                $enhance->save();
            }            
        }
        $payment->save();     


        return back();        
    }

}