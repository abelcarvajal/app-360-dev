<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Identificacion extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_documento',
        'tipo_documento_id'
    ];

    public function colaborador()
    {
        return $this->belongsTo(Colaborador::class);
    }

    public function tipo_documento()
    {
        return $this->belongsTo(TipoDocumento::class);
    }
}
