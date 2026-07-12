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
        Schema::table('colaboradors', function (Blueprint $table) {
            $table->dropForeign(['pais_nacimiento_id']);
            $table->dropForeign(['departamento_nacimiento_id']);
            $table->dropColumn(['pais_nacimiento_id', 'departamento_nacimiento_id']);
        });
    }

    public function down(): void
    {
        Schema::table('colaboradors', function (Blueprint $table) {
            $table->foreignId('pais_nacimiento_id')->constrained('pais');
            $table->foreignId('departamento_nacimiento_id')->constrained('departamentos');
        });
    }
};
