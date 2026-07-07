<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            DiaSemanaSeeder::class,
            MetodoPagoSeeder::class,

            AdminUserSeeder::class,

            HorarioSeeder::class,
            HorarioDiaSemanaSeeder::class,

            ClienteSeeder::class,
            BarberoSeeder::class,
            BarberoHorarioSeeder::class,

            ServicioSeeder::class,

            BarberoServicioSeeder::class,
            CitaSeeder::class,
            PagoSeeder::class,
        ]);
    }
}