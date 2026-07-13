<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('colaborador_roles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('colaborador_id')
                  ->constrained('colaboradors')
                  ->onDelete('cascade');
            $table->foreignId('rol_id')
                  ->constrained('roles')
                  ->onDelete('cascade');
            $table->timestamps();

            $table->unique(['colaborador_id', 'rol_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('colaborador_roles');
    }
};