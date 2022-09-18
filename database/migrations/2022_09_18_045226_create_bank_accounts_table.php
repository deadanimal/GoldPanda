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
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->id();
            $table->boolean('active');
            $table->char('bank_name',128);
            $table->char('bank_country',3);
            $table->char('account_name',128);
            $table->char('account_number',128);
            $table->char('note_1',128);
            $table->char('note_2',128);
            $table->char('note_3',128);
            $table->char('description',128);
            $table->boolean('verified')->default(0);
            $table->timestamp('verified_at');
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
        Schema::dropIfExists('bank_accounts');
    }
};
