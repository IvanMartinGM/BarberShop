<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            [
                'nombre' => 'administrador',
                'descripcion' => 'Usuario con acceso total al sistema.',
            ],
            [
                'nombre' => 'barbero',
                'descripcion' => 'Usuario encargado de atender citas y realizar servicios.',
            ],
            [
                'nombre' => 'cliente',
                'descripcion' => 'Usuario que agenda citas y consulta su historial.',
            ],
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(
                ['nombre' => $role['nombre']],
                ['descripcion' => $role['descripcion']]
            );
        }
    }
}