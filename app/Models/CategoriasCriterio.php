<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriasCriterio extends Model
{
    use HasFactory;
    protected $fillable = ['categoria', 'descripcion'];
    public function items()
    {
        return $this->hasMany(ItemEvaluacion::class, 'id_categorias_criterios')
                    ->where('activo', true);
    }
}
