<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStatikRequest;
use App\Http\Requests\UpdateStatikRequest;
use App\Models\Statik;
use App\Models\User;
use App\Models\GoldPrice;

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
        $gold_price = GoldPrice::latest()->first();
        return view('app', compact('gold_price'));
    }     

    public function admin()
    {
        return view('admin');
    }       


}
