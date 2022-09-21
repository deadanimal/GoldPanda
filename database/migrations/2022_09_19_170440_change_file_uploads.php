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
        Schema::dropIfExists('profiles');
        Schema::dropIfExists('statiks');
        Schema::dropIfExists('user_pyramids');

        Schema::table('file_uploads', function (Blueprint $table) {
            $table->dropColumn([
                'file_id',
            ]);     
            $table->string('name')->nullable();
            $table->string('file_path')->nullable();            
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
