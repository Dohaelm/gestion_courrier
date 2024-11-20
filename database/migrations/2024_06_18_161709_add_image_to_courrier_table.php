<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('courrier', function (Blueprint $table) {
            $table->string('image')->nullable(); // To store the image path
        });
    }
    
    public function down()
    {
        Schema::table('courrier', function (Blueprint $table) {
            $table->dropColumn('image');
        });
    }
};
