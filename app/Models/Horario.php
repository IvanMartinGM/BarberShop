<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Horario extends Model
{
    public $timestamps = false;

    protected $table = 'horarios';

    protected $fillable = [
        'nombre_horario',
        'descripcion',
        'hora_inicio',
        'hora_fin',
        'estado',
    ];

    protected $casts = [
        'estado' => 'boolean',
    ];

    // N:M con Barberos via barberos_horarios
    public function barberos(): BelongsToMany
    {
        return $this->belongsToMany(Barbero::class, 'barberos_horarios', 'id_horario', 'id_barbero')
            ->withPivot(['fecha_asignacion', 'estado']);
    }

    // N:M con DiasSemana via horarios_dias_semana
    public function diasSemana(): BelongsToMany
    {
        return $this->belongsToMany(DiaSemana::class, 'horarios_dias_semana', 'id_horario', 'id_dia');
    }
}