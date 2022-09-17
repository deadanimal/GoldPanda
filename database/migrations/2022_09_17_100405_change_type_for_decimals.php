<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('advances', function (Blueprint $table) {
            $table->integer('gold_amount')->change();
            $table->integer('fiat_leased')->change();
            $table->integer('interest')->change();
        });

        Schema::table('blockchain_mints', function (Blueprint $table) {
            $table->integer('amount')->change();
        });      
        
        Schema::table('blockchain_transactions', function (Blueprint $table) {
            $table->integer('amount')->change();
        });     
        
        Schema::table('blockchain_wallets', function (Blueprint $table) {
            $table->dropColumn(['coin_balance', 'token_balance']);

        });    
        
        Schema::table('boughts', function (Blueprint $table) {
            $table->integer('gold_amount')->change();
            $table->integer('fiat_nett')->change();
            $table->integer('fiat_fee')->change();
            $table->integer('fiat_inflow')->change();
        });          
        
        Schema::dropIfExists('configurations');

        Schema::table('enhances', function (Blueprint $table) {
            $table->integer('amount')->change();
            $table->integer('capital')->change();
            $table->integer('loan')->change();
            $table->integer('interest')->change();
        });   
        
        Schema::table('forex_prices', function (Blueprint $table) {
            $table->integer('price')->change();
            $table->integer('buy_price')->change();
            $table->integer('sell_price')->change();
        });     
        
        Schema::table('gold_prices', function (Blueprint $table) {
            $table->integer('price')->change();
            $table->integer('buy_price')->change();
            $table->integer('sell_price')->change();
        });     
        
        Schema::table('pay_ins', function (Blueprint $table) {
            $table->integer('amount')->change();
        });    
        
        Schema::table('pay_outs', function (Blueprint $table) {
            $table->integer('amount')->change();
        });           
			
        Schema::table('physical_mints', function (Blueprint $table) {
            $table->integer('amount')->change();
        });  
        
        Schema::table('reward_profiles', function (Blueprint $table) {
            $table->integer('balance')->change();
            $table->integer('total_out')->change();
        });    
        
        Schema::table('rewards', function (Blueprint $table) {
            $table->integer('amount')->change();
        });    
        
        Schema::table('solds', function (Blueprint $table) {
            $table->integer('gold_amount')->change();
            $table->integer('fiat_nett')->change();
            $table->integer('fiat_fee')->change();
            $table->integer('fiat_outflow')->change();
        });     
        
        Schema::table('users', function (Blueprint $table) {
            $table->integer('alloted_gold')->change();
            $table->integer('unalloted_gold')->change();
            $table->integer('advance_gold_latest');
            $table->integer('advance_gold_aggregate');
            $table->integer('advance_fiat_latest');
            $table->integer('advance_fiat_aggregate');      
            $table->integer('enhance_gold_latest');
            $table->integer('enhance_gold_aggregate');
            $table->integer('enhance_fiat_latest');
            $table->integer('enhance_fiat_aggregate');  
            $table->dropColumn(['advance_gold', 'advance_fiat', 'enhance_gold', 'enhance_fiat']);                  
        });         
        					
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
