<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemEvaluacion extends Model
{
    use HasFactory;

    protected $table = 'items_evaluacion';
    protected $fillable = ['nombre', 'descripcion', 'id_categorias_criterios', 'activo'];

    protected $casts = [
        'activo' => 'boolean',
    ];

    public function categoria()
    {
        return $this->belongsTo(CategoriasCriterio::class, 'id_categorias_criterios');
    }

    public function niveles()
    {
        return $this->hasMany(ItemNivel::class, 'item_evaluacion_id')->orderBy('nivel');
    }
}
