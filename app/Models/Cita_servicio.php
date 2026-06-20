<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cita_servicio extends Model
{
    protected $table = 'citas_servicios';

    protected $fillable = [
        'cantidad',
    ];
}
