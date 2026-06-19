<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';

    protected $fillable = [
        'fecha_nacimiento',
        'ultima_visita',
        'tipo_cliente',
        'puntos_fidelidad',
        'acepta_notificaciones',
        'notas_generales',
        'total_visitas',
        'total_gastado',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
}

