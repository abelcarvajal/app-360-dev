<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemNivel extends Model
{
    use HasFactory;

    protected $table = 'item_niveles';
    protected $fillable = ['item_evaluacion_id', 'nivel', 'descripcion'];

    protected $casts = [
        'nivel' => 'integer',
    ];

    public function item()
    {
        return $this->belongsTo(ItemEvaluacion::class, 'item_evaluacion_id');
    }
}
