<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{
    use HasFactory;
    protected $fillable=[
        'abreviatura',
        'tipo_documento'
    ];

    public function identificacions()
    {
        return $this->hasMany(Identificacion::class);
    }
}
