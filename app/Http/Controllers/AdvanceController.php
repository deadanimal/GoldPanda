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
use App\Models\PayOut;

class AdvanceController extends Controller
{
    public function home(Request $request) {
        $user_id = auth()->user()->id;
        $advances = Advance::where('user_id', $user_id)->get();

        if ($request->ajax()) {
            return DataTables::collection($advances)
                ->addIndexColumn()
                // ->addColumn('pelaksana', function (Advance $advance) {
                //     return $advance->pekerja->name;
                // })
                // ->addColumn('status_', function (Advance $advance) {
                //     $html_badge = '<span class="badge rounded-pill bg-primary">' . ucfirst($advance->status) . '</span>';
                //     return $html_badge;
                // })
                // ->addColumn('link', function (Advance $advance) {
                //     $url = '/projek/' . $advance->projek_id . '/advance/' . $advance->id;
                //     $html_button = '<a href="' . $url . '"><button class="btn btn-primary">Lihat</button></a>';
                //     return $html_button;
                // })
                ->editColumn('created_at', function (Advance $advance) {
                    return [
                        'display' => ($advance->created_at && $advance->created_at != '0000-00-00 00:00:00') ? with(new Carbon($advance->created_at))->format('d F Y') : '',
                        'timestamp' => ($advance->created_at && $advance->created_at != '0000-00-00 00:00:00') ? with(new Carbon($advance->created_at))->timestamp : ''
                    ];
                })
                // ->rawColumns(['status_', 'link'])
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


    public function cipta_advance(Request $request)
    {
        $validatedData = $request->validate([
            'gold_amount' => ['required', 'gte:0.1'],
        ]);

        $user = $request->user();


        $gold_amount = $request->gold_amount;
        $gold_price = GoldPrice::latest()->first()->sell_price;
        $myr_price = ForexPrice::where('currency', 'MYR')->latest()->first()->sell_price;

        $fiat_flow = $gold_amount * 1000000 * ($gold_price * $myr_price) / 100;
        $fiat_fee = 0;
        $fiat_nett = $fiat_flow - $fiat_fee;
        $amount_lent = $fiat_nett * 85 / 100;

        if($gold_amount * 1000000 < $user->balance) {
            Alert::error('Gold Advanced', 'You have insufficient amount of gold to lease');
        }



        $advance = new Advance;
        $advance->gold_amount = $request->gold_amount * 1000000;
        $advance->fiat_leased = $amount_lent;
        $advance->currency = 'MYR';
        $advance->status = 'created';
        $advance->user_id = $request->user()->id;
        $advance->save();

        $payment = New Payment;
        $payment->payable_type = 'App\Models\Advance';
        $payment->payable_id = $advance->id;
        $payment->user_id = $request->user()->id;
        $payment->status = 'created';
        $payment->amount = $advance->fiat_leased;
        $payment->currency = $advance->currency;            
        $payment->save();

        $user->balance -=$gold_amount * 1000000;
        $user->save();

        Alert::success('Gold Advanced', 'Your gold has been successfully been leased. You will receive a payment within two to three working days');
        return back();
    }


    public function satu_advance(Request $request)
    {
        $id = (int)$request->route('id');
        $advance = Advance::find($id);
        $pay_out = PayOut::where([
            ['payable_id', '=', $id],
            ['payable_type', '=', 'App\Models\Advance'],
        ])->first();
        return view('advance.detail', compact('advance', 'pay_out'));
    }
}
