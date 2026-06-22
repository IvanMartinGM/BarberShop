<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
class Diasemana extends Model
{
    
    protected $table = 'dias_semana';
    
    public $timestamps = false;

    protected $fillable = [
        'nombre_dia'
    ];


    protected function casts(): array {
    return [
        'nombre_dia' => 'string',
    ];
}

    // N:M con Horarios via horarios_dias_semana
    public function horarios():BelongsToMany
    {
        return $this->belongsToMany(Horario::class, 'horarios_dias_semana', 'id_dia', 'id_horario')
            ->as('horarios_dias_semana');
    }

    
}


