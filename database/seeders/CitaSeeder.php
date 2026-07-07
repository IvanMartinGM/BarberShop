<?php

namespace Database\Seeders;

use App\Models\Barbero;
use App\Models\Cita;
use App\Models\Cliente;
use App\Models\Servicio;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitaSeeder extends Seeder
{
    public function run(): void
    {
        $clientes = Cliente::all();

        if ($clientes->isEmpty()) {
            return;
        }

        $estados = [
            'completada',
            'completada',
            'completada',
            'confirmada',
            'pendiente',
            'cancelada',
        ];

        foreach ($clientes as $cliente) {
            $numeroCitas = rand(2, 4);

            for ($i = 0; $i < $numeroCitas; $i++) {
                $estadoCita = $estados[array_rand($estados)];

                $servicio = Servicio::where('estado', 1)
                    ->inRandomOrder()
                    ->first();

                if (!$servicio) {
                    continue;
                }

                $barbero = Barbero::where('estado_disponibilidad', '!=', 'inactivo')
                    ->whereHas('servicios', function ($query) use ($servicio) {
                        $query->where('servicios.id', $servicio->id)
                            ->where('barberos_servicios.estado', 1);
                    })
                    ->inRandomOrder()
                    ->first();

                if (!$barbero) {
                    continue;
                }

                $fechaBase = match ($estadoCita) {
                    'completada', 'cancelada' => now()->subDays(rand(1, 20)),
                    'confirmada', 'pendiente' => now()->addDays(rand(1, 10)),
                    default => now(),
                };

                $horaInicio = Carbon::createFromTime(
                    rand(9, 17),
                    [0, 30][array_rand([0, 30])]
                );

                $duracionMinutos = (int) ($servicio->duracion_minutos ?? 30);

                if ($duracionMinutos <= 0) {
                    $duracionMinutos = 30;
                }

                $horaFin = $horaInicio->copy()->addMinutes($duracionMinutos);

                $cita = Cita::create([
                    'id_cliente' => $cliente->id,
                    'id_barbero' => $barbero->id,
                    'fecha_cita' => $fechaBase->format('Y-m-d'),
                    'hora_inicio' => $horaInicio->format('H:i'),
                    'hora_fin' => $horaFin->format('H:i'),
                    'estado_cita' => $estadoCita,
                    'observaciones' => $this->getObservacion($estadoCita),
                ]);

                $precioAplicado = $servicio->precio_base
                    ?? $servicio->precio
                    ?? 0;

                $estadoServicio = match ($estadoCita) {
                    'completada' => 'realizado',
                    'cancelada' => 'cancelado',
                    default => 'pendiente',
                };

                DB::table('citas_servicios')->insert([
                    'id_cita' => $cita->id,
                    'id_servicio' => $servicio->id,
                    'precio_aplicado' => $precioAplicado,
                    'estado_servicio' => $estadoServicio,
                    'observaciones_servicio' => null,
                ]);
            }
        }
    }

    private function getObservacion(string $estado): string
    {
        return match ($estado) {
            'completada' => 'Servicio realizado correctamente.',
            'confirmada' => 'Cita confirmada por administración.',
            'pendiente' => 'Cita pendiente de confirmación.',
            'cancelada' => 'Cita cancelada por disponibilidad.',
            default => 'Sin observaciones.',
        };
    }
}