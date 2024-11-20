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
        Schema::table('courrier_supprime', function (Blueprint $table) {
            $table->string('image')->after('description'); // Add the image column
        });
    }

    public function down()
    {
        Schema::table('courrier_supprime', function (Blueprint $table) {
            $table->dropColumn('image');
        });
    }
};
