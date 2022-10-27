<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use DataTables;
use DateTime;
use Carbon\Carbon;
use Alert;

use App\Http\Controllers\RewardController;
use App\Models\Invoice;
use App\Models\User;
use App\Models\Enhance;
use App\Models\Trade;


class InvoiceController extends Controller
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

    public function satu(Request $request) {
        $id = (int)$request->route('id');
        $invoice = Invoice::find($id);
        return view('invoice.satu', compact('invoice'));
    }  

    public function sah(Request $request) {
        $id = (int)$request->route('id');
        $invoice = Invoice::find($id);

        if($request->jenis == 'paid') {
            $invoice->status = 'Paid';
            $reward_controller = new RewardController;
            $reward_controller->distribute_sell_reward(
                $invoice->user_id, 
                $invoice->payable->fee, 
                $invoice->payable->fiat_currency, 
                $invoice->payable_id, 
                1);      
            if($invoice->payable_type == 'App\Models\Trade') {
                $trade = Trade::find($invoice->payable_id);
                $trade->status = 'Paid';
                $trade->save();
                $user = User::find($trade->user_id);
                $user->balance += $trade->gold;
                $user->save();
            } else {
                $enhance = Enhance::find($invoice->payable_id);
                $enhance->status = 'Paid';
                $enhance->save();
                $user = User::find($enhance->user_id);
                $user->booked += $enhance->amount;
                $user->save();
            }
        } else if ($request->jenis == 'paid-partial') {
            $invoice->status = 'Partial Payment';
        } else if ($request->jenis == 'paid-over') {
            $invoice->status = 'Overpaid';
        } else {
            $invoice->status = 'Expired';
            if($invoice->payable_type == 'App\Models\Trade') {
                $trade = Trade::find($invoice->payable_id);
                $trade->status = 'Expired';
                $trade->save();
            } else {
                $enhance = Enhance::find($invoice->payable_id);
                $enhance->status = 'Expired';
                $enhance->save();
            }            
        }
        $invoice->save();     


        return back();        
    }

}