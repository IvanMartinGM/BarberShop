@extends('layouts.barbero')

@section('title', 'Mis servicios - BarberShop')
@section('page-title', 'Mis servicios')

@section('content')

<section class="space-y-6">

    <!-- Header -->
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="font-display text-3xl font-bold text-navy">
                Mis servicios
            </h2>

            <p class="mt-2 text-sm text-ink-600">
                Selecciona los servicios que puedes realizar dentro de la barbería.
            </p>
        </div>

        <a href="{{ route('barbero.dashboard') }}"
           class="inline-flex items-center justify-center rounded-panel border border-cream-300 bg-white px-5 py-3 text-sm font-bold text-navy hover:bg-cream-100 transition-colors">
            Volver al dashboard
        </a>
    </div>

    <!-- Resumen -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4">

        <div class="rounded-panel bg-white border border-cream-200 p-6 shadow-card">
            <p class="text-sm font-semibold text-ink-500">
                Servicios disponibles
            </p>

            <p class="mt-3 font-display text-4xl font-bold text-navy">
                {{ $servicios->count() }}
            </p>
        </div>

        <div class="rounded-panel bg-white border border-cream-200 p-6 shadow-card">
            <p class="text-sm font-semibold text-ink-500">
                Servicios seleccionados
            </p>
            <p class="mt-3 font-display text-4xl font-bold text-navy">
                {{ count($serviciosAsignados) }}
            </p>
        </div>

        <div class="rounded-panel bg-barber-red p-6 shadow-panel">
            <p class="text-sm font-semibold text-white/80">
                Estado
            </p>

            <p class="mt-3 font-display text-4xl font-bold text-white">
                {{ $barbero->estado_disponibilidad ?? 'No definido' }}
            </p>
        </div>

    </div>

    <!-- Servicios asociados actualmente -->
    <div class="rounded-panel border border-cream-200 bg-white shadow-card overflow-hidden">

        <div class="border-b border-cream-200 px-6 py-5">
            <h3 class="font-display text-xl font-bold text-navy">
                Servicios asociados actualmente
            </h3>

            <p class="mt-1 text-sm text-ink-500">
                Estos son los servicios que tienes seleccionados en este momento.
            </p>
        </div>

        <div class="p-6">
            @if ($barbero->servicios->count() > 0)

                <div class="flex flex-wrap gap-3">
                    @foreach ($barbero->servicios as $servicioAsignado)
                        <span class="inline-flex rounded-full bg-success-light px-4 py-2 text-sm font-bold text-success">
                            {{ $servicioAsignado->nombre_servicio }}
                        </span>
                    @endforeach
                </div>

            @else

                <div class="rounded-card border border-warning bg-warning-light px-5 py-8 text-center">
                    <h4 class="font-display text-2xl font-bold text-warning">
                        No tienes servicios asociados
                    </h4>

                    <p class="mt-2 text-sm font-medium text-ink-700">
                        Todavía no has seleccionado ningún servicio. Marca los servicios que puedes realizar y guarda los cambios.
                    </p>
                </div>

            @endif
        </div>

    </div>

    <!-- Formulario -->
    <div class="rounded-panel border border-cream-200 bg-white shadow-card overflow-hidden">

        <form method="POST" action="{{ route('barbero.servicios.self.update') }}">
            @csrf
            @method('PATCH')

            <div class="border-b border-cream-200 px-6 py-5">
                <h3 class="font-display text-xl font-bold text-navy">
                    Servicios del sistema
                </h3>

                <p class="mt-1 text-sm text-ink-500">
                    Marca los servicios que puedes atender.
                </p>
            </div>

            <div class="p-6">

                @php
                    $serviciosSeleccionados = collect(
                        old('servicios', $serviciosAsignados)
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
                                    {{ in_array($servicio->id, $serviciosSeleccionados) ? 'checked' : '' }}
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
                                            {{ in_array($servicio->id, $serviciosSeleccionados) ? 'Servicio seleccionado' : 'Seleccionar servicio' }}
                                        </span>
                                    </div>

                                </article>

                            </label>

                        @endforeach

                    </div>

                @else

                    <div class="rounded-card border border-warning bg-warning-light px-5 py-8 text-center">
                        <h4 class="font-display text-2xl font-bold text-warning">
                            No hay servicios disponibles
                        </h4>

                        <p class="mt-2 text-sm font-medium text-ink-700">
                            Actualmente no existen servicios activos en el sistema.
                        </p>
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

            <div class="flex flex-col-reverse gap-3 border-t border-cream-200 px-6 py-5 sm:flex-row sm:justify-end">

                <a href="{{ route('barbero.dashboard') }}"
                   class="inline-flex items-center justify-center rounded-panel bg-cream-200 px-6 py-3 text-sm font-bold text-navy hover:bg-cream-300 transition-colors">
                    Cancelar
                </a>

                <button
                    type="submit"
                    class="rounded-panel bg-barber-red px-6 py-3 text-sm font-bold text-white hover:bg-barber-red-700 focus:outline-none focus:ring-4 focus:ring-barber-red-100 transition-colors"
                >
                    Guardar mis servicios
                </button>

            </div>

        </form>

    </div>

</section>

@endsection