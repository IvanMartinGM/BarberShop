<?php

namespace Database\Seeders;

use App\Models\Cita;
use App\Models\MetodoPago;
use App\Models\Pago;
use Illuminate\Database\Seeder;

class PagoSeeder extends Seeder
{
    public function run(): void
    {
        $metodoEfectivo = MetodoPago::where('nombre_metodo', 'efectivo')->first();

        if (!$metodoEfectivo) {
            return;
        }

        $citasCompletadas = Cita::with(['servicios', 'pago'])
            ->where('estado_cita', 'completada')
            ->whereDoesntHave('pago')
            ->get();

        foreach ($citasCompletadas as $cita) {
            $monto = $cita->servicios->sum(function ($servicio) {
                return $servicio->citas_servicios->precio_aplicado ?? 0;
            });

            if ($monto <= 0) {
                continue;
            }

            Pago::create([
                'id_cita' => $cita->id,
                'id_metodo_pago' => $metodoEfectivo->id,
                'monto' => $monto,
                'fecha_pago' => $cita->fecha_cita
                    ? $cita->fecha_cita->copy()->setTime(rand(10, 18), [0, 15, 30, 45][array_rand([0, 15, 30, 45])])
                    : now(),
                'estado_pago' => 'pagado',
                'referencia_transaccion' => 'EFECTIVO-' . str_pad((string) $cita->id, 5, '0', STR_PAD_LEFT),
                'concepto' => 'Pago en efectivo de la cita #' . $cita->id,
            ]);
        }
    }
}