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
        Schema::create('advances', function (Blueprint $table) {
            $table->id();

            $table->decimal('gold_amount', 18, 6);
            $table->decimal('fiat_leased', 18, 6);
            $table->char('currency', 3);

            $table->char('status', 3);

            $table->decimal('interest', 18, 6)->default(0.00);
            $table->timestamp('interest_calculated_at', $precision = 0)->useCurrent();

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
        Schema::dropIfExists('advances');
    }
};
