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
        Schema::create('evaluaciones', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->unsignedBigInteger('id_colaboradores');
            $table->foreign('id_colaboradores')->references('id')->on('colaboradors');
            $table->unsignedBigInteger('id_login');
            $table->foreign('id_login')->references('id')->on('login');
            $table->unsignedBigInteger('id_detalle_evaluacion');
            $table->foreign('id_detalle_evaluacion')->references('id')->on('detalle_evaluacions');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluacions');
    }
};
