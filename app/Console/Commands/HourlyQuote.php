<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\GoldPrice;
use App\Models\ForexPrice;

class HourlyQuote extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'quote:hourly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get forex and gold price on hourly basis';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $endpoint = 'latest';
        $access_key = 'API_KEY';

        $ch = curl_init('https://data.fixer.io/api/'.$endpoint.'?access_key='.$access_key.'&base=USD');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $json = curl_exec($ch);
        curl_close($ch);

        $exchangeRates = json_decode($json, true);
        
        $xau_input = $exchangeRates['rates']['XAU'];        
        $myr_input = $exchangeRates['rates']['MYR'];        

        $gold_price = new GoldPrice;
        $gold_price->price = (int)($xau_input * 1000000 / 28.3495);
        $gold_price->save();


        $myr_price = new ForexPrice;
        $myr_price->price = (int)($myr_input * 100);
        $myr_price->save();        

        return 1;
    }


}
