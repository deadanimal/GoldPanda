<?php

namespace App\Http\Controllers;

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

    public function distribute_sell_reward($user_id, $amount, $currency, $trade_id, $trade)
    {

        $first_level_amount = (int)($amount * 0.20);
        $second_level_amount = (int)($amount * 0.12);
        $third_level_amount = (int)($amount * 0.08);
        $profit_amount = (int)($amount * 0.60);

        $first_promoter_profile = RewardProfile::where('user_id', $user_id)->first();
        
        if (RewardProfile::where('user_id', $first_promoter_profile->promoter_id)->exists()) {
            $second_promoter_profile = RewardProfile::where('user_id', $first_promoter_profile->promoter_id)->first();
        } else {
            $second_promoter_profile = RewardProfile::where('code', 'SAUFIA')->first();
        }

        if (RewardProfile::where('user_id', $second_promoter_profile->promoter_id)->exists()) {
            $third_promoter_profile = RewardProfile::where('user_id', $second_promoter_profile->promoter_id)->first();
        } else {
            $third_promoter_profile = RewardProfile::where('code', 'SAUFIA')->first();
        }

        if ($trade == 1) {
            $tradable_type = 'App\Models\Bought';        
        } else{
            $tradable_type = 'App\Models\Enhance';        
        }

        $first_reward = new Reward;
        $first_reward->amount = $first_level_amount;
        $first_reward->currency = $currency;
        $first_reward->level = 1;
        $first_reward->tradable_id = $trade_id;
        $first_reward->tradable_type = $tradable_type;
        $first_reward->promoter_id = $first_promoter_profile->id;
        $first_reward->buyer_id = $user_id;
        $first_reward->save();

        $second_reward = new Reward;
        $second_reward->amount = $second_level_amount;
        $second_reward->currency = $currency;
        $second_reward->level = 2;
        $second_reward->tradable_id = $trade_id;
        $second_reward->tradable_type = $tradable_type;
        $second_reward->promoter_id = $second_promoter_profile->id;
        $second_reward->buyer_id = $user_id;
        $second_reward->save();
        
        $third_reward = new Reward;
        $third_reward->amount = $third_level_amount;
        $third_reward->currency = $currency;
        $third_reward->level = 3;
        $third_reward->tradable_id = $trade_id;
        $third_reward->tradable_type = $tradable_type;
        $third_reward->promoter_id = $third_promoter_profile->id;
        $third_reward->buyer_id = $user_id;
        $third_reward->save();
        
        $profit = new Reward;
        $profit->amount = $profit_amount;
        $profit->currency = $currency;
        $profit->level = 0;
        $profit->tradable_id = $trade_id;
        $profit->tradable_type = $tradable_type;
        $profit->promoter_id = 1;
        $profit->buyer_id = $user_id;
        $profit->save();        


    }


    public function home()
    {
        $user_id = auth()->user()->id;
        $profile = RewardProfile::where('user_id', $user_id)->first();
        $profiles = RewardProfile::where('promoter_id', $user_id)->get();
        $rewards = Reward::where([
            ['promoter_id', '=', $user_id],
            ['level', '>', 0],
        ])->get();
        return view('reward.home', compact('profile', 'profiles', 'rewards'));
    }  
    
    public function admin_home()
    {
        return view('reward.admin_home');
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

        return redirect('/app/reward');
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(StoreRewardRequest $request)
    {
        //
    }

    public function show(Reward $reward)
    {
        //
    }

    public function edit(Reward $reward)
    {
        //
    }

    public function update(UpdateRewardRequest $request, Reward $reward)
    {
        //
    }

    public function destroy(Reward $reward)
    {
        //
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
            $code = $code.$character;
        }
    
        if (RewardProfile::where('code', $code)->exists()) {
            $this->generateUniqueCode();
        }
    
        return $code;
    
    }    
    
}
