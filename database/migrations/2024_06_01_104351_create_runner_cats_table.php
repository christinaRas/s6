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
        Schema::create('runner_cats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_runner');
            $table->unsignedBigInteger('id_categorie');
            $table->timestamps();
            

            $table->foreign('id_categorie')->references('id')->on('categories');
            $table->foreign('id_runner')->references('id')->on('runners');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('runner_cats');
    }
};
