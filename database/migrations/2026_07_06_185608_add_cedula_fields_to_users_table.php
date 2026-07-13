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
        Schema::table('users', function (Blueprint $table) {
            $table->string('cedula')->unique()->nullable()->after('id');
            $table->boolean('debe_cambiar_password')->default(true)->after('password');
            $table->foreignId('colaborador_id')
                  ->nullable()
                  ->constrained('colaboradors')
                  ->onDelete('set null')
                  ->after('debe_cambiar_password');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['colaborador_id']);
            $table->dropColumn(['cedula', 'debe_cambiar_password', 'colaborador_id']);
        });
    }
};
