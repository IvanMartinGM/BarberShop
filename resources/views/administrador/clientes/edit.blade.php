@extends('layouts.admin')

@section('title', 'Editar cliente - BarberShop')
@section('page-title', 'Editar cliente')

@section('content')

<section class="max-w-5xl mx-auto">

    <!-- Header interno -->
    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="font-display text-3xl font-bold text-navy">
                Editar cliente
            </h2>

            <p class="mt-2 text-sm text-ink-600">
                Actualiza la información personal y de acceso del cliente.
            </p>
        </div>

        <a href="{{ route('cliente.show', $cliente->id) }}"
           class="inline-flex items-center justify-center rounded-panel border border-cream-300 bg-white px-5 py-3 text-sm font-bold text-navy hover:bg-cream-100 transition-colors">
            Volver al perfil
        </a>
    </div>

    <!-- Card principal -->
    <div class="rounded-panel border border-cream-200 bg-white shadow-card">

        <form method="POST" action="{{ route('cliente.update', $cliente->id) }}" class="p-6 sm:p-8 space-y-8">
            @csrf
            @method('PUT')

            <!-- Información de usuario -->
            <div>
                <div class="mb-5 border-b border-cream-200 pb-4">
                    <h3 class="font-display text-2xl font-bold text-navy">
                        Información de usuario
                    </h3>

                    <p class="mt-1 text-sm text-ink-600">
                        Datos básicos de la cuenta del cliente.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">

                    <div>
                        <label for="nombres" class="block text-sm font-semibold text-navy mb-2">
                            Nombres *
                        </label>

                        <input
                            type="text"
                            id="nombres"
                            name="nombres"
                            value="{{ old('nombres', $cliente->user?->nombres) }}"
                            required
                            placeholder="Ivan Martin"
                            class="w-full px-4 py-3 rounded-card border border-cream-300 bg-white text-ink placeholder:text-ink-500 focus:border-barber-red focus:outline-none focus:ring-4 focus:ring-barber-red-100 transition-colors"
                        >

                        @error('nombres')
                            <p class="text-sm text-barber-red mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="primer_apellido" class="block text-sm font-semibold text-navy mb-2">
                            Primer Apellido *
                        </label>

                        <input
                            type="text"
                            id="primer_apellido"
                            name="primer_apellido"
                            value="{{ old('primer_apellido', $cliente->user?->primer_apellido) }}"
                            required
                            placeholder="Gomez"
                            class="w-full px-4 py-3 rounded-card border border-cream-300 bg-white text-ink placeholder:text-ink-500 focus:border-barber-red focus:outline-none focus:ring-4 focus:ring-barber-red-100 transition-colors"
                        >

                        @error('primer_apellido')
                            <p class="text-sm text-barber-red mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="segundo_apellido" class="block text-sm font-semibold text-navy mb-2">
                            Segundo Apellido
                        </label>

                        <input
                            type="text"
                            id="segundo_apellido"
                            name="segundo_apellido"
                            value="{{ old('segundo_apellido', $cliente->user?->segundo_apellido) }}"
                            placeholder="Magaña"
                            class="w-full px-4 py-3 rounded-card border border-cream-300 bg-white text-ink placeholder:text-ink-500 focus:border-barber-red focus:outline-none focus:ring-4 focus:ring-barber-red-100 transition-colors"
                        >

                        @error('segundo_apellido')
                            <p class="text-sm text-barber-red mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="celular" class="block text-sm font-semibold text-navy mb-2">
                            Celular
                        </label>

                        <input
                            type="tel"
                            id="celular"
                            name="celular"
                            value="{{ old('celular', $cliente->user?->celular) }}"
                            placeholder="+52 333 456 7890"
                            class="w-full px-4 py-3 rounded-card border border-cream-300 bg-white text-ink placeholder:text-ink-500 focus:border-barber-red focus:outline-none focus:ring-4 focus:ring-barber-red-100 transition-colors"
                        >

                        @error('celular')
                            <p class="text-sm text-barber-red mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="email" class="block text-sm font-semibold text-navy mb-2">
                            Correo Electrónico *
                        </label>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email', $cliente->user?->email) }}"
                            required
                            placeholder="cliente@email.com"
                            class="w-full px-4 py-3 rounded-card border border-cream-300 bg-white text-ink placeholder:text-ink-500 focus:border-barber-red focus:outline-none focus:ring-4 focus:ring-barber-red-100 transition-colors"
                        >

                        @error('email')
                            <p class="text-sm text-barber-red mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="nombre_usuario" class="block text-sm font-semibold text-navy mb-2">
                            Nombre de Usuario *
                        </label>

                        <input
                            type="text"
                            id="nombre_usuario"
                            name="nombre_usuario"
                            value="{{ old('nombre_usuario', $cliente->user?->nombre_usuario) }}"
                            required
                            placeholder="ivangomez123"
                            class="w-full px-4 py-3 rounded-card border border-cream-300 bg-white text-ink placeholder:text-ink-500 focus:border-barber-red focus:outline-none focus:ring-4 focus:ring-barber-red-100 transition-colors"
                        >

                        @error('nombre_usuario')
                            <p class="text-sm text-barber-red mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="genero" class="block text-sm font-semibold text-navy mb-2">
                            Género
                        </label>

                        <select
                            id="genero"
                            name="genero"
                            class="w-full px-4 py-3 rounded-card border border-cream-300 bg-white text-ink focus:border-barber-red focus:outline-none focus:ring-4 focus:ring-barber-red-100 transition-colors"
                        >
                            <option value="">Selecciona una opción</option>
                            <option value="M" {{ old('genero', $cliente->user?->genero) === 'M' ? 'selected' : '' }}>
                                Masculino
                            </option>
                            <option value="F" {{ old('genero', $cliente->user?->genero) === 'F' ? 'selected' : '' }}>
                                Femenino
                            </option>
                            <option value="otro" {{ old('genero', $cliente->user?->genero) === 'otro' ? 'selected' : '' }}>
                                Otro
                            </option>
                        </select>

                        @error('genero')
                            <p class="text-sm text-barber-red mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="estado" class="block text-sm font-semibold text-navy mb-2">
                            Estado del cliente *
                        </label>

                        <select
                            id="estado"
                            name="estado"
                            required
                            class="w-full px-4 py-3 rounded-card border border-cream-300 bg-white text-ink focus:border-barber-red focus:outline-none focus:ring-4 focus:ring-barber-red-100 transition-colors"
                        >
                            <option value="1" {{ (string) old('estado', $cliente->user?->estado) === '1' ? 'selected' : '' }}>
                                Activo
                            </option>
                            <option value="0" {{ (string) old('estado', $cliente->user?->estado) === '0' ? 'selected' : '' }}>
                                Inactivo
                            </option>
                        </select>

                        @error('estado')
                            <p class="text-sm text-barber-red mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
            </div>

            <!-- Credenciales -->
            <div>
                <div class="mb-5 border-b border-cream-200 pb-4">
                    <h3 class="font-display text-2xl font-bold text-navy">
                        Credenciales de acceso
                    </h3>

                    <p class="mt-1 text-sm text-ink-600">
                        Deja estos campos vacíos si no deseas cambiar la contraseña.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">

                    <div>
                        <label for="password" class="block text-sm font-semibold text-navy mb-2">
                            Nueva contraseña
                        </label>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Dejar vacío para no cambiar"
                            class="w-full px-4 py-3 rounded-card border border-cream-300 bg-white text-ink placeholder:text-ink-500 focus:border-barber-red focus:outline-none focus:ring-4 focus:ring-barber-red-100 transition-colors"
                        >

                        @error('password')
                            <p class="text-sm text-barber-red mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-semibold text-navy mb-2">
                            Confirmar nueva contraseña
                        </label>

                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            placeholder="Repite la nueva contraseña"
                            class="w-full px-4 py-3 rounded-card border border-cream-300 bg-white text-ink placeholder:text-ink-500 focus:border-barber-red focus:outline-none focus:ring-4 focus:ring-barber-red-100 transition-colors"
                        >

                        @error('password_confirmation')
                            <p class="text-sm text-barber-red mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
            </div>

            <!-- Botones -->
            <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 border-t border-cream-200 pt-6">

                <a href="{{ route('cliente.show', $cliente->id) }}"
                   class="inline-flex items-center justify-center rounded-panel bg-cream-200 px-6 py-3 text-sm font-bold text-navy hover:bg-cream-300 transition-colors">
                    Cancelar
                </a>

                <button
                    type="submit"
                    class="rounded-panel bg-barber-red px-6 py-3 text-sm font-bold text-white hover:bg-barber-red-700 focus:outline-none focus:ring-4 focus:ring-barber-red-100 transition-colors"
                >
                    Actualizar cliente
                </button>

            </div>

        </form>

    </div>

</section>

@endsection