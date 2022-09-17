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
        Schema::create('blockchain_wallets', function (Blueprint $table) {
            $table->id();
            $table->decimal('coin_balance', 18, 6)->default(0);
            $table->decimal('token_balance', 18, 6)->default(0);
            $table->char('address', 128);
            $table->char('public_key', 128);
            $table->char('private_key', 128);
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
        Schema::dropIfExists('blockchain_wallets');
    }
};
