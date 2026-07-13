<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CicloEvaluacion extends Model
{
    use HasFactory;

    protected $table = 'ciclos_evaluacion';
    protected $fillable = [
        'nombre',
        'anio',
        'tipo',
        'fecha_inicio',
        'fecha_fin',
        'activo',
        'max_evaluadores_pares',
        'max_evaluaciones_recibidas',
        'min_evaluaciones_recibidas',
        'permite_modificacion',
        'requiere_completitud',
        'evaluacion_cruzada',
    ];

    protected $casts = [
        'activo' => 'boolean',
        'permite_modificacion' => 'boolean',
        'requiere_completitud' => 'boolean',
        'evaluacion_cruzada' => 'boolean',
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
    ];

    public function evaluaciones()
    {
        return $this->hasMany(Evaluacion::class, 'ciclo_id');
    }
}
