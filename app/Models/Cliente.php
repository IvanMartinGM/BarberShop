<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cliente extends Model
{
    // Especificamos el nombre de la tabla asociada a este modelo
    protected $table = 'clientes';
    public $timestamps = false;
    
    //Especificamos los campos que se pueden asignar masivamente (mass assignment)
    protected $fillable = [
        'id_usuario',
        'fecha_nacimiento',
        'ultima_visita',
        'tipo_cliente',
        'puntos_fidelidad',
        'acepta_notificaciones',
        'notas_generales',
        'total_visitas',
        'total_gastado',
    ];

    // Relacion inversa con el modelo User (Usuario)
    // un cliente pertenece a un usuario, por lo que se define una relación belongsTo
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    //Relacion con el modelo Cita (un cliente puede tener muchas citas)
    public function citas(): HasMany
    {
        return $this->hasMany(Cita::class, 'id_cliente');
    }

    protected function casts(): array {
      return [
          'fecha_nacimiento' => 'date',
          'ultima_visita' => 'datetime',
          'puntos_fidelidad' => 'integer',
          'total_visitas' => 'integer',
          'total_gastado' => 'decimal:2',
          'acepta_notificaciones' => 'boolean',
      ];
  }


}

