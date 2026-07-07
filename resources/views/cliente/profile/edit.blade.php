@extends('layouts.guest')

@section('title', 'Editar perfil - BarberShop')

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
                    Editar perfil
                </h1>

                <p class="mt-2 text-sm text-ink-600">
                    Actualiza tu información personal y datos de acceso.
                </p>
            </div>

            <a href="{{ route('profile.show') }}"
               class="inline-flex items-center justify-center rounded-panel border border-cream-300 bg-white px-5 py-3 text-sm font-bold text-navy hover:bg-cream-100 transition-colors">
                Volver a mi perfil
            </a>
        </div>

        @if ($errors->any())
            <div class="mb-6 rounded-card border border-danger bg-danger-light px-5 py-4 text-sm text-danger">
                <p class="mb-2 font-bold">
                    Hay errores en el formulario:
                </p>

                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST"
              action="{{ route('profile.update') }}"
              enctype="multipart/form-data"
              class="overflow-hidden rounded-panel border border-cream-200 bg-white shadow-panel">
            @csrf
            @method('PUT')

            <div class="bg-linear-to-r from-navy via-navy-800 to-barber-red px-6 py-8 text-white">

                <div class="flex flex-col items-center gap-5 sm:flex-row">

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
                            Puedes cambiar tu foto de perfil desde el formulario.
                        </p>
                    </div>

                </div>

            </div>

            <div class="grid grid-cols-1 gap-6 p-6 md:grid-cols-2">

                <div>
                    <label for="nombres" class="mb-2 block text-sm font-bold text-navy">
                        Nombre(s)
                    </label>

                    <input type="text"
                           name="nombres"
                           id="nombres"
                           value="{{ old('nombres', $user->nombres) }}"
                           required
                           class="w-full rounded-card border border-cream-300 px-4 py-3 text-ink shadow-sm focus:border-barber-red focus:outline-none focus:ring-4 focus:ring-barber-red-100">
                </div>

                <div>
                    <label for="primer_apellido" class="mb-2 block text-sm font-bold text-navy">
                        Primer apellido
                    </label>

                    <input type="text"
                           name="primer_apellido"
                           id="primer_apellido"
                           value="{{ old('primer_apellido', $user->primer_apellido) }}"
                           required
                           class="w-full rounded-card border border-cream-300 px-4 py-3 text-ink shadow-sm focus:border-barber-red focus:outline-none focus:ring-4 focus:ring-barber-red-100">
                </div>

                <div>
                    <label for="segundo_apellido" class="mb-2 block text-sm font-bold text-navy">
                        Segundo apellido
                    </label>

                    <input type="text"
                           name="segundo_apellido"
                           id="segundo_apellido"
                           value="{{ old('segundo_apellido', $user->segundo_apellido) }}"
                           class="w-full rounded-card border border-cream-300 px-4 py-3 text-ink shadow-sm focus:border-barber-red focus:outline-none focus:ring-4 focus:ring-barber-red-100">
                </div>

                <div>
                    <label for="nombre_usuario" class="mb-2 block text-sm font-bold text-navy">
                        Nombre de usuario
                    </label>

                    <input type="text"
                           name="nombre_usuario"
                           id="nombre_usuario"
                           value="{{ old('nombre_usuario', $user->nombre_usuario) }}"
                           required
                           class="w-full rounded-card border border-cream-300 px-4 py-3 text-ink shadow-sm focus:border-barber-red focus:outline-none focus:ring-4 focus:ring-barber-red-100">
                </div>

                <div>
                    <label for="email" class="mb-2 block text-sm font-bold text-navy">
                        Correo electrónico
                    </label>

                    <input type="email"
                           name="email"
                           id="email"
                           value="{{ old('email', $user->email) }}"
                           required
                           class="w-full rounded-card border border-cream-300 px-4 py-3 text-ink shadow-sm focus:border-barber-red focus:outline-none focus:ring-4 focus:ring-barber-red-100">
                </div>

                <div>
                    <label for="celular" class="mb-2 block text-sm font-bold text-navy">
                        Celular
                    </label>

                    <input type="text"
                           name="celular"
                           id="celular"
                           value="{{ old('celular', $user->celular) }}"
                           class="w-full rounded-card border border-cream-300 px-4 py-3 text-ink shadow-sm focus:border-barber-red focus:outline-none focus:ring-4 focus:ring-barber-red-100">
                </div>

                <div>
                    <label for="genero" class="mb-2 block text-sm font-bold text-navy">
                        Género
                    </label>

                    <select name="genero"
                            id="genero"
                            class="w-full rounded-card border border-cream-300 px-4 py-3 text-ink shadow-sm focus:border-barber-red focus:outline-none focus:ring-4 focus:ring-barber-red-100">
                        <option value="">Selecciona una opción</option>
                        <option value="M" {{ old('genero', $user->genero) === 'M' ? 'selected' : '' }}>Masculino</option>
                        <option value="F" {{ old('genero', $user->genero) === 'F' ? 'selected' : '' }}>Femenino</option>
                        <option value="otro" {{ old('genero', $user->genero) === 'otro' ? 'selected' : '' }}>Otro</option>
                    </select>
                </div>

                <div>
                    <label for="foto_perfil" class="mb-2 block text-sm font-bold text-navy">
                        Foto de perfil
                    </label>

                    <input type="file"
                           name="foto_perfil"
                           id="foto_perfil"
                           accept="image/png,image/jpeg,image/jpg,image/webp"
                           class="w-full rounded-card border border-cream-300 bg-white px-4 py-3 text-sm text-ink shadow-sm file:mr-4 file:rounded-card file:border-0 file:bg-barber-red file:px-4 file:py-2 file:font-bold file:text-white hover:file:bg-barber-red-700 focus:outline-none focus:ring-4 focus:ring-barber-red-100">
                </div>

            </div>

            <div class="border-t border-cream-200 bg-cream-50 p-6">

                <h3 class="font-display text-2xl font-bold text-navy">
                    Cambiar contraseña
                </h3>

                <p class="mt-1 text-sm text-ink-500">
                    Deja estos campos vacíos si no deseas cambiar tu contraseña.
                </p>

                <div class="mt-6 grid grid-cols-1 gap-6 md:grid-cols-2">

                    <div>
                        <label for="password" class="mb-2 block text-sm font-bold text-navy">
                            Nueva contraseña
                        </label>

                        <input type="password"
                               name="password"
                               id="password"
                               placeholder="Mínimo 8 caracteres"
                               class="w-full rounded-card border border-cream-300 px-4 py-3 text-ink shadow-sm focus:border-barber-red focus:outline-none focus:ring-4 focus:ring-barber-red-100">
                    </div>

                    <div>
                        <label for="password_confirmation" class="mb-2 block text-sm font-bold text-navy">
                            Confirmar contraseña
                        </label>

                        <input type="password"
                               name="password_confirmation"
                               id="password_confirmation"
                               placeholder="Repite la nueva contraseña"
                               class="w-full rounded-card border border-cream-300 px-4 py-3 text-ink shadow-sm focus:border-barber-red focus:outline-none focus:ring-4 focus:ring-barber-red-100">
                    </div>

                </div>

            </div>

            <div class="flex flex-col-reverse gap-3 border-t border-cream-200 px-6 py-5 sm:flex-row sm:justify-end">

                <a href="{{ route('profile.show') }}"
                   class="inline-flex items-center justify-center rounded-panel bg-cream-200 px-6 py-3 text-sm font-bold text-navy hover:bg-cream-300 transition-colors">
                    Cancelar
                </a>

                <button type="submit"
                        class="inline-flex items-center justify-center rounded-panel bg-barber-red px-6 py-3 text-sm font-bold text-white shadow-card hover:bg-barber-red-700 focus:outline-none focus:ring-4 focus:ring-barber-red-100 transition-colors">
                    Guardar cambios
                </button>

            </div>

        </form>

    </div>

</section>

@endsection