<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pago extends Model
{
    protected $table = 'pagos';

    protected $fillable = [
        'id_cita',
        'id_metodo_pago',
        'monto',
        'fecha_pago',
        'estado_pago',
        'referencia_transaccion',
        'concepto'
    ];


    protected function casts(): array
    {
        return [
            'monto' => 'decimal:2',
            'fecha_pago' => 'datetime',
        ];
    }

    //Relacion inversa con el modelo Cita (Una cita puede tener un pago, pero un pago pertenece a una cita)
    public function cita(): BelongsTo
    {
        return $this->BelongsTo(Cita::class, 'id_cita');
    }

    //Relacion inversa con el modelo Metodo_pago (Un metodo de pago puede tener muchos pagos, pero un pago pertenece a un metodo de pago)
    public function metodoPago(): BelongsTo
    {
        return $this->BelongsTo(MetodoPago::class, 'id_metodo_pago');
    }
}
