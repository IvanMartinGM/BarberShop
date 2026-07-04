<?php

namespace Database\Seeders;

use App\Models\Cliente;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ClienteSeeder extends Seeder
{
    private const DEFAULT_PROFILE_PHOTO = 'images/default-avatar.svg';

    public function run(): void
    {
        $clienteRole = Role::where('nombre', 'cliente')->first();

        if (!$clienteRole) {
            return;
        }

        $clientes = [
            [
                'usuario' => [
                    'nombres' => 'Carlos',
                    'primer_apellido' => 'Ramirez',
                    'segundo_apellido' => 'Lopez',
                    'email' => 'carlos.cliente@example.com',
                    'password' => Hash::make('password123'),
                    'estado' => 1,
                    'nombre_usuario' => 'carlosramirez',
                    'fecha_registro' => now(),
                    'ultimo_acceso' => null,
                    'genero' => 'M',
                    'foto_perfil' => self::DEFAULT_PROFILE_PHOTO,
                    'celular' => '3331112233',
                ],
                'cliente' => [
                    'fecha_nacimiento' => '1998-04-12',
                    'ultima_visita' => null,
                    'tipo_cliente' => 'regular',
                    'puntos_fidelidad' => 20,
                    'acepta_notificaciones' => 1,
                    'notas_generales' => 'Cliente frecuente para corte clásico.',
                    'total_visitas' => 3,
                    'total_gastado' => 450.00,
                ],
            ],
            [
                'usuario' => [
                    'nombres' => 'Andrea',
                    'primer_apellido' => 'Gonzalez',
                    'segundo_apellido' => 'Martinez',
                    'email' => 'andrea.cliente@example.com',
                    'password' => Hash::make('password123'),
                    'estado' => 1,
                    'nombre_usuario' => 'andreagonzalez',
                    'fecha_registro' => now(),
                    'ultimo_acceso' => null,
                    'genero' => 'F',
                    'foto_perfil' => self::DEFAULT_PROFILE_PHOTO,
                    'celular' => '3332223344',
                ],
                'cliente' => [
                    'fecha_nacimiento' => '2001-08-20',
                    'ultima_visita' => null,
                    'tipo_cliente' => 'nuevo',
                    'puntos_fidelidad' => 0,
                    'acepta_notificaciones' => 1,
                    'notas_generales' => 'Primera visita pendiente.',
                    'total_visitas' => 0,
                    'total_gastado' => 0.00,
                ],
            ],
            [
                'usuario' => [
                    'nombres' => 'Miguel',
                    'primer_apellido' => 'Torres',
                    'segundo_apellido' => 'Hernandez',
                    'email' => 'miguel.cliente@example.com',
                    'password' => Hash::make('password123'),
                    'estado' => 0,
                    'nombre_usuario' => 'migueltorres',
                    'fecha_registro' => now(),
                    'ultimo_acceso' => null,
                    'genero' => 'M',
                    'foto_perfil' => self::DEFAULT_PROFILE_PHOTO,
                    'celular' => '3334445566',
                ],
                'cliente' => [
                    'fecha_nacimiento' => '1995-11-03',
                    'ultima_visita' => null,
                    'tipo_cliente' => 'inactivo',
                    'puntos_fidelidad' => 10,
                    'acepta_notificaciones' => 0,
                    'notas_generales' => 'Cliente desactivado para pruebas.',
                    'total_visitas' => 1,
                    'total_gastado' => 150.00,
                ],
            ],
        ];

        foreach ($clientes as $data) {
            $user = User::updateOrCreate(
                ['email' => $data['usuario']['email']],
                $data['usuario']
            );

            Cliente::updateOrCreate(
                ['id_usuario' => $user->id],
                $data['cliente']
            );

            $user->roles()->syncWithoutDetaching([
                $clienteRole->id => [
                    'fecha_asignacion' => now(),
                    'estado' => 1,
                ],
            ]);
        }
    }
}