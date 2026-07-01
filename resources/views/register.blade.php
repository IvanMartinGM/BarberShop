@extends('layouts.guest')

@section('title', 'Registro - BarberShop')

@section('content')

    <!-- ==================================================
         REGISTER SECTION CON FONDO DE IMAGEN
         ================================================== -->

    <section class="relative min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">

        <!-- Fondo de imagen con overlay -->
        <div class="absolute inset-0 bg-cover bg-center bg-no-repeat"
             style="background-image: url('https://images.unsplash.com/photo-1585747860715-cd4628902d4a?w=1200&q=80');
                     background-attachment: fixed;">
            <!-- Overlay oscuro para mejor legibilidad -->
            <div class="absolute inset-0 bg-black opacity-60"></div>
        </div>

        <!-- Contenedor del formulario -->
        <div class="relative z-10 w-full max-w-2xl">

            <!-- Card del Registro -->
            <div class="bg-white rounded-2xl shadow-elevated p-8 md:p-10">

                <!-- Logo/Header -->
                <div class="text-center mb-8">
                    <h1 class="font-display text-4xl font-bold text-navy mb-2">
                        BARBERSHOP
                    </h1>
                    <p class="text-ink-600 text-sm">
                        Crea tu cuenta y disfruta de nuestros servicios
                    </p>
                </div>

                <!-- Formulario de Registro -->
                <form method="POST" action="{{ route('cliente.store') }}" class="space-y-6">

                    @csrf

                    <!-- Grid para campos en dos columnas en desktop -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">

                        <!-- Nombres -->
                        <div>
                            <label for="nombres" class="block text-sm font-semibold text-navy mb-2">
                                Nombres *
                            </label>
                            <input 
                                type="text" 
                                id="nombres" 
                                name="nombres" 
                                value="{{ old('nombres') }}"
                                required
                                placeholder="Juan"
                                class="w-full px-4 py-3 rounded-lg border-2 border-cream-200 focus:border-barber-red focus:outline-none transition-colors text-ink"
                            >
                            @error('nombres')
                                <p class="text-sm text-barber-red mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Primer Apellido -->
                        <div>
                            <label for="primer_apellido" class="block text-sm font-semibold text-navy mb-2">
                                Primer Apellido *
                            </label>
                            <input 
                                type="text" 
                                id="primer_apellido" 
                                name="primer_apellido" 
                                value="{{ old('primer_apellido') }}"
                                required
                                placeholder="Pérez"
                                class="w-full px-4 py-3 rounded-lg border-2 border-cream-200 focus:border-barber-red focus:outline-none transition-colors text-ink"
                            >
                            @error('primer_apellido')
                                <p class="text-sm text-barber-red mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Segundo Apellido -->
                        <div>
                            <label for="segundo_apellido" class="block text-sm font-semibold text-navy mb-2">
                                Segundo Apellido
                            </label>
                            <input 
                                type="text" 
                                id="segundo_apellido" 
                                name="segundo_apellido" 
                                value="{{ old('segundo_apellido') }}"
                                placeholder="García"
                                class="w-full px-4 py-3 rounded-lg border-2 border-cream-200 focus:border-barber-red focus:outline-none transition-colors text-ink"
                            >
                            @error('segundo_apellido')
                                <p class="text-sm text-barber-red mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Celular -->
                        <div>
                            <label for="celular" class="block text-sm font-semibold text-navy mb-2">
                                Celular
                            </label>
                            <input 
                                type="tel" 
                                id="celular" 
                                name="celular" 
                                value="{{ old('celular') }}"
                                placeholder="+34 123 456 789"
                                class="w-full px-4 py-3 rounded-lg border-2 border-cream-200 focus:border-barber-red focus:outline-none transition-colors text-ink"
                            >
                            @error('celular')
                                <p class="text-sm text-barber-red mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    <!-- Correo Electrónico (Full Width) -->
                    <div>
                        <label for="email" class="block text-sm font-semibold text-navy mb-2">
                            Correo Electrónico *
                        </label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            value="{{ old('email') }}"
                            required
                            placeholder="tu@email.com"
                            class="w-full px-4 py-3 rounded-lg border-2 border-cream-200 focus:border-barber-red focus:outline-none transition-colors text-ink"
                        >
                        @error('email')
                            <p class="text-sm text-barber-red mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nombre de Usuario (Full Width) -->
                    <div>
                        <label for="nombre_usuario" class="block text-sm font-semibold text-navy mb-2">
                            Nombre de Usuario *
                        </label>
                        <input 
                            type="text" 
                            id="nombre_usuario" 
                            name="nombre_usuario" 
                            value="{{ old('nombre_usuario') }}"
                            required
                            placeholder="juanperez123"
                            class="w-full px-4 py-3 rounded-lg border-2 border-cream-200 focus:border-barber-red focus:outline-none transition-colors text-ink"
                        >
                        @error('nombre_usuario')
                            <p class="text-sm text-barber-red mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Grid para campos en dos columnas -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">

                        <!-- Género -->
                        <div>
                            <label for="genero" class="block text-sm font-semibold text-navy mb-2">
                                Género
                            </label>
                            <select 
                                id="genero" 
                                name="genero"
                                class="w-full px-4 py-3 rounded-lg border-2 border-cream-200 focus:border-barber-red focus:outline-none transition-colors text-ink"
                            >
                                <option value="">Selecciona una opción</option>
                                <option value="M" {{ old('genero') === 'M' ? 'selected' : '' }}>Masculino</option>
                                <option value="F" {{ old('genero') === 'F' ? 'selected' : '' }}>Femenino</option>
                                <option value="otro" {{ old('genero') === 'otro' ? 'selected' : '' }}>Otro</option>
                            </select>
                            @error('genero')
                                <p class="text-sm text-barber-red mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Fecha de Nacimiento -->
                        <div>
                            <label for="fecha_nacimiento" class="block text-sm font-semibold text-navy mb-2">
                                Fecha de Nacimiento
                            </label>
                            <input 
                                type="date" 
                                id="fecha_nacimiento" 
                                name="fecha_nacimiento" 
                                value="{{ old('fecha_nacimiento') }}"
                                class="w-full px-4 py-3 rounded-lg border-2 border-cream-200 focus:border-barber-red focus:outline-none transition-colors text-ink"
                            >
                            @error('fecha_nacimiento')
                                <p class="text-sm text-barber-red mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    <!-- Contraseña -->
                    <div>
                        <label for="password" class="block text-sm font-semibold text-navy mb-2">
                            Contraseña *
                        </label>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            required
                            placeholder="••••••••"
                            class="w-full px-4 py-3 rounded-lg border-2 border-cream-200 focus:border-barber-red focus:outline-none transition-colors text-ink"
                        >
                        @error('password')
                            <p class="text-sm text-barber-red mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirmar Contraseña -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-semibold text-navy mb-2">
                            Confirmar Contraseña *
                        </label>
                        <input 
                            type="password" 
                            id="password_confirmation" 
                            name="password_confirmation" 
                            required
                            placeholder="••••••••"
                            class="w-full px-4 py-3 rounded-lg border-2 border-cream-200 focus:border-barber-red focus:outline-none transition-colors text-ink"
                        >
                        @error('password_confirmation')
                            <p class="text-sm text-barber-red mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Botones -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-4">
                        <button 
                            type="submit"
                            class="flex-1 bg-linear-to-r from-barber-red to-barber-red-600 hover:from-barber-red-600 hover:to-barber-red-700 text-white font-bold py-3 px-6 rounded-lg transition-all transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-barber-red-200"
                        >
                            Crear Cuenta
                        </button>
                        <button 
                            type="reset"
                            class="flex-1 bg-cream-200 hover:bg-cream-300 text-navy font-bold py-3 px-6 rounded-lg transition-colors"
                        >
                            Limpiar
                        </button>
                    </div>

                </form>

                <!-- Divider -->
                <div class="relative my-8">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t-2 border-cream-200"></div>
                    </div>
                </div>

                <!-- Link al Login -->
                <p class="text-center text-ink-600">
                    ¿Ya tienes cuenta? 
                    <a href="{{ route('login') }}" class="text-barber-red font-bold hover:text-barber-red-600">
                        Inicia sesión
                    </a>
                </p>

            </div>

            <!-- Link al inicio -->
            <div class="text-center mt-6">
                <a href="{{ route('home') }}" class="text-white hover:text-cream-100 font-semibold flex items-center justify-center">
                    ← Volver al Inicio
                </a>
            </div>

        </div>

    </section>

    <!-- CSS personalizado para el fondo -->
    <style>
        @media (max-width: 768px) {
            section {
                background-attachment: scroll !important;
            }
        }
    </style>

@endsection
