<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreIdentityDocumentRequest;
use App\Http\Requests\UpdateIdentityDocumentRequest;
use App\Models\IdentityDocument;

class IdentityDocumentController extends Controller
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
     * @param  \App\Http\Requests\StoreIdentityDocumentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreIdentityDocumentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IdentityDocument  $identityDocument
     * @return \Illuminate\Http\Response
     */
    public function show(IdentityDocument $identityDocument)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IdentityDocument  $identityDocument
     * @return \Illuminate\Http\Response
     */
    public function edit(IdentityDocument $identityDocument)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateIdentityDocumentRequest  $request
     * @param  \App\Models\IdentityDocument  $identityDocument
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateIdentityDocumentRequest $request, IdentityDocument $identityDocument)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IdentityDocument  $identityDocument
     * @return \Illuminate\Http\Response
     */
    public function destroy(IdentityDocument $identityDocument)
    {
        //
    }
}
