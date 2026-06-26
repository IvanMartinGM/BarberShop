@extends('layouts.admin')

@section('title', 'Detalle del cliente - BarberShop')
@section('page-title', 'Detalle del cliente')

@section('content')

<section class="space-y-6">

    <!-- Header interno -->
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>
            <h2 class="font-display text-3xl font-bold text-navy">
                Perfil del cliente
            </h2>

            <p class="mt-2 text-sm text-ink-600">
                Consulta la información personal y general del cliente.
            </p>
        </div>

        <div class="flex flex-col sm:flex-row gap-3">

            <a href="{{ route('cliente.index') }}"
               class="inline-flex items-center justify-center rounded-panel border border-cream-300 bg-white px-5 py-3 text-sm font-bold text-navy hover:bg-cream-100 transition-colors">
                Volver
            </a>

            <a href="{{ route('cliente.edit', $cliente->id) }}"
               class="inline-flex items-center justify-center rounded-panel bg-barber-red px-5 py-3 text-sm font-bold text-white hover:bg-barber-red-700 transition-colors">
                Editar cliente
            </a>

        </div>

    </div>

    <!-- Layout principal -->
    <div class="grid grid-cols-1 xl:grid-cols-[360px_minmax(0,1fr)] gap-6">

        <!-- Card perfil -->
        <aside class="rounded-panel border border-cream-200 bg-white shadow-card overflow-hidden">

            <div class="bg-navy px-6 py-8 text-center">

                <div class="mx-auto flex h-24 w-24 items-center justify-center rounded-full bg-barber-red text-4xl font-bold text-white shadow-panel">
                    {{ strtoupper(substr($cliente->user?->nombres ?? 'C', 0, 1)) }}
                </div>

                <h3 class="mt-4 font-display text-2xl font-bold text-white">
                    {{ $cliente->user?->nombres ?? 'Sin nombre' }}
                    {{ $cliente->user?->primer_apellido ?? '' }}
                </h3>

                <p class="mt-1 text-sm text-cream-200">
                    Cliente registrado
                </p>

            </div>

            <div class="p-6 space-y-5">

                <!-- Estado -->
                <div>
                    <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                        Estado
                    </p>

                    <div class="mt-2">
                        @if ($cliente->user?->estado == 1)
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

                    <p class="mt-1 text-sm font-medium text-ink">
                        {{ $cliente->user?->email ?? 'No registrado' }}
                    </p>
                </div>

                <!-- Celular -->
                <div class="border-t border-cream-200 pt-5">
                    <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                        Celular
                    </p>

                    <p class="mt-1 text-sm font-medium text-ink">
                        {{ $cliente->user?->celular ?? 'No registrado' }}
                    </p>
                </div>

                <!-- Nombre usuario -->
                <div class="border-t border-cream-200 pt-5">
                    <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                        Nombre de usuario
                    </p>

                    <p class="mt-1 text-sm font-medium text-ink">
                        {{ $cliente->user?->nombre_usuario ?? 'No registrado' }}
                    </p>
                </div>

            </div>

        </aside>

        <!-- Información principal -->
        <div class="space-y-6">

            <!-- Información personal -->
            <div class="rounded-panel border border-cream-200 bg-white shadow-card">

                <div class="border-b border-cream-200 px-6 py-5">
                    <h3 class="font-display text-xl font-bold text-navy">
                        Información personal
                    </h3>

                    <p class="mt-1 text-sm text-ink-500">
                        Datos generales del usuario asociado al cliente.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 p-6">

                    <div class="rounded-card bg-cream-50 px-4 py-4">
                        <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                            Nombres
                        </p>

                        <p class="mt-1 font-semibold text-ink">
                            {{ $cliente->user?->nombres ?? 'No registrado' }}
                        </p>
                    </div>

                    <div class="rounded-card bg-cream-50 px-4 py-4">
                        <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                            Primer apellido
                        </p>

                        <p class="mt-1 font-semibold text-ink">
                            {{ $cliente->user?->primer_apellido ?? 'No registrado' }}
                        </p>
                    </div>

                    <div class="rounded-card bg-cream-50 px-4 py-4">
                        <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                            Segundo apellido
                        </p>

                        <p class="mt-1 font-semibold text-ink">
                            {{ $cliente->user?->segundo_apellido ?? 'No registrado' }}
                        </p>
                    </div>

                    <div class="rounded-card bg-cream-50 px-4 py-4">
                        <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                            Género
                        </p>

                        <p class="mt-1 font-semibold text-ink">
                            {{ $cliente->user?->genero ?? 'No registrado' }}
                        </p>
                    </div>

                </div>

            </div>

            <!-- Información del cliente -->
            <div class="rounded-panel border border-cream-200 bg-white shadow-card">

                <div class="border-b border-cream-200 px-6 py-5">
                    <h3 class="font-display text-xl font-bold text-navy">
                        Información del cliente
                    </h3>

                    <p class="mt-1 text-sm text-ink-500">
                        Datos propios del perfil de cliente.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5 p-6">

                    <div class="rounded-card bg-cream-50 px-4 py-4">
                        <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                            Fecha de nacimiento
                        </p>

                        <p class="mt-1 font-semibold text-ink">
                            {{ $cliente->fecha_nacimiento ?? 'No registrada' }}
                        </p>
                    </div>

                    <div class="rounded-card bg-cream-50 px-4 py-4">
                        <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                            Última visita
                        </p>

                        <p class="mt-1 font-semibold text-ink">
                            {{ $cliente->ultima_visita ?? 'Sin visitas registradas' }}
                        </p>
                    </div>

                    <div class="rounded-card bg-cream-50 px-4 py-4">
                        <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                            Fecha de registro
                        </p>

                        <p class="mt-1 font-semibold text-ink">
                            {{ $cliente->user?->fecha_registro ?? 'No registrada' }}
                        </p>
                    </div>

                    <div class="rounded-card bg-cream-50 px-4 py-4">
                        <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                            Último acceso
                        </p>

                        <p class="mt-1 font-semibold text-ink">
                            {{ $cliente->user?->ultimo_acceso ?? 'Sin acceso registrado' }}
                        </p>
                    </div>

                </div>

            </div>

            <!-- Observaciones -->
            <div class="rounded-panel border border-cream-200 bg-white shadow-card">

                <div class="border-b border-cream-200 px-6 py-5">
                    <h3 class="font-display text-xl font-bold text-navy">
                        Observaciones
                    </h3>

                    <p class="mt-1 text-sm text-ink-500">
                        Notas internas o información adicional del cliente.
                    </p>
                </div>

                <div class="p-6">
                    <p class="leading-7 text-ink-700">
                        {{ $cliente->observaciones ?? 'Este cliente aún no tiene observaciones registradas.' }}
                    </p>
                </div>

            </div>

        </div>

    </div>

</section>

@endsection