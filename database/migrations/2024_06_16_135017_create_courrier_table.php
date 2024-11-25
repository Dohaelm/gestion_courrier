<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('courrier', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->datetime('date');
            $table->string('destinataire');
            $table->string('expediteur');
            $table->string('description');
           
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courrier');
    }
};
