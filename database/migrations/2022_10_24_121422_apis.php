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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();                
            $table->timestamps();            
            $table->morphs('payable');
            $table->foreignId('user_id')->nullable()->constrained('users')->cascadeOnDelete();            
        });

        Schema::create('payments', function (Blueprint $table) {
            $table->id();                
            $table->timestamps();            
            $table->morphs('payable');
            $table->foreignId('user_id')->nullable()->constrained('users')->cascadeOnDelete();            
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
