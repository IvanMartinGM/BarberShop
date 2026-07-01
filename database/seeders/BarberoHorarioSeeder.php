<?php

namespace Database\Seeders;

use App\Models\Barbero;
use App\Models\Horario;
use Illuminate\Database\Seeder;

class BarberoHorarioSeeder extends Seeder
{
    public function run(): void
    {
        $javier = Barbero::whereHas('user', function ($query) {
            $query->where('email', 'javier.barbero@example.com');
        })->first();

        $roberto = Barbero::whereHas('user', function ($query) {
            $query->where('email', 'roberto.barbero@example.com');
        })->first();

        $luis = Barbero::whereHas('user', function ($query) {
            $query->where('email', 'luis.barbero@example.com');
        })->first();

        $turnoMatutino = Horario::where('nombre_horario', 'Turno matutino')->first();
        $turnoVespertino = Horario::where('nombre_horario', 'Turno vespertino')->first();
        $turnoCompleto = Horario::where('nombre_horario', 'Turno completo')->first();
        $sabadoCorto = Horario::where('nombre_horario', 'Sábado corto')->first();

        if ($javier && $turnoMatutino && $sabadoCorto) {
            $javier->horarios()->sync([
                $turnoMatutino->id => [
                    'fecha_asignacion' => now(),
                    'estado' => 1,
                ],
                $sabadoCorto->id => [
                    'fecha_asignacion' => now(),
                    'estado' => 1,
                ],
            ]);
        }

        if ($roberto && $turnoVespertino) {
            $roberto->horarios()->sync([
                $turnoVespertino->id => [
                    'fecha_asignacion' => now(),
                    'estado' => 1,
                ],
            ]);
        }

        if ($luis && $turnoCompleto) {
            $luis->horarios()->sync([
                $turnoCompleto->id => [
                    'fecha_asignacion' => now(),
                    'estado' => 0,
                ],
            ]);
        }
    }
}