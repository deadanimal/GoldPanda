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
        Schema::table('users', function (Blueprint $table) {
            $table->decimal('advance_gold', 18, 6)->default(0);
            $table->decimal('enhance_gold', 18, 6)->default(0);
            $table->decimal('advance_fiat', 18, 6)->default(0);
            $table->decimal('enhance_fiat', 18, 6)->default(0);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user', function (Blueprint $table) {
            //
        });
    }
};
