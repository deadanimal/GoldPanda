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
            $table->char('code', 12);
            $table->decimal('balance', 18, 6);
            $table->decimal('total_out', 18, 6);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reward_profiles', function (Blueprint $table) {
            //
        });
    }
};
