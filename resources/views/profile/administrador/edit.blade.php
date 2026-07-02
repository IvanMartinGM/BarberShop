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
@endphp
<section class="space-y-6">

    <!-- Header interno -->
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>
            <h2 class="font-display text-3xl font-bold text-navy">
                Mi perfil
            </h2>

            <p class="mt-2 text-sm text-ink-600">
                Actualiza la información de tu cuenta administrativa.
            </p>
        </div>

        <a href="{{ route('administrador.dashboard') }}" class="inline-flex items-center justify-center rounded-panel border border-cream-300 bg-white px-5 py-3 text-sm font-bold text-navy hover:bg-cream-100 transition-colors">
            Volver al dashboard
        </a>

    </div>

    <!-- Layout principal -->
    <div class="grid grid-cols-1 xl:grid-cols-[340px_minmax(0,1fr)] gap-6">

        <!-- Card perfil -->
        <aside class="rounded-panel border border-cream-200 bg-white shadow-card overflow-hidden">

            <div class="bg-navy px-6 py-8 text-center">

                <div class="mx-auto h-28 w-28 overflow-hidden rounded-full border-4 border-white bg-cream shadow-panel">
                    <img src="{{ $profileImage }}" alt="Foto de perfil de {{ $user->nombres ?? 'administrador' }}" class="h-full w-full object-cover">
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

                <!-- Correo -->
                <div class="border-t border-cream-200 pt-5">
                    <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                        Correo electrónico
                    </p>

                    <p class="mt-1 text-sm font-medium text-ink">
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

        <!-- Formulario -->
        <div class="rounded-panel border border-cream-200 bg-white shadow-card">

            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="p-6 sm:p-8 space-y-8">
                @csrf
                @method('PUT')


                <!-- Foto de perfil -->
                <div>

                    <div class="mb-5 border-b border-cream-200 pb-4">
                        <h3 class="font-display text-2xl font-bold text-navy">
                            Foto de perfil
                        </h3>

                        <p class="mt-1 text-sm text-ink-600">
                            Actualiza la imagen que se mostrará en tu cuenta administrativa.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-[180px_minmax(0,1fr)] gap-6 items-center">

                        <div class="flex justify-center md:justify-start">
                            <div class="h-32 w-32 overflow-hidden rounded-full border-4 border-cream-200 bg-cream shadow-card">
                                <img src="{{ $profileImage }}" alt="Foto de perfil actual" class="h-full w-full object-cover">
                            </div>
                        </div>

                        <div>
                            <label for="foto_perfil" class="block text-sm font-semibold text-navy mb-2">
                                Nueva foto de perfil
                            </label>

                            <input type="file" id="foto_perfil" name="foto_perfil" accept="image/png,image/jpeg,image/jpg,image/webp,image/svg+xml" class="w-full rounded-card border border-cream-300 bg-white px-4 py-3 text-sm text-ink file:mr-4 file:rounded-card file:border-0 file:bg-barber-red file:px-4 file:py-2 file:text-sm file:font-bold file:text-white hover:file:bg-barber-red-700 focus:border-barber-red focus:outline-none focus:ring-4 focus:ring-barber-red-100 transition-colors">

                            @error('foto_perfil')
                            <p class="text-sm text-barber-red mt-1">{{ $message }}</p>
                            @enderror

                            <p class="mt-2 text-xs text-ink-500">
                                Formatos permitidos: JPG, JPEG, PNG, WEBP o SVG. Tamaño máximo: 2 MB.
                            </p>
                        </div>

                    </div>

                </div>
                <!-- Información personal -->
                <div>

                    <div class="mb-5 border-b border-cream-200 pb-4">
                        <h3 class="font-display text-2xl font-bold text-navy">
                            Información personal
                        </h3>

                        <p class="mt-1 text-sm text-ink-600">
                            Estos datos pertenecen a tu usuario administrador.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">

                        <!-- Nombres -->
                        <div>
                            <label for="nombres" class="block text-sm font-semibold text-navy mb-2">
                                Nombres *
                            </label>

                            <input type="text" id="nombres" name="nombres" value="{{ old('nombres', $user->nombres) }}" required maxlength="100" class="w-full px-4 py-3 rounded-card border border-cream-300 bg-white text-ink focus:border-barber-red focus:outline-none focus:ring-4 focus:ring-barber-red-100 transition-colors">

                            @error('nombres')
                            <p class="text-sm text-barber-red mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Primer apellido -->
                        <div>
                            <label for="primer_apellido" class="block text-sm font-semibold text-navy mb-2">
                                Primer apellido *
                            </label>

                            <input type="text" id="primer_apellido" name="primer_apellido" value="{{ old('primer_apellido', $user->primer_apellido) }}" required maxlength="100" class="w-full px-4 py-3 rounded-card border border-cream-300 bg-white text-ink focus:border-barber-red focus:outline-none focus:ring-4 focus:ring-barber-red-100 transition-colors">

                            @error('primer_apellido')
                            <p class="text-sm text-barber-red mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Segundo apellido -->
                        <div>
                            <label for="segundo_apellido" class="block text-sm font-semibold text-navy mb-2">
                                Segundo apellido
                            </label>

                            <input type="text" id="segundo_apellido" name="segundo_apellido" value="{{ old('segundo_apellido', $user->segundo_apellido) }}" maxlength="100" class="w-full px-4 py-3 rounded-card border border-cream-300 bg-white text-ink focus:border-barber-red focus:outline-none focus:ring-4 focus:ring-barber-red-100 transition-colors">

                            @error('segundo_apellido')
                            <p class="text-sm text-barber-red mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Género -->
                        <div>
                            <label for="genero" class="block text-sm font-semibold text-navy mb-2">
                                Género
                            </label>

                            <select id="genero" name="genero" class="w-full px-4 py-3 rounded-card border border-cream-300 bg-white text-ink focus:border-barber-red focus:outline-none focus:ring-4 focus:ring-barber-red-100 transition-colors">
                                <option value="">Selecciona una opción</option>

                                <option value="M" {{ old('genero', $user->genero) === 'M' ? 'selected' : '' }}>
                                    Masculino
                                </option>

                                <option value="F" {{ old('genero', $user->genero) === 'F' ? 'selected' : '' }}>
                                    Femenino
                                </option>

                                <option value="otro" {{ old('genero', $user->genero) === 'otro' ? 'selected' : '' }}>
                                    Otro
                                </option>
                            </select>

                            @error('genero')
                            <p class="text-sm text-barber-red mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                </div>

                <!-- Información de acceso -->
                <div>

                    <div class="mb-5 border-b border-cream-200 pb-4">
                        <h3 class="font-display text-2xl font-bold text-navy">
                            Información de acceso
                        </h3>

                        <p class="mt-1 text-sm text-ink-600">
                            Datos usados para iniciar sesión en el sistema.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-semibold text-navy mb-2">
                                Correo electrónico *
                            </label>

                            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required maxlength="255" class="w-full px-4 py-3 rounded-card border border-cream-300 bg-white text-ink focus:border-barber-red focus:outline-none focus:ring-4 focus:ring-barber-red-100 transition-colors">

                            @error('email')
                            <p class="text-sm text-barber-red mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Nombre usuario -->
                        <div>
                            <label for="nombre_usuario" class="block text-sm font-semibold text-navy mb-2">
                                Nombre de usuario *
                            </label>

                            <input type="text" id="nombre_usuario" name="nombre_usuario" value="{{ old('nombre_usuario', $user->nombre_usuario) }}" required maxlength="100" class="w-full px-4 py-3 rounded-card border border-cream-300 bg-white text-ink focus:border-barber-red focus:outline-none focus:ring-4 focus:ring-barber-red-100 transition-colors">

                            @error('nombre_usuario')
                            <p class="text-sm text-barber-red mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Celular -->
                        <div class="md:col-span-2">
                            <label for="celular" class="block text-sm font-semibold text-navy mb-2">
                                Celular
                            </label>

                            <input type="text" id="celular" name="celular" value="{{ old('celular', $user->celular) }}" maxlength="20" class="w-full px-4 py-3 rounded-card border border-cream-300 bg-white text-ink focus:border-barber-red focus:outline-none focus:ring-4 focus:ring-barber-red-100 transition-colors">

                            @error('celular')
                            <p class="text-sm text-barber-red mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                </div>

                <!-- Cambio de contraseña -->
                <div>

                    <div class="mb-5 border-b border-cream-200 pb-4">
                        <h3 class="font-display text-2xl font-bold text-navy">
                            Cambiar contraseña
                        </h3>

                        <p class="mt-1 text-sm text-ink-600">
                            Deja estos campos vacíos si no quieres cambiar tu contraseña.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-semibold text-navy mb-2">
                                Nueva contraseña
                            </label>

                            <input type="password" id="password" name="password" autocomplete="new-password" class="w-full px-4 py-3 rounded-card border border-cream-300 bg-white text-ink focus:border-barber-red focus:outline-none focus:ring-4 focus:ring-barber-red-100 transition-colors">

                            @error('password')
                            <p class="text-sm text-barber-red mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password confirmation -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-semibold text-navy mb-2">
                                Confirmar nueva contraseña
                            </label>

                            <input type="password" id="password_confirmation" name="password_confirmation" autocomplete="new-password" class="w-full px-4 py-3 rounded-card border border-cream-300 bg-white text-ink focus:border-barber-red focus:outline-none focus:ring-4 focus:ring-barber-red-100 transition-colors">
                        </div>

                    </div>

                </div>

                <!-- Botones -->
                <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 border-t border-cream-200 pt-6">

                    <a href="{{ route('administrador.dashboard') }}" class="inline-flex items-center justify-center rounded-panel bg-cream-200 px-6 py-3 text-sm font-bold text-navy hover:bg-cream-300 transition-colors">
                        Cancelar
                    </a>

                    <button type="submit" class="rounded-panel bg-barber-red px-6 py-3 text-sm font-bold text-white hover:bg-barber-red-700 focus:outline-none focus:ring-4 focus:ring-barber-red-100 transition-colors">
                        Guardar cambios
                    </button>

                </div>

            </form>

        </div>

    </div>

</section>

@endsection
