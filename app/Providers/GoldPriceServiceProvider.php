<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\GoldPrice;
use App\Models\ForexPrice;

class GoldPriceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.app', function ($view) {
            $gold_price = GoldPrice::latest()->first();
            $myr_price = ForexPrice::where('currency', 'MYR')->latest()->first();        
            return $view->with('gold_price', $gold_price)->with('myr_price', $myr_price);
        });
    }
}
