@extends('layouts.admin')

@section('title', 'Detalle de pago - Panel Administrativo')
@section('page-title', 'Detalle de pago')

@section('content')

@php
    $estadoClasses = match ($pago->estado_pago) {
        'pagado' => 'bg-success-light text-success border-success',
        'pendiente' => 'bg-warning-light text-warning border-warning',
        'cancelado' => 'bg-danger-light text-danger border-danger',
        default => 'bg-cream-100 text-ink-600 border-cream-300',
    };
@endphp

<section class="space-y-6">

    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="font-display text-3xl font-bold text-navy">
                Pago #{{ $pago->id }}
            </h2>

            <p class="mt-2 text-sm text-ink-600">
                Detalle del pago registrado para la cita #{{ $pago->cita?->id }}.
            </p>
        </div>

        <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
            <a href="{{ route('administrador.citas.show', $pago->cita?->id) }}"
               class="inline-flex items-center justify-center rounded-panel bg-navy px-5 py-3 text-sm font-bold text-white shadow-card hover:bg-navy-800 transition-colors">
                Ver cita
            </a>

            <a href="{{ route('administrador.pagos.index') }}"
               class="inline-flex items-center justify-center rounded-panel border border-cream-300 bg-white px-5 py-3 text-sm font-bold text-navy hover:bg-cream-100 transition-colors">
                Volver a pagos
            </a>
        </div>
    </div>

    @if (session('status'))
        <div class="rounded-card border border-success bg-success-light px-5 py-4 text-sm font-semibold text-success">
            {{ session('status') }}
        </div>
    @endif

    <div class="overflow-hidden rounded-panel border border-cream-200 bg-white shadow-panel">

        <div class="bg-linear-to-r from-navy via-navy-800 to-success px-6 py-8 text-white">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm font-semibold text-cream-100">
                        Monto pagado
                    </p>

                    <h3 class="mt-2 font-display text-5xl font-bold">
                        ${{ number_format($pago->monto, 2) }}
                    </h3>
                </div>

                <span class="inline-flex w-fit rounded-full border bg-white px-4 py-2 text-xs font-bold uppercase tracking-wide {{ $estadoClasses }}">
                    {{ $pago->estado_pago }}
                </span>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 p-6 md:grid-cols-2">

            <div class="rounded-card border border-cream-200 bg-cream-50 p-5">
                <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                    Cliente
                </p>

                <p class="mt-2 font-display text-xl font-bold text-navy">
                    {{ $pago->cita?->cliente?->user?->getFullName() ?? 'Cliente no disponible' }}
                </p>

                <p class="mt-1 text-sm text-ink-600">
                    {{ $pago->cita?->cliente?->user?->email ?? 'Sin correo' }}
                </p>
            </div>

            <div class="rounded-card border border-cream-200 bg-cream-50 p-5">
                <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                    Barbero
                </p>

                <p class="mt-2 font-display text-xl font-bold text-navy">
                    {{ $pago->cita?->barbero?->user?->getFullName() ?? 'Barbero no disponible' }}
                </p>

                <p class="mt-1 text-sm text-ink-600">
                    {{ $pago->cita?->barbero?->especialidad ?? 'Sin especialidad' }}
                </p>
            </div>

            <div class="rounded-card border border-cream-200 bg-cream-50 p-5">
                <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                    Método de pago
                </p>

                <p class="mt-2 font-semibold text-ink">
                    {{ ucfirst($pago->metodoPago?->nombre_metodo ?? 'No disponible') }}
                </p>
            </div>

            <div class="rounded-card border border-cream-200 bg-cream-50 p-5">
                <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                    Fecha de pago
                </p>

                <p class="mt-2 font-semibold text-ink">
                    {{ $pago->fecha_pago?->format('d/m/Y H:i') ?? 'Sin fecha' }}
                </p>
            </div>

            <div class="rounded-card border border-cream-200 bg-cream-50 p-5">
                <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                    Referencia
                </p>

                <p class="mt-2 font-semibold text-ink">
                    {{ $pago->referencia_transaccion ?? 'Sin referencia' }}
                </p>
            </div>

            <div class="rounded-card border border-cream-200 bg-cream-50 p-5">
                <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                    Cita relacionada
                </p>

                <p class="mt-2 font-semibold text-ink">
                    Cita #{{ $pago->cita?->id ?? 'N/D' }}
                </p>
            </div>

        </div>

    </div>

    <div class="overflow-hidden rounded-panel border border-cream-200 bg-white shadow-panel">

        <div class="border-b border-cream-200 px-6 py-5">
            <h3 class="font-display text-2xl font-bold text-navy">
                Servicios pagados
            </h3>
        </div>

        <div class="p-6">

            @if ($pago->cita?->servicios?->count() > 0)

                <div class="space-y-4">
                    @foreach ($pago->cita->servicios as $servicio)
                        <div class="flex flex-col gap-3 rounded-card border border-cream-200 bg-cream-50 p-5 sm:flex-row sm:items-center sm:justify-between">
                            <div>
                                <h4 class="font-display text-xl font-bold text-navy">
                                    {{ $servicio->nombre_servicio }}
                                </h4>

                                <p class="mt-1 text-sm text-ink-600">
                                    Estado: {{ $servicio->citas_servicios->estado_servicio ?? 'pendiente' }}
                                </p>
                            </div>

                            <p class="font-display text-2xl font-bold text-success">
                                ${{ number_format($servicio->citas_servicios->precio_aplicado ?? 0, 2) }}
                            </p>
                        </div>
                    @endforeach
                </div>

            @else

                <p class="text-sm text-ink-500">
                    No hay servicios asociados a esta cita.
                </p>

            @endif

        </div>

    </div>

    <div class="rounded-panel border border-cream-200 bg-white p-6 shadow-card">
        <h3 class="font-display text-2xl font-bold text-navy">
            Concepto
        </h3>

        <p class="mt-3 rounded-card bg-cream-50 p-5 text-sm leading-6 text-ink-600">
            {{ $pago->concepto ?? 'Sin concepto registrado.' }}
        </p>
    </div>

</section>

@endsection