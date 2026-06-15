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
                <form method="POST" action="{{ route('register') }}" class="space-y-6">

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
                            <label for="primerApellido" class="block text-sm font-semibold text-navy mb-2">
                                Primer Apellido *
                            </label>
                            <input 
                                type="text" 
                                id="primerApellido" 
                                name="primerApellido" 
                                value="{{ old('primerApellido') }}"
                                required
                                placeholder="Pérez"
                                class="w-full px-4 py-3 rounded-lg border-2 border-cream-200 focus:border-barber-red focus:outline-none transition-colors text-ink"
                            >
                            @error('primerApellido')
                                <p class="text-sm text-barber-red mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Segundo Apellido -->
                        <div>
                            <label for="segundoApellido" class="block text-sm font-semibold text-navy mb-2">
                                Segundo Apellido
                            </label>
                            <input 
                                type="text" 
                                id="segundoApellido" 
                                name="segundoApellido" 
                                value="{{ old('segundoApellido') }}"
                                placeholder="García"
                                class="w-full px-4 py-3 rounded-lg border-2 border-cream-200 focus:border-barber-red focus:outline-none transition-colors text-ink"
                            >
                            @error('segundoApellido')
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
                        <label for="correo" class="block text-sm font-semibold text-navy mb-2">
                            Correo Electrónico *
                        </label>
                        <input 
                            type="email" 
                            id="correo" 
                            name="correo" 
                            value="{{ old('correo') }}"
                            required
                            placeholder="tu@email.com"
                            class="w-full px-4 py-3 rounded-lg border-2 border-cream-200 focus:border-barber-red focus:outline-none transition-colors text-ink"
                        >
                        @error('correo')
                            <p class="text-sm text-barber-red mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nombre de Usuario (Full Width) -->
                    <div>
                        <label for="nombreUsuario" class="block text-sm font-semibold text-navy mb-2">
                            Nombre de Usuario *
                        </label>
                        <input 
                            type="text" 
                            id="nombreUsuario" 
                            name="nombreUsuario" 
                            value="{{ old('nombreUsuario') }}"
                            required
                            placeholder="juanperez123"
                            class="w-full px-4 py-3 rounded-lg border-2 border-cream-200 focus:border-barber-red focus:outline-none transition-colors text-ink"
                        >
                        @error('nombreUsuario')
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
                        <label for="contrasena" class="block text-sm font-semibold text-navy mb-2">
                            Contraseña *
                        </label>
                        <input 
                            type="password" 
                            id="contrasena" 
                            name="contrasena" 
                            required
                            placeholder="••••••••"
                            class="w-full px-4 py-3 rounded-lg border-2 border-cream-200 focus:border-barber-red focus:outline-none transition-colors text-ink"
                        >
                        @error('contrasena')
                            <p class="text-sm text-barber-red mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirmar Contraseña -->
                    <div>
                        <label for="contrasena_confirmation" class="block text-sm font-semibold text-navy mb-2">
                            Confirmar Contraseña *
                        </label>
                        <input 
                            type="password" 
                            id="contrasena_confirmation" 
                            name="contrasena_confirmation" 
                            required
                            placeholder="••••••••"
                            class="w-full px-4 py-3 rounded-lg border-2 border-cream-200 focus:border-barber-red focus:outline-none transition-colors text-ink"
                        >
                    </div>

                    <!-- Checkbox Notificaciones y Términos -->
                    <div class="space-y-3">
                        <label class="flex items-start">
                            <input 
                                type="checkbox" 
                                name="acepta_notificaciones" 
                                id="acepta_notificaciones"
                                value="1"
                                checked
                                class="w-4 h-4 mt-1 accent-barber-red rounded"
                            >
                            <span class="ml-3 text-sm text-ink-600">
                                Quiero recibir ofertas y promociones especiales de BarberShop
                            </span>
                        </label>

                        <label class="flex items-start">
                            <input 
                                type="checkbox" 
                                name="terminos" 
                                id="terminos"
                                required
                                class="w-4 h-4 mt-1 accent-barber-red rounded"
                            >
                            <span class="ml-3 text-sm text-ink-600">
                                Acepto los <span class="font-semibold text-navy">términos y condiciones</span> y la <span class="font-semibold text-navy">política de privacidad</span> *
                            </span>
                        </label>
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
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white text-ink-600">O regístrate con</span>
                    </div>
                </div>

                <!-- Google Register -->
                <a href="#auth.google" 
                   class="w-full flex items-center justify-center px-4 py-3 border-2 border-cream-200 rounded-lg hover:bg-cream-50 transition-colors font-semibold text-navy mb-6">
                    <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                        <path fill="currentColor" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                        <path fill="currentColor" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                        <path fill="currentColor" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                    </svg>
                    Registrarse con Google
                </a>

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
