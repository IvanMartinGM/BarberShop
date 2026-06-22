<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
USE Illuminate\Database\Eloquent\Relations\HasMany;
class MetodoPago extends Model
{
    protected $table = 'metodo_pago';

    protected $fillable = [
        'nombre_metodo',
        'descripcion',
        'estado'
    ];


    //Relacion con el modelo Pago (Un metodo de pago puede tener muchos pagos, pero un pago pertenece a un metodo de pago)
    public function pagos(): hasMany{
        return $this->hasMany(Pago::class, 'id_metodo_pago');
    }

}
