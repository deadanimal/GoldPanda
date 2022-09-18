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
        Schema::create('identity_documents', function (Blueprint $table) {
            $table->id();
            $table->char('country',3)->default('MYS');
            $table->char('identity_type',8)->default('NRIC');
            $table->char('identity_number', 32)->default('NRIC');
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
        Schema::dropIfExists('identity_documents');
    }
};
