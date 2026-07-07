@extends('layouts.admin')

@section('title', 'Lista de servicios - BarberShop')
@section('page-title', 'Lista de servicios')

@section('content')

<section class="space-y-6">

    <!-- Header interno -->
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>
            <h2 class="font-display text-3xl font-bold text-navy">
                Servicios
            </h2>

            <p class="mt-2 text-sm text-ink-600">
                Administra el catálogo de servicios que después podrán ofrecer los barberos.
            </p>
        </div>

        <a href="{{ route('servicio.create') }}" class="inline-flex items-center justify-center rounded-panel bg-barber-red px-5 py-3 text-sm font-bold text-white shadow-card hover:bg-barber-red-700 focus:outline-none focus:ring-4 focus:ring-barber-red-100 transition-colors">
            Agregar servicio
        </a>

    </div>

    <!-- Stats rápidas -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">

        <div class="rounded-panel border border-cream-200 bg-white p-5 shadow-card">
            <p class="text-sm font-semibold text-ink-500">
                Total servicios
            </p>

            <p class="mt-2 font-display text-3xl font-bold text-navy">
                {{ $servicios->count() ?? 0 }}
            </p>
        </div>

        <div class="rounded-panel border border-cream-200 bg-white p-5 shadow-card">
            <p class="text-sm font-semibold text-ink-500">
                Activos
            </p>

            <p class="mt-2 font-display text-3xl font-bold text-success">
                {{ $servicios->filter(fn ($servicio) => $servicio->estado == 1)->count() }}
            </p>
        </div>

        <div class="rounded-panel border border-danger bg-danger-light p-5 shadow-card">
            <p class="text-sm font-semibold text-danger">
                Inactivos
            </p>

            <p class="mt-2 font-display text-3xl font-bold text-danger">
                {{ $servicios->filter(fn ($servicio) => $servicio->estado == 0)->count() }}
            </p>
        </div>

        <div class="rounded-panel border border-cream-200 bg-white p-5 shadow-card">
            <p class="text-sm font-semibold text-ink-500">
                Categorías
            </p>

            <p class="mt-2 font-display text-3xl font-bold text-warning">
                {{ $servicios->pluck('categoria')->filter()->unique()->count() }}
            </p>
        </div>

    </div>

    <!-- Tabla principal -->
    <div class="rounded-panel border border-cream-200 bg-white shadow-card overflow-hidden">

        <!-- Encabezado de tabla -->
        <div class="flex flex-col gap-4 border-b border-cream-200 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <h3 class="font-display text-xl font-bold text-navy">
                    Lista de servicios
                </h3>

                <p class="mt-1 text-sm text-ink-500">
                    Consulta los servicios, precios, duración, categoría y estado dentro del catálogo.
                </p>
            </div>

            <div class="w-full sm:w-80">
                <input type="text" placeholder="Buscar servicio..." class="w-full rounded-card border border-cream-300 bg-white px-4 py-3 text-sm text-ink placeholder:text-ink-500 focus:border-barber-red focus:outline-none focus:ring-4 focus:ring-barber-red-100 transition-colors">
            </div>

        </div>

        <!-- Tabla desktop -->
        <div class="hidden lg:block overflow-x-auto">
            <table class="w-full text-sm">

                <thead class="bg-cream-100 text-ink-600">
                    <tr>
                        <th class="px-6 py-4 text-left font-bold">Servicio</th>
                        <th class="px-6 py-4 text-left font-bold">Precio base</th>
                        <th class="px-6 py-4 text-left font-bold">Duración</th>
                        <th class="px-6 py-4 text-left font-bold">Categoría</th>
                        <th class="px-6 py-4 text-left font-bold">Estado</th>
                        <th class="px-6 py-4 text-right font-bold">Acciones</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-cream-200">

                    @forelse ($servicios as $servicio)
                    @php
                    $imagenServicio = $servicio->imagen_servicio;

                    $imagenServicioUrl = $imagenServicio && str_starts_with($imagenServicio, 'service_images/')
                    ? asset('storage/' . $imagenServicio)
                    : null;
                    @endphp

                    <tr class="hover:bg-cream-50 transition-colors">

                        <!-- Servicio -->
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-3">

                                <div class="h-12 w-12 shrink-0 overflow-hidden rounded-card bg-cream-100 shadow-card ring-2 ring-cream-200">
                                    @if ($imagenServicioUrl)
                                    <img src="{{ $imagenServicioUrl }}" alt="Imagen de {{ $servicio->nombre_servicio }}" class="h-full w-full object-cover">
                                    @else
                                    <div class="flex h-full w-full items-center justify-center bg-navy text-xl text-white">
                                        ✂
                                    </div>
                                    @endif
                                </div>

                                <div>
                                    <p class="font-bold text-ink">
                                        {{ $servicio->nombre_servicio }}
                                    </p>

                                    <p class="text-xs text-ink-500">
                                        {{ $servicio->descripcion ? \Illuminate\Support\Str::limit($servicio->descripcion, 70) : 'Sin descripción' }}
                                    </p>
                                </div>

                            </div>
                        </td>

                        <!-- Precio -->
                        <td class="px-6 py-5 text-ink-700">
                            <span class="font-bold text-navy">
                                ${{ number_format($servicio->precio_base, 2) }}
                            </span>
                        </td>

                        <!-- Duración -->
                        <td class="px-6 py-5 text-ink-700">
                            <span class="font-semibold">
                                {{ $servicio->duracion_minutos }}
                            </span>

                            <span class="text-ink-500">
                                min
                            </span>
                        </td>

                        <!-- Categoría -->
                        <td class="px-6 py-5">
                            @if ($servicio->categoria)
                            <span class="inline-flex rounded-full bg-cream-100 px-3 py-1 text-xs font-bold text-ink-700">
                                {{ $servicio->categoria }}
                            </span>
                            @else
                            <span class="text-sm text-ink-500">
                                Sin categoría
                            </span>
                            @endif
                        </td>

                        <!-- Estado -->
                        <td class="px-6 py-5">
                            @if ($servicio->estado == 1)
                            <span class="inline-flex rounded-full bg-success-light px-3 py-1 text-xs font-bold text-success">
                                Activo
                            </span>
                            @else
                            <span class="inline-flex rounded-full bg-danger-light px-3 py-1 text-xs font-bold text-danger">
                                Inactivo
                            </span>
                            @endif
                        </td>

                        <!-- Acciones -->
                        <td class="px-6 py-5">
                            <div class="flex items-center justify-end gap-2">

                                <a href="{{ route('servicio.show', $servicio->id) }}" title="Ver servicio" class="inline-flex h-10 w-10 items-center justify-center rounded-card border border-cream-300 bg-white text-navy hover:bg-navy hover:text-white transition-colors">
                                    👁
                                </a>

                                <a href="{{ route('servicio.edit', $servicio->id) }}" title="Editar servicio" class="inline-flex h-10 w-10 items-center justify-center rounded-card border border-cream-300 bg-white text-barber-red hover:bg-barber-red hover:text-white transition-colors">
                                    ✎
                                </a>

                                @if ($servicio->estado == 1)
                                <form method="POST" action="{{ route('servicio.destroy', $servicio->id) }}" onsubmit="return confirm('¿Seguro que deseas desactivar este servicio? Ya no será elegible para que los barberos lo seleccionen.');">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" title="Desactivar servicio" class="inline-flex h-10 w-10 items-center justify-center rounded-card border border-danger bg-white text-danger hover:bg-danger hover:text-white transition-colors">
                                        🗑
                                    </button>
                                </form>
                                @else
                                <span title="Servicio inactivo" class="inline-flex h-10 w-10 items-center justify-center rounded-card border border-cream-300 bg-cream-100 text-ink-500">
                                    —
                                </span>
                                @endif

                            </div>
                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="6" class="px-6 py-14 text-center">

                            <div class="mx-auto max-w-md">
                                <h3 class="font-display text-2xl font-bold text-navy">
                                    No hay servicios registrados
                                </h3>

                                <p class="mt-2 text-sm text-ink-600">
                                    Cuando registres servicios, aparecerán listados en esta sección.
                                </p>

                                <a href="{{ route('servicio.create') }}" class="mt-6 inline-flex items-center justify-center rounded-panel bg-barber-red px-5 py-3 text-sm font-bold text-white hover:bg-barber-red-700 transition-colors">
                                    Agregar primer servicio
                                </a>
                            </div>

                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>
        </div>

        <!-- Cards mobile/tablet -->
        <div class="lg:hidden divide-y divide-cream-200">

            @forelse ($servicios as $servicio)

            @php
            $imagenServicio = $servicio->imagen_servicio;

            $imagenServicioUrl = $imagenServicio && str_starts_with($imagenServicio, 'service_images/')
            ? asset('storage/' . $imagenServicio)
            : null;
            @endphp

            <article class="p-5">

                <div class="flex items-start justify-between gap-4">

                    <div class="flex items-center gap-3">

                        <div class="h-20 w-24 shrink-0 overflow-hidden rounded-card bg-cream-100 shadow-card ring-2 ring-cream-200">
                            @if ($imagenServicioUrl)
                            <img src="{{ $imagenServicioUrl }}" alt="Imagen de {{ $servicio->nombre_servicio }}" class="h-full w-full object-cover">
                            @else
                            <div class="flex h-full w-full items-center justify-center bg-navy text-xl text-white">
                                ✂
                            </div>
                            @endif
                        </div>

                        <div>
                            <h3 class="font-bold text-ink">
                                {{ $servicio->nombre_servicio }}
                            </h3>

                            <p class="text-sm text-ink-500">
                                ${{ number_format($servicio->precio_base, 2) }}
                                ·
                                {{ $servicio->duracion_minutos }} min
                            </p>
                        </div>

                    </div>

                    @if ($servicio->estado == 1)
                    <span class="rounded-full bg-success-light px-3 py-1 text-xs font-bold text-success">
                        Activo
                    </span>
                    @else
                    <span class="rounded-full bg-danger-light px-3 py-1 text-xs font-bold text-danger">
                        Inactivo
                    </span>
                    @endif

                </div>

                <div class="mt-4 grid grid-cols-1 gap-3 text-sm">

                    <div class="rounded-card bg-cream-50 px-4 py-3">
                        <p class="text-xs font-semibold text-ink-500">
                            Descripción
                        </p>

                        <p class="mt-1 font-medium text-ink">
                            {{ $servicio->descripcion ?? 'Sin descripción' }}
                        </p>
                    </div>

                    <div class="rounded-card bg-cream-50 px-4 py-3">
                        <p class="text-xs font-semibold text-ink-500">
                            Categoría
                        </p>

                        <p class="mt-1 font-medium text-ink">
                            {{ $servicio->categoria ?? 'Sin categoría' }}
                        </p>
                    </div>

                </div>

                <div class="mt-4 flex flex-wrap justify-end gap-2">

                    <a href="{{ route('servicio.show', $servicio->id) }}" class="inline-flex items-center justify-center rounded-card border border-cream-300 bg-white px-4 py-2 text-sm font-bold text-navy hover:bg-navy hover:text-white transition-colors">
                        Ver
                    </a>

                    <a href="{{ route('servicio.edit', $servicio->id) }}" class="inline-flex items-center justify-center rounded-card bg-barber-red px-4 py-2 text-sm font-bold text-white hover:bg-barber-red-700 transition-colors">
                        Editar
                    </a>

                    @if ($servicio->estado == 1)
                    <form method="POST" action="{{ route('servicio.destroy', $servicio->id) }}" onsubmit="return confirm('¿Seguro que deseas desactivar este servicio? Ya no será elegible para que los barberos lo seleccionen.');">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="inline-flex items-center justify-center rounded-card border border-danger bg-white px-4 py-2 text-sm font-bold text-danger hover:bg-danger hover:text-white transition-colors">
                            Desactivar
                        </button>
                    </form>
                    @else
                    <span class="inline-flex items-center justify-center rounded-card bg-cream-100 px-4 py-2 text-sm font-bold text-ink-500">
                        Inactivo
                    </span>
                    @endif

                </div>

            </article>

            @empty

            <div class="px-6 py-14 text-center">
                <h3 class="font-display text-2xl font-bold text-navy">
                    No hay servicios registrados
                </h3>

                <p class="mt-2 text-sm text-ink-600">
                    Cuando registres servicios, aparecerán listados en esta sección.
                </p>

                <a href="{{ route('servicio.create') }}" class="mt-6 inline-flex items-center justify-center rounded-panel bg-barber-red px-5 py-3 text-sm font-bold text-white hover:bg-barber-red-700 transition-colors">
                    Agregar primer servicio
                </a>
            </div>

            @endforelse

        </div>

    </div>

</section>

@endsection
