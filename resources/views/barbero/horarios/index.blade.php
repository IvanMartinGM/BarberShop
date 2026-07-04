@extends('layouts.barbero')

@section('title', 'Mis horarios - BarberShop')
@section('page-title', 'Mis horarios')

@section('content')

@php
    $horariosActivos = $horarios->filter(function ($horario) {
        $pivotHorario = $horario->barberos_horarios ?? $horario->pivot;

        return $horario->estado == 1 && ($pivotHorario?->estado ?? 1) == 1;
    });

    $totalHorarios = $horarios->count();
    $totalHorariosActivos = $horariosActivos->count();

    $diasCubiertos = $horarios
        ->flatMap(fn ($horario) => $horario->diasSemana ?? collect())
        ->pluck('nombre_dia')
        ->unique()
        ->count();

    $formatTime = function ($time) {
        if (!$time) {
            return 'No registrada';
        }

        return \Carbon\Carbon::parse($time)->format('H:i');
    };
@endphp

<!-- Header -->
<section class="mb-8">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="font-display text-3xl font-bold text-navy">
                Mis horarios asignados
            </h2>

            <p class="mt-2 text-sm text-ink-600">
                Consulta los horarios y días que tienes asignados dentro de la barbería.
            </p>
        </div>

        <a href="{{ route('barbero.dashboard') }}"
           class="inline-flex items-center justify-center rounded-panel border border-cream-300 bg-white px-5 py-3 text-sm font-bold text-navy hover:bg-cream-100 transition-colors">
            Volver al dashboard
        </a>
    </div>
</section>

<!-- KPI Cards -->
<section class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 mb-8">

    <div class="rounded-panel bg-white border border-cream-200 p-6 shadow-card">
        <p class="text-sm font-semibold text-ink-500">
            Horarios asignados
        </p>

        <p class="mt-3 font-display text-4xl font-bold text-navy">
            {{ $totalHorarios }}
        </p>

        <p class="mt-2 text-xs text-ink-500">
            Total de horarios vinculados a tu perfil.
        </p>
    </div>

    <div class="rounded-panel bg-white border border-cream-200 p-6 shadow-card">
        <p class="text-sm font-semibold text-ink-500">
            Horarios activos
        </p>

        <p class="mt-3 font-display text-4xl font-bold text-navy">
            {{ $totalHorariosActivos }}
        </p>

        <p class="mt-2 text-xs text-ink-500">
            Horarios disponibles para tu jornada.
        </p>
    </div>

    <div class="rounded-panel bg-white border border-cream-200 p-6 shadow-card">
        <p class="text-sm font-semibold text-ink-500">
            Días cubiertos
        </p>

        <p class="mt-3 font-display text-4xl font-bold text-navy">
            {{ $diasCubiertos }}
        </p>

        <p class="mt-2 text-xs text-ink-500">
            Días de la semana con horario asignado.
        </p>
    </div>

    <div class="rounded-panel bg-barber-red p-6 shadow-panel">
        <p class="text-sm font-semibold text-white/80">
            Estado del perfil
        </p>

        <p class="mt-3 font-display text-4xl font-bold text-white">
            {{ $barbero->estado_disponibilidad ?? 'No definido' }}
        </p>

        <p class="mt-2 text-xs text-white/80">
            Disponibilidad actual del barbero.
        </p>
    </div>

</section>

<!-- Content -->
<section class="grid grid-cols-1 xl:grid-cols-[1fr_360px] gap-6">

    <!-- Horarios asignados -->
    <div class="rounded-panel bg-white border border-cream-200 shadow-card overflow-hidden">

        <div class="border-b border-cream-200 px-6 py-5">
            <h3 class="font-display text-xl font-bold text-navy">
                Lista de horarios
            </h3>

            <p class="mt-1 text-sm text-ink-500">
                Estos son los horarios que el administrador te ha asignado.
            </p>
        </div>

        <div class="p-6">

            @forelse ($horarios as $horario)
                @php
                    $pivotHorario = $horario->barberos_horarios ?? $horario->pivot;

                    $horarioActivo = $horario->estado == 1;
                    $asignacionActiva = ($pivotHorario?->estado ?? 1) == 1;

                    $dias = ($horario->diasSemana ?? collect())
                        ->pluck('nombre_dia')
                        ->join(', ');

                    $fechaAsignacion = $pivotHorario?->fecha_asignacion ?? null;
                @endphp

                <article class="mb-5 last:mb-0 rounded-panel border border-cream-200 bg-cream-50 p-5">

                    <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">

                        <div class="min-w-0">
                            <h4 class="font-display text-xl font-bold text-navy">
                                {{ $horario->nombre_horario ?? 'Horario sin nombre' }}
                            </h4>

                            <p class="mt-2 text-sm leading-6 text-ink-600">
                                {{ $horario->descripcion ?? 'Sin descripción registrada.' }}
                            </p>
                        </div>

                        <div class="flex flex-wrap gap-2">
                            @if ($horarioActivo)
                                <span class="inline-flex rounded-full bg-success-light px-3 py-1 text-xs font-bold text-success">
                                    Horario activo
                                </span>
                            @else
                                <span class="inline-flex rounded-full bg-danger-light px-3 py-1 text-xs font-bold text-danger">
                                    Horario inactivo
                                </span>
                            @endif

                            @if ($asignacionActiva)
                                <span class="inline-flex rounded-full bg-success-light px-3 py-1 text-xs font-bold text-success">
                                    Asignación activa
                                </span>
                            @else
                                <span class="inline-flex rounded-full bg-warning-light px-3 py-1 text-xs font-bold text-warning">
                                    Asignación inactiva
                                </span>
                            @endif
                        </div>

                    </div>

                    <div class="mt-5 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">

                        <div class="rounded-card bg-white px-4 py-4">
                            <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                                Hora de inicio
                            </p>

                            <p class="mt-1 font-semibold text-ink">
                                {{ $formatTime($horario->hora_inicio) }}
                            </p>
                        </div>

                        <div class="rounded-card bg-white px-4 py-4">
                            <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                                Hora de fin
                            </p>

                            <p class="mt-1 font-semibold text-ink">
                                {{ $formatTime($horario->hora_fin) }}
                            </p>
                        </div>

                        <div class="rounded-card bg-white px-4 py-4 md:col-span-2">
                            <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                                Días asignados
                            </p>

                            <p class="mt-1 font-semibold text-ink">
                                {{ $dias ?: 'Sin días asignados' }}
                            </p>
                        </div>

                        <div class="rounded-card bg-white px-4 py-4 md:col-span-2">
                            <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                                Fecha de asignación
                            </p>

                            <p class="mt-1 font-semibold text-ink">
                                {{ $fechaAsignacion ? \Carbon\Carbon::parse($fechaAsignacion)->format('d/m/Y') : 'No registrada' }}
                            </p>
                        </div>

                        <div class="rounded-card bg-white px-4 py-4 md:col-span-2">
                            <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                                Duración aproximada
                            </p>

                            <p class="mt-1 font-semibold text-ink">
                                @if ($horario->hora_inicio && $horario->hora_fin)
                                    {{ \Carbon\Carbon::parse($horario->hora_inicio)->diffInHours(\Carbon\Carbon::parse($horario->hora_fin)) }} horas
                                @else
                                    No calculable
                                @endif
                            </p>
                        </div>

                    </div>

                </article>

            @empty

                <div class="rounded-panel border border-warning bg-warning-light px-6 py-8 text-center">
                    <h4 class="font-display text-2xl font-bold text-warning">
                        No tienes horarios asignados
                    </h4>

                    <p class="mt-2 text-sm text-ink-700">
                        Por ahora no hay horarios vinculados a tu perfil de barbero.
                        Contacta al administrador para que te asigne un horario.
                    </p>
                </div>

            @endforelse

        </div>

    </div>

    <!-- Right Column -->
    <div class="space-y-6">

        <!-- Perfil del barbero -->
        <div class="rounded-panel bg-white border border-cream-200 p-6 shadow-card">
            <h3 class="font-display text-xl font-bold text-navy mb-4">
                Mi perfil laboral
            </h3>

            <div class="space-y-3">

                <div class="flex items-center justify-between rounded-card bg-cream-50 px-4 py-3">
                    <span class="font-medium text-ink">
                        Especialidad
                    </span>

                    <span class="text-sm font-semibold text-navy">
                        {{ $barbero->especialidad ?? 'No registrada' }}
                    </span>
                </div>

                <div class="flex items-center justify-between rounded-card bg-cream-50 px-4 py-3">
                    <span class="font-medium text-ink">
                        Experiencia
                    </span>

                    <span class="text-sm font-semibold text-navy">
                        {{ $barbero->experiencia_anos ?? 0 }} años
                    </span>
                </div>

                <div class="flex items-center justify-between rounded-card bg-cream-50 px-4 py-3">
                    <span class="font-medium text-ink">
                        Calificación
                    </span>

                    <span class="text-sm font-semibold text-navy">
                        {{ $barbero->calificacion_promedio ?? 'Sin calificación' }}
                    </span>
                </div>

            </div>
        </div>

        <!-- Nota -->
        <div class="rounded-panel bg-white border border-cream-200 p-6 shadow-card">
            <h3 class="font-display text-xl font-bold text-navy mb-4">
                Nota
            </h3>

            <p class="text-sm leading-6 text-ink-600">
                Los horarios son administrados por el panel administrativo.
                Si necesitas modificar tu jornada, contacta al administrador de la barbería.
            </p>
        </div>

        <!-- Acciones -->
        <div class="rounded-panel bg-white border border-cream-200 p-6 shadow-card">
            <h3 class="font-display text-xl font-bold text-navy mb-4">
                Acciones rápidas
            </h3>

            <div class="space-y-3">
                <a href="{{ route('barbero.dashboard') }}"
                   class="flex w-full items-center justify-center rounded-panel bg-navy px-4 py-3 text-sm font-semibold text-white hover:bg-navy-800 transition-colors">
                    Ir al dashboard
                </a>

                <a href="{{ route('profile.show') }}"
                   class="flex w-full items-center justify-center rounded-panel border border-cream-300 bg-white px-4 py-3 text-sm font-semibold text-ink hover:bg-cream-100 transition-colors">
                    Ver mi perfil
                </a>
            </div>
        </div>

    </div>

</section>

@endsection