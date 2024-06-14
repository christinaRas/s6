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
        Schema::create('assignements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_etape');
            $table->unsignedBigInteger('id_runner');
            $table->timestamps();

            $table->foreign('id_etape')->references('id')->on('etapes');
            $table->foreign('id_runner')->references('id')->on('runners');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignements');
    }
};
