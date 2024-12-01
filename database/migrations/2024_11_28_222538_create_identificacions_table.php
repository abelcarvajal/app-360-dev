<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('identificacions', function (Blueprint $table) {
            $table->id();
            $table->string('numero_documento')->unique();
            $table->foreignId('tipo_documento_id')->constrained('tipo_documentos');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('identificacions');
    }
};
