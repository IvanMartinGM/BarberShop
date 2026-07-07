@extends('layouts.barbero')

@section('title', 'Dashboard Barbero - BarberShop')
@section('page-title', 'Dashboard')

@section('content')

<section class="space-y-6">

    <div>
        <h2 class="font-display text-3xl font-bold text-navy">
            Bienvenido, {{ auth()->user()->nombres }}
        </h2>

        <p class="mt-2 text-sm text-ink-600">
            Aquí puedes consultar tus citas, servicios y horarios asignados.
        </p>
    </div>

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">

        <div class="rounded-panel border border-cream-200 bg-white p-6 shadow-card">
            <p class="text-sm font-semibold text-ink-500">
                Citas de hoy
            </p>

            <p class="mt-3 font-display text-4xl font-bold text-navy">
                {{ $totalCitasHoy }}
            </p>
        </div>

        <div class="rounded-panel border border-cream-200 bg-white p-6 shadow-card">
            <p class="text-sm font-semibold text-ink-500">
                Pendientes
            </p>

            <p class="mt-3 font-display text-4xl font-bold text-warning">
                {{ $citasPendientes }}
            </p>
        </div>

        <div class="rounded-panel border border-cream-200 bg-white p-6 shadow-card">
            <p class="text-sm font-semibold text-ink-500">
                Confirmadas
            </p>

            <p class="mt-3 font-display text-4xl font-bold text-info">
                {{ $citasConfirmadas }}
            </p>
        </div>

        <div class="rounded-panel bg-barber-red p-6 shadow-panel">
            <p class="text-sm font-semibold text-white/80">
                Completadas
            </p>

            <p class="mt-3 font-display text-4xl font-bold text-white">
                {{ $citasCompletadas }}
            </p>
        </div>

    </div>

    <div class="grid grid-cols-1 gap-6 xl:grid-cols-[1fr_360px]">

        <div class="overflow-hidden rounded-panel border border-cream-200 bg-white shadow-panel">

            <div class="flex items-center justify-between border-b border-cream-200 px-6 py-5">
                <div>
                    <h3 class="font-display text-xl font-bold text-navy">
                        Próximas citas
                    </h3>

                    <p class="mt-1 text-sm text-ink-500">
                        Citas pendientes o confirmadas asignadas a ti.
                    </p>
                </div>

                <a href="{{ route('barbero.citas.index') }}"
                   class="text-sm font-bold text-barber-red hover:text-barber-red-700">
                    Ver todas
                </a>
            </div>

            <div class="overflow-x-auto">

                <table class="min-w-full divide-y divide-cream-200">

                    <thead class="bg-cream-100">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wide text-ink-500">
                                Fecha
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wide text-ink-500">
                                Hora
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wide text-ink-500">
                                Cliente
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wide text-ink-500">
                                Servicio
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wide text-ink-500">
                                Estado
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-cream-200 bg-white">

                        @forelse ($proximasCitas as $cita)

                            @php
                                $estadoClasses = match ($cita->estado_cita) {
                                    'pendiente' => 'bg-warning-light text-warning',
                                    'confirmada' => 'bg-info-light text-info',
                                    'completada' => 'bg-success-light text-success',
                                    'cancelada' => 'bg-danger-light text-danger',
                                    default => 'bg-cream-100 text-ink-600',
                                };
                            @endphp

                            <tr class="hover:bg-cream-50 transition-colors">

                                <td class="whitespace-nowrap px-6 py-4 font-semibold text-ink">
                                    {{ $cita->fecha_cita?->format('d/m/Y') }}
                                </td>

                                <td class="whitespace-nowrap px-6 py-4 text-ink-600">
                                    {{ $cita->hora_inicio }} - {{ $cita->hora_fin }}
                                </td>

                                <td class="px-6 py-4 text-ink">
                                    {{ $cita->cliente?->user?->getFullName() ?? 'Cliente no disponible' }}
                                </td>

                                <td class="px-6 py-4">
                                    @foreach ($cita->servicios as $servicio)
                                        <span class="rounded-full bg-cream-100 px-3 py-1 text-xs font-bold text-navy">
                                            {{ $servicio->nombre_servicio }}
                                        </span>
                                    @endforeach
                                </td>

                                <td class="px-6 py-4">
                                    <span class="rounded-full px-3 py-1 text-xs font-bold uppercase {{ $estadoClasses }}">
                                        {{ $cita->estado_cita }}
                                    </span>
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="5" class="px-6 py-10 text-center text-sm text-ink-500">
                                    No tienes próximas citas asignadas.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        <div class="space-y-6">

            <div class="rounded-panel border border-cream-200 bg-white p-6 shadow-card">
                <h3 class="font-display text-xl font-bold text-navy">
                    Acciones rápidas
                </h3>

                <div class="mt-5 space-y-3">
                    <a href="{{ route('barbero.citas.index') }}"
                       class="flex w-full items-center justify-center rounded-panel bg-barber-red px-4 py-3 text-sm font-bold text-white hover:bg-barber-red-700 transition-colors">
                        Ver mis citas
                    </a>

                    <a href="{{ route('barbero.servicios.index') }}"
                       class="flex w-full items-center justify-center rounded-panel border border-cream-300 bg-white px-4 py-3 text-sm font-bold text-navy hover:bg-cream-100 transition-colors">
                        Mis servicios
                    </a>

                    <a href="{{ route('barbero.horarios.index') }}"
                       class="flex w-full items-center justify-center rounded-panel border border-cream-300 bg-white px-4 py-3 text-sm font-bold text-navy hover:bg-cream-100 transition-colors">
                        Mis horarios
                    </a>
                </div>
            </div>

            <div class="rounded-panel border border-cream-200 bg-white p-6 shadow-card">
                <h3 class="font-display text-xl font-bold text-navy">
                    Mi información
                </h3>

                <div class="mt-5 space-y-3 text-sm text-ink-600">
                    <p>
                        <span class="font-bold text-navy">Especialidad:</span>
                        {{ $barbero->especialidad ?? 'No registrada' }}
                    </p>

                    <p>
                        <span class="font-bold text-navy">Experiencia:</span>
                        {{ $barbero->experiencia_anos ?? 0 }} años
                    </p>

                    <p>
                        <span class="font-bold text-navy">Estado:</span>
                        {{ $barbero->estado_disponibilidad }}
                    </p>
                </div>
            </div>

        </div>

    </div>

</section>

@endsection