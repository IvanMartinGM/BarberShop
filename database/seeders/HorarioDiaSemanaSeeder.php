<?php

namespace Database\Seeders;

use App\Models\DiaSemana;
use App\Models\Horario;
use Illuminate\Database\Seeder;

class HorarioDiaSemanaSeeder extends Seeder
{
    public function run(): void
    {
        $dias = DiaSemana::all()->keyBy('nombre_dia');

        $turnoMatutino = Horario::where('nombre_horario', 'Turno matutino')->first();
        $turnoVespertino = Horario::where('nombre_horario', 'Turno vespertino')->first();
        $turnoCompleto = Horario::where('nombre_horario', 'Turno completo')->first();
        $sabadoCorto = Horario::where('nombre_horario', 'Sábado corto')->first();

        if ($turnoMatutino) {
            $turnoMatutino->diasSemana()->sync([
                $dias['lunes']->id,
                $dias['martes']->id,
                $dias['miercoles']->id,
                $dias['jueves']->id,
                $dias['viernes']->id,
            ]);
        }

        if ($turnoVespertino) {
            $turnoVespertino->diasSemana()->sync([
                $dias['lunes']->id,
                $dias['martes']->id,
                $dias['miercoles']->id,
                $dias['jueves']->id,
                $dias['viernes']->id,
            ]);
        }

        if ($turnoCompleto) {
            $turnoCompleto->diasSemana()->sync([
                $dias['lunes']->id,
                $dias['martes']->id,
                $dias['miercoles']->id,
                $dias['jueves']->id,
                $dias['viernes']->id,
                $dias['sabado']->id,
            ]);
        }

        if ($sabadoCorto) {
            $sabadoCorto->diasSemana()->sync([
                $dias['sabado']->id,
            ]);
        }
    }
}