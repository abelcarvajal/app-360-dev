<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Colaborador extends Model
{
    protected $fillable = [
        'nombres',
        'apellidos',
        'telefono_fijo',
        'celular',
        'email',
        'fecha_nacimiento',
        'identificacion_id',
        'pais_nacimiento_id',
        'departamento_nacimiento_id',
        'ciudad_nacimiento_id',
        'ciudad_residencia_id',
        'direccion',
        'id_cargos',
        'id_centro_costo',
        'id_programas'
    ];

    // Relaciones
    public function identificacion()
    {
        return $this->belongsTo(Identificacion::class);
    }

    public function paisNacimiento()
    {
        return $this->belongsTo(Pais::class, 'pais_nacimiento_id');
    }

    public function departamentoNacimiento()
    {
        return $this->belongsTo(Departamento::class, 'departamento_nacimiento_id');
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
}
