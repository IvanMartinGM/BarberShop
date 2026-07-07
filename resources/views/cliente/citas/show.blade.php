@extends('layouts.guest')

@section('title', 'Detalle de cita - BarberShop')

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

<section class="bg-cream py-12 md:py-16">

    <div class="mx-auto max-w-5xl px-4 sm:px-6">

        <!-- Header -->
        <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="font-display text-4xl font-bold text-navy">
                    Detalle de cita
                </h1>

                <p class="mt-2 text-sm text-ink-600">
                    Revisa la información completa de tu cita.
                </p>
            </div>

            <a href="{{ route('cliente.citas.index') }}" class="inline-flex items-center justify-center rounded-panel border border-cream-300 bg-white px-5 py-3 text-sm font-bold text-navy hover:bg-cream-100 transition-colors">
                Volver a mis citas
            </a>
        </div>

        @if (session('error'))
        <div class="mb-6 rounded-card border border-danger bg-danger-light px-5 py-4 text-sm font-semibold text-danger">
            {{ session('error') }}
        </div>
        @endif

        <div class="overflow-hidden rounded-panel border border-cream-200 bg-white shadow-panel">

            <div class="bg-linear-to-r from-navy via-navy-800 to-barber-red px-6 py-8 text-white">

                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                    <div>
                        <p class="text-sm font-semibold text-cream-100">
                            Cita #{{ $cita->id }}
                        </p>

                        <h2 class="mt-2 font-display text-3xl font-bold">
                            {{ $cita->fecha_cita?->format('d/m/Y') }}
                            —
                            {{ $cita->hora_inicio }} a {{ $cita->hora_fin }}
                        </h2>
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

                    <p class="mt-2 font-semibold text-ink">
                        {{ $cliente->user?->getFullName() ?? 'Cliente' }}
                    </p>
                </div>

                <div class="rounded-card border border-cream-200 bg-cream-50 p-5">
                    <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                        Barbero
                    </p>

                    <p class="mt-2 font-semibold text-ink">
                        {{ $cita->barbero?->user?->getFullName() ?? 'Barbero no disponible' }}
                    </p>
                </div>

                <div class="rounded-card border border-cream-200 bg-cream-50 p-5">
                    <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                        Fecha
                    </p>

                    <p class="mt-2 font-semibold text-ink">
                        {{ $cita->fecha_cita?->format('d/m/Y') }}
                    </p>
                </div>

                <div class="rounded-card border border-cream-200 bg-cream-50 p-5">
                    <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                        Horario
                    </p>

                    <p class="mt-2 font-semibold text-ink">
                        {{ $cita->hora_inicio }} a {{ $cita->hora_fin }}
                    </p>
                </div>

            </div>

            <div class="border-t border-cream-200 p-6">

                <h3 class="font-display text-2xl font-bold text-navy">
                    Servicios
                </h3>

                <div class="mt-5 space-y-4">

                    @foreach ($cita->servicios as $servicio)

                    <div class="rounded-card border border-cream-200 bg-cream-50 p-5">

                        <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">

                            <div>
                                <h4 class="font-display text-xl font-bold text-navy">
                                    {{ $servicio->nombre_servicio }}
                                </h4>

                                <p class="mt-1 text-sm text-ink-600">
                                    {{ $servicio->descripcion ?? 'Sin descripción registrada.' }}
                                </p>
                            </div>

                            <div class="text-left sm:text-right">
                                <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                                    Precio aplicado
                                </p>

                                <p class="mt-1 font-bold text-ink">
                                    ${{ number_format($servicio->citas_servicios->precio_aplicado ?? 0, 2) }}
                                </p>
                            </div>

                        </div>
                        @php
                        $estadoServicio = $servicio->citas_servicios->estado_servicio ?? 'pendiente';

                        $estadoServicioClasses = match ($estadoServicio) {
                        'pendiente' => 'bg-warning-light text-warning border-warning',
                        'realizado' => 'bg-success-light text-success border-success',
                        'cancelado' => 'bg-danger-light text-danger border-danger',
                        default => 'bg-cream-100 text-ink-600 border-cream-300',
                        };
                        @endphp

                        <div class="mt-4 grid grid-cols-1 gap-3 sm:grid-cols-2">

                            <div class="rounded-card bg-white px-4 py-3 shadow-card">
                                <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                                    Estado del servicio
                                </p>

                                <span class="mt-2 inline-flex rounded-full border px-3 py-1 text-xs font-bold uppercase tracking-wide {{ $estadoServicioClasses }}">
                                    {{ $estadoServicio }}
                                </span>
                            </div>

                            <div class="rounded-card bg-white px-4 py-3 shadow-card">
                                <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                                    Precio aplicado
                                </p>

                                <p class="mt-1 font-semibold text-ink">
                                    ${{ number_format($servicio->citas_servicios->precio_aplicado ?? 0, 2) }}
                                </p>
                            </div>

                        </div>

                    </div>

                    @endforeach

                </div>

            </div>

            @if ($cita->observaciones)
            <div class="border-t border-cream-200 p-6">

                <h3 class="font-display text-2xl font-bold text-navy">
                    Observaciones
                </h3>

                <p class="mt-3 rounded-card bg-cream-50 p-5 text-sm leading-6 text-ink-600">
                    {{ $cita->observaciones }}
                </p>

            </div>
            @endif

            <div class="flex flex-col gap-3 border-t border-cream-200 bg-cream-50 px-6 py-5 sm:flex-row sm:justify-between">

                <a href="{{ route('cliente.citas.index') }}" class="inline-flex items-center justify-center rounded-panel border border-cream-300 bg-white px-5 py-3 text-sm font-bold text-navy hover:bg-cream-100 transition-colors">
                    Volver
                </a>

                @if (!in_array($cita->estado_cita, ['completada', 'cancelada']))
                <form method="POST" action="{{ route('cliente.citas.cancel', $cita->id) }}" onsubmit="return confirm('¿Seguro que deseas cancelar esta cita?');">
                    @csrf
                    @method('PATCH')

                    <button type="submit" class="inline-flex w-full items-center justify-center rounded-panel bg-danger px-5 py-3 text-sm font-bold text-white hover:bg-barber-red-700 transition-colors">
                        Cancelar cita
                    </button>
                </form>
                @endif

            </div>

        </div>

    </div>

</section>

@endsection
