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
        // Tabla vacía y sin referencias: TiposViaController y el modelo TiposVia
        // eran código muerto (sin ruta registrada desde la Fase 2.3); Colaborador.direccion
        // ya es texto libre y no usa esta clasificación.
        Schema::dropIfExists('tipos_vias');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('tipos_vias', function (Blueprint $table) {
            $table->id();
            $table->char('tipo_via', 4);
            $table->timestamps();
        });
    }
};
