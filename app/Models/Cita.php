<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    protected $table = 'citas';


        protected $fillable = [
            'fecha_hora',
            'estado',
            'servicio',
            'notas',
        ];


    public function clientes(){
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }

    public function barberos(){
        return $this->belongsTo(Barbero::class, 'id_barbero');
    }
}
