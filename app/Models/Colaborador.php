<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Colaborador extends Model
{
    protected $fillable = [
        'nombres',
        'apellidos',
        'identificacion_id',
        'fecha_nacimiento',
        'ciudad_nacimiento_id',
        'ciudad_residencia_id',
        'direccion',
        'telefono_fijo',
        'celular',
        'email',
        'id_cargos',
        'id_programas',
        'id_centro_costo'
    ];

    // Relaciones
    public function identificacion()
    {
        return $this->belongsTo(Identificacion::class);
    }

    public function ciudadNacimiento()
    {
        return $this->belongsTo(Municipio::class, 'ciudad_nacimiento_id');
    }

    public function ciudadResidencia()
    {
        return $this->belongsTo(Municipio::class, 'ciudad_residencia_id');
    }

    public function cargo()
    {
        return $this->belongsTo(Cargo::class, 'id_cargos');
    }

    public function programa()
    {
        return $this->belongsTo(Programa::class, 'id_programas');
    }

    public function centroCosto()
    {
        return $this->belongsTo(CentroCosto::class, 'id_centro_costo');
    }
}
