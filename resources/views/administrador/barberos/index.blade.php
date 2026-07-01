@extends('layouts.admin')

@section('title', 'Lista de barberos - BarberShop')
@section('page-title', 'Lista de barberos')

@section('content')

<section class="space-y-6">

    <!-- Header interno -->
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>
            <h2 class="font-display text-3xl font-bold text-navy">
                Barberos
            </h2>

            <p class="mt-2 text-sm text-ink-600">
                Administra los barberos registrados en el sistema.
            </p>
        </div>

        <a href="{{ route('barbero.create') }}" class="inline-flex items-center justify-center rounded-panel bg-barber-red px-5 py-3 text-sm font-bold text-white shadow-card hover:bg-barber-red-700 focus:outline-none focus:ring-4 focus:ring-barber-red-100 transition-colors">
            Agregar barbero
        </a>
    </div>
    <!-- Stats rápidas -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">

        <div class="rounded-panel border border-cream-200 bg-white p-5 shadow-card">
            <p class="text-sm font-semibold text-ink-500">
                Total barberos
            </p>
            <p class="mt-2 font-display text-3xl font-bold text-navy">
                {{ $barberos->count() ?? 0 }}
            </p>
        </div>

        <div class="rounded-panel border border-cream-200 bg-white p-5 shadow-card">
            <p class="text-sm font-semibold text-ink-500">
                Disponibles
            </p>
            <p class="mt-2 font-display text-3xl font-bold text-success">
                {{ $barberos->where('estado_disponibilidad', 'disponible')->count() ?? 0 }}
            </p>
        </div>

        <div class="rounded-panel border border-cream-200 bg-white p-5 shadow-card">
            <p class="text-sm font-semibold text-ink-500">
                Ocupados
            </p>
            <p class="mt-2 font-display text-3xl font-bold text-warning">
                {{ $barberos->where('estado_disponibilidad', 'ocupado')->count() ?? 0 }}
            </p>
        </div>

        <div class="rounded-panel border border-danger bg-danger-light p-5 shadow-card">
            <p class="text-sm font-semibold text-danger">
                Inactivos
            </p>
            <p class="mt-2 font-display text-3xl font-bold text-danger">
                {{ $barberos->where('estado_disponibilidad', 'inactivo')->count() ?? 0 }}
            </p>
        </div>

    </div>

    <!-- Tabla principal -->
    <div class="rounded-panel border border-cream-200 bg-white shadow-card overflow-hidden">

        <!-- Encabezado de tabla -->
        <div class="flex flex-col gap-4 border-b border-cream-200 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <h3 class="font-display text-xl font-bold text-navy">
                    Lista de barberos
                </h3>

                <p class="mt-1 text-sm text-ink-500">
                    Consulta la información principal de cada barbero.
                </p>
            </div>

            <div class="w-full sm:w-80">
                <input type="text" placeholder="Buscar barbero..." class="w-full rounded-card border border-cream-300 bg-white px-4 py-3 text-sm text-ink placeholder:text-ink-500 focus:border-barber-red focus:outline-none focus:ring-4 focus:ring-barber-red-100 transition-colors">
            </div>

        </div>

        <!-- Tabla desktop -->
        <div class="hidden lg:block overflow-x-auto">
            <table class="w-full text-sm">

                <thead class="bg-cream-100 text-ink-600">
                    <tr>
                        <th class="px-6 py-4 text-left font-bold">Barbero</th>
                        <th class="px-6 py-4 text-left font-bold">Especialidad</th>
                        <th class="px-6 py-4 text-left font-bold">Celular</th>
                        <th class="px-6 py-4 text-left font-bold">Experiencia</th>
                        <th class="px-6 py-4 text-left font-bold">Estado</th>
                        <th class="px-6 py-4 text-right font-bold">Acciones</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-cream-200">

                    @forelse ($barberos as $barbero)

                    <tr class="hover:bg-cream-50 transition-colors">

                        <!-- Barbero -->
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-3">

                                <div class="flex h-11 w-11 items-center justify-center rounded-full bg-navy text-white font-bold shadow-card">
                                    {{ strtoupper(substr($barbero->usuario->nombres ?? 'B', 0, 1)) }}
                                </div>

                                <div>
                                    <p class="font-bold text-ink">
                                        {{ $barbero->user->nombres }}
                                        {{ $barbero->user->primer_apellido }}
                                        {{ $barbero->user->segundo_apellido }}
                                    </p>

                                    <p class="text-xs text-ink-500">
                                        {{ $barbero->user->email }}
                                    </p>
                                </div>

                            </div>
                        </td>

                        <!-- Especialidad -->
                        <td class="px-6 py-5 text-ink-700">
                            {{ $barbero->especialidad ?? 'Sin especialidad' }}
                        </td>

                        <!-- Celular -->
                        <td class="px-6 py-5 text-ink-700">
                            {{ $barbero->user->celular ?? 'No registrado' }}
                        </td>

                        <!-- Experiencia -->
                        <td class="px-6 py-5 text-ink-700">
                            {{ $barbero->experiencia_anos }} años
                        </td>

                        <!-- Estado -->
                        <td class="px-6 py-5">
                            @if ($barbero->estado_disponibilidad === 'disponible')
                            <span class="inline-flex rounded-full bg-success-light px-3 py-1 text-xs font-bold text-success">
                                Disponible
                            </span>
                            @elseif ($barbero->estado_disponibilidad === 'ocupado')
                            <span class="inline-flex rounded-full bg-warning-light px-3 py-1 text-xs font-bold text-warning">
                                Ocupado
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

                                <a href="{{ route('barbero.show', $barbero->id) }}" title="Ver barbero" class="inline-flex h-10 w-10 items-center justify-center rounded-card border border-cream-300 bg-white text-navy hover:bg-navy hover:text-white transition-colors">
                                    👁
                                </a>

                                <a href="{{ route('barbero.edit', $barbero->id) }}" title="Editar barbero" class="inline-flex h-10 w-10 items-center justify-center rounded-card border border-cream-300 bg-white text-barber-red hover:bg-barber-red hover:text-white transition-colors">
                                    ✎
                                </a>

                                @if ($barbero->user?->estado == 1)
                                <form method="POST" action="{{ route('barbero.destroy', $barbero->id) }}" onsubmit="return confirm('¿Seguro que deseas eliminar este barbero? El usuario quedará inactivo.');">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" title="Eliminar barbero" class="inline-flex h-10 w-10 items-center justify-center rounded-card border border-danger bg-white text-danger hover:bg-danger hover:text-white transition-colors">
                                        🗑
                                    </button>
                                </form>
                                @else
                                <span title="Barbero inactivo" class="inline-flex h-10 w-10 items-center justify-center rounded-card border border-cream-300 bg-cream-100 text-ink-500">
                                    Inactivo
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
                                    No hay barberos registrados
                                </h3>

                                <p class="mt-2 text-sm text-ink-600">
                                    Cuando registres barberos, aparecerán listados en esta sección.
                                </p>

                                <a href="{{ route('barbero.create') }}" class="mt-6 inline-flex items-center justify-center rounded-panel bg-barber-red px-5 py-3 text-sm font-bold text-white hover:bg-barber-red-700 transition-colors">
                                    Agregar primer barbero
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

            @forelse ($barberos as $barbero)

            <article class="p-5">

                <div class="flex items-start justify-between gap-4">

                    <div class="flex items-center gap-3">

                        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-navy text-white font-bold shadow-card">
                            {{ strtoupper(substr($barbero->user->nombres ?? 'B', 0, 1)) }}
                        </div>

                        <div>
                            <h3 class="font-bold text-ink">
                                {{ $barbero->user->nombres }}
                                {{ $barbero->user->primer_apellido }}
                                {{ $barbero->user->segundo_apellido }}
                            </h3>

                            <p class="text-sm text-ink-500">
                                {{ $barbero->user->email }}
                            </p>
                        </div>

                    </div>

                    @if ($barbero->estado_disponibilidad === 'disponible')
                    <span class="rounded-full bg-success-light px-3 py-1 text-xs font-bold text-success">
                        Disponible
                    </span>
                    @elseif ($barbero->estado_disponibilidad === 'ocupado')
                    <span class="rounded-full bg-warning-light px-3 py-1 text-xs font-bold text-warning">
                        Ocupado
                    </span>
                    @else
                    <span class="rounded-full bg-danger-light px-3 py-1 text-xs font-bold text-danger">
                        Inactivo
                    </span>
                    @endif

                </div>

                <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-3 text-sm">

                    <div class="rounded-card bg-cream-50 px-4 py-3">
                        <p class="text-xs font-semibold text-ink-500">Especialidad</p>
                        <p class="mt-1 font-medium text-ink">
                            {{ $barbero->especialidad ?? 'Sin especialidad' }}
                        </p>
                    </div>

                    <div class="rounded-card bg-cream-50 px-4 py-3">
                        <p class="text-xs font-semibold text-ink-500">Celular</p>
                        <p class="mt-1 font-medium text-ink">
                            {{ $barbero->user->celular ?? 'No registrado' }}
                        </p>
                    </div>

                    <div class="rounded-card bg-cream-50 px-4 py-3">
                        <p class="text-xs font-semibold text-ink-500">Experiencia</p>
                        <p class="mt-1 font-medium text-ink">
                            {{ $barbero->experiencia_anos }} años
                        </p>
                    </div>

                </div>

                <div class="mt-4 flex flex-wrap justify-end gap-2">

                    <a href="{{ route('barbero.show', $barbero->id) }}" class="inline-flex items-center justify-center rounded-card border border-cream-300 bg-white px-4 py-2 text-sm font-bold text-navy hover:bg-navy hover:text-white transition-colors">
                        Ver
                    </a>

                    <a href="{{ route('barbero.edit', $barbero->id) }}" class="inline-flex items-center justify-center rounded-card bg-barber-red px-4 py-2 text-sm font-bold text-white hover:bg-barber-red-700 transition-colors">
                        Editar
                    </a>

                    @if ($barbero->user?->estado == 1)
                    <form method="POST" action="{{ route('barbero.destroy', $barbero->id) }}" onsubmit="return confirm('¿Seguro que deseas eliminar este barbero? El usuario quedará inactivo.');">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="inline-flex items-center justify-center rounded-card border border-danger bg-white px-4 py-2 text-sm font-bold text-danger hover:bg-danger hover:text-white transition-colors">
                            🗑
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
                    No hay barberos registrados
                </h3>

                <p class="mt-2 text-sm text-ink-600">
                    Cuando registres barberos, aparecerán listados en esta sección.
                </p>

                <a href="{{ route('barbero.create') }}" class="mt-6 inline-flex items-center justify-center rounded-panel bg-barber-red px-5 py-3 text-sm font-bold text-white hover:bg-barber-red-700 transition-colors">
                    Agregar primer barbero
                </a>
            </div>

            @endforelse

        </div>

    </div>

</section>

@endsection
