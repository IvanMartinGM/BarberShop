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
use App\Notifications\CustomResetPasswordNotification;

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
        'primer_apellido',
        'segundo_apellido',
        'email',
        'password',
        'estado',
        'nombre_usuario',
        'fecha_registro',
        'ultimo_acceso',
        'genero',
        'foto_perfil',
        'celular',
        'fecha_baja',
    ];


    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'estado' => 'boolean',
            'fecha_registro' => 'datetime',
            'ultimo_acceso' => 'datetime',
            'fecha_baja' => 'datetime',
        ];
    }


    protected $hidden = [
        'password'
    ];

    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new CustomResetPasswordNotification($token));
    }


    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'usuarios_roles', 'id_usuario', 'id_rol')
            ->as('usuarios_roles')
            ->withPivot('fecha_asignacion', 'estado');
    }

    public function cliente(): HasOne
    {
        return $this->hasOne(Cliente::class, 'id_usuario');
    }

    public function barbero(): HasOne
    {
        return $this->hasOne(Barbero::class, 'id_usuario');
    }

    //Functions to get the full name of the user 
    public function getFullName(): string
    {
        $userfullname = trim("{$this->nombres} {$this->primer_apellido} {$this->segundo_apellido}");
        return $userfullname;
    }

    /* This function checks if the user has a specific role */
    public function hasRole(string $role): bool
    {
        return $this->roles()->where('nombre', $role)
            ->wherePivot('estado', 1)
            ->exists();
    }

    /* This function gets all the roles of the user that are active in an array */
    public function getActiveRoles(): array
    {
        $roles = $this->roles()->wherePivot('estado', 1)->pluck('nombre');
        return $roles->toArray();
    }

    /* This function checks if the user has any active roles */
    public function hasActiveRoles(): bool
    {
        return $this->roles()->wherePivot('estado', 1)->exists();
    }

    /*A function to check if the user has any of the specified roles return 
    true if the user has any of the roles, otherwise return false */
    public function hasAnyRole(array $roles): bool
    {
        return $this->roles()->whereIn('nombre', $roles)
            ->wherePivot('estado', 1)
            ->exists();
    }

    // A fuunction to check if the user has a specific role
    public function isAdmin(): bool
    {
        return $this->hasRole('administrador');
    }

    public function isBarbero(): bool
    {
        return $this->hasRole('barbero');
    }

    public function isCliente(): bool
    {
        return $this->hasRole('cliente');
    }
}
