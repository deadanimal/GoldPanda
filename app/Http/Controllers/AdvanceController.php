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
use App\Models\Flow;
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


        $gold_amount = $request->gold_amount;
        $gold_price = GoldPrice::latest()->first()->sell_price;
        $myr_price = ForexPrice::where('currency', 'MYR')->latest()->first()->sell_price;

        $fiat_flow = $gold_amount  * ($gold_price * $myr_price) / 100;
        $fiat_fee = 0;
        $fiat_nett = $fiat_flow - $fiat_fee;
        $amount_lent = $fiat_nett * 85 / 100;

        // $gold_balance = $request->user()->alloted_gold;
        // if($gold_amount * 1000000 > $gold_balance) {
        //     $gold_balance_string = number_format($gold_balance / 1000000, 6, '.', ',');
        //     $statement = 'You do not enough gold balance. Your current available gold balance is '.$gold_balance_string.' g';
        //     return Redirect::back()->withErrors(['msg' => $statement]);
        // }

        $advance = new Advance;
        $advance->gold_amount = $request->gold_amount * 1000000;
        $advance->fiat_leased = $amount_lent;
        $advance->currency = 'MYR';
        $advance->status = 'CRT';
        $advance->user_id = $request->user()->id;
        $advance->save();

        $flow = new Flow;

        $flow->amount = $advance->fiat_leased;
        $flow->currency = $advance->currency;
        $flow->in = true;
        $flow->method = 'MAN';
        $flow->status = 'CRT';

        $flow->payable_id = $advance->id;
        $flow->payable_type = 'App\Models\Advance';

        $flow->note_1 = '';
        $flow->note_2 = '';
        $flow->note_3 = '';

        $flow->save();

        Alert::alert('Title', 'Message', 'Type');
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
