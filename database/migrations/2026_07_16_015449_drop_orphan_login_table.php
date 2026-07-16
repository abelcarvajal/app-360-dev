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
        // La migración 2026_06_28_203615_drop_logins_table hace dropIfExists('logins'),
        // pero la tabla real (creada en 2024_11_29_224225_create_logins_table) es 'login'
        // (singular), por lo que quedó huérfana. Este es el drop explícito correcto.
        Schema::dropIfExists('login');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('login', function (Blueprint $table) {
            $table->id();
            $table->string('usuario');
            $table->string('contrasena');
            $table->unsignedBigInteger('id_roles');
            $table->foreign('id_roles')->references('id')->on('roles');
            $table->unsignedBigInteger('id_colaboradores');
            $table->foreign('id_colaboradores')->references('id')->on('colaboradors');
            $table->timestamps();
        });
    }
};
