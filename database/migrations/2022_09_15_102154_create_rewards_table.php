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
            $table->integer('level');
            $table->foreign('trade_id')
                ->references('id')
                ->on('trades')
                ->onCascade('delete');             
            $table->foreign('promoter_id')
                ->references('id')
                ->on('users')
                ->onCascade('delete');             
            $table->foreign('buyer_id')
                ->references('id')
                ->on('users')
                ->onCascade('delete');              
            $table->timestamps();
        });

        Schema::create('reward_profiles', function (Blueprint $table) {
            $table->id();
            $table->integer('level');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onCascade('delete');    
            $table->foreign('promoter_id')
                ->references('id')
                ->on('users')
                ->onCascade('delete');
            $table->timestamps();
        });        
    }


    public function down()
    {
        Schema::dropIfExists('rewards');
    }
};
