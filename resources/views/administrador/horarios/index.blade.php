@extends('layouts.admin')

@section('title', 'Lista de horarios - BarberShop')
@section('page-title', 'Lista de horarios')

@section('content')

<section class="space-y-6">

    <!-- Header interno -->
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>
            <h2 class="font-display text-3xl font-bold text-navy">
                Horarios
            </h2>

            <p class="mt-2 text-sm text-ink-600">
                Administra los horarios de trabajo disponibles para los barberos.
            </p>
        </div>

        <a href="{{ route('horario.create') }}" class="inline-flex items-center justify-center rounded-panel bg-barber-red px-5 py-3 text-sm font-bold text-white shadow-card hover:bg-barber-red-700 focus:outline-none focus:ring-4 focus:ring-barber-red-100 transition-colors">
            Agregar horario
        </a>

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

    <!-- Stats rápidas -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4">

        <div class="rounded-panel border border-cream-200 bg-white p-5 shadow-card">
            <p class="text-sm font-semibold text-ink-500">
                Total horarios
            </p>

            <p class="mt-2 font-display text-3xl font-bold text-navy">
                {{ $horarios->count() ?? 0 }}
            </p>
        </div>

        <div class="rounded-panel border border-cream-200 bg-white p-5 shadow-card">
            <p class="text-sm font-semibold text-ink-500">
                Activos
            </p>

            <p class="mt-2 font-display text-3xl font-bold text-success">
                {{ $horarios->filter(fn ($horario) => $horario->estado == 1)->count() }}
            </p>
        </div>

        <div class="rounded-panel border border-danger bg-danger-light p-5 shadow-card">
            <p class="text-sm font-semibold text-danger">
                Inactivos
            </p>

            <p class="mt-2 font-display text-3xl font-bold text-danger">
                {{ $horarios->filter(fn ($horario) => $horario->estado == 0)->count() }}
            </p>
        </div>

    </div>

    <!-- Tabla principal -->
    <div class="rounded-panel border border-cream-200 bg-white shadow-card overflow-hidden">

        <!-- Encabezado de tabla -->
        <div class="flex flex-col gap-4 border-b border-cream-200 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <h3 class="font-display text-xl font-bold text-navy">
                    Lista de horarios
                </h3>

                <p class="mt-1 text-sm text-ink-500">
                    Consulta los horarios, días asignados y estado de cada turno.
                </p>
            </div>

            <div class="w-full sm:w-80">
                <input type="text" placeholder="Buscar horario..." class="w-full rounded-card border border-cream-300 bg-white px-4 py-3 text-sm text-ink placeholder:text-ink-500 focus:border-barber-red focus:outline-none focus:ring-4 focus:ring-barber-red-100 transition-colors">
            </div>

        </div>

        <!-- Tabla desktop -->
        <div class="hidden lg:block overflow-x-auto">
            <table class="w-full text-sm">

                <thead class="bg-cream-100 text-ink-600">
                    <tr>
                        <th class="px-6 py-4 text-left font-bold">Horario</th>
                        <th class="px-6 py-4 text-left font-bold">Horas</th>
                        <th class="px-6 py-4 text-left font-bold">Días</th>
                        <th class="px-6 py-4 text-left font-bold">Estado</th>
                        <th class="px-6 py-4 text-right font-bold">Acciones</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-cream-200">

                    @forelse ($horarios as $horario)

                    <tr class="hover:bg-cream-50 transition-colors">

                        <!-- Horario -->
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-3">

                                <div class="flex h-11 w-11 items-center justify-center rounded-full bg-navy text-white font-bold shadow-card">
                                    🕒
                                </div>

                                <div>
                                    <p class="font-bold text-ink">
                                        {{ $horario->nombre_horario }}
                                    </p>

                                    <p class="text-xs text-ink-500">
                                        {{ $horario->descripcion ?? 'Sin descripción' }}
                                    </p>
                                </div>

                            </div>
                        </td>

                        <!-- Horas -->
                        <td class="px-6 py-5 text-ink-700">
                            <span class="font-semibold">
                                {{ substr($horario->hora_inicio, 0, 5) }}
                            </span>

                            <span class="text-ink-500">a</span>

                            <span class="font-semibold">
                                {{ substr($horario->hora_fin, 0, 5) }}
                            </span>
                        </td>

                        <!-- Días -->
                        <td class="px-6 py-5">
                            <div class="flex flex-wrap gap-2">
                                @forelse ($horario->diasSemana as $dia)
                                <span class="inline-flex rounded-full bg-cream-100 px-3 py-1 text-xs font-bold text-ink-700">
                                    {{ ucfirst($dia->nombre_dia) }}
                                </span>
                                @empty
                                <span class="text-sm text-ink-500">
                                    Sin días asignados
                                </span>
                                @endforelse
                            </div>
                        </td>

                        <!-- Estado -->
                        <td class="px-6 py-5">
                            @if ($horario->estado == 1)
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

                                <a href="{{ route('horario.show', $horario->id) }}" title="Ver horario" class="inline-flex h-10 w-10 items-center justify-center rounded-card border border-cream-300 bg-white text-navy hover:bg-navy hover:text-white transition-colors">
                                    👁
                                </a>

                                <a href="{{ route('horario.edit', $horario->id) }}" title="Editar horario" class="inline-flex h-10 w-10 items-center justify-center rounded-card border border-cream-300 bg-white text-barber-red hover:bg-barber-red hover:text-white transition-colors">
                                    ✎
                                </a>

                                @if ($horario->estado == 1)
                                <form method="POST" action="{{ route('horario.destroy', $horario->id) }}" onsubmit="return confirm('¿Seguro que deseas desactivar este horario? Ya no será elegible para asignarlo a barberos.');">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" title="Desactivar horario" class="inline-flex h-10 w-10 items-center justify-center rounded-card border border-danger bg-white text-danger hover:bg-danger hover:text-white transition-colors">
                                        🗑
                                    </button>
                                </form>
                                @else
                                <span title="Horario inactivo" class="inline-flex h-10 w-10 items-center justify-center rounded-card border border-cream-300 bg-cream-100 text-ink-500">
                                    —
                                </span>
                                @endif

                            </div>
                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="5" class="px-6 py-14 text-center">

                            <div class="mx-auto max-w-md">
                                <h3 class="font-display text-2xl font-bold text-navy">
                                    No hay horarios registrados
                                </h3>

                                <p class="mt-2 text-sm text-ink-600">
                                    Cuando registres horarios, aparecerán listados en esta sección.
                                </p>

                                <a href="{{ route('horario.create') }}" class="mt-6 inline-flex items-center justify-center rounded-panel bg-barber-red px-5 py-3 text-sm font-bold text-white hover:bg-barber-red-700 transition-colors">
                                    Agregar primer horario
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

            @forelse ($horarios as $horario)

            <article class="p-5">

                <div class="flex items-start justify-between gap-4">

                    <div class="flex items-center gap-3">

                        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-navy text-white font-bold shadow-card">
                            🕒
                        </div>

                        <div>
                            <h3 class="font-bold text-ink">
                                {{ $horario->nombre_horario }}
                            </h3>

                            <p class="text-sm text-ink-500">
                                {{ substr($horario->hora_inicio, 0, 5) }}
                                -
                                {{ substr($horario->hora_fin, 0, 5) }}
                            </p>
                        </div>

                    </div>

                    @if ($horario->estado == 1)
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
                        <p class="text-xs font-semibold text-ink-500">Descripción</p>
                        <p class="mt-1 font-medium text-ink">
                            {{ $horario->descripcion ?? 'Sin descripción' }}
                        </p>
                    </div>

                    <div class="rounded-card bg-cream-50 px-4 py-3">
                        <p class="text-xs font-semibold text-ink-500">Días asignados</p>

                        <div class="mt-2 flex flex-wrap gap-2">
                            @forelse ($horario->diasSemana as $dia)
                            <span class="inline-flex rounded-full bg-white px-3 py-1 text-xs font-bold text-ink-700 shadow-card">
                                {{ ucfirst($dia->nombre_dia) }}
                            </span>
                            @empty
                            <span class="text-sm text-ink-500">
                                Sin días asignados
                            </span>
                            @endforelse
                        </div>
                    </div>

                </div>

                <div class="mt-4 flex flex-wrap justify-end gap-2">

                    <a href="{{ route('horario.show', $horario->id) }}" class="inline-flex items-center justify-center rounded-card border border-cream-300 bg-white px-4 py-2 text-sm font-bold text-navy hover:bg-navy hover:text-white transition-colors">
                        Ver
                    </a>

                    <a href="{{ route('horario.edit', $horario->id) }}" class="inline-flex items-center justify-center rounded-card bg-barber-red px-4 py-2 text-sm font-bold text-white hover:bg-barber-red-700 transition-colors">
                        Editar
                    </a>

                    @if ($horario->estado == 1)
                    <form method="POST" action="{{ route('horario.destroy', $horario->id) }}" onsubmit="return confirm('¿Seguro que deseas desactivar este horario? Ya no será elegible para asignarlo a barberos.');">
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
                    No hay horarios registrados
                </h3>

                <p class="mt-2 text-sm text-ink-600">
                    Cuando registres horarios, aparecerán listados en esta sección.
                </p>

                <a href="{{ route('horario.create') }}" class="mt-6 inline-flex items-center justify-center rounded-panel bg-barber-red px-5 py-3 text-sm font-bold text-white hover:bg-barber-red-700 transition-colors">
                    Agregar primer horario
                </a>
            </div>

            @endforelse

        </div>

    </div>

</section>

@endsection
