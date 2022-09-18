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
        Schema::table('reward_profiles', function (Blueprint $table) {
            $table->dropColumn([
                'balance',
                'total_out',
            ]);   
        });

        Schema::table('reward_profiles', function (Blueprint $table) {
            $table->integer('balance')->default(0);
            $table->integer('total_out')->default(0);            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reward_profile', function (Blueprint $table) {
            //
        });
    }
};
