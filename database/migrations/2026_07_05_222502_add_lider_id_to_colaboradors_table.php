<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('colaboradors', function (Blueprint $table) {
            $table->foreignId('lider_id')
                  ->nullable()
                  ->constrained('colaboradors')
                  ->onDelete('set null')
                  ->after('id_centro_costo');
        });
    }

    public function down(): void
    {
        Schema::table('colaboradors', function (Blueprint $table) {
            $table->dropForeign(['lider_id']);
            $table->dropColumn('lider_id');
        });
    }
};