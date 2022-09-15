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
        Schema::create('boughts', function (Blueprint $table) {
            $table->id();
            $table->decimal('gold_amount', 18, 6);
            $table->decimal('fiat_nett', 18, 6);
            $table->decimal('fiat_fee', 18, 6);
            $table->decimal('fiat_inflow', 18, 6);
            $table->char('fiat_currency', 3);
            $table->char('status', 3);
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
        });


        Schema::create('solds', function (Blueprint $table) {
            $table->id();
            $table->decimal('gold_amount', 18, 6);
            $table->decimal('fiat_outflow', 18, 6);
            $table->decimal('fiat_nett', 18, 6);
            $table->decimal('fiat_fee', 18, 6);            
            $table->char('fiat_currency', 3);
            $table->char('status', 3);      
            $table->foreignId('user_id')->constrained('users');  
            $table->timestamps();
        });        


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('boughts');
        Schema::dropIfExists('solds');
    }
};
