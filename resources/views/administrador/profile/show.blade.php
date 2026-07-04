@extends('layouts.admin')

@section('title', 'Mi perfil - BarberShop')
@section('page-title', 'Mi perfil')

@section('content')


@php
    $defaultProfilePhoto = 'images/default-avatar.svg';

    $fotoPerfil = $user->foto_perfil;

    if (!$fotoPerfil) {
        $profileImage = asset($defaultProfilePhoto);
    } elseif (\Illuminate\Support\Str::startsWith($fotoPerfil, ['http://', 'https://'])) {
        $profileImage = $fotoPerfil;
    } elseif (\Illuminate\Support\Str::startsWith($fotoPerfil, 'images/')) {
        $profileImage = asset($fotoPerfil);
    } else {
        $profileImage = asset('storage/' . $fotoPerfil);
    }

    $isDefaultProfilePhoto = !$fotoPerfil || $fotoPerfil === $defaultProfilePhoto;

    $generoTexto = match ($user->genero) {
        'M' => 'Masculino',
        'F' => 'Femenino',
        'otro' => 'Otro',
        default => 'No registrado',
    };
@endphp

<section class="space-y-6">

    <!-- Header interno -->
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>
            <h2 class="font-display text-3xl font-bold text-navy">
                Mi perfil
            </h2>

            <p class="mt-2 text-sm text-ink-600">
                Consulta la información de tu cuenta administrativa.
            </p>
        </div>

        <div class="flex flex-col sm:flex-row gap-3">

            <a href="{{ route('administrador.dashboard') }}"
               class="inline-flex items-center justify-center rounded-panel border border-cream-300 bg-white px-5 py-3 text-sm font-bold text-navy hover:bg-cream-100 transition-colors">
                Volver al dashboard
            </a>

            <a href="{{ route('profile.edit') }}"
               class="inline-flex items-center justify-center rounded-panel bg-barber-red px-5 py-3 text-sm font-bold text-white shadow-card hover:bg-barber-red-700 focus:outline-none focus:ring-4 focus:ring-barber-red-100 transition-colors">
                Editar perfil
            </a>

        </div>

    </div>

    <!-- Layout principal -->
    <div class="grid grid-cols-1 xl:grid-cols-[340px_minmax(0,1fr)] gap-6">

        <!-- Card perfil -->
        <aside class="rounded-panel border border-cream-200 bg-white shadow-card overflow-hidden">

            <div class="bg-navy px-6 py-8 text-center">

                <div class="mx-auto h-28 w-28 overflow-hidden rounded-full border-4 border-white bg-cream shadow-panel">
                    <img
                        src="{{ $profileImage }}"
                        alt="Foto de perfil de {{ $user->nombres ?? 'administrador' }}"
                        class="h-full w-full object-cover"
                    >
                </div>

                <h3 class="mt-4 font-display text-2xl font-bold text-white">
                    {{ $user->nombres ?? 'Administrador' }}
                    {{ $user->primer_apellido ?? '' }}
                </h3>

                <p class="mt-1 text-sm text-cream-200">
                    Cuenta administrativa
                </p>

            </div>

            <div class="p-6 space-y-5">

                <!-- Estado -->
                <div>
                    <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                        Estado
                    </p>

                    <div class="mt-2">
                        @if ($user->estado == 1)
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

                <!-- Rol -->
                <div class="border-t border-cream-200 pt-5">
                    <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                        Tipo de cuenta
                    </p>

                    <p class="mt-1 text-sm font-medium text-ink">
                        Administrador
                    </p>
                </div>

                <!-- Correo -->
                <div class="border-t border-cream-200 pt-5">
                    <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                        Correo electrónico
                    </p>

                    <p class="mt-1 break-words text-sm font-medium text-ink">
                        {{ $user->email ?? 'No registrado' }}
                    </p>
                </div>

                <!-- Nombre usuario -->
                <div class="border-t border-cream-200 pt-5">
                    <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                        Nombre de usuario
                    </p>

                    <p class="mt-1 text-sm font-medium text-ink">
                        {{ $user->nombre_usuario ?? 'No registrado' }}
                    </p>
                </div>

                <!-- Celular -->
                <div class="border-t border-cream-200 pt-5">
                    <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                        Celular
                    </p>

                    <p class="mt-1 text-sm font-medium text-ink">
                        {{ $user->celular ?? 'No registrado' }}
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
                        Datos internos y administrativos de tu usuario.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5 p-6">

                    <div class="rounded-card bg-cream-50 px-4 py-4">
                        <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                            ID usuario
                        </p>

                        <p class="mt-1 font-semibold text-ink">
                            {{ $user->id }}
                        </p>
                    </div>

                    <div class="rounded-card bg-cream-50 px-4 py-4">
                        <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                            Fecha de registro
                        </p>

                        <p class="mt-1 font-semibold text-ink">
                            {{ $user->fecha_registro ?? 'No registrada' }}
                        </p>
                    </div>

                    <div class="rounded-card bg-cream-50 px-4 py-4">
                        <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                            Último acceso
                        </p>

                        <p class="mt-1 font-semibold text-ink">
                            {{ $user->ultimo_acceso ?? 'Sin acceso registrado' }}
                        </p>
                    </div>

                    <div class="rounded-card bg-cream-50 px-4 py-4">
                        <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                            Foto de perfil
                        </p>

                        <p class="mt-1 font-semibold text-ink">
                            {{ $isDefaultProfilePhoto ? 'Imagen default' : 'Personalizada' }}
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
                        Datos generales asociados a tu cuenta.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 p-6">

                    <div class="rounded-card bg-cream-50 px-4 py-4">
                        <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                            Nombres
                        </p>

                        <p class="mt-1 font-semibold text-ink">
                            {{ $user->nombres ?? 'No registrado' }}
                        </p>
                    </div>

                    <div class="rounded-card bg-cream-50 px-4 py-4">
                        <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                            Primer apellido
                        </p>

                        <p class="mt-1 font-semibold text-ink">
                            {{ $user->primer_apellido ?? 'No registrado' }}
                        </p>
                    </div>

                    <div class="rounded-card bg-cream-50 px-4 py-4">
                        <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                            Segundo apellido
                        </p>

                        <p class="mt-1 font-semibold text-ink">
                            {{ $user->segundo_apellido ?? 'No registrado' }}
                        </p>
                    </div>

                    <div class="rounded-card bg-cream-50 px-4 py-4">
                        <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                            Género
                        </p>

                        <p class="mt-1 font-semibold text-ink">
                            {{ $generoTexto }}
                        </p>
                    </div>

                </div>

            </div>

            <!-- Información de acceso -->
            <div class="rounded-panel border border-cream-200 bg-white shadow-card">

                <div class="border-b border-cream-200 px-6 py-5">
                    <h3 class="font-display text-xl font-bold text-navy">
                        Información de acceso
                    </h3>

                    <p class="mt-1 text-sm text-ink-500">
                        Datos que utilizas para identificarte e iniciar sesión.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 p-6">

                    <div class="rounded-card bg-cream-50 px-4 py-4">
                        <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                            Correo electrónico
                        </p>

                        <p class="mt-1 break-words font-semibold text-ink">
                            {{ $user->email ?? 'No registrado' }}
                        </p>
                    </div>

                    <div class="rounded-card bg-cream-50 px-4 py-4">
                        <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                            Nombre de usuario
                        </p>

                        <p class="mt-1 font-semibold text-ink">
                            {{ $user->nombre_usuario ?? 'No registrado' }}
                        </p>
                    </div>

                    <div class="rounded-card bg-cream-50 px-4 py-4 md:col-span-2">
                        <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                            Celular
                        </p>

                        <p class="mt-1 font-semibold text-ink">
                            {{ $user->celular ?? 'No registrado' }}
                        </p>
                    </div>

                </div>

            </div>

            <!-- Seguridad -->
            <div class="rounded-panel border border-cream-200 bg-white shadow-card">

                <div class="border-b border-cream-200 px-6 py-5">
                    <h3 class="font-display text-xl font-bold text-navy">
                        Seguridad de la cuenta
                    </h3>

                    <p class="mt-1 text-sm text-ink-500">
                        Información general sobre la protección de tu acceso.
                    </p>
                </div>

                <div class="p-6">

                    <div class="rounded-card border border-warning bg-warning-light px-5 py-4">
                        <p class="text-sm font-bold text-warning">
                            Contraseña protegida
                        </p>

                        <p class="mt-1 text-sm leading-6 text-ink-700">
                            Por seguridad, tu contraseña no se muestra en esta pantalla.
                            Puedes cambiarla desde la edición de tu perfil.
                        </p>
                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection