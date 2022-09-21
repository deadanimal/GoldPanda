<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Support;
use App\Models\SupportTicket;

class SupportController extends Controller
{

    public function home(Request $request)
    {
        $user_id = $request->user()->id;
        $support_tickets = Support::where('user_id', $user_id)->get();
        return view('support.home', compact('support_tickets'));
    }

    public function admin_home(Request $request)
    {
        return view('support.admin_home');
    }    

    public function index(Request $request)
    {
        //
    }


    public function create_support(Request $request)
    {
        $user_id = $request->user()->id;
        $support_ticket = new Support;

        $support_ticket->user_id = $user_id;
        $support_ticket->status = 'CRT';

        $support_ticket->save();

        $support_message = new SupportTicket;

        $support_message->message = $request->message;
        $support_message->support_id = $support_ticket->id;
        $support_message->sender_id = $user_id;

        $support_message->save();

        $support_messages = SupportTicket::where('support_id', $support_ticket->id)->get();

        return view('support.detail', compact('support_ticket', 'support_messages'));
    }

    public function send_message(Request $request)
    {
        $user_id = $request->user()->id;
        $id = (int)$request->route('id');

        $support_ticket = Support::where([
            ['user_id', '=', $user_id],
            ['id', '=', $id],
        ])->first();

        $support_message = new SupportTicket;

        $support_message->message = $request->message;
        $support_message->support_id = $support_ticket->id;
        $support_message->sender_id = $user_id;

        $support_message->save();

        $support_messages = SupportTicket::where('support_id', $support_ticket->id)->get();

        return view('support.detail', compact('support_ticket', 'support_messages'));
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
    public function show(Request $request)
    {
        $user_id = $request->user()->id;
        $id = (int)$request->route('id');
        $support_ticket = Support::where([
            ['user_id', '=', $user_id],
            ['id', '=', $id]
        ])->firstOrFail();
        $support_messages = SupportTicket::where('support_id', $support_ticket->id)->get();
        return view('support.detail', compact('support_ticket', 'support_messages'));
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
