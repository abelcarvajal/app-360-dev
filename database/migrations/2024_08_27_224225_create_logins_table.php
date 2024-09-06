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
        Schema::create('login', function (Blueprint $table) {
            $table->id();
            $table->string('usuario');
            $table->string('contrasena');
            $table->unsignedBigInteger('id_roles');
            $table->foreign('id_roles')->references('id')->on('roles');
            $table->unsignedBigInteger('id_colaboradores');
            $table->foreign('id_colaboradores')->references('id')->on('colaboradores');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logins');
    }
};
