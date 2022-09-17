<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRewardRequest;
use App\Http\Requests\UpdateRewardRequest;
use App\Models\Reward;
use App\Models\RewardProfile;

class RewardController extends Controller
{

    public function distribute_sell_reward($user_id, $amount, $currency, $trade_id)
    {

        $first_level_amount = $amount * 0.20;
        $second_level_amount = $amount * 0.10;
        $third_level_amount = $amount * 0.05;
        $profit_amount = $amount * 0.65;

        $first_promoter_profile = RewardProfile::where('user_id', $user_id)->first();
        $second_promoter_profile = RewardProfile::where('user_id', $first_promoter_profile->promoter_id)->first();
        $third_promoter_profile = RewardProfile::where('user_id', $first_promoter_profile->promoter_id)->first();

        if (!$first_promoter_profile) {
            $reward = new Reward;
            $reward->amount = $first_level_amount;
            $reward->currency = $currency;
            $reward->level = 0;
            $reward->trade_id = $trade_id;
            $reward->promoter_id = 0;
            $reward->buyer_id = $user_id;
            $reward->save();
        } else {
            $reward = new Reward;
            $reward->amount = $first_level_amount;
            $reward->currency = $currency;
            $reward->level = 1;
            $reward->trade_id = $trade_id;
            $reward->promoter_id = $first_promoter_profile->id;
            $reward->buyer_id = $user_id;
            $reward->save();
        }

        if (!$second_promoter_profile) {
            $reward = new Reward;
            $reward->amount = $second_level_amount;
            $reward->currency = $currency;
            $reward->level = 0;
            $reward->trade_id = $trade_id;
            $reward->promoter_id = 0;
            $reward->buyer_id = $user_id;
            $reward->save();
        } else {
            $reward = new Reward;
            $reward->amount = $second_level_amount;
            $reward->currency = $currency;
            $reward->level = 2;
            $reward->trade_id = $trade_id;
            $reward->promoter_id = $second_promoter_profile->id;
            $reward->buyer_id = $user_id;
            $reward->save();
        }   
        

        if (!$third_promoter_profile) {
            $reward = new Reward;
            $reward->amount = $third_level_amount;
            $reward->currency = $currency;
            $reward->level = 0;
            $reward->trade_id = $trade_id;
            $reward->promoter_id = 0;
            $reward->buyer_id = $user_id;
            $reward->save();
        } else {
            $reward = new Reward;
            $reward->amount = $third_level_amount;
            $reward->currency = $currency;
            $reward->level = 3;
            $reward->trade_id = $trade_id;
            $reward->promoter_id = $third_promoter_profile->id;
            $reward->buyer_id = $user_id;
            $reward->save();
        }   
        
        $profit = new Reward;
        $profit->amount = $profit_amount;
        $profit->currency = $currency;
        $profit->level = 0;
        $profit->trade_id = $trade_id;
        $profit->promoter_id = 0;
        $profit->buyer_id = $user_id;
        $profit->save();        


    }

    public function add_reward_profile($user_id, $promoter_id, $level)
    {
        $reward_profile = new RewardProfile;
        $reward_profile->level = $level;
        $reward_profile->user_id = $user_id;
        $reward_profile->promoter_id = $promoter_id;
        $reward_profile->save();
    }


    public function home()
    {
        return view('reward.home');
    }  
    
    public function admin_home()
    {
        return view('reward.admin_home');
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
}
