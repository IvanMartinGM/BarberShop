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
            {{ $totalCitasHoy }}
        </p>
    </div>

    <div class="rounded-panel bg-white border border-cream-200 p-6 shadow-card">
        <p class="text-sm font-semibold text-ink-500">
            Clientes registrados
        </p>

        <p class="mt-3 font-display text-4xl font-bold text-navy">
            {{ $totalClientes }}
        </p>
    </div>

    <div class="rounded-panel bg-white border border-cream-200 p-6 shadow-card">
        <p class="text-sm font-semibold text-ink-500">
            Barberos activos
        </p>

        <p class="mt-3 font-display text-4xl font-bold text-navy">
            {{ $totalBarberosActivos }}
        </p>
    </div>

    <div class="rounded-panel bg-barber-red p-6 shadow-panel">
        <p class="text-sm font-semibold text-white/80">
            Pagos pendientes
        </p>

        <p class="mt-3 font-display text-4xl font-bold text-white">
            {{ $pagosPendientes }}
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

            <a href="{{ route('administrador.citas.index') }}" class="text-sm font-semibold text-barber-red hover:text-barber-red-700">
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

                    @forelse ($citasHoy as $cita)

                    @php
                    $estadoClasses = match ($cita->estado_cita) {
                    'pendiente' => 'bg-warning-light text-warning',
                    'confirmada' => 'bg-info-light text-info',
                    'completada' => 'bg-success-light text-success',
                    'cancelada' => 'bg-danger-light text-danger',
                    default => 'bg-cream-100 text-ink-600',
                    };
                    @endphp

                    <tr>
                        <td class="px-6 py-4">
                            {{ $cita->hora_inicio }}
                        </td>

                        <td class="px-6 py-4 font-medium text-ink">
                            {{ $cita->cliente?->user?->getFullName() ?? 'Cliente no disponible' }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $cita->barbero?->user?->getFullName() ?? 'Barbero no disponible' }}
                        </td>

                        <td class="px-6 py-4">
                            @forelse ($cita->servicios as $servicio)
                            <span class="rounded-full bg-cream-100 px-3 py-1 text-xs font-semibold text-navy">
                                {{ $servicio->nombre_servicio }}
                            </span>
                            @empty
                            <span class="text-ink-500">
                                Sin servicio
                            </span>
                            @endforelse
                        </td>

                        <td class="px-6 py-4">
                            <span class="rounded-full px-3 py-1 text-xs font-semibold {{ $estadoClasses }}">
                                {{ ucfirst($cita->estado_cita) }}
                            </span>
                        </td>
                    </tr>

                    @empty

                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center text-sm text-ink-500">
                            No hay citas programadas para hoy.
                        </td>
                    </tr>

                    @endforelse

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
                <a href="{{ route('cliente.create') }}" class="flex w-full items-center justify-center rounded-panel border border-cream-300 bg-white px-4 py-3 text-sm font-semibold text-ink hover:bg-cream-100 transition-colors">
                    Agregar cliente
                </a>

                <a href="{{ route('barbero.create') }}" class="flex w-full items-center justify-center rounded-panel bg-barber-red px-4 py-3 text-sm font-semibold text-white hover:bg-barber-red-700 transition-colors">
                    Agregar barbero
                </a>

                <a href="{{ route('servicio.create') }}" class="flex w-full items-center justify-center rounded-panel border border-cream-300 bg-white px-4 py-3 text-sm font-semibold text-ink hover:bg-cream-100 transition-colors">
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

                @forelse ($barberos as $barbero)

                @php
                $estadoTexto = match ($barbero->estado_disponibilidad) {
                'disponible' => 'Disponible',
                'ocupado' => 'Ocupado',
                'inactivo' => 'Inactivo',
                default => ucfirst($barbero->estado_disponibilidad ?? 'Sin estado'),
                };

                $estadoColor = match ($barbero->estado_disponibilidad) {
                'disponible' => 'text-success',
                'ocupado' => 'text-warning',
                'inactivo' => 'text-danger',
                default => 'text-ink-500',
                };
                @endphp

                <div class="flex items-center justify-between rounded-card bg-cream-50 px-4 py-3">
                    <span class="font-medium text-ink">
                        {{ $barbero->user?->getFullName() ?? 'Barbero sin usuario' }}
                    </span>

                    <span class="text-xs font-semibold {{ $estadoColor }}">
                        {{ $estadoTexto }}
                    </span>
                </div>

                @empty

                <div class="rounded-card bg-cream-50 px-4 py-3 text-sm text-ink-500">
                    No hay barberos registrados.
                </div>

                @endforelse

            </div>
        </div>

    </div>

</section>

@endsection
