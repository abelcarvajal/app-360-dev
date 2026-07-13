<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ciclos_evaluacion', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->year('anio');
            $table->enum('tipo', ['anual', 'periodo_prueba']);
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->boolean('activo')->default(false);
            $table->integer('max_evaluadores_pares')->default(5);
            $table->integer('max_evaluaciones_recibidas')->default(8);
            $table->integer('min_evaluaciones_recibidas')->default(3);
            $table->boolean('permite_modificacion')->default(false);
            $table->boolean('requiere_completitud')->default(false);
            $table->boolean('evaluacion_cruzada')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ciclos_evaluacion');
    }
};