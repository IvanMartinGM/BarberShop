<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    protected $table = 'servicios';


    protected $fillable = [
        'nombre',
        'descripcion',
        'duracion_minutos',
        'precio',
    ];

    public function barberos(): BelongsToMany
    {
        return $this->belongsToMany(Barbero::class, 'barberos_servicios', 'id_servicio', 'id_barbero')
        ->as('barberos_servicios')
       ->withPivot('estado');
    }

    public function citas(): BelongsToMany
    {
        return $this->belongsToMany(Cita::class, 'citas_servicios', 'id_servicio', 'id_cita')
        ->as('citas_servicios')
        ->withPivot('cantidad');
    }


}
