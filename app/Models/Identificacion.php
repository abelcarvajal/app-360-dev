<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Identificacion extends Model
{
    use HasFactory;
    protected $fillable=['id_tipos_documento','numero_identidad','id_municipios','fecha_expedicion'];
}
