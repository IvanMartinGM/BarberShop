<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{

    protected $table = 'usuarios';

    public $timestamps = false;
    
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */


    protected $fillable = [
        'nombres',
        'primer_Apellido',
        'segundo_Apellido',
        'email',
        'password',
        'estado',
        'nombreUsuario',
        'fecha_registro',
        'ultimo_acceso',
        'genero',
        'foto_perfil',
        'celular',
    ];


    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }


    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'usuarios_roles', 'id_usuario', 'id_rol')
            ->as('usuarios_roles')
            ->withPivot('fecha_asignacion', 'estado')
            ->withTimestamps();
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
