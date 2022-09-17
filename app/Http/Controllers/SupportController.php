<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Support;

class SupportController extends Controller
{

    public function home(Request $request)
    {
        $user_id = $request->user()->id;
        //compact('boughts', 'solds')
        return view('support.home');
    }

    public function admin_home(Request $request)
    {
        return view('support.admin_home');
    }    

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
     * @param  \App\Http\Requests\StoreSupportRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSupportRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Support  $support
     * @return \Illuminate\Http\Response
     */
    public function show(Support $support)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Support  $support
     * @return \Illuminate\Http\Response
     */
    public function edit(Support $support)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSupportRequest  $request
     * @param  \App\Models\Support  $support
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSupportRequest $request, Support $support)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Support  $support
     * @return \Illuminate\Http\Response
     */
    public function destroy(Support $support)
    {
        //
    }
}
