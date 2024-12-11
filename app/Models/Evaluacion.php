<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Colaborador;
use App\Models\EvaluacionTipo;

class Evaluacion extends Model
{
    use HasFactory;
    protected $fillable=['id_colaboradores','id_evaluacion_tipos','created_at'];
    
    public function colaborador(){
        return $this->belongsTo(Colaborador::class, 'id_colaboradores');
    }
    public function evaluacion_tipos(){
        return $this->belongsTo(EvaluacionTipo::class, 'id_evaluacion_tipos');
    }
    public function detalle_evaluacion(){
        return $this->hasMany(DetalleEvaluacion::class,'id_evaluacion');
    }
}
    