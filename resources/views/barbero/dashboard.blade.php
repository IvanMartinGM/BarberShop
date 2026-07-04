@extends('layouts.barbero')

@section('title', 'Dashboard barbero - BarberShop')
@section('page-title', 'Dashboard barbero')

@section('content')

@php
    $authUser = auth()->user();
@endphp

<!-- Welcome -->
<section class="mb-8">
    <h2 class="font-display text-3xl font-bold text-navy">
        Bienvenido, {{ $authUser?->nombres ?? 'Barbero' }}
    </h2>

    <p class="mt-2 text-sm text-ink-600">
        Aquí tienes un resumen de tu jornada, tus citas y tu actividad dentro de la barbería.
    </p>
</section>

<!-- KPI Cards -->
<section class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 mb-8">

    <div class="rounded-panel bg-white border border-cream-200 p-6 shadow-card">
        <p class="text-sm font-semibold text-ink-500">
            Mis citas de hoy
        </p>

        <p class="mt-3 font-display text-4xl font-bold text-navy">
            6
        </p>

        <p class="mt-2 text-xs text-ink-500">
            Citas asignadas para esta jornada.
        </p>
    </div>

    <div class="rounded-panel bg-white border border-cream-200 p-6 shadow-card">
        <p class="text-sm font-semibold text-ink-500">
            Próxima cita
        </p>

        <p class="mt-3 font-display text-4xl font-bold text-navy">
            09:30
        </p>

        <p class="mt-2 text-xs text-ink-500">
            Corte clásico con cliente registrado.
        </p>
    </div>

    <div class="rounded-panel bg-white border border-cream-200 p-6 shadow-card">
        <p class="text-sm font-semibold text-ink-500">
            Servicios asignados
        </p>

        <p class="mt-3 font-display text-4xl font-bold text-navy">
            4
        </p>

        <p class="mt-2 text-xs text-ink-500">
            Servicios que puedes realizar.
        </p>
    </div>

    <div class="rounded-panel bg-barber-red p-6 shadow-panel">
        <p class="text-sm font-semibold text-white/80">
            Estado actual
        </p>

        <p class="mt-3 font-display text-4xl font-bold text-white">
            Disponible
        </p>

        <p class="mt-2 text-xs text-white/80">
            Listo para atender citas.
        </p>
    </div>

</section>

<!-- Main Grid -->
<section class="grid grid-cols-1 xl:grid-cols-[1fr_360px] gap-6">

    <!-- Mis citas de hoy -->
    <div class="rounded-panel bg-white border border-cream-200 shadow-card overflow-hidden">

        <div class="flex items-center justify-between px-6 py-5 border-b border-cream-200">
            <div>
                <h3 class="font-display text-xl font-bold text-navy">
                    Mis citas de hoy
                </h3>

                <p class="mt-1 text-sm text-ink-500">
                    Próximas citas asignadas a tu agenda.
                </p>
            </div>

            <a href="#barbero.citas.index"
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
                        <th class="px-6 py-3 text-left font-semibold">Servicio</th>
                        <th class="px-6 py-3 text-left font-semibold">Duración</th>
                        <th class="px-6 py-3 text-left font-semibold">Estado</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-cream-200">
                    <tr>
                        <td class="px-6 py-4">09:30</td>

                        <td class="px-6 py-4 font-medium text-ink">
                            Juan Pérez
                        </td>

                        <td class="px-6 py-4">
                            Corte clásico
                        </td>

                        <td class="px-6 py-4">
                            30 min
                        </td>

                        <td class="px-6 py-4">
                            <span class="rounded-full bg-success-light px-3 py-1 text-xs font-semibold text-success">
                                Confirmada
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td class="px-6 py-4">11:00</td>

                        <td class="px-6 py-4 font-medium text-ink">
                            Carlos López
                        </td>

                        <td class="px-6 py-4">
                            Barba
                        </td>

                        <td class="px-6 py-4">
                            25 min
                        </td>

                        <td class="px-6 py-4">
                            <span class="rounded-full bg-warning-light px-3 py-1 text-xs font-semibold text-warning">
                                Pendiente
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td class="px-6 py-4">13:00</td>

                        <td class="px-6 py-4 font-medium text-ink">
                            Miguel Torres
                        </td>

                        <td class="px-6 py-4">
                            Corte + barba
                        </td>

                        <td class="px-6 py-4">
                            60 min
                        </td>

                        <td class="px-6 py-4">
                            <span class="rounded-full bg-success-light px-3 py-1 text-xs font-semibold text-success">
                                Confirmada
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
                <a href="#barbero.citas.index"
                   class="flex w-full items-center justify-center rounded-panel bg-navy px-4 py-3 text-sm font-semibold text-white hover:bg-navy-800 transition-colors">
                    Ver mis citas
                </a>

                <a href="#barbero.horarios.index"
                   class="flex w-full items-center justify-center rounded-panel border border-cream-300 bg-white px-4 py-3 text-sm font-semibold text-ink hover:bg-cream-100 transition-colors">
                    Consultar mi horario
                </a>

                <a href="#barbero.servicios.index"
                   class="flex w-full items-center justify-center rounded-panel bg-barber-red px-4 py-3 text-sm font-semibold text-white hover:bg-barber-red-700 transition-colors">
                    Ver mis servicios
                </a>

                <a href="#profile.show"
                   class="flex w-full items-center justify-center rounded-panel border border-cream-300 bg-white px-4 py-3 text-sm font-semibold text-ink hover:bg-cream-100 transition-colors">
                    Mi perfil
                </a>
            </div>
        </div>

        <!-- Jornada -->
        <div class="rounded-panel bg-white border border-cream-200 p-6 shadow-card">
            <h3 class="font-display text-xl font-bold text-navy mb-4">
                Mi jornada
            </h3>

            <div class="space-y-3">
                <div class="flex items-center justify-between rounded-card bg-cream-50 px-4 py-3">
                    <span class="font-medium text-ink">Entrada</span>
                    <span class="text-sm font-semibold text-navy">09:00</span>
                </div>

                <div class="flex items-center justify-between rounded-card bg-cream-50 px-4 py-3">
                    <span class="font-medium text-ink">Salida</span>
                    <span class="text-sm font-semibold text-navy">18:00</span>
                </div>

                <div class="flex items-center justify-between rounded-card bg-cream-50 px-4 py-3">
                    <span class="font-medium text-ink">Descanso</span>
                    <span class="text-sm font-semibold text-ink-500">14:00 - 15:00</span>
                </div>
            </div>
        </div>

        <!-- Resumen de servicios -->
        <div class="rounded-panel bg-white border border-cream-200 p-6 shadow-card">
            <h3 class="font-display text-xl font-bold text-navy mb-4">
                Servicios frecuentes
            </h3>

            <div class="space-y-3">
                <div class="rounded-card bg-cream-50 px-4 py-3">
                    <p class="font-semibold text-ink">
                        Corte clásico
                    </p>

                    <p class="mt-1 text-xs text-ink-500">
                        Duración estimada: 30 minutos
                    </p>
                </div>

                <div class="rounded-card bg-cream-50 px-4 py-3">
                    <p class="font-semibold text-ink">
                        Corte de barba
                    </p>

                    <p class="mt-1 text-xs text-ink-500">
                        Duración estimada: 25 minutos
                    </p>
                </div>

                <div class="rounded-card bg-cream-50 px-4 py-3">
                    <p class="font-semibold text-ink">
                        Corte + barba
                    </p>

                    <p class="mt-1 text-xs text-ink-500">
                        Duración estimada: 60 minutos
                    </p>
                </div>
            </div>
        </div>

    </div>

</section>

@endsection