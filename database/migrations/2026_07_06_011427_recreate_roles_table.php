<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
{
    // Eliminar FK de colaborador_roles
    Schema::table('colaborador_roles', function (Blueprint $table) {
        $table->dropForeign(['rol_id']);
    });

    // Eliminar FK de login hacia roles
    Schema::table('login', function (Blueprint $table) {
        $table->dropForeign(['id_roles']);
    });

    Schema::dropIfExists('roles');

    Schema::create('roles', function (Blueprint $table) {
        $table->id();
        $table->string('nombre');
        $table->string('slug')->unique();
        $table->timestamps();
    });

    // Restaurar FK de colaborador_roles
    Schema::table('colaborador_roles', function (Blueprint $table) {
        $table->foreign('rol_id')
              ->references('id')
              ->on('roles')
              ->onDelete('cascade');
    });

    // Nota: NO restauramos FK de login porque esa tabla
    // será eliminada en Fase 3 (ya está en el plan)
}
};