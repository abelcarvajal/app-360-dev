<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direction extends Model
{
    use HasFactory;
    protected $fillable = [
        'colaborador_id',
        'municipio_id',
        'direccion_residencia'
    ];

    public function colaborador()
    {
        return $this->belongsTo(Colaborador::class);
    }

    public function municipio()
    {
        return $this->belongsTo(Municipio::class);
    }
}
