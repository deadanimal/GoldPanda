<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('rewards', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount', 18, 6);
            $table->char('currency', 3);
            $table->integer('level');
            $table->foreignId('bought_id')->constrained('boughts');                          
            $table->foreignId('promoter_id')->constrained('users');             
            $table->foreignId('buyer_id')->constrained('users');                        
            $table->timestamps();
        });

        Schema::create('reward_profiles', function (Blueprint $table) {
            $table->id();
            $table->integer('level');
            $table->foreignId('user_id')->constrained('users');   
            $table->foreignId('promoter_id')->constrained('users');   
            $table->timestamps();

            $table->unique('user_id');


        });        
    }


    public function down()
    {
        Schema::dropIfExists('rewards');
    }
};
