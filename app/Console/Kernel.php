<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Http;
use App\Models\ForexPrice;
use App\Models\GoldPrice;

class Kernel extends ConsoleKernel
{

    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $this->updateGoldPrice();
        })->hourly();
    }


    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }

    public function updateGoldPrice() {
        $url = 'https://api.metalpriceapi.com/v1/latest?api_key=c79844174c0a8cb86ed47b1db62a7cef&base=USD&currencies=MYR,XAU,XAG&unit=gram';
        $data = Http::get($url)->json();  
        $myr = (int)($data['rates']['MYR'] * 100);
        $gold = (int)((1 / $data['rates']['XAU']) * 100);

        $myr_price = New ForexPrice;
        $myr_price->currency = 'MYR';
        $myr_price->price = $myr;
        $myr_price->save();
                
        $gold_price = New GoldPrice;
        $gold_price->price = $gold;
        $gold_price->save();        
    }
}
