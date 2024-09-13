<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colaborador extends Model
{
    use HasFactory;
    protected $fillable=['nombres','apellidos','id_identificacion','id_direcciones','telefono_fijo','celular','email','fecha_nacimiento','id_cargos','id_sedes','id_programas'];
}
