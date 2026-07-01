<?php

namespace Database\Seeders;

use App\Models\Horario;
use Illuminate\Database\Seeder;

class HorarioSeeder extends Seeder
{
    public function run(): void
    {
        $horarios = [
            [
                'nombre_horario' => 'Turno matutino',
                'descripcion' => 'Horario principal para atención durante la mañana.',
                'hora_inicio' => '09:00',
                'hora_fin' => '14:00',
                'estado' => 1,
            ],
            [
                'nombre_horario' => 'Turno vespertino',
                'descripcion' => 'Horario principal para atención durante la tarde.',
                'hora_inicio' => '15:00',
                'hora_fin' => '20:00',
                'estado' => 1,
            ],
            [
                'nombre_horario' => 'Turno completo',
                'descripcion' => 'Horario extendido para barberos con jornada completa.',
                'hora_inicio' => '10:00',
                'hora_fin' => '19:00',
                'estado' => 1,
            ],
            [
                'nombre_horario' => 'Sábado corto',
                'descripcion' => 'Horario especial para atención de fin de semana.',
                'hora_inicio' => '10:00',
                'hora_fin' => '15:00',
                'estado' => 1,
            ],
        ];

        foreach ($horarios as $horario) {
            Horario::updateOrCreate(
                ['nombre_horario' => $horario['nombre_horario']],
                $horario
            );
        }
    }
}