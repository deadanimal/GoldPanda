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

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'advance_gold_latest',
                'advance_gold_aggregate',
                'advance_fiat_latest',
                'advance_fiat_aggregate',
                'enhance_gold_latest',
                'enhance_gold_aggregate',
                'enhance_fiat_latest',
                'enhance_fiat_aggregate'
            ]);                  
        });              
        Schema::table('users', function (Blueprint $table) {
            $table->integer('advance_gold_latest')->default(0);
            $table->integer('advance_gold_aggregate')->default(0);
            $table->integer('advance_fiat_latest')->default(0);
            $table->integer('advance_fiat_aggregate')->default(0);      
            $table->integer('enhance_gold_latest')->default(0);
            $table->integer('enhance_gold_aggregate')->default(0);
            $table->integer('enhance_fiat_latest')->default(0);
            $table->integer('enhance_fiat_aggregate')->default(0);  
        });       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
