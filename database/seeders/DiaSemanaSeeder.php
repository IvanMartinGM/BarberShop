<?php

namespace Database\Seeders;

use App\Models\DiaSemana;
use Illuminate\Database\Seeder;

class DiaSemanaSeeder extends Seeder
{
    public function run(): void
    {
        $dias = [
            'lunes',
            'martes',
            'miercoles',
            'jueves',
            'viernes',
            'sabado',
            'domingo',
        ];

        foreach ($dias as $dia) {
            DiaSemana::firstOrCreate(
                ['nombre_dia' => $dia]
            );
        }
    }
}