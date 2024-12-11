<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criterio extends Model
{
    use HasFactory;
    protected $fillable = ['criterio', 'id_categorias_criterios'];
    
    protected $foreignKey = 'id_categorias_criterios';
    
    public function categoriaCriterio()
    {
        return $this->belongsTo(CategoriasCriterio::class, 'id_categorias_criterios');
    }
}

