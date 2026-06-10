<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
        protected $fillable = [
        'nombre',
        'descripcion',
        ];

        protected $table = 'roles';

        public $timestamps = false;

        public function usuarios(): BelongsToMany
        {
            return $this->belongsToMany(Usuario::class, 'usuarios_roles', 'id_rol', 'id_usuario')
                ->withPivot(['fecha_asignacion', 'estado']);
        }
}
