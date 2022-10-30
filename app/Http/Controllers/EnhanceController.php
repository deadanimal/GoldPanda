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

use App\Models\User;
use App\Models\Enhance;
use App\Models\GoldPrice;
use App\Models\ForexPrice;
use App\Models\Invoice;
use App\Models\Payment;
use Billplz\Client;
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
                    $html_button = 'RM '.number_format((int)($enhance->capital)  / 100, 2, '.', ',');
                    return $html_button;
                })  
                ->addColumn('booked_', function (Enhance $enhance) {                
                    $html_button = 'RM '.number_format((int)($enhance->capital + $enhance->loan)  / 100, 2, '.', ',');
                    return $html_button;
                })                                 
                ->addColumn('gold_', function (Enhance $enhance) {                    
                    $html_button = number_format((int)$enhance->amount / 1000000, 3, '.', '').'g';
                    return $html_button;
                })
                ->addColumn('link', function (Enhance $enhance) {                    
                    if ($enhance->status == "Waiting For Payment") {
                        $url = "https://billplz.com/bills/".$enhance->invoice->billplz_id;
                        $html_button = '<a href="' . $url . '"><button class="btn btn-primary">Pay</button></a>';
                        return $html_button;
                    } else {
                        $url = '/enhance/'. $enhance->id;
                        $html_button = '<a href="' . $url . '"><button class="btn btn-primary">View</button></a>';
                        return $html_button;  
                    }                    
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

    public function admin(Request $request)
    {
        return view('enhance.admin');
    }    

    public function cipta(Request $request)
    {        

        $validatedData = $request->validate([
            'fiat_amount' => ['required', 'gte:20.00', 'lte:20000.00'],
        ]);        

        $fiat_flow = $request->fiat_amount * 100; // in cent
        $fiat_leased = $fiat_flow * $request->leverage;
        $fiat_fee = ($fiat_flow + $fiat_leased) / 20;
    
        
        $gold_price = GoldPrice::latest()->first()->price;
        $myr_price = ForexPrice::where('currency', 'MYR')->latest()->first()->price;

        $user_id = $request->user()->id;
        $user = User::find($user_id);

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
        $enhance->user_id = $user_id;
        $enhance->save();

        $invoice = New Invoice;
        $invoice->payable_type = 'App\Models\Enhance';
        $invoice->payable_id = $enhance->id;
        $invoice->user_id = $user_id;
        $invoice->status = 'Waiting For Payment';
        $invoice->amount = $enhance->capital;
        $invoice->currency = $enhance->currency;

        $billplz = Client::make(env('BILLPLZ_API_KEY'), env('BILLPLZ_X_SIGNATURE'));
        $bill = $billplz->bill();  

        $datetime = new DateTime('tomorrow');
        $billplz_statement = 'Booking of '.number_format(($enhance->amount / 1000000), 3, ".", ",").' gram of gold at the price of RM'.number_format(($gold_price * $myr_price / 10000), 2, ".", ",").' per gram. Fee imposed on the purchased is RM'.number_format(($fiat_fee / 100), 2, ".", ",");
        $response = $bill->create(
            'tzuppys4',
            $user->email,
            $user->mobile,
            'Easy Gold - Booking of Gold',
            \Duit\MYR::given($enhance->capital),
            'https://easygold.com.my/billplz-callback',
            $billplz_statement,
            [
                "reference_1_label" => "Gold Amount",
                "reference_1" => number_format(($enhance->amount / 1000000),3,".",","),
                "due_at" => new \DateTime($datetime->format('Y-m-d')),
                "redirect_url" => 'https://easygold.com.my/billplz-redirect',
                "callback_url" => 'https://easygold.com.my/billplz-callback',
            ]
        );

        $billplz_data = $response->toArray();

        $invoice->billplz_id = $billplz_data['id'];
        $invoice->save();
        return redirect($billplz_data['url']);
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
