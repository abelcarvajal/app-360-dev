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
        'id_centro_costo',
        'lider_id',
        'barrio',
        'activo',
    ];

    protected $casts = [
        'activo' => 'boolean',
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

    public function setBarrioAttribute($value): void
    {
        $this->attributes['barrio'] = $value ? strtoupper(trim($value)) : null;
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

    public function lider()
    {
        return $this->belongsTo(Colaborador::class, 'lider_id');
    }

    public function subordinados()
    {
        return $this->hasMany(Colaborador::class, 'lider_id');
    }

    public function roles()
    {
        return $this->belongsToMany(Rol::class, 'colaborador_roles');
    }

    public function tieneRol(string $slug): bool
    {
        return $this->roles->contains('slug', $slug);
    }

    /**
     * IDs de colaboradores cuyas evaluaciones puede ver/gestionar este colaborador.
     * null = sin restricción (gerente/admin).
     */
    public function alcanceEvaluacionIds(): ?array
    {
        if ($this->tieneRol('gerente') || $this->tieneRol('admin')) {
            return null;
        }

        $ids = [$this->id];

        if ($this->tieneRol('lider')) {
            $ids = array_merge($ids, $this->subordinados()->pluck('id')->all());
        }

        return $ids;
    }

    public function puedeAccederAColaborador(int $colaboradorId): bool
    {
        $alcance = $this->alcanceEvaluacionIds();

        return $alcance === null || in_array($colaboradorId, $alcance, true);
    }

    /**
     * El gerente no es evaluado por nadie, ni siquiera por sí mismo (FASE 6.1 de REFACTOR.md).
     */
    public function puedeSerEvaluado(): bool
    {
        return !$this->tieneRol('gerente');
    }
}
