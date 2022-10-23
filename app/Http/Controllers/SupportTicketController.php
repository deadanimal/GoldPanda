<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SupportTicket;

class SupportTicketController extends Controller
{

    public function home(Request $request)
    {
        $user_id = $request->user()->id;
        $tickets = SupportTicket::where('sender_id', $user_id)->get();
        return view('support.home', compact('tickets'));
    }

    public function admin_home(Request $request)
    {
        return view('support.admin_home');
    }    

    public function create_support(Request $request)
    {
        $user_id = $request->user()->id;
        $support_ticket = new SupportTicket;

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

        $support_ticket = SupportTicket::where([
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

}
