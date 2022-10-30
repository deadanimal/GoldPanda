<?php

namespace App\Http\Controllers;

use DataTables;
use DateTime;
use Carbon\Carbon;
use Alert;

use Illuminate\Http\Request;
use App\Http\Requests\StoreRewardRequest;
use App\Http\Requests\UpdateRewardRequest;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\Reward;
use App\Models\User;
use App\Models\RewardProfile;

class RewardController extends Controller
{

    public function distribute_sell_reward($user_id, $amount, $currency, $trade_id, $trade) {

        $user = User::find($user_id);
        $first_level_amount = (int)($amount * 0.20);
        $second_level_amount = (int)($amount * 0.12);
        $third_level_amount = (int)($amount * 0.08);
        $profit_amount = (int)($amount * 0.60);

        $first_introducer = User::where('introducer_id', $user->id)->first();

        if (User::where('introducer_id', $first_introducer->introducer_id)->exists()) {
            $second_introducer = User::where('introducer_id', $first_introducer->introducer_id)->first();
        } else {
            $second_introducer = User::where('code', 'SAUFIA')->first();
        }

        if (User::where('introducer_id', $second_introducer->introducer_id)->exists()) {
            $third_introducer = User::where('introducer_id', $second_introducer->introducer_id)->first();
        } else {
            $third_introducer = User::where('code', 'SAUFIA')->first();
        }

        if ($trade == 1) {
            $tradable_type = 'App\Models\Trade';
        } else {
            $tradable_type = 'App\Models\Enhance';
        }

        $first_reward = new Reward;
        $first_reward->amount = $first_level_amount;
        $first_reward->currency = $currency;
        $first_reward->level = 1;
        $first_reward->tradable_id = $trade_id;
        $first_reward->tradable_type = $tradable_type;
        $first_reward->introducer_id = $first_introducer->id;
        $first_reward->buyer_id = $user_id;
        $first_reward->save();

        $second_reward = new Reward;
        $second_reward->amount = $second_level_amount;
        $second_reward->currency = $currency;
        $second_reward->level = 2;
        $second_reward->tradable_id = $trade_id;
        $second_reward->tradable_type = $tradable_type;
        $second_reward->introducer_id = $second_introducer->id;
        $second_reward->buyer_id = $user_id;
        $second_reward->save();

        $third_reward = new Reward;
        $third_reward->amount = $third_level_amount;
        $third_reward->currency = $currency;
        $third_reward->level = 3;
        $third_reward->tradable_id = $trade_id;
        $third_reward->tradable_type = $tradable_type;
        $third_reward->introducer_id = $third_introducer->id;
        $third_reward->buyer_id = $user_id;
        $third_reward->save();

        $profit = new Reward;
        $profit->amount = $profit_amount;
        $profit->currency = $currency;
        $profit->level = 0;
        $profit->tradable_id = $trade_id;
        $profit->tradable_type = $tradable_type;
        $profit->introducer_id = 8;
        $profit->buyer_id = $user_id;
        $profit->save();
    }


    public function home(Request $request) {
        $user = $request->user();
        $rewards = Reward::where([
            ['introducer_id', '=', $user->id],
            ['level', '>', 0],
        ])->get();
        if ($request->ajax()) {
            return DataTables::collection($rewards)
                ->addColumn('buyer_', function (Reward $reward) {
                    $url = '/user/' . $reward->buyer->id;
                    $html_button = '<a href="' . $url . '"><button class="btn btn-primary">'.$reward->buyer->name.'</button></a>';
                    return $html_button;
                })
                ->addColumn('amount_', function (Reward $reward) {
                    $html_statement = 'RM '.number_format($reward->amount / 100, 3, '.', ','); ;
                    return $html_statement;
                })                
                ->editColumn('created_at', function (reward $reward) {
                    return [
                        'display' => ($reward->created_at && $reward->created_at != '0000-00-00 00:00:00') ? with(new Carbon($reward->created_at))->format('d/m/Y') : '',
                        'timestamp' => ($reward->created_at && $reward->created_at != '0000-00-00 00:00:00') ? with(new Carbon($reward->created_at))->timestamp : ''
                    ];
                })
                ->rawColumns(['buyer_','amount_'])
                ->make(true);
        }
        return view('reward.home', compact('rewards', 'user'));
    }

    public function admin() {
        return view('reward.admin');
    }

    public function add_new_user(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'code' => ['required', 'string', 'max:6'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        $promoter = User::find($request->promoter_id);
        $promoter_profile = RewardProfile::where('user_id', $promoter->id)->first();

        $reward_profile = new RewardProfile;
        $reward_profile->level = $promoter_profile->level + 1;
        $reward_profile->user_id = $user->id;
        $reward_profile->promoter_id = $promoter->id;
        $reward_profile->code = $this->generateUniqueCode();
        $reward_profile->save();

        return back();
    }


    public function generateUniqueCode()
    {

        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersNumber = strlen($characters);
        $codeLength = 6;

        $code = '';

        while (strlen($code) < 6) {
            $position = rand(0, $charactersNumber - 1);
            $character = $characters[$position];
            $code = $code . $character;
        }

        if (RewardProfile::where('code', $code)->exists()) {
            $this->generateUniqueCode();
        }

        return $code;
    }
}
