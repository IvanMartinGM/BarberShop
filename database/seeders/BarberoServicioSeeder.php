<?php

namespace Database\Seeders;

use App\Models\Barbero;
use App\Models\Servicio;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class BarberoServicioSeeder extends Seeder
{
    public function run(): void
    {
        $barberos = Barbero::all();
        $servicios = Servicio::where('estado', 1)->get();

        if ($barberos->isEmpty() || $servicios->isEmpty()) {
            return;
        }

        foreach ($barberos as $barbero) {
            $serviciosAsignados = $servicios->random(
                min(rand(2, 4), $servicios->count())
            );

            foreach ($serviciosAsignados as $servicio) {
                $data = [
                    'id_barbero' => $barbero->id,
                    'id_servicio' => $servicio->id,
                    'estado' => 1,
                ];

                if (Schema::hasColumn('barberos_servicios', 'created_at')) {
                    $data['created_at'] = now();
                }

                if (Schema::hasColumn('barberos_servicios', 'updated_at')) {
                    $data['updated_at'] = now();
                }

                DB::table('barberos_servicios')->updateOrInsert(
                    [
                        'id_barbero' => $barbero->id,
                        'id_servicio' => $servicio->id,
                    ],
                    $data
                );
            }
        }
    }
}