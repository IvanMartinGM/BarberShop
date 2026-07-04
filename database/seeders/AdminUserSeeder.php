<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    private const DEFAULT_PROFILE_PHOTO = 'images/default-avatar.svg';

    public function run(): void
    {
        DB::transaction(function () {
            $adminRole = Role::where('nombre', 'administrador')->firstOrFail();

            $admin = User::updateOrCreate(
                ['email' => 'admin@barberia.com'],
                [
                    'nombres' => 'Administrador',
                    'primer_apellido' => 'Principal',
                    'segundo_apellido' => 'Elbueno',
                    'password' => Hash::make('password123'),
                    'estado' => 1,
                    'nombre_usuario' => 'admin',
                    'genero' => 'M',
                    'celular' => '3312765431',
                    'foto_perfil' => self::DEFAULT_PROFILE_PHOTO,
                    'ultimo_acceso' => null,
                    'fecha_registro' => now(),
                ]
            );

            $admin->roles()->syncWithoutDetaching([
                $adminRole->id => [
                    'fecha_asignacion' => now(),
                    'estado' => 1,
                ],
            ]);
        });
    }
}