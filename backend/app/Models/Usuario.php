<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $table = 'usuarios';

    protected $fillable = [
        'nombres',
        'primer_apellido',
        'segundo_apellido',
        'correo',
        'contrasena',
        'estado',
        'nombre_usuario',
        'fecha_registro',
        'ultimo_acceso',
        'genero',
        'foto_perfil',
        'celular',
    ];

    protected $hidden = [
        'contrasena',
    ];

    protected $casts = [
        'estado' => 'boolean',
        'fecha_registro' => 'datetime',
        'ultimo_acceso' => 'datetime',
        'contrasena' => 'hashed',
    ];

    public function getAuthPassword(): string
    {
        return $this->contrasena;
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Rol::class, 'usuarios_roles', 'id_usuario', 'id_rol')
            ->withPivot(['fecha_asignacion', 'estado']);
    }

    public function cliente(): HasOne
    {
        return $this->hasOne(Cliente::class, 'id_usuario');
    }

    public function barbero(): HasOne
    {
        return $this->hasOne(Barbero::class, 'id_usuario');
    }
}
