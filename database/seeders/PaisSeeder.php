<?php

namespace Database\Seeders;

use App\Models\Pais;
use Illuminate\Database\Seeder;

class PaisSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['Colombia', 'Alemania'] as $nombrePais) {
            Pais::firstOrCreate(['nombre_pais' => $nombrePais]);
        }
    }
}
