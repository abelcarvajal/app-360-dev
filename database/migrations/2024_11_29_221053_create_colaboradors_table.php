<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('colaboradors', function (Blueprint $table) {
            $table->id();
            $table->string('nombres');
            $table->string('apellidos');
            $table->foreignId('identificacion_id')->constrained('identificacions');
            $table->date('fecha_nacimiento');
            $table->foreignId('pais_nacimiento_id')->constrained('pais');
            $table->foreignId('departamento_nacimiento_id')->constrained('departamentos');
            $table->foreignId('ciudad_nacimiento_id')->constrained('municipios');
            $table->foreignId('ciudad_residencia_id')->constrained('municipios');
            $table->string('direccion');
            $table->string('telefono_fijo')->nullable();
            $table->string('celular');
            $table->string('email')->unique();
            $table->foreignId('id_cargos')->constrained('cargos');
            $table->foreignId('id_programas')->constrained('programas');
            $table->foreignId('id_centro_costo');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('colaboradors');
    }
};
