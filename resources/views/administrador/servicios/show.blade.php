@extends('layouts.admin')

@section('title', 'Detalle del servicio - BarberShop')
@section('page-title', 'Detalle del servicio')

@section('content')

@php
$imagenServicio = $servicio->imagen_servicio;

$imagenServicioUrl = $imagenServicio && str_starts_with($imagenServicio, 'service_images/')
? asset('storage/' . $imagenServicio)
: null;
@endphp

<section class="space-y-6">

    <!-- Header interno -->
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>
            <h2 class="font-display text-3xl font-bold text-navy">
                Detalle del servicio
            </h2>

            <p class="mt-2 text-sm text-ink-600">
                Consulta la información administrativa del servicio dentro del catálogo.
            </p>
        </div>

        <div class="flex flex-col sm:flex-row gap-3">

            <a href="{{ route('servicio.index') }}" class="inline-flex items-center justify-center rounded-panel border border-cream-300 bg-white px-5 py-3 text-sm font-bold text-navy hover:bg-cream-100 transition-colors">
                Volver
            </a>

            <a href="{{ route('servicio.edit', $servicio->id) }}" class="inline-flex items-center justify-center rounded-panel bg-barber-red px-5 py-3 text-sm font-bold text-white hover:bg-barber-red-700 transition-colors">
                Editar servicio
            </a>

        </div>

    </div>

    <!-- Layout principal -->
    <div class="grid grid-cols-1 xl:grid-cols-[360px_minmax(0,1fr)] gap-6">

        <!-- Card perfil -->
        <aside class="rounded-panel border border-cream-200 bg-white shadow-card overflow-hidden">

            <div class="bg-navy px-6 py-8 text-center">

                <div class="mx-auto h-40 w-full max-w-64 overflow-hidden rounded-panel bg-white p-2 shadow-panel ring-4 ring-cream-100">
                    @if ($imagenServicioUrl)
                    <img src="{{ $imagenServicioUrl }}" alt="Imagen de {{ $servicio->nombre_servicio }}" class="h-full w-full rounded-card object-cover">
                    @else
                    <div class="flex h-full w-full items-center justify-center rounded-card bg-barber-red text-6xl font-bold text-white">
                        ✂
                    </div>
                    @endif
                </div>

                <h3 class="mt-4 font-display text-2xl font-bold text-white">
                    {{ $servicio->nombre_servicio }}
                </h3>

                <p class="mt-1 text-sm text-cream-200">
                    {{ $servicio->categoria ?? 'Servicio sin categoría' }}
                </p>

            </div>

            <div class="p-6 space-y-5">

                <!-- Estado -->
                <div>
                    <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                        Estado
                    </p>

                    <div class="mt-2">
                        @if ($servicio->estado == 1)
                        <span class="inline-flex rounded-full bg-success-light px-3 py-1 text-xs font-bold text-success">
                            Activo
                        </span>
                        @else
                        <span class="inline-flex rounded-full bg-danger-light px-3 py-1 text-xs font-bold text-danger">
                            Inactivo
                        </span>
                        @endif
                    </div>
                </div>

                <!-- Categoría -->
                <div class="border-t border-cream-200 pt-5">
                    <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                        Categoría
                    </p>

                    <p class="mt-1 text-sm font-medium text-ink">
                        {{ $servicio->categoria ?? 'No registrada' }}
                    </p>
                </div>

                <!-- Precio -->
                <div class="border-t border-cream-200 pt-5">
                    <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                        Precio base
                    </p>

                    <p class="mt-1 font-display text-3xl font-bold text-navy">
                        ${{ number_format((float) $servicio->precio_base, 2) }}
                    </p>
                </div>

                <!-- Duración -->
                <div class="border-t border-cream-200 pt-5">
                    <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                        Duración estimada
                    </p>

                    <p class="mt-1 text-sm font-medium text-ink">
                        {{ $servicio->duracion_minutos }} minutos
                    </p>
                </div>

            </div>

        </aside>

        <!-- Información principal -->
        <div class="space-y-6">

            <!-- Información del sistema -->
            <div class="rounded-panel border border-cream-200 bg-white shadow-card">

                <div class="border-b border-cream-200 px-6 py-5">
                    <h3 class="font-display text-xl font-bold text-navy">
                        Información del sistema
                    </h3>

                    <p class="mt-1 text-sm text-ink-500">
                        Identificadores internos y datos administrativos del servicio.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5 p-6">

                    <div class="rounded-card bg-cream-50 px-4 py-4">
                        <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                            ID servicio
                        </p>

                        <p class="mt-1 font-semibold text-ink">
                            {{ $servicio->id }}
                        </p>
                    </div>

                    <div class="rounded-card bg-cream-50 px-4 py-4">
                        <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                            Creado el
                        </p>

                        <p class="mt-1 font-semibold text-ink">
                            {{ $servicio->created_at ? $servicio->created_at->format('d/m/Y H:i') : 'No registrado' }}
                        </p>
                    </div>

                    <div class="rounded-card bg-cream-50 px-4 py-4">
                        <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                            Actualizado el
                        </p>

                        <p class="mt-1 font-semibold text-ink">
                            {{ $servicio->updated_at ? $servicio->updated_at->format('d/m/Y H:i') : 'No registrado' }}
                        </p>
                    </div>

                    <div class="rounded-card bg-cream-50 px-4 py-4">
                        <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                            Estado actual
                        </p>

                        <p class="mt-1 font-semibold">
                            @if ($servicio->estado == 1)
                            <span class="text-success">
                                Activo
                            </span>
                            @else
                            <span class="text-danger">
                                Inactivo
                            </span>
                            @endif
                        </p>
                    </div>

                </div>

            </div>

            <!-- Información del servicio -->
            <div class="rounded-panel border border-cream-200 bg-white shadow-card">

                <div class="border-b border-cream-200 px-6 py-5">
                    <h3 class="font-display text-xl font-bold text-navy">
                        Información del servicio
                    </h3>

                    <p class="mt-1 text-sm text-ink-500">
                        Datos principales del servicio dentro del catálogo.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5 p-6">

                    <div class="rounded-card bg-cream-50 px-4 py-4 md:col-span-2">
                        <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                            Nombre del servicio
                        </p>

                        <p class="mt-1 font-semibold text-ink">
                            {{ $servicio->nombre_servicio }}
                        </p>
                    </div>

                    <div class="rounded-card bg-cream-50 px-4 py-4">
                        <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                            Precio base
                        </p>

                        <p class="mt-1 font-semibold text-ink">
                            ${{ number_format((float) $servicio->precio_base, 2) }}
                        </p>
                    </div>

                    <div class="rounded-card bg-cream-50 px-4 py-4">
                        <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                            Duración
                        </p>

                        <p class="mt-1 font-semibold text-ink">
                            {{ $servicio->duracion_minutos }} minutos
                        </p>
                    </div>

                    <div class="rounded-card bg-cream-50 px-4 py-4">
                        <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                            Categoría
                        </p>

                        <p class="mt-1 font-semibold text-ink">
                            {{ $servicio->categoria ?? 'No registrada' }}
                        </p>
                    </div>

                    <div class="rounded-card bg-cream-50 px-4 py-4">
                        <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                            Elegible para barberos
                        </p>

                        <p class="mt-1 font-semibold text-ink">
                            @if ($servicio->estado == 1)
                            Sí
                            @else
                            No
                            @endif
                        </p>
                    </div>

                    <div class="rounded-card bg-cream-50 px-4 py-4">
                        <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                            Barberos asignados
                        </p>

                        <p class="mt-1 font-semibold text-ink">
                            {{ $servicio->barberos->count() }}
                        </p>
                    </div>

                </div>

            </div>

            <!-- Barberos que ofrecen este servicio -->
            <div class="rounded-panel border border-cream-200 bg-white shadow-card overflow-hidden">

                <div class="border-b border-cream-200 px-6 py-5">
                    <h3 class="font-display text-xl font-bold text-navy">
                        Barberos que ofrecen este servicio
                    </h3>

                    <p class="mt-1 text-sm text-ink-500">
                        Barberos que tienen este servicio asignado en su catálogo personal.
                    </p>
                </div>

                <div class="divide-y divide-cream-200">

                    @forelse ($servicio->barberos as $barbero)

                    <div class="flex flex-col gap-4 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">

                        <div class="flex items-center gap-3">

                            <div class="flex h-11 w-11 items-center justify-center rounded-full bg-navy text-white font-bold shadow-card">
                                {{ strtoupper(substr($barbero->user?->nombres ?? 'B', 0, 1)) }}
                            </div>

                            <div>
                                <p class="font-bold text-ink">
                                    {{ $barbero->user?->nombres ?? 'Sin nombre' }}
                                    {{ $barbero->user?->primer_apellido ?? '' }}
                                </p>

                                <p class="text-xs text-ink-500">
                                    {{ $barbero->especialidad ?? 'Sin especialidad registrada' }}
                                </p>
                            </div>

                        </div>

                        <div class="flex items-center gap-2">

                            @if ($barbero->barberos_servicios?->estado == 1)
                            <span class="rounded-full bg-success-light px-3 py-1 text-xs font-bold text-success">
                                Asignación activa
                            </span>
                            @else
                            <span class="rounded-full bg-danger-light px-3 py-1 text-xs font-bold text-danger">
                                Asignación inactiva
                            </span>
                            @endif

                            <a href="{{ route('barbero.show', $barbero->id) }}" class="inline-flex items-center justify-center rounded-card border border-cream-300 bg-white px-4 py-2 text-sm font-bold text-navy hover:bg-navy hover:text-white transition-colors">
                                Ver barbero
                            </a>

                        </div>

                    </div>

                    @empty

                    <div class="px-6 py-10 text-center">
                        <h4 class="font-display text-xl font-bold text-navy">
                            Sin barberos asignados
                        </h4>

                        <p class="mt-2 text-sm text-ink-600">
                            Cuando un barbero seleccione este servicio, aparecerá en esta sección.
                        </p>
                    </div>

                    @endforelse

                </div>

            </div>

            <!-- Descripción -->
            <div class="rounded-panel border border-cream-200 bg-white shadow-card">

                <div class="border-b border-cream-200 px-6 py-5">
                    <h3 class="font-display text-xl font-bold text-navy">
                        Descripción
                    </h3>

                    <p class="mt-1 text-sm text-ink-500">
                        Detalle de lo que incluye este servicio.
                    </p>
                </div>

                <div class="p-6">
                    <p class="leading-7 text-ink-700">
                        {{ $servicio->descripcion ?? 'Este servicio aún no tiene una descripción registrada.' }}
                    </p>
                </div>

            </div>

        </div>

    </div>

</section>

@endsection
