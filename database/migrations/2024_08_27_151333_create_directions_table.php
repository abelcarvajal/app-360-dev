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
        Schema::create('directions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_tipos_via');
            $table->foreign('id_tipos_via')->references('id')->on('tipos_vias');
            $table->string('numero_via');
            $table->string('numero');
            $table->unsignedBigInteger('id_barrios');
            $table->foreign('id_barrios')->references('id')->on('barrios');
            $table->unsignedBigInteger('id_posiciones_cardinales');
            $table->foreign('id_posiciones_cardinales')->references('id')->on('posiciones_cardinales');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('directions');
    }
};
