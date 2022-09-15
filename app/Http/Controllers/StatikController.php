<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStatikRequest;
use App\Http\Requests\UpdateStatikRequest;
use App\Models\Statik;

class StatikController extends Controller
{

    public function home()
    {
        return view('statik.home');
    }

    public function about()
    {
        return view('statik.about');
    }    

    public function products()
    {
        return view('statik.products');
    }        

    public function contact()
    {
        return view('statik.contact');
    }       
    
    public function faq()
    {
        return view('statik.faq');
    }     

    public function privacy()
    {
        return view('statik.privacy');
    }  
    
    public function terms()
    {
        return view('statik.terms');
    }    
    
    public function app()
    {
        return view('app');
    }     

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(StoreStatikRequest $request)
    {
        //
    }

    public function show(Statik $statik)
    {
        //
    }

    public function edit(Statik $statik)
    {
        //
    }

    public function update(UpdateStatikRequest $request, Statik $statik)
    {
        //
    }

    public function destroy(Statik $statik)
    {
        //
    }
}
