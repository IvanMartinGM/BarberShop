<?php

namespace Database\Seeders;

use App\Models\MetodoPago;
use Illuminate\Database\Seeder;

class MetodoPagoSeeder extends Seeder
{
    public function run(): void
    {
        $metodosPago = [
            [
                'nombre_metodo' => 'efectivo',
                'descripcion' => 'Pago realizado en efectivo directamente en la barbería.',
                'estado' => 1,
            ],
            [
                'nombre_metodo' => 'paypal',
                'descripcion' => 'Pago realizado en línea mediante PayPal.',
                'estado' => 1,
            ],
        ];

        foreach ($metodosPago as $metodo) {
            MetodoPago::updateOrCreate(
                ['nombre_metodo' => $metodo['nombre_metodo']],
                [
                    'descripcion' => $metodo['descripcion'],
                    'estado' => $metodo['estado'],
                ]
            );
        }
    }
}