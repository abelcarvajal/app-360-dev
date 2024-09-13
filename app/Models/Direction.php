<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direction extends Model
{
    use HasFactory;
    protected $fillable=['id_tipos_via','numero_via','numero','id_barrios','id_posiciones_cardinales'];
}
