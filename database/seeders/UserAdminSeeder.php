<?php

namespace Database\Seeders;

use App\Models\Cargo;
use App\Models\CentroCosto;
use App\Models\Colaborador;
use App\Models\Departamento;
use App\Models\Identificacion;
use App\Models\Municipio;
use App\Models\Pais;
use App\Models\Programa;
use App\Models\Rol;
use App\Models\TipoDocumento;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserAdminSeeder extends Seeder
{
    public function run(): void
    {
        // Datos mínimos de catálogo requeridos por las FK obligatorias de "colaboradors"
        $paisColombia = Pais::firstOrCreate(['nombre_pais' => 'Colombia']);

        $departamento = Departamento::firstOrCreate([
            'nombre_departamento' => 'Bogotá D.C.',
            'id_pais' => $paisColombia->id,
        ]);

        $municipio = Municipio::firstOrCreate([
            'nombre_municipio' => 'Bogotá',
            'id_departamentos' => $departamento->id,
        ]);

        $tipoDocumento = TipoDocumento::firstOrCreate(
            ['abreviatura' => 'CC'],
            ['tipo_documento' => 'Cédula de ciudadanía']
        );

        $identificacion = Identificacion::firstOrCreate(
            ['numero_documento' => '000000000'],
            ['tipo_documento_id' => $tipoDocumento->id]
        );

        $cargo = Cargo::firstOrCreate(['nombre_cargo' => 'Administrador del Sistema']);
        $programa = Programa::firstOrCreate(['nombre_programa' => 'Administración']);
        $centroCosto = CentroCosto::firstOrCreate(['nombre_centro_costo' => 'Sede Principal']);

        // Colaborador admin
        $colaborador = Colaborador::firstOrCreate(
            ['email' => 'admin@fundacion.org'],
            [
                'nombres' => 'Administrador',
                'apellidos' => 'Sistema',
                'identificacion_id' => $identificacion->id,
                'fecha_nacimiento' => '1990-01-01',
                'ciudad_nacimiento_id' => $municipio->id,
                'ciudad_residencia_id' => $municipio->id,
                'direccion' => 'N/A',
                'celular' => '0000000000',
                'id_cargos' => $cargo->id,
                'id_programas' => $programa->id,
                'id_centro_costo' => $centroCosto->id,
                'activo' => true,
            ]
        );

        // Asignar rol admin
        $rolAdmin = Rol::where('slug', 'admin')->first();
        $colaborador->roles()->syncWithoutDetaching([$rolAdmin->id]);

        // Crear usuario con login por cédula
        User::firstOrCreate(
            ['cedula' => '000000000'],
            [
                'name' => 'Administrador',
                'email' => 'admin@fundacion.org',
                'password' => Hash::make('000000000'),
                'debe_cambiar_password' => true,
                'colaborador_id' => $colaborador->id,
            ]
        );
    }
}
