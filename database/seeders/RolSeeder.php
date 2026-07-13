<?php

namespace Database\Seeders;

use App\Models\Rol;
use Illuminate\Database\Seeder;

class RolSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['nombre' => 'Colaborador',      'slug' => 'colaborador'],
            ['nombre' => 'Líder',            'slug' => 'lider'],
            ['nombre' => 'Gerente/Director', 'slug' => 'gerente'],
            ['nombre' => 'Psicólogo',        'slug' => 'psicologo'],
            ['nombre' => 'Administrador',    'slug' => 'admin'],
        ];

        foreach ($roles as $rol) {
            Rol::firstOrCreate(['slug' => $rol['slug']], $rol);
        }
    }
}
