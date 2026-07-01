<?php

namespace Database\Seeders;

use App\Models\Barbero;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class BarberoSeeder extends Seeder
{
    public function run(): void
    {
        $barberoRole = Role::where('nombre', 'barbero')->first();

        if (!$barberoRole) {
            return;
        }

        $barberos = [
            [
                'usuario' => [
                    'nombres' => 'Javier',
                    'primer_apellido' => 'Morales',
                    'segundo_apellido' => 'Santos',
                    'email' => 'javier.barbero@example.com',
                    'password' => Hash::make('password123'),
                    'estado' => 1,
                    'nombre_usuario' => 'javiermorales',
                    'fecha_registro' => now(),
                    'ultimo_acceso' => null,
                    'genero' => 'M',
                    'foto_perfil' => 'images/default_profile.jpg',
                    'celular' => '3335556677',
                ],
                'barbero' => [
                    'estado_disponibilidad' => 'disponible',
                    'especialidad' => 'Fade',
                    'biografia' => 'Barbero especializado en cortes modernos y fades.',
                    'fecha_contratacion' => '2024-01-15',
                    'calificacion_promedio' => 4.80,
                    'experiencia_anos' => 4,
                ],
            ],
            [
                'usuario' => [
                    'nombres' => 'Roberto',
                    'primer_apellido' => 'Castillo',
                    'segundo_apellido' => 'Perez',
                    'email' => 'roberto.barbero@example.com',
                    'password' => Hash::make('password123'),
                    'estado' => 1,
                    'nombre_usuario' => 'robertocastillo',
                    'fecha_registro' => now(),
                    'ultimo_acceso' => null,
                    'genero' => 'M',
                    'foto_perfil' => 'images/default_profile.jpg',
                    'celular' => '3336667788',
                ],
                'barbero' => [
                    'estado_disponibilidad' => 'disponible',
                    'especialidad' => 'Barba',
                    'biografia' => 'Especialista en arreglo de barba, afeitado y perfilado.',
                    'fecha_contratacion' => '2023-09-10',
                    'calificacion_promedio' => 4.60,
                    'experiencia_anos' => 6,
                ],
            ],
            [
                'usuario' => [
                    'nombres' => 'Luis',
                    'primer_apellido' => 'Navarro',
                    'segundo_apellido' => 'Diaz',
                    'email' => 'luis.barbero@example.com',
                    'password' => Hash::make('password123'),
                    'estado' => 0,
                    'nombre_usuario' => 'luisnavarro',
                    'fecha_registro' => now(),
                    'ultimo_acceso' => null,
                    'genero' => 'M',
                    'foto_perfil' => 'images/default_profile.jpg',
                    'celular' => '3337778899',
                ],
                'barbero' => [
                    'estado_disponibilidad' => 'inactivo',
                    'especialidad' => 'Corte clásico',
                    'biografia' => 'Barbero inactivo creado para pruebas del sistema.',
                    'fecha_contratacion' => '2022-05-20',
                    'calificacion_promedio' => 4.20,
                    'experiencia_anos' => 8,
                ],
            ],
        ];

        foreach ($barberos as $data) {
            $user = User::updateOrCreate(
                ['email' => $data['usuario']['email']],
                $data['usuario']
            );

            Barbero::updateOrCreate(
                ['id_usuario' => $user->id],
                $data['barbero']
            );

            $user->roles()->syncWithoutDetaching([
                $barberoRole->id => [
                    'fecha_asignacion' => now(),
                    'estado' => 1,
                ],
            ]);
        }
    }
}