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
        Schema::create('blockchain_transactions', function (Blueprint $table) {
            $table->id();
            $table->char('token', 6);
            $table->char('transaction_hash', 128);
            $table->integer('block_number');
            $table->char('to', 128);            
            $table->decimal('amount', 18, 6)->default(0);
            $table->foreignId('blockchain_wallet_id')->constrained('blockchain_wallets');               
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
        Schema::dropIfExists('blockchain_transactions');
    }
};
