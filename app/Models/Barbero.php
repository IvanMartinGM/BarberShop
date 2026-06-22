<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Barbero extends Model
{
    protected $table = 'barberos';

    protected $fillable = [
        'id_usuario',
        'estado_disponibilidad',
        'especialidad',
        'biografia',
        'fecha_contratacion',
        'calificacion_promedio',
        'experiencia_anos'
    ];


    protected function casts(): array {
    return [
        'calificacion_promedio' => 'decimal:2',
        'experiencia_anos' => 'integer',
        'estado_disponibilidad' => 'string',
    ]; 
    }

    // Relacion inversa con el modelo User (Usuario)
    // un barbero pertenece a un usuario, por lo que se define una relación belongsTo
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }


    // Relación con el modelo Servicio con la tabla pivot  barberos_servicios (un barbero puede ofrecer muchos servicios y un servicio puede ser ofrecido por muchos barberos)
    public function servicios(): BelongsToMany
    {
        return $this->belongsToMany(Servicio::class, 'barberos_servicios', 'id_barbero', 'id_servicio')
        ->as('barberos_servicios')
        ->withPivot('estado')
        ->withTimestamps();
    }


    //Relacion con el modelo Cita (un barbero puede tener muchas citas)
    public function citas(): HasMany{
        return $this->hasMany(Cita::class, 'id_barbero');
    }

    // Relacion con el modelo Horario con la tabla pivot barberos_horarios (un barbero puede tener muchos horarios y un horario puede ser asignado a muchos barberos)
    public function horarios(): BelongsToMany
    {
        return $this->belongsToMany(Horario::class, 'barberos_horarios', 'id_barbero', 'id_horario')
        ->as('barberos_horarios')
        ->withPivot('fecha_asignacion', 'estado');
    }


}
