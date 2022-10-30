<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use DataTables;
use DateTime;
use DateTimeZone;
use Carbon\Carbon;
use Alert;

use App\Http\Controllers\RewardController;
use App\Models\Invoice;
use App\Models\User;
use App\Models\Enhance;
use App\Models\Trade;
use Billplz\Client;


class InvoiceController extends Controller
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
                ->rawColumns(['fiat_', 'gold_', 'link'])
                ->make(true);
        }
    }

    public function admin(Request $request)
    {
        $invoices = Invoice::all();
        if ($request->ajax()) {
            return DataTables::collection($invoices)
                ->addIndexColumn()
                ->addColumn('amount_', function (Invoice $invoice) {
                    $html_button = 'RM ' . number_format((int)($invoice->amount)  / 100, 2, '.', '');
                    return $html_button;
                })
                ->addColumn('user', function (Invoice $invoice) {
                    $html_button = $invoice->user->name . '(' . $invoice->user->mobile . ')';
                    return $html_button;
                })
                ->addColumn('action', function (Invoice $invoice) {
                    $html_button = '-';
                    if ($invoice->status == "Waiting For Payment") {
                        $url = '/admin/invoice/' . $invoice->id . '/kemaskini?action=paid';
                        $html_button = '<a href="' . $url . '"><button class="btn btn-success">Paid</button></a>';
                    }
                    return $html_button;
                })
                ->addColumn('status', function (Invoice $invoice) {
                    $html_statement = ucwords($invoice->status);
                    return $html_statement;
                })
                ->editColumn('created_at', function (Invoice $invoice) {
                    return [
                        'display' => ($invoice->created_at && $invoice->created_at != '0000-00-00 00:00:00') ? with(new Carbon($invoice->created_at))->format('d F Y h:m:s') : '',
                        'timestamp' => ($invoice->created_at && $invoice->created_at != '0000-00-00 00:00:00') ? with(new Carbon($invoice->created_at))->timestamp : ''
                    ];
                })
                ->rawColumns(['amount_', 'status', 'user', 'action'])
                ->make(true);
        } else {
            return view('invoice.admin');
        }
    }

    public function satu(Request $request)
    {
        $id = (int)$request->route('id');
        $invoice = Invoice::find($id);
        return view('invoice.satu', compact('invoice'));
    }

    public function kemaskini(Request $request)
    {
        $id = (int)$request->route('id');
        $invoice = Invoice::find($id);

        $action = $request->query('action');

        if ($action == 'paid') {
            $invoice->status = 'Paid';
            $reward_controller = new RewardController;
            if ($invoice->payable_type == 'App\Models\Trade') {
                $trade = Trade::find($invoice->payable_id);
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
                    1
                );
            } else {
                $enhance = Enhance::find($invoice->payable_id);
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
                    0
                );
            }
        } else if ($action == 'paid-partial') {
            $invoice->status = 'Partial Payment';
        } else if ($action == 'paid-over') {
            $invoice->status = 'Overpaid';
        } else {
            $invoice->status = 'Expired';
            if ($invoice->payable_type == 'App\Models\Trade') {
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

    public function billplz_redirect(Request $request)
    {
        $billplz = Client::make(env('BILLPLZ_API_KEY'), env('BILLPLZ_X_SIGNATURE'));
        $bill = $billplz->bill();
        $data = $bill->redirect($_GET);

        $bill_id = $data['id'];
        $bill_paid = $data['paid'];
        $bill_paid_at = $data['paid_at'];
        $bill_paid_at->setTimeZone(new DateTimeZone('Asia/Kuala_Lumpur'));
        $bill_x_signature = $data['x_signature'];
        $bill_string = 'billplzid' . $bill_id . '|billplzpaid_at' . $bill_paid_at->format('Y-m-d H:i:s O') . '|billplzpaid' . $bill_paid;
        $bill_self_compute = hash_hmac('sha256', $bill_string, env('BILLPLZ_X_SIGNATURE'));
        // if($bill_x_signature == $bill_self_compute) {
        //     dd('OK');
        // }
        // if ($bill_paid) {
        $invoice = Invoice::where('billplz_id', $bill_id)->first();
        $invoice->status = 'Paid';
        $reward_controller = new RewardController;
        if ($invoice->payable_type == 'App\Models\Trade') {
            $trade = Trade::find($invoice->payable_id);
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
                1
            );
        } else {
            $enhance = Enhance::find($invoice->payable_id);
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
                0
            );
        }
        $invoice->save();
        // }            
        return view('invoice.billplz_redirect', compact('invoice'));
        // } else {
        //     Alert::error('False Signature', 'You are not from billplz website.');
        //     return redirect('/dashboard');
        // }        
    }

    public function billplz_callback(Request $request)
    {
        $billplz = Client::make(env('BILLPLZ_API_KEY'), env('BILLPLZ_X_SIGNATURE'));
        $bill = $billplz->bill();
        $data = $bill->webhook($_POST);
        return response('', 200);
    }
}
