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
        Schema::create('colaboradors', function (Blueprint $table) {
            $table->id();
            $table->string('nombres');
            $table->string('apellidos');
            $table->unsignedBigInteger('id_identificacion');
            $table->foreign('id_identificacion')->references('id')->on('identificacions');
            $table->unsignedBigInteger('id_direcciones');
            $table->foreign('id_direcciones')->references('id')->on('directions');
            $table->string('telefono_fijo');
            $table->string('celular');
            $table->string('email');
            $table->date('fecha_nacimiento');
            $table->unsignedBigInteger('id_cargos');
            $table->foreign('id_cargos')->references('id')->on('cargos');
            $table->unsignedBigInteger('id_sedes');
            $table->foreign('id_sedes')->references('id')->on('sedes');
            $table->unsignedBigInteger('id_programas');
            $table->foreign('id_programas')->references('id')->on('programas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('colaboradors');
    }
};
