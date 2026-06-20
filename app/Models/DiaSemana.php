<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dia_semana extends Model
{
    
    protected $table = 'dias_semana';

    protected $fillable = [
        'nombre_dia'
    ];


    public function horarios():belongsToMany
    {
        return $this->belongsToMany(Horario::class, 'horarios_dias_semana', 'id_dia', 'id_horario');
    }

    
}


