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
        Schema::create('reserves', function (Blueprint $table) {
            $table->id();
            $table->integer('amount');
            $table->char('currency', 3);
            $table->boolean('flow')->default(1);             
            $table->timestamps();                       
        });

        Schema::create('profits', function (Blueprint $table) {
            $table->id();
            $table->integer('amount');  
            $table->char('currency', 3);          
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
        //
    }
};
