<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
class Servicio extends Model
{
    protected $table = 'servicios';
    public $timestamps = true;
    
    protected $fillable = [
        'nombre_servicio',
        'descripcion',
        'precio_base',
        'duracion_minutos',
        'categoria',
        'estado',
    ];

    protected function casts(): array {
    return [
        'precio_base' => 'decimal:2',
        'duracion_minutos' => 'integer',
        'estado' => 'boolean',
    ];
}

    public function barberos(): BelongsToMany
    {
        return $this->belongsToMany(Barbero::class, 'barberos_servicios', 'id_servicio', 'id_barbero')
        ->as('barberos_servicios')
       ->withPivot('estado')
       ->withTimestamps();
    }

    public function citas(): BelongsToMany
    {
        return $this->belongsToMany(Cita::class, 'citas_servicios', 'id_servicio', 'id_cita')
        ->as('citas_servicios')
        ->withPivot('precio_aplicado', 
        'hora_inicio_real',
        'hora_fin_real', 
        'duracion_real_minutos', 
        'observaciones_servicio'
        );
    }


}
