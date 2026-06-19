<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barbero extends Model
{
    protected $table = 'barberos';

    protected $fillable = [
        'estado_disponibilidad',
        'especialidad',
        'biografia',
        'fecha_contratacion',
        'calificacion_promedio',
        'experiencia_anos'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
}
