<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Statik;
use App\Models\User;
use App\Models\GoldPrice;
use App\Models\ForexPrice;

class StatikController extends Controller
{

    public function home() {

        return view('statik.home');
    }

    public function advance() {
        return view('statik.product-advance');
    }   
    
    public function enhance() {
        return view('statik.product-enhance');
    }      

    public function about() {
        return view('statik.about');
    }    

    public function products() {
        return view('statik.products');
    }        

    public function contact() {
        return view('statik.contact');
    }       
    
    public function faq() {
        return view('statik.faq');
    }     

    public function privacy() {
        return view('statik.privacy');
    }  
    
    public function terms() {
        return view('statik.terms');
    }    
    
    public function app(Request $request)
    {
        $gold_price = GoldPrice::latest()->first();
        $myr_price = ForexPrice::where('currency', 'MYR')->latest()->first();  
        $user = auth()->user();
        return view('app', compact('gold_price', 'myr_price', 'user'));
    }    
    
    public function pro(Request $request)
    {
        $gold_price = GoldPrice::latest()->first();
        $myr_price = ForexPrice::where('currency', 'MYR')->latest()->first();  
        $user = auth()->user();
        return view('pro', compact('gold_price', 'myr_price', 'user'));
    }     

    public function admin()
    {
        return view('admin');
    }       

    


}
