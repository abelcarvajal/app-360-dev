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
        Schema::table('evaluacions', function (Blueprint $table) {
            $table->dropForeign(['id_login']);
            $table->dropForeign(['id_detalle_evaluacion']);
            $table->dropColumn(['id_login', 'id_detalle_evaluacion']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('evaluacions', function (Blueprint $table) {
            $table->unsignedBigInteger('id_detalle_evaluacion');
            $table->unsignedBigInteger('id_login')->nullable();
            $table->foreign('id_detalle_evaluacion')->references('id')->on('detalle_evaluacions');
            $table->foreign('id_login')->references('id')->on('logins');
        });
    }
};
