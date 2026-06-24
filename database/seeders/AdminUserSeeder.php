<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            $adminRole = Role::where('nombre', 'administrador')->firstOrFail();

            $admin = User::firstOrCreate(
                ['email' => 'admin@barberia.com'],
                [
                    'nombres' => 'ElAdministrador',
                    'primer_apellido' => 'Principal',
                    'segundo_apellido' => 'Elbueno',
                    'password' => 'password123',
                    'estado' => 1,
                    'nombre_usuario' => 'admin',
                    'genero' => 'otro',
                    'celular' => null,
                    'foto_perfil' => null,
                    'ultimo_acceso' => null,
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