<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;



class Role extends Model
{
    protected $table = 'roles';

    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    /* The relationships between the Role  and User with the pivot table usuarios_roles  */
        public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'usuarios_roles', 'id_usuario', 'id_rol')
        ->as('usuarios_roles')
        ->withPivot('fecha_asignacion', 'estado')
        ->withTimestamps();
    }
}
