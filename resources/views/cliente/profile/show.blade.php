@extends('layouts.guest')

@section('title', 'Mi perfil - BarberShop')

@section('content')

@php
    $defaultProfilePhoto = 'images/default-avatar.svg';

    $fotoPerfil = $user->foto_perfil;

    if (!$fotoPerfil) {
        $fotoPerfilUrl = asset($defaultProfilePhoto);
    } elseif (\Illuminate\Support\Str::startsWith($fotoPerfil, ['http://', 'https://'])) {
        $fotoPerfilUrl = $fotoPerfil;
    } elseif (\Illuminate\Support\Str::startsWith($fotoPerfil, 'images/')) {
        $fotoPerfilUrl = asset($fotoPerfil);
    } else {
        $fotoPerfilUrl = asset('storage/' . $fotoPerfil);
    }
@endphp

<section class="bg-cream py-12 md:py-16">

    <div class="mx-auto max-w-5xl px-4 sm:px-6">

        <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="font-display text-4xl font-bold text-navy">
                    Mi perfil
                </h1>

                <p class="mt-2 text-sm text-ink-600">
                    Consulta la información asociada a tu cuenta de cliente.
                </p>
            </div>

            <a href="{{ route('profile.edit') }}"
               class="inline-flex items-center justify-center rounded-panel bg-barber-red px-5 py-3 text-sm font-bold text-white shadow-card hover:bg-barber-red-700 transition-colors">
                Editar perfil
            </a>
        </div>

        @if (session('status'))
            <div class="mb-6 rounded-card border border-success bg-success-light px-5 py-4 text-sm font-semibold text-success">
                {{ session('status') }}
            </div>
        @endif

        <div class="overflow-hidden rounded-panel border border-cream-200 bg-white shadow-panel">

            <div class="bg-linear-to-r from-navy via-navy-800 to-barber-red px-6 py-8 text-white">
                <div class="flex flex-col items-center gap-5 sm:flex-row sm:text-left">

                    <div class="h-28 w-28 overflow-hidden rounded-full bg-white p-1 shadow-elevated ring-4 ring-white/20">
                        <img src="{{ $fotoPerfilUrl }}"
                             alt="Foto de perfil de {{ $user->nombres }}"
                             class="h-full w-full rounded-full object-cover">
                    </div>

                    <div class="text-center sm:text-left">
                        <h2 class="font-display text-3xl font-bold">
                            {{ $user->getFullName() }}
                        </h2>

                        <p class="mt-2 text-sm text-cream-100">
                            Cliente BarberShop
                        </p>

                        <span class="mt-4 inline-flex rounded-full bg-success-light px-4 py-1 text-xs font-bold uppercase tracking-wide text-success">
                            Cuenta activa
                        </span>
                    </div>

                </div>
            </div>

            <div class="grid grid-cols-1 gap-6 p-6 md:grid-cols-2">

                <div class="rounded-card border border-cream-200 bg-cream-50 p-5">
                    <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                        Correo electrónico
                    </p>

                    <p class="mt-2 font-semibold text-ink">
                        {{ $user->email }}
                    </p>
                </div>

                <div class="rounded-card border border-cream-200 bg-cream-50 p-5">
                    <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                        Nombre de usuario
                    </p>

                    <p class="mt-2 font-semibold text-ink">
                        {{ $user->nombre_usuario }}
                    </p>
                </div>

                <div class="rounded-card border border-cream-200 bg-cream-50 p-5">
                    <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                        Teléfono
                    </p>

                    <p class="mt-2 font-semibold text-ink">
                        {{ $user->celular ?? 'No registrado' }}
                    </p>
                </div>

                <div class="rounded-card border border-cream-200 bg-cream-50 p-5">
                    <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                        Género
                    </p>

                    <p class="mt-2 font-semibold text-ink">
                        {{ $user->genero ?? 'No registrado' }}
                    </p>
                </div>

                <div class="rounded-card border border-cream-200 bg-cream-50 p-5">
                    <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                        Fecha de registro
                    </p>

                    <p class="mt-2 font-semibold text-ink">
                        {{ $user->fecha_registro?->format('d/m/Y H:i') ?? 'No disponible' }}
                    </p>
                </div>

                <div class="rounded-card border border-cream-200 bg-cream-50 p-5">
                    <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                        Último acceso
                    </p>

                    <p class="mt-2 font-semibold text-ink">
                        {{ $user->ultimo_acceso?->format('d/m/Y H:i') ?? 'No registrado' }}
                    </p>
                </div>

            </div>

            <div class="flex flex-col gap-3 border-t border-cream-200 bg-cream-50 px-6 py-5 sm:flex-row sm:justify-between">

                <a href="#cliente.citas.index"
                   class="inline-flex items-center justify-center rounded-panel border border-cream-300 bg-white px-5 py-3 text-sm font-bold text-navy hover:bg-cream-100 transition-colors">
                    Ver mis citas
                </a>

                <a href="#cliente.citas.create"
                   class="inline-flex items-center justify-center rounded-panel bg-barber-red px-5 py-3 text-sm font-bold text-white shadow-card hover:bg-barber-red-700 transition-colors">
                    Agendar cita
                </a>

            </div>

        </div>

    </div>

</section>

@endsection