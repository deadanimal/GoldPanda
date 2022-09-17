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
        Schema::create('blockchain_mints', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount', 18, 6);
            $table->char('status', 3);
            $table->char('hash', 128)->nullable();
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
        Schema::dropIfExists('blockchain_mints');
    }
};
