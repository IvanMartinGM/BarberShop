@extends('layouts.admin')

@section('title', 'Asignar servicios - BarberShop')
@section('page-title', 'Asignar servicios')

@section('content')

<section class="max-w-6xl mx-auto space-y-6">

    <!-- Header interno -->
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>
            <h2 class="font-display text-3xl font-bold text-navy">
                Asignar servicios
            </h2>

            <p class="mt-2 text-sm text-ink-600">
                Selecciona los servicios que este barbero puede realizar dentro de la barbería.
            </p>
        </div>

        <a href="{{ route('barbero.show', $barbero->id) }}"
           class="inline-flex items-center justify-center rounded-panel border border-cream-300 bg-white px-5 py-3 text-sm font-bold text-navy hover:bg-cream-100 transition-colors">
            Volver al perfil
        </a>

    </div>

    <!-- Card del barbero -->
    <div class="rounded-panel border border-cream-200 bg-white p-6 shadow-card">

        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div class="flex items-center gap-4">

                <div class="flex h-16 w-16 items-center justify-center rounded-full bg-navy text-xl font-bold text-white shadow-card">
                    {{ strtoupper(substr($barbero->user?->nombres ?? 'B', 0, 1)) }}
                </div>

                <div>
                    <h3 class="font-display text-2xl font-bold text-navy">
                        {{ $barbero->user?->nombres ?? 'Sin nombre' }}
                        {{ $barbero->user?->primer_apellido ?? '' }}
                        {{ $barbero->user?->segundo_apellido ?? '' }}
                    </h3>

                    <p class="mt-1 text-sm text-ink-600">
                        {{ $barbero->especialidad ?? 'Sin especialidad registrada' }}
                    </p>
                </div>

            </div>

            <div>
                @if ($barbero->estado_disponibilidad === 'disponible')
                    <span class="inline-flex rounded-full bg-success-light px-4 py-2 text-sm font-bold text-success">
                        Disponible
                    </span>
                @elseif ($barbero->estado_disponibilidad === 'ocupado')
                    <span class="inline-flex rounded-full bg-warning-light px-4 py-2 text-sm font-bold text-warning">
                        Ocupado
                    </span>
                @else
                    <span class="inline-flex rounded-full bg-danger-light px-4 py-2 text-sm font-bold text-danger">
                        Inactivo
                    </span>
                @endif
            </div>

        </div>

    </div>

    <!-- Servicios actualmente asignados -->
    <div class="rounded-panel border border-cream-200 bg-white shadow-card overflow-hidden">

        <div class="border-b border-cream-200 px-6 py-5">
            <h3 class="font-display text-xl font-bold text-navy">
                Servicios asociados actualmente
            </h3>

            <p class="mt-1 text-sm text-ink-500">
                Estos son los servicios que el barbero tiene asignados en este momento.
            </p>
        </div>

        <div class="p-6">

            @if ($barbero->servicios->count() > 0)

                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">

                    @foreach ($barbero->servicios as $servicioAsignado)

                        <article class="rounded-card border border-cream-200 bg-cream-50 px-5 py-4">

                            <div class="flex items-start justify-between gap-3">

                                <div>
                                    <h4 class="font-display text-lg font-bold text-navy">
                                        {{ $servicioAsignado->nombre_servicio }}
                                    </h4>

                                    <p class="mt-1 text-sm text-ink-600">
                                        {{ $servicioAsignado->categoria ?? 'Sin categoría' }}
                                    </p>
                                </div>

                                <span class="inline-flex rounded-full bg-success-light px-3 py-1 text-xs font-bold text-success">
                                    Asignado
                                </span>

                            </div>

                            <div class="mt-4 grid grid-cols-2 gap-3">

                                <div class="rounded-card bg-white px-4 py-3 shadow-card">
                                    <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                                        Precio
                                    </p>

                                    <p class="mt-1 font-semibold text-ink">
                                        ${{ number_format($servicioAsignado->precio_base ?? 0, 2) }}
                                    </p>
                                </div>

                                <div class="rounded-card bg-white px-4 py-3 shadow-card">
                                    <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                                        Duración
                                    </p>

                                    <p class="mt-1 font-semibold text-ink">
                                        {{ $servicioAsignado->duracion_minutos ?? 0 }} min
                                    </p>
                                </div>

                            </div>

                        </article>

                    @endforeach

                </div>

            @else

                <div class="rounded-card border border-warning bg-warning-light px-5 py-8 text-center">

                    <h4 class="font-display text-2xl font-bold text-warning">
                        Sin servicios asociados
                    </h4>

                    <p class="mt-2 text-sm font-medium text-ink-700">
                        Este barbero todavía no tiene servicios asignados.
                        Selecciona uno o varios servicios disponibles y guarda los cambios.
                    </p>

                </div>

            @endif

        </div>

    </div>

    <!-- Formulario -->
    <div class="rounded-panel border border-cream-200 bg-white shadow-card overflow-hidden">

        <form method="POST" action="{{ route('barbero.servicios.update', $barbero->id) }}">
            @csrf
            @method('PATCH')

            <div class="border-b border-cream-200 px-6 py-5">
                <h3 class="font-display text-xl font-bold text-navy">
                    Servicios disponibles
                </h3>

                <p class="mt-1 text-sm text-ink-500">
                    Puedes asignar uno o varios servicios al barbero.
                </p>
            </div>

            <div class="p-6">

                @php
                    $serviciosAsignados = collect(
                        old('servicios', $barbero->servicios->pluck('id')->toArray())
                    )->map(fn ($id) => (int) $id)->toArray();
                @endphp

                @if ($servicios->count() > 0)

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">

                        @foreach ($servicios as $servicio)

                            <label class="block cursor-pointer">

                                <input
                                    type="checkbox"
                                    name="servicios[]"
                                    value="{{ $servicio->id }}"
                                    {{ in_array($servicio->id, $serviciosAsignados) ? 'checked' : '' }}
                                    class="peer sr-only"
                                >

                                <article class="rounded-panel border border-cream-200 bg-cream-50 p-5 transition-all hover:border-barber-red hover:bg-barber-red-50 peer-checked:border-barber-red peer-checked:bg-barber-red-50 peer-checked:shadow-panel">

                                    <div class="flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">

                                        <div>
                                            <h4 class="font-display text-xl font-bold text-navy">
                                                {{ $servicio->nombre_servicio }}
                                            </h4>

                                            <p class="mt-1 text-sm text-ink-600">
                                                {{ $servicio->descripcion ?? 'Sin descripción registrada.' }}
                                            </p>
                                        </div>

                                        <span class="inline-flex w-fit rounded-full bg-success-light px-3 py-1 text-xs font-bold text-success">
                                            Activo
                                        </span>

                                    </div>

                                    <div class="mt-5 grid grid-cols-1 sm:grid-cols-3 gap-3">

                                        <div class="rounded-card bg-white px-4 py-3 shadow-card">
                                            <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                                                Categoría
                                            </p>

                                            <p class="mt-1 font-semibold text-ink">
                                                {{ $servicio->categoria ?? 'Sin categoría' }}
                                            </p>
                                        </div>

                                        <div class="rounded-card bg-white px-4 py-3 shadow-card">
                                            <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                                                Precio base
                                            </p>

                                            <p class="mt-1 font-semibold text-ink">
                                                ${{ number_format($servicio->precio_base ?? 0, 2) }}
                                            </p>
                                        </div>

                                        <div class="rounded-card bg-white px-4 py-3 shadow-card">
                                            <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                                                Duración
                                            </p>

                                            <p class="mt-1 font-semibold text-ink">
                                                {{ $servicio->duracion_minutos ?? 0 }} min
                                            </p>
                                        </div>

                                    </div>

                                    <div class="mt-5 flex items-center gap-2 text-sm font-bold text-barber-red">
                                        <span class="hidden peer-checked:inline">
                                            ✓
                                        </span>

                                        <span>
                                            {{ in_array($servicio->id, $serviciosAsignados) ? 'Servicio seleccionado' : 'Seleccionar servicio' }}
                                        </span>
                                    </div>

                                </article>

                            </label>

                        @endforeach

                    </div>

                @else

                    <div class="rounded-card border border-warning bg-warning-light px-5 py-8 text-center">

                        <h4 class="font-display text-2xl font-bold text-warning">
                            No hay servicios activos
                        </h4>

                        <p class="mt-2 text-sm font-medium text-ink-700">
                            Primero registra servicios activos para poder asignarlos a un barbero.
                        </p>

                        <a href="{{ route('servicio.create') }}"
                           class="mt-5 inline-flex items-center justify-center rounded-panel bg-barber-red px-5 py-3 text-sm font-bold text-white hover:bg-barber-red-700 transition-colors">
                            Crear servicio
                        </a>

                    </div>

                @endif

                @error('servicios')
                    <p class="mt-3 text-sm text-barber-red">
                        {{ $message }}
                    </p>
                @enderror

                @error('servicios.*')
                    <p class="mt-3 text-sm text-barber-red">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            <!-- Botones -->
            <div class="flex flex-col-reverse gap-3 border-t border-cream-200 px-6 py-5 sm:flex-row sm:justify-end">

                <a href="{{ route('barbero.show', $barbero->id) }}"
                   class="inline-flex items-center justify-center rounded-panel bg-cream-200 px-6 py-3 text-sm font-bold text-navy hover:bg-cream-300 transition-colors">
                    Cancelar
                </a>

                <button
                    type="submit"
                    class="rounded-panel bg-barber-red px-6 py-3 text-sm font-bold text-white hover:bg-barber-red-700 focus:outline-none focus:ring-4 focus:ring-barber-red-100 transition-colors"
                >
                    Guardar servicios
                </button>

            </div>

        </form>

    </div>

</section>

@endsection