<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSupportTicketRequest;
use App\Http\Requests\UpdateSupportTicketRequest;
use App\Models\SupportTicket;

class SupportTicketController extends Controller
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
     * @param  \App\Http\Requests\StoreSupportTicketRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSupportTicketRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SupportTicket  $supportTicket
     * @return \Illuminate\Http\Response
     */
    public function show(SupportTicket $supportTicket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SupportTicket  $supportTicket
     * @return \Illuminate\Http\Response
     */
    public function edit(SupportTicket $supportTicket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSupportTicketRequest  $request
     * @param  \App\Models\SupportTicket  $supportTicket
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSupportTicketRequest $request, SupportTicket $supportTicket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SupportTicket  $supportTicket
     * @return \Illuminate\Http\Response
     */
    public function destroy(SupportTicket $supportTicket)
    {
        //
    }
}
