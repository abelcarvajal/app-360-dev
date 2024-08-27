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
        Schema::create('identificacion', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_tipos_documento');
            $table->foreign('id_tipos_documento')->references('id')->on('tipos_documento');
            $table->string('numero_identidad');
            $table->unsignedBigInteger('id_municipios');
            $table->foreign('id_municipios')->references('id')->on('municipios');
            $table->date('fecha_expedicion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('identificacions');
    }
};
