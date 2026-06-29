@extends('layouts.admin')

@section('title', 'Detalle del horario - BarberShop')
@section('page-title', 'Detalle del horario')

@section('content')

<section class="space-y-6">

    <!-- Header interno -->
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>
            <h2 class="font-display text-3xl font-bold text-navy">
                Detalle del horario
            </h2>

            <p class="mt-2 text-sm text-ink-600">
                Consulta la información completa del horario seleccionado.
            </p>
        </div>

        <div class="flex flex-col sm:flex-row gap-3">

            <a href="{{ route('horario.index') }}"
               class="inline-flex items-center justify-center rounded-panel border border-cream-300 bg-white px-5 py-3 text-sm font-bold text-navy hover:bg-cream-100 transition-colors">
                Volver
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

    <!-- Contenido principal -->
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        <!-- Card lateral -->
        <aside class="xl:col-span-1">

            <div class="rounded-panel border border-cream-200 bg-white p-6 shadow-card">

                <div class="flex flex-col items-center text-center">

                    <div class="flex h-24 w-24 items-center justify-center rounded-full bg-navy text-4xl text-white shadow-panel">
                        🕒
                    </div>

                    <h3 class="mt-5 font-display text-2xl font-bold text-navy">
                        {{ $horario->nombre_horario }}
                    </h3>

                    <p class="mt-2 text-sm text-ink-600">
                        {{ $horario->descripcion ?? 'Sin descripción registrada.' }}
                    </p>

                    <div class="mt-5">
                        @if ($horario->estado == 1)
                            <span class="inline-flex rounded-full bg-success-light px-4 py-2 text-sm font-bold text-success">
                                Activo
                            </span>
                        @else
                            <span class="inline-flex rounded-full bg-danger-light px-4 py-2 text-sm font-bold text-danger">
                                Inactivo
                            </span>
                        @endif
                    </div>

                </div>

                <div class="mt-6 border-t border-cream-200 pt-6 space-y-4">

                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-ink-500">
                            Hora de inicio
                        </p>

                        <p class="mt-1 text-lg font-bold text-ink">
                            {{ substr($horario->hora_inicio, 0, 5) }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-ink-500">
                            Hora de fin
                        </p>

                        <p class="mt-1 text-lg font-bold text-ink">
                            {{ substr($horario->hora_fin, 0, 5) }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-ink-500">
                            Total de días de trabajo
                        </p>

                        <p class="mt-1 text-lg font-bold text-ink">
                            {{ $horario->diasSemana->count() }}
                        </p>
                    </div>

                </div>

            </div>

        </aside>

        <!-- Información detallada -->
        <div class="xl:col-span-2 space-y-6">

            <!-- Información del horario -->
            <div class="rounded-panel border border-cream-200 bg-white shadow-card overflow-hidden">

                <div class="border-b border-cream-200 px-6 py-5">
                    <h3 class="font-display text-xl font-bold text-navy">
                        Información del horario
                    </h3>

                    <p class="mt-1 text-sm text-ink-500">
                        Datos principales registrados para este horario.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-6">

                    <div class="rounded-card bg-cream-50 px-4 py-3">
                        <p class="text-xs font-semibold text-ink-500">ID del horario</p>
                        <p class="mt-1 font-bold text-ink">
                            {{ $horario->id }}
                        </p>
                    </div>

                    <div class="rounded-card bg-cream-50 px-4 py-3">
                        <p class="text-xs font-semibold text-ink-500">Nombre</p>
                        <p class="mt-1 font-bold text-ink">
                            {{ $horario->nombre_horario }}
                        </p>
                    </div>

                    <div class="rounded-card bg-cream-50 px-4 py-3">
                        <p class="text-xs font-semibold text-ink-500">Hora de inicio</p>
                        <p class="mt-1 font-bold text-ink">
                            {{ substr($horario->hora_inicio, 0, 5) }}
                        </p>
                    </div>

                    <div class="rounded-card bg-cream-50 px-4 py-3">
                        <p class="text-xs font-semibold text-ink-500">Hora de fin</p>
                        <p class="mt-1 font-bold text-ink">
                            {{ substr($horario->hora_fin, 0, 5) }}
                        </p>
                    </div>

                    <div class="rounded-card bg-cream-50 px-4 py-3">
                        <p class="text-xs font-semibold text-ink-500">Estado</p>

                        <p class="mt-1 font-bold">
                            @if ($horario->estado == 1)
                                <span class="text-success">Activo</span>
                            @else
                                <span class="text-danger">Inactivo</span>
                            @endif
                        </p>
                    </div>

                    <div class="rounded-card bg-cream-50 px-4 py-3 md:col-span-2">
                        <p class="text-xs font-semibold text-ink-500">Descripción</p>
                        <p class="mt-1 font-medium text-ink">
                            {{ $horario->descripcion ?? 'Sin descripción registrada.' }}
                        </p>
                    </div>

                </div>

            </div>

            <!-- Días asignados -->
            <div class="rounded-panel border border-cream-200 bg-white shadow-card overflow-hidden">

                <div class="border-b border-cream-200 px-6 py-5">
                    <h3 class="font-display text-xl font-bold text-navy">
                        Días asignados
                    </h3>

                    <p class="mt-1 text-sm text-ink-500">
                        Días de la semana en los que aplica este horario.
                    </p>
                </div>

                <div class="p-6">

                    <div class="flex flex-wrap gap-3">

                        @forelse ($horario->diasSemana as $dia)
                            <span class="inline-flex rounded-full bg-cream-100 px-4 py-2 text-sm font-bold text-ink-700">
                                {{ ucfirst($dia->nombre_dia) }}
                            </span>
                        @empty
                            <p class="text-sm text-ink-500">
                                Este horario aún no tiene días asignados.
                            </p>
                        @endforelse

                    </div>

                </div>

            </div>

            <!-- Barberos asignados -->
            <div class="rounded-panel border border-cream-200 bg-white shadow-card overflow-hidden">

                <div class="border-b border-cream-200 px-6 py-5">
                    <h3 class="font-display text-xl font-bold text-navy">
                        Barberos asignados
                    </h3>

                    <p class="mt-1 text-sm text-ink-500">
                        Barberos que actualmente tienen este horario asignado.
                    </p>
                </div>

                <div class="divide-y divide-cream-200">

                    @forelse ($horario->barberos as $barbero)

                        <div class="flex items-center justify-between gap-4 px-6 py-5">

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

                            @if ($barbero->pivot?->estado == 1)
                                <span class="rounded-full bg-success-light px-3 py-1 text-xs font-bold text-success">
                                    Activo
                                </span>
                            @else
                                <span class="rounded-full bg-danger-light px-3 py-1 text-xs font-bold text-danger">
                                    Inactivo
                                </span>
                            @endif

                        </div>

                    @empty

                        <div class="px-6 py-10 text-center">
                            <h4 class="font-display text-xl font-bold text-navy">
                                Sin barberos asignados
                            </h4>

                            <p class="mt-2 text-sm text-ink-600">
                                Cuando asignes este horario a un barbero, aparecerá en esta sección.
                            </p>
                        </div>

                    @endforelse

                </div>

            </div>

        </div>

    </div>

</section>

@endsection