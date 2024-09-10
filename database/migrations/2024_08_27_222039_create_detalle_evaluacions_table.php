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
        Schema::create('detalle_evaluacion', function (Blueprint $table) {
            $table->id();
            $table->string('valoracion');
            $table->unsignedBigInteger('id_criterios');
            $table->foreign('id_criterios')->references('id')->on('criterios');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_evaluacion');
    }
};
