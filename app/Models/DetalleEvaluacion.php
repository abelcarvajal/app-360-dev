<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Criterio;
class DetalleEvaluacion extends Model
{
    use HasFactory;
    protected $fillable=['valoracion','id_criterios','id_evaluacion'];

    public function criterio()
    {
        return $this->belongsTo(Criterio::class, 'id_criterios');
    }
}
