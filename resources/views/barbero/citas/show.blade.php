@extends('layouts.barbero')

@section('title', 'Detalle de cita - BarberShop')
@section('page-title', 'Detalle de cita')

@section('content')

@php
    $estadoClasses = match ($cita->estado_cita) {
        'pendiente' => 'bg-warning-light text-warning border-warning',
        'confirmada' => 'bg-info-light text-info border-info',
        'completada' => 'bg-success-light text-success border-success',
        'cancelada' => 'bg-danger-light text-danger border-danger',
        default => 'bg-cream-100 text-ink-600 border-cream-300',
    };
@endphp

<section class="space-y-6">

    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>
            <h2 class="font-display text-3xl font-bold text-navy">
                Cita #{{ $cita->id }}
            </h2>

            <p class="mt-2 text-sm text-ink-600">
                Detalle de la cita asignada.
            </p>
        </div>

        <a href="{{ route('barbero.citas.index') }}"
           class="inline-flex items-center justify-center rounded-panel border border-cream-300 bg-white px-5 py-3 text-sm font-bold text-navy hover:bg-cream-100 transition-colors">
            Volver a mis citas
        </a>

    </div>

    <div class="overflow-hidden rounded-panel border border-cream-200 bg-white shadow-panel">

        <div class="bg-linear-to-r from-navy via-navy-800 to-barber-red px-6 py-8 text-white">

            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                <div>
                    <p class="text-sm font-semibold text-cream-100">
                        Fecha y horario
                    </p>

                    <h3 class="mt-2 font-display text-3xl font-bold">
                        {{ $cita->fecha_cita?->format('d/m/Y') }}
                        —
                        {{ $cita->hora_inicio }} a {{ $cita->hora_fin }}
                    </h3>
                </div>

                <span class="inline-flex w-fit rounded-full border bg-white px-4 py-2 text-xs font-bold uppercase tracking-wide {{ $estadoClasses }}">
                    {{ $cita->estado_cita }}
                </span>

            </div>

        </div>

        <div class="grid grid-cols-1 gap-6 p-6 md:grid-cols-2">

            <div class="rounded-card border border-cream-200 bg-cream-50 p-5">
                <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                    Cliente
                </p>

                <p class="mt-2 font-display text-xl font-bold text-navy">
                    {{ $cita->cliente?->user?->getFullName() ?? 'Cliente no disponible' }}
                </p>

                <p class="mt-1 text-sm text-ink-600">
                    {{ $cita->cliente?->user?->email ?? 'Sin correo' }}
                </p>

                <p class="mt-1 text-sm text-ink-600">
                    {{ $cita->cliente?->user?->celular ?? 'Sin celular' }}
                </p>
            </div>

            <div class="rounded-card border border-cream-200 bg-cream-50 p-5">
                <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                    Estado de la cita
                </p>

                <span class="mt-3 inline-flex rounded-full border px-3 py-1 text-xs font-bold uppercase tracking-wide {{ $estadoClasses }}">
                    {{ $cita->estado_cita }}
                </span>
            </div>

        </div>

    </div>

    <div class="overflow-hidden rounded-panel border border-cream-200 bg-white shadow-panel">

        <div class="border-b border-cream-200 px-6 py-5">
            <h3 class="font-display text-2xl font-bold text-navy">
                Servicios
            </h3>
        </div>

        <div class="p-6">

            @if ($cita->servicios->count() > 0)

                <div class="space-y-4">

                    @foreach ($cita->servicios as $servicio)

                        @php
                            $estadoServicio = $servicio->citas_servicios->estado_servicio ?? 'pendiente';

                            $estadoServicioClasses = match ($estadoServicio) {
                                'pendiente' => 'bg-warning-light text-warning border-warning',
                                'realizado' => 'bg-success-light text-success border-success',
                                'cancelado' => 'bg-danger-light text-danger border-danger',
                                default => 'bg-cream-100 text-ink-600 border-cream-300',
                            };
                        @endphp

                        <div class="rounded-card border border-cream-200 bg-cream-50 p-5">

                            <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">

                                <div>
                                    <h4 class="font-display text-xl font-bold text-navy">
                                        {{ $servicio->nombre_servicio }}
                                    </h4>

                                    <p class="mt-1 text-sm leading-6 text-ink-600">
                                        {{ $servicio->descripcion ?? 'Sin descripción registrada.' }}
                                    </p>
                                </div>

                                <div class="text-left sm:text-right">
                                    <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                                        Estado del servicio
                                    </p>

                                    <span class="mt-2 inline-flex rounded-full border px-3 py-1 text-xs font-bold uppercase tracking-wide {{ $estadoServicioClasses }}">
                                        {{ $estadoServicio }}
                                    </span>
                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>

            @else

                <p class="text-sm text-ink-500">
                    Esta cita no tiene servicios asociados.
                </p>

            @endif

        </div>

    </div>

    <div class="rounded-panel border border-cream-200 bg-white p-6 shadow-card">

        <h3 class="font-display text-2xl font-bold text-navy">
            Observaciones
        </h3>

        <p class="mt-3 rounded-card bg-cream-50 p-5 text-sm leading-6 text-ink-600">
            {{ $cita->observaciones ?? 'Sin observaciones registradas.' }}
        </p>

    </div>

</section>

@endsection