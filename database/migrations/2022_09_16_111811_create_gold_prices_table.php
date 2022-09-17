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
        Schema::create('gold_prices', function (Blueprint $table) {
            $table->id();        
            $table->decimal('buy_price', 18, 6);
            $table->decimal('sell_price', 18, 6);
            $table->decimal('price', 18, 6);
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
        Schema::dropIfExists('gold_prices');
    }
};
