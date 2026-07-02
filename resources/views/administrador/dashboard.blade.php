@extends('layouts.admin')

@section('title', 'Dashboard - BarberShop')
@section('page-title', 'Dashboard')

@section('content')

    <!-- Welcome -->
    <section class="mb-8">
        <h2 class="font-display text-3xl font-bold text-navy">
            Bienvenido, Administrador
        </h2>

        <p class="mt-2 text-sm text-ink-600">
            Aquí tienes un resumen general de la actividad de la barbería.
        </p>
    </section>

    <!-- KPI Cards -->
    <section class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 mb-8">

        <div class="rounded-panel bg-white border border-cream-200 p-6 shadow-card">
            <p class="text-sm font-semibold text-ink-500">
                Citas de hoy
            </p>
            <p class="mt-3 font-display text-4xl font-bold text-navy">
                12
            </p>
        </div>

        <div class="rounded-panel bg-white border border-cream-200 p-6 shadow-card">
            <p class="text-sm font-semibold text-ink-500">
                Clientes registrados
            </p>
            <p class="mt-3 font-display text-4xl font-bold text-navy">
                124
            </p>
        </div>

        <div class="rounded-panel bg-white border border-cream-200 p-6 shadow-card">
            <p class="text-sm font-semibold text-ink-500">
                Barberos activos
            </p>
            <p class="mt-3 font-display text-4xl font-bold text-navy">
                8
            </p>
        </div>

        <div class="rounded-panel bg-barber-red p-6 shadow-panel">
            <p class="text-sm font-semibold text-white/80">
                Pagos pendientes
            </p>
            <p class="mt-3 font-display text-4xl font-bold text-white">
                3
            </p>
        </div>

    </section>

    <!-- Main Grid -->
    <section class="grid grid-cols-1 xl:grid-cols-[1fr_360px] gap-6">

        <!-- Citas de hoy -->
        <div class="rounded-panel bg-white border border-cream-200 shadow-card overflow-hidden">

            <div class="flex items-center justify-between px-6 py-5 border-b border-cream-200">
                <div>
                    <h3 class="font-display text-xl font-bold text-navy">
                        Citas de hoy
                    </h3>
                    <p class="mt-1 text-sm text-ink-500">
                        Próximas citas programadas.
                    </p>
                </div>

                <a href="{{ url('/citas') }}"
                   class="text-sm font-semibold text-barber-red hover:text-barber-red-700">
                    Ver todas
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-cream-100 text-ink-600">
                        <tr>
                            <th class="px-6 py-3 text-left font-semibold">Hora</th>
                            <th class="px-6 py-3 text-left font-semibold">Cliente</th>
                            <th class="px-6 py-3 text-left font-semibold">Barbero</th>
                            <th class="px-6 py-3 text-left font-semibold">Servicio</th>
                            <th class="px-6 py-3 text-left font-semibold">Estado</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-cream-200">
                        <tr>
                            <td class="px-6 py-4">09:00</td>
                            <td class="px-6 py-4 font-medium text-ink">Juan Pérez</td>
                            <td class="px-6 py-4">Marco</td>
                            <td class="px-6 py-4">Corte clásico</td>
                            <td class="px-6 py-4">
                                <span class="rounded-full bg-success-light px-3 py-1 text-xs font-semibold text-success">
                                    Confirmada
                                </span>
                            </td>
                        </tr>

                        <tr>
                            <td class="px-6 py-4">10:30</td>
                            <td class="px-6 py-4 font-medium text-ink">Carlos López</td>
                            <td class="px-6 py-4">Leo</td>
                            <td class="px-6 py-4">Barba</td>
                            <td class="px-6 py-4">
                                <span class="rounded-full bg-warning-light px-3 py-1 text-xs font-semibold text-warning">
                                    Pendiente
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>

        <!-- Right Column -->
        <div class="space-y-6">

            <!-- Quick Actions -->
            <div class="rounded-panel bg-white border border-cream-200 p-6 shadow-card">
                <h3 class="font-display text-xl font-bold text-navy mb-4">
                    Acciones rápidas
                </h3>

                <div class="space-y-3">
                    <a href="#citas.create"
                       class="flex w-full items-center justify-center rounded-panel bg-navy px-4 py-3 text-sm font-semibold text-white hover:bg-navy-800 transition-colors">
                        Crear cita
                    </a>

                    <a href="{{ route('cliente.create') }}"
                       class="flex w-full items-center justify-center rounded-panel border border-cream-300 bg-white px-4 py-3 text-sm font-semibold text-ink hover:bg-cream-100 transition-colors">
                        Agregar cliente
                    </a>

                    <a href="{{ route('barbero.create') }}"
                       class="flex w-full items-center justify-center rounded-panel bg-barber-red px-4 py-3 text-sm font-semibold text-white hover:bg-barber-red-700 transition-colors">
                        Agregar barbero
                    </a>

                    <a href="{{ route('servicio.create') }}"
                       class="flex w-full items-center justify-center rounded-panel border border-cream-300 bg-white px-4 py-3 text-sm font-semibold text-ink hover:bg-cream-100 transition-colors">
                        Agregar servicio
                    </a>
                </div>
            </div>

            <!-- Estado de barberos -->
            <div class="rounded-panel bg-white border border-cream-200 p-6 shadow-card">
                <h3 class="font-display text-xl font-bold text-navy mb-4">
                    Estado de barberos
                </h3>

                <div class="space-y-3">
                    <div class="flex items-center justify-between rounded-card bg-cream-50 px-4 py-3">
                        <span class="font-medium text-ink">Marco</span>
                        <span class="text-xs font-semibold text-success">Disponible</span>
                    </div>

                    <div class="flex items-center justify-between rounded-card bg-cream-50 px-4 py-3">
                        <span class="font-medium text-ink">Leo</span>
                        <span class="text-xs font-semibold text-warning">Ocupado</span>
                    </div>

                    <div class="flex items-center justify-between rounded-card bg-cream-50 px-4 py-3">
                        <span class="font-medium text-ink">Sarah</span>
                        <span class="text-xs font-semibold text-ink-500">Fuera</span>
                    </div>
                </div>
            </div>

        </div>

    </section>

@endsection