<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'roles';
    protected $fillable = ['nombre', 'slug'];

    public function colaboradores()
    {
        return $this->belongsToMany(Colaborador::class, 'colaborador_roles');
    }
}
