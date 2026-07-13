<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement('ALTER TABLE detalle_evaluacions ALTER COLUMN valoracion TYPE smallint USING valoracion::smallint');
        DB::statement('ALTER TABLE detalle_evaluacions ALTER COLUMN valoracion SET NOT NULL');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE detalle_evaluacions ALTER COLUMN valoracion TYPE integer USING valoracion::integer');
    }
};
