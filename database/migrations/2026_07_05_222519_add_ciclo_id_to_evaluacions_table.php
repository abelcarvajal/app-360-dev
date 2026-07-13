<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('evaluacions', function (Blueprint $table) {
            $table->foreignId('ciclo_id')
                  ->nullable()
                  ->constrained('ciclos_evaluacion')
                  ->onDelete('set null')
                  ->after('id');
        });
    }

    public function down(): void
    {
        Schema::table('evaluacions', function (Blueprint $table) {
            $table->dropForeign(['ciclo_id']);
            $table->dropColumn('ciclo_id');
        });
    }
};