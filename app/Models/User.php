<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{

 protected $table = 'usuarios';

    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */


    protected $fillable = [
        'nombres',
        'primerApellido',
        'segundoApellido',
        'correo',
        'contrasena',
        'estado',
        'nombreUsuario',
        'fecha_registro',
        'ultimo_acceso',
        'genero',
        'foto_perfil',
        'celular',
    ];

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'usuarios_roles', 'id_usuario', 'id_rol')
        ->as('usuarios_roles')
        ->withPivot('fecha_asignacion', 'estado')
        ->withTimestamps();
    }

    protected function casts(): array
    {
        return [
            'contrasena' => 'hashed',
        ];
    }
}
