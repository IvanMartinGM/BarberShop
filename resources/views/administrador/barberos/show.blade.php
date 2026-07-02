@extends('layouts.admin')

@section('title', 'Detalle del barbero - BarberShop')
@section('page-title', 'Detalle del barbero')

@section('content')

@php
$fotoPerfil = $barbero->user?->foto_perfil ?? 'images/default-avatar.svg';

$fotoPerfilUrl = str_starts_with($fotoPerfil, 'profile_photos/')
? asset('storage/' . $fotoPerfil)
: asset($fotoPerfil);
@endphp

<section class="space-y-6">

    <!-- Header interno -->
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>
            <h2 class="font-display text-3xl font-bold text-navy">
                Perfil del barbero
            </h2>

            <p class="mt-2 text-sm text-ink-600">
                Consulta toda la información administrativa y profesional del barbero.
            </p>
        </div>

        <div class="flex flex-col sm:flex-row gap-3">

            <a href="{{ route('barbero.index') }}" class="inline-flex items-center justify-center rounded-panel border border-cream-300 bg-white px-5 py-3 text-sm font-bold text-navy hover:bg-cream-100 transition-colors">
                Volver
            </a>

            <a href="{{ route('barbero.edit', $barbero->id) }}" class="inline-flex items-center justify-center rounded-panel bg-barber-red px-5 py-3 text-sm font-bold text-white hover:bg-barber-red-700 transition-colors">
                Editar barbero
            </a>

            <a href="{{ route('barbero.horarios.edit', $barbero->id) }}" class="inline-flex items-center justify-center rounded-panel bg-navy px-5 py-3 text-sm font-bold text-white hover:bg-navy-800 transition-colors">
                Gestionar horarios
            </a>

        </div>

    </div>

    <!-- Layout principal -->
    <div class="grid grid-cols-1 xl:grid-cols-[360px_minmax(0,1fr)] gap-6">

        <!-- Card perfil -->
        <aside class="rounded-panel border border-cream-200 bg-white shadow-card overflow-hidden">

            <div class="bg-navy px-6 py-8 text-center">

                <div class="mx-auto h-28 w-28 overflow-hidden rounded-full bg-white p-2 shadow-panel ring-4 ring-cream-100">
                    <img src="{{ $fotoPerfilUrl }}" alt="Foto de perfil de {{ $barbero->user?->nombres ?? 'barbero' }}" class="h-full w-full rounded-full object-cover">
                </div>

                <h3 class="mt-4 font-display text-2xl font-bold text-white">
                    {{ $barbero->user?->nombres ?? 'Sin nombre' }}
                    {{ $barbero->user?->primer_apellido ?? '' }}
                    {{ $barbero->user?->segundo_apellido ?? '' }}
                </h3>

                <p class="mt-1 text-sm text-cream-200">
                    {{ $barbero->especialidad ?? 'Sin especialidad registrada' }}
                </p>

            </div>

            <div class="p-6 space-y-5">

                <!-- Estado de disponibilidad -->
                <div>
                    <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                        Estado de disponibilidad
                    </p>

                    <div class="mt-2">
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
                    </div>
                </div>

                <!-- Estado del usuario -->
                <div class="border-t border-cream-200 pt-5">
                    <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                        Estado del usuario
                    </p>

                    <div class="mt-2">
                        @if ($barbero->user?->estado == 1)
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

                <!-- Correo -->
                <div class="border-t border-cream-200 pt-5">
                    <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                        Correo electrónico
                    </p>

                    <p class="mt-1 text-sm font-medium text-ink break-all">
                        {{ $barbero->user?->email ?? 'No registrado' }}
                    </p>
                </div>

                <!-- Celular -->
                <div class="border-t border-cream-200 pt-5">
                    <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                        Celular
                    </p>

                    <p class="mt-1 text-sm font-medium text-ink">
                        {{ $barbero->user?->celular ?? 'No registrado' }}
                    </p>
                </div>

                <!-- Nombre usuario -->
                <div class="border-t border-cream-200 pt-5">
                    <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                        Nombre de usuario
                    </p>

                    <p class="mt-1 text-sm font-medium text-ink">
                        {{ $barbero->user?->nombre_usuario ?? 'No registrado' }}
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
                        Identificadores internos y datos administrativos.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5 p-6">

                    <div class="rounded-card bg-cream-50 px-4 py-4">
                        <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                            ID barbero
                        </p>

                        <p class="mt-1 font-semibold text-ink">
                            {{ $barbero->id }}
                        </p>
                    </div>

                    <div class="rounded-card bg-cream-50 px-4 py-4">
                        <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                            ID usuario asociado
                        </p>

                        <p class="mt-1 font-semibold text-ink">
                            {{ $barbero->id_usuario ?? 'No registrado' }}
                        </p>
                    </div>

                    <div class="rounded-card bg-cream-50 px-4 py-4">
                        <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                            Fecha de registro
                        </p>

                        <p class="mt-1 font-semibold text-ink">
                            {{ $barbero->user?->fecha_registro ?? 'No registrada' }}
                        </p>
                    </div>

                    <div class="rounded-card bg-cream-50 px-4 py-4">
                        <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                            Último acceso
                        </p>

                        <p class="mt-1 font-semibold text-ink">
                            {{ $barbero->user?->ultimo_acceso ?? 'Sin acceso registrado' }}
                        </p>
                    </div>

                </div>

            </div>

            <!-- Información personal -->
            <div class="rounded-panel border border-cream-200 bg-white shadow-card">

                <div class="border-b border-cream-200 px-6 py-5">
                    <h3 class="font-display text-xl font-bold text-navy">
                        Información personal
                    </h3>

                    <p class="mt-1 text-sm text-ink-500">
                        Datos generales del usuario asociado al barbero.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 p-6">

                    <div class="rounded-card bg-cream-50 px-4 py-4">
                        <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                            Nombres
                        </p>

                        <p class="mt-1 font-semibold text-ink">
                            {{ $barbero->user?->nombres ?? 'No registrado' }}
                        </p>
                    </div>

                    <div class="rounded-card bg-cream-50 px-4 py-4">
                        <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                            Primer apellido
                        </p>

                        <p class="mt-1 font-semibold text-ink">
                            {{ $barbero->user?->primer_apellido ?? 'No registrado' }}
                        </p>
                    </div>

                    <div class="rounded-card bg-cream-50 px-4 py-4">
                        <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                            Segundo apellido
                        </p>

                        <p class="mt-1 font-semibold text-ink">
                            {{ $barbero->user?->segundo_apellido ?? 'No registrado' }}
                        </p>
                    </div>

                    <div class="rounded-card bg-cream-50 px-4 py-4">
                        <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                            Género
                        </p>

                        @php
                        $genero = $barbero->user?->genero;
                        @endphp

                        <p class="mt-1 font-semibold text-ink">
                            @if (!$genero)
                            No registrado
                            @elseif ($genero === 'M')
                            Masculino
                            @elseif ($genero === 'F')
                            Femenino
                            @else
                            Otro
                            @endif
                        </p>
                    </div>
                </div>

            </div>

            <!-- Información profesional -->
            <div class="rounded-panel border border-cream-200 bg-white shadow-card">

                <div class="border-b border-cream-200 px-6 py-5">
                    <h3 class="font-display text-xl font-bold text-navy">
                        Información profesional
                    </h3>

                    <p class="mt-1 text-sm text-ink-500">
                        Datos propios del perfil profesional del barbero.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5 p-6">

                    <div class="rounded-card bg-cream-50 px-4 py-4">
                        <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                            Estado disponibilidad
                        </p>

                        <p class="mt-1 font-semibold text-ink">
                            {{ $barbero->estado_disponibilidad ?? 'No registrado' }}
                        </p>
                    </div>

                    <div class="rounded-card bg-cream-50 px-4 py-4">
                        <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                            Especialidad
                        </p>

                        <p class="mt-1 font-semibold text-ink">
                            {{ $barbero->especialidad ?? 'No registrada' }}
                        </p>
                    </div>

                    <div class="rounded-card bg-cream-50 px-4 py-4">
                        <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                            Experiencia
                        </p>

                        <p class="mt-1 font-semibold text-ink">
                            {{ $barbero->experiencia_anos ?? 0 }} años
                        </p>
                    </div>

                    <div class="rounded-card bg-cream-50 px-4 py-4">
                        <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                            Fecha contratación
                        </p>

                        <p class="mt-1 font-semibold text-ink">
                            {{ $barbero->fecha_contratacion ?? 'No registrada' }}
                        </p>
                    </div>

                    <div class="rounded-card bg-cream-50 px-4 py-4">
                        <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                            Calificación promedio
                        </p>

                        <p class="mt-1 font-semibold text-ink">
                            {{ $barbero->calificacion_promedio ?? '0.00' }}
                        </p>
                    </div>

                </div>

            </div>
            <!-- Horarios asignados -->
            <div class="rounded-panel border border-cream-200 bg-white shadow-card">

                <div class="border-b border-cream-200 px-6 py-5">
                    <h3 class="font-display text-xl font-bold text-navy">
                        Horarios asignados
                    </h3>

                    <p class="mt-1 text-sm text-ink-500">
                        Consulta los horarios de trabajo asignados a este barbero.
                    </p>
                </div>

                <div class="p-6">

                    @if ($barbero->horarios->count() > 0)

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">

                        @foreach ($barbero->horarios as $horario)

                        <article class="rounded-card border border-cream-200 bg-cream-50 p-5">

                            <div class="flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">

                                <div>
                                    <h4 class="font-display text-xl font-bold text-navy">
                                        {{ $horario->nombre_horario }}
                                    </h4>

                                    <p class="mt-1 text-sm text-ink-600">
                                        {{ $horario->descripcion ?? 'Sin descripción registrada.' }}
                                    </p>
                                </div>

                                @if ($horario->estado == 1)
                                <span class="inline-flex w-fit rounded-full bg-success-light px-3 py-1 text-xs font-bold text-success">
                                    Activo
                                </span>
                                @else
                                <span class="inline-flex w-fit rounded-full bg-danger-light px-3 py-1 text-xs font-bold text-danger">
                                    Inactivo
                                </span>
                                @endif

                            </div>

                            <div class="mt-5 grid grid-cols-1 sm:grid-cols-2 gap-3">

                                <div class="rounded-card bg-white px-4 py-3 shadow-card">
                                    <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                                        Hora de inicio
                                    </p>

                                    <p class="mt-1 font-semibold text-ink">
                                        {{ substr($horario->hora_inicio, 0, 5) }}
                                    </p>
                                </div>

                                <div class="rounded-card bg-white px-4 py-3 shadow-card">
                                    <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                                        Hora de fin
                                    </p>

                                    <p class="mt-1 font-semibold text-ink">
                                        {{ substr($horario->hora_fin, 0, 5) }}
                                    </p>
                                </div>

                            </div>

                            <div class="mt-5">
                                <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                                    Días asignados
                                </p>

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

                        </article>

                        @endforeach

                    </div>

                    @else

                    <div class="rounded-card border border-warning bg-warning-light px-5 py-6 text-center">

                        <h4 class="font-display text-xl font-bold text-warning">
                            Sin horarios asignados
                        </h4>

                        <p class="mt-2 text-sm font-medium text-ink-700">
                            Este barbero todavía no tiene horarios de trabajo asignados.
                        </p>

                        <a href="{{ route('barbero.horarios.edit', $barbero->id) }}" class="mt-5 inline-flex items-center justify-center rounded-panel bg-barber-red px-5 py-3 text-sm font-bold text-white hover:bg-barber-red-700 transition-colors">
                            Asignar horario
                        </a>

                    </div>

                    @endif

                </div>

            </div>
            <!-- Biografía -->
            <div class="rounded-panel border border-cream-200 bg-white shadow-card">

                <div class="border-b border-cream-200 px-6 py-5">
                    <h3 class="font-display text-xl font-bold text-navy">
                        Biografía
                    </h3>

                    <p class="mt-1 text-sm text-ink-500">
                        Descripción, experiencia o información adicional del barbero.
                    </p>
                </div>

                <div class="p-6">
                    <p class="leading-7 text-ink-700">
                        {{ $barbero->biografia ?? 'Este barbero aún no tiene una biografía registrada.' }}
                    </p>
                </div>

            </div>

        </div>

    </div>

</section>

@endsection
