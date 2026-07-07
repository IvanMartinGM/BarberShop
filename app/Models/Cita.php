<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Cita extends Model
{
    public $timestamps = true;

    protected $table = 'citas';

    protected $fillable = [
        'id_cliente',
        'id_barbero',
        'fecha_cita',
        'hora_inicio',
        'hora_fin',
        'estado_cita',
        'observaciones'
    ];


    protected function casts(): array
    {
        return [
            'fecha_cita' => 'date',
            'hora_inicio' => 'string',
            'hora_fin' => 'string',
        ];
    }

    // Relacion inversa con el modelo Cliente (un cliente puede tener muchas citas, pero una cita pertenece a un cliente)
    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }

    //Relacion inversa con el modelo Barbero (un barbero puede tener muchas citas, pero una cita pertenece a un barbero)
    public function barbero(): BelongsTo
    {
        return $this->belongsTo(Barbero::class, 'id_barbero');
    }

    // Relacion con el modelo Pagos (Una cita puede tener un pago, pero un pago pertenece a una cita)
    public function pago(): HasOne
    {
        return $this->hasOne(Pago::class, 'id_cita');
    }

    //Relacion con el modelo Servicio (Una cita puede tener uno o mas servicios, y un servicio puede pertenecer a muchas citas)
    public function servicios(): BelongsToMany
    {
        return $this->belongsToMany(Servicio::class, 'citas_servicios', 'id_cita', 'id_servicio')
            ->as('citas_servicios')
            ->withPivot(
                'precio_aplicado',
                'estado_servicio',
                'observaciones_servicio'
            );
    }
}
