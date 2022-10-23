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
        Schema::create('flows', function (Blueprint $table) {
            $table->id();
            $table->integer('amount')->nullable();
            $table->char('currency', 3)->nullable();
            $table->char('method', 3)->nullable();
            $table->char('status', 3)->nullable();

            $table->morphs('payable');
            $table->char('note_1', 128)->nullable();
            $table->char('note_2', 128)->nullable();
            $table->char('note_3', 128)->nullable();                
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
        Schema::dropIfExists('flows');
    }
};
