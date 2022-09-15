<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRewardRequest;
use App\Http\Requests\UpdateRewardRequest;
use App\Models\Reward;
use App\Models\RewardProfile;

class RewardController extends Controller
{

    public function distribute_reward($user_id, $amount)
    {
        //
    }

    public function add_reward_profile($user_id, $promoter_id)
    {
        $flight = new Flight;
        $flight->name = $request->name;
        $flight->save();
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
