<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Eliminar FK que depende de criterios
        Schema::table('detalle_evaluacions', function (Blueprint $table) {
            $table->dropForeign(['id_criterios']);
        });

        // 2. Ahora sí se puede eliminar criterios
        Schema::dropIfExists('criterios');

        // 3. Crear items_evaluacion (reemplaza criterios)
        Schema::create('items_evaluacion', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_categorias_criterios')
                  ->constrained('categorias_criterios')
                  ->onDelete('cascade');
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });

        // 4. Crear item_niveles
        Schema::create('item_niveles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_evaluacion_id')
                  ->constrained('items_evaluacion')
                  ->onDelete('cascade');
            $table->tinyInteger('nivel');
            $table->text('descripcion');
            $table->timestamps();

            $table->unique(['item_evaluacion_id', 'nivel']);
        });

        // 5. Redirigir FK en detalle_evaluacions hacia items_evaluacion
        Schema::table('detalle_evaluacions', function (Blueprint $table) {
            $table->foreign('id_criterios')
                  ->references('id')
                  ->on('items_evaluacion')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('detalle_evaluacions', function (Blueprint $table) {
            $table->dropForeign(['id_criterios']);
        });

        Schema::dropIfExists('item_niveles');
        Schema::dropIfExists('items_evaluacion');

        Schema::create('criterios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_categorias_criterios')
                  ->constrained('categorias_criterios');
            $table->string('criterio');
            $table->timestamps();
        });

        Schema::table('detalle_evaluacions', function (Blueprint $table) {
            $table->foreign('id_criterios')
                  ->references('id')
                  ->on('criterios')
                  ->onDelete('cascade');
        });
    }
};