<?php

namespace Database\Seeders;

use App\Models\Servicio;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicioSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            $servicios = [
                [
                    'nombre_servicio' => 'Corte clásico',
                    'descripcion' => 'Corte tradicional con tijera y máquina, ideal para un estilo limpio y formal.',
                    'precio_base' => 120.00,
                    'duracion_minutos' => 30,
                    'categoria' => 'corte',
                    'imagen_servicio' => null,
                    'estado' => 1,
                ],
                [
                    'nombre_servicio' => 'Corte moderno / Fade',
                    'descripcion' => 'Corte degradado moderno con máquina, acabado detallado y estilo personalizado.',
                    'precio_base' => 150.00,
                    'duracion_minutos' => 45,
                    'categoria' => 'corte',
                    'imagen_servicio' => null,
                    'estado' => 1,
                ],
                [
                    'nombre_servicio' => 'Arreglo de barba',
                    'descripcion' => 'Perfilado, recorte y arreglo de barba para mantener una apariencia limpia.',
                    'precio_base' => 90.00,
                    'duracion_minutos' => 25,
                    'categoria' => 'barba',
                    'imagen_servicio' => null,
                    'estado' => 1,
                ],
                [
                    'nombre_servicio' => 'Afeitado clásico',
                    'descripcion' => 'Afeitado tradicional con navaja, toalla caliente y acabado profesional.',
                    'precio_base' => 110.00,
                    'duracion_minutos' => 30,
                    'categoria' => 'barba',
                    'imagen_servicio' => null,
                    'estado' => 1,
                ],
                [
                    'nombre_servicio' => 'Corte y barba',
                    'descripcion' => 'Servicio completo que incluye corte de cabello y arreglo de barba.',
                    'precio_base' => 220.00,
                    'duracion_minutos' => 60,
                    'categoria' => 'paquete',
                    'imagen_servicio' => null,
                    'estado' => 1,
                ],
                [
                    'nombre_servicio' => 'Perfilado de cejas',
                    'descripcion' => 'Limpieza y perfilado básico de cejas para mejorar la presentación personal.',
                    'precio_base' => 50.00,
                    'duracion_minutos' => 15,
                    'categoria' => 'estetica',
                    'imagen_servicio' => null,
                    'estado' => 1,
                ],
                [
                    'nombre_servicio' => 'Lavado de cabello',
                    'descripcion' => 'Lavado básico de cabello con shampoo y preparación para corte o peinado.',
                    'precio_base' => 60.00,
                    'duracion_minutos' => 15,
                    'categoria' => 'cuidado',
                    'imagen_servicio' => null,
                    'estado' => 1,
                ],
                [
                    'nombre_servicio' => 'Peinado',
                    'descripcion' => 'Peinado básico con producto para acabado casual o formal.',
                    'precio_base' => 80.00,
                    'duracion_minutos' => 20,
                    'categoria' => 'cuidado',
                    'imagen_servicio' => null,
                    'estado' => 1,
                ],
            ];

            foreach ($servicios as $servicio) {
                Servicio::updateOrCreate(
                    ['nombre_servicio' => $servicio['nombre_servicio']],
                    $servicio
                );
            }
        });
    }
}