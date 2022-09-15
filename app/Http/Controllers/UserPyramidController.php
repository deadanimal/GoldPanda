<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserPyramidRequest;
use App\Http\Requests\UpdateUserPyramidRequest;
use App\Models\UserPyramid;

class UserPyramidController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserPyramidRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserPyramidRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserPyramid  $userPyramid
     * @return \Illuminate\Http\Response
     */
    public function show(UserPyramid $userPyramid)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserPyramid  $userPyramid
     * @return \Illuminate\Http\Response
     */
    public function edit(UserPyramid $userPyramid)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserPyramidRequest  $request
     * @param  \App\Models\UserPyramid  $userPyramid
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserPyramidRequest $request, UserPyramid $userPyramid)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserPyramid  $userPyramid
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserPyramid $userPyramid)
    {
        //
    }
}
