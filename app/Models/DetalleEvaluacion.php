<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleEvaluacion extends Model
{
    use HasFactory;
    protected $fillable=['valoracion','id_criterios','id_evaluacion'];
    protected $casts = [
        'valoracion' => 'integer',
    ];

    public function setValoracionAttribute($value): void
    {
        $this->attributes['valoracion'] = max(1, min(5, (int)$value));
    }

    public function item()
    {
        return $this->belongsTo(ItemEvaluacion::class, 'id_criterios');
    }

    public function evaluacion()
    {
        return $this->belongsTo(Evaluacion::class, 'id_evaluacion');
    }
}
