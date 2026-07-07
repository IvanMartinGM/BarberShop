@extends('layouts.admin')

@section('title', 'Detalle de cita - Panel Administrativo')
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

    <!-- Header -->
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>
            <h2 class="font-display text-3xl font-bold text-navy">
                Cita #{{ $cita->id }}
            </h2>

            <p class="mt-2 text-sm text-ink-600">
                Consulta la información completa de la cita y actualiza su estado.
            </p>
        </div>
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center">

            @if ($cita->estado_cita === 'completada' && !$cita->pago)
            <a href="{{ route('administrador.pagos.create', ['cita' => $cita->id]) }}" class="inline-flex items-center justify-center rounded-panel bg-success px-5 py-3 text-sm font-bold text-white shadow-card hover:bg-success/90 transition-colors">
                Generar pago
            </a>
            @endif

            @if ($cita->pago)
            <a href="{{ route('administrador.pagos.show', $cita->pago->id) }}" class="inline-flex items-center justify-center rounded-panel bg-navy px-5 py-3 text-sm font-bold text-white shadow-card hover:bg-navy-800 transition-colors">
                Ver pago
            </a>
            @endif

            <a href="{{ route('administrador.citas.index') }}" class="inline-flex items-center justify-center rounded-panel border border-cream-300 bg-white px-5 py-3 text-sm font-bold text-navy hover:bg-cream-100 transition-colors">
                Volver al listado
            </a>

        </div>

    </div>

    <!-- Mensajes -->
    @if (session('status'))
    <div class="rounded-card border border-success bg-success-light px-5 py-4 text-sm font-semibold text-success">
        {{ session('status') }}
    </div>
    @endif

    @if (session('error'))
    <div class="rounded-card border border-danger bg-danger-light px-5 py-4 text-sm font-semibold text-danger">
        {{ session('error') }}
    </div>
    @endif

    @if ($errors->any())
    <div class="rounded-card border border-danger bg-danger-light px-5 py-4 text-sm text-danger">
        <p class="mb-2 font-bold">
            Hay errores en el formulario:
        </p>

        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
            <li>
                {{ $error }}
            </li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Resumen principal -->
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

            <!-- Cliente -->
            <div class="rounded-card border border-cream-200 bg-cream-50 p-5">

                <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                    Cliente
                </p>

                <p class="mt-2 font-display text-xl font-bold text-navy">
                    {{ $cita->cliente?->user?->getFullName() ?? 'Cliente no disponible' }}
                </p>

                <div class="mt-4 space-y-1 text-sm text-ink-600">
                    <p>
                        <span class="font-bold">Correo:</span>
                        {{ $cita->cliente?->user?->email ?? 'No disponible' }}
                    </p>

                    <p>
                        <span class="font-bold">Celular:</span>
                        {{ $cita->cliente?->user?->celular ?? 'No registrado' }}
                    </p>
                </div>

            </div>

            <!-- Barbero -->
            <div class="rounded-card border border-cream-200 bg-cream-50 p-5">

                <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                    Barbero
                </p>

                <p class="mt-2 font-display text-xl font-bold text-navy">
                    {{ $cita->barbero?->user?->getFullName() ?? 'Barbero no disponible' }}
                </p>

                <div class="mt-4 space-y-1 text-sm text-ink-600">
                    <p>
                        <span class="font-bold">Especialidad:</span>
                        {{ $cita->barbero?->especialidad ?? 'No registrada' }}
                    </p>

                    <p>
                        <span class="font-bold">Estado:</span>
                        {{ $cita->barbero?->estado_disponibilidad ?? 'No disponible' }}
                    </p>
                </div>

            </div>

            <!-- Datos de cita -->
            <div class="rounded-card border border-cream-200 bg-cream-50 p-5">

                <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                    Datos de la cita
                </p>

                <div class="mt-4 space-y-2 text-sm text-ink-600">

                    <p>
                        <span class="font-bold">Fecha:</span>
                        {{ $cita->fecha_cita?->format('d/m/Y') }}
                    </p>

                    <p>
                        <span class="font-bold">Inicio:</span>
                        {{ $cita->hora_inicio }}
                    </p>

                    <p>
                        <span class="font-bold">Fin:</span>
                        {{ $cita->hora_fin }}
                    </p>

                    <p>
                        <span class="font-bold">Estado actual:</span>
                        {{ $cita->estado_cita }}
                    </p>

                </div>

            </div>

            <!-- Cambiar estado -->
            <div class="rounded-card border border-cream-200 bg-cream-50 p-5">

                <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                    Actualizar estado
                </p>

                @if (in_array($cita->estado_cita, ['completada', 'cancelada']))

                <div class="mt-4 rounded-card border border-warning bg-warning-light px-4 py-3 text-sm font-semibold text-warning">
                    Esta cita ya está {{ $cita->estado_cita }} y no puede modificarse.
                </div>

                @else

                <form method="POST" action="{{ route('administrador.citas.estado.update', $cita->id) }}" class="mt-4 space-y-4">
                    @csrf
                    @method('PATCH')

                    <div>
                        <label for="estado_cita" class="mb-2 block text-sm font-bold text-navy">
                            Nuevo estado
                        </label>

                        <select name="estado_cita" id="estado_cita" required class="w-full rounded-card border border-cream-300 bg-white px-4 py-3 text-ink shadow-sm focus:border-barber-red focus:outline-none focus:ring-4 focus:ring-barber-red-100">

                            <option value="pendiente" {{ $cita->estado_cita === 'pendiente' ? 'selected' : '' }}>
                                Pendiente
                            </option>

                            <option value="confirmada" {{ $cita->estado_cita === 'confirmada' ? 'selected' : '' }}>
                                Confirmada
                            </option>

                            <option value="completada" {{ $cita->estado_cita === 'completada' ? 'selected' : '' }}>
                                Completada
                            </option>

                            <option value="cancelada" {{ $cita->estado_cita === 'cancelada' ? 'selected' : '' }}>
                                Cancelada
                            </option>

                        </select>
                    </div>

                    <button type="submit" class="inline-flex w-full items-center justify-center rounded-panel bg-barber-red px-5 py-3 text-sm font-bold text-white shadow-card hover:bg-barber-red-700 focus:outline-none focus:ring-4 focus:ring-barber-red-100 transition-colors">
                        Guardar estado
                    </button>

                </form>

                @endif

            </div>

        </div>

    </div>

    <!-- Servicios -->
    <div class="overflow-hidden rounded-panel border border-cream-200 bg-white shadow-panel">

        <div class="border-b border-cream-200 px-6 py-5">

            <h3 class="font-display text-2xl font-bold text-navy">
                Servicios de la cita
            </h3>

            <p class="mt-1 text-sm text-ink-500">
                Servicios solicitados por el cliente.
            </p>

        </div>

        <div class="p-6">

            @if ($cita->servicios->count() > 0)

            <div class="space-y-4">

                @foreach ($cita->servicios as $servicio)

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
                                Precio aplicado
                            </p>

                            <p class="mt-1 font-display text-2xl font-bold text-navy">
                                ${{ number_format($servicio->citas_servicios->precio_aplicado ?? 0, 2) }}
                            </p>
                        </div>

                    </div>
                    @php
                    $estadoServicioClasses = match ($servicio->citas_servicios->estado_servicio ?? 'pendiente') {
                    'pendiente' => 'bg-warning-light text-warning border-warning',
                    'realizado' => 'bg-success-light text-success border-success',
                    'cancelado' => 'bg-danger-light text-danger border-danger',
                    default => 'bg-cream-100 text-ink-600 border-cream-300',
                    };
                    @endphp

                    <div class="mt-5 grid grid-cols-1 gap-3 sm:grid-cols-2">

                        <div class="rounded-card bg-white px-4 py-3 shadow-card">
                            <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                                Estado del servicio
                            </p>

                            <span class="mt-2 inline-flex rounded-full border px-3 py-1 text-xs font-bold uppercase tracking-wide {{ $estadoServicioClasses }}">
                                {{ $servicio->citas_servicios->estado_servicio ?? 'pendiente' }}
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

                    @if ($servicio->citas_servicios->observaciones_servicio)
                    <div class="mt-5 rounded-card border border-cream-200 bg-white p-4">
                        <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                            Observaciones del servicio
                        </p>

                        <p class="mt-1 text-sm text-ink-600">
                            {{ $servicio->citas_servicios->observaciones_servicio }}
                        </p>
                    </div>
                    @endif

                </div>

                @endforeach

            </div>

            @else

            <div class="rounded-card border border-warning bg-warning-light px-5 py-8 text-center">
                <h4 class="font-display text-2xl font-bold text-warning">
                    Esta cita no tiene servicios asociados
                </h4>

                <p class="mt-2 text-sm font-medium text-ink-700">
                    Revisa la información de la cita o la tabla intermedia de servicios.
                </p>
            </div>

            @endif

        </div>

    </div>

    <!-- Observaciones -->
    <div class="rounded-panel border border-cream-200 bg-white p-6 shadow-card">

        <h3 class="font-display text-2xl font-bold text-navy">
            Observaciones
        </h3>

        @if ($cita->observaciones)
        <p class="mt-3 rounded-card bg-cream-50 p-5 text-sm leading-6 text-ink-600">
            {{ $cita->observaciones }}
        </p>
        @else
        <p class="mt-3 text-sm text-ink-500">
            Esta cita no tiene observaciones registradas.
        </p>
        @endif

    </div>

</section>

@endsection
