@extends('layouts.guest')

@section('title', 'Iniciar Sesión - BarberShop')

@section('content')

    <!-- ==================================================
         LOGIN SECTION CON FONDO DE IMAGEN
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
        <div class="relative z-10 w-full max-w-md">

            <!-- Card del Login -->
            <div class="bg-white rounded-2xl shadow-elevated p-8 md:p-10">

                <!-- Logo/Header -->
                <div class="text-center mb-8">
                    <h1 class="font-display text-4xl font-bold text-navy mb-2">
                        BARBERSHOP
                    </h1>
                    <p class="text-ink-600 text-sm">
                        Inicia sesión en tu cuenta
                    </p>
                </div>

                <!-- Formulario de Login -->
                <form method="POST" action="{{ route('login') }}" class="space-y-6">

                    @csrf

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-semibold text-navy mb-2">
                            Correo Electrónico
                        </label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            value="{{ old('email') }}"
                            required
                            autofocus
                            placeholder="tu@email.com"
                            class="w-full px-4 py-3 rounded-lg border-2 border-cream-200 focus:border-barber-red focus:outline-none transition-colors text-ink"
                        >
                        @error('email')
                            <p class="text-sm text-barber-red mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Contraseña -->
                    <div>
                        <label for="password" class="block text-sm font-semibold text-navy mb-2">
                            Contraseña
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

                    <!-- Recuérdame y Olvidé contraseña -->
                    <div class="flex items-center justify-between">
                        <label class="flex items-center">
                            <input 
                                type="checkbox" 
                                name="remember" 
                                id="remember"
                                class="w-4 h-4 accent-barber-red rounded"
                            >
                            <span class="ml-2 text-sm text-ink-600">Recuérdame</span>
                        </label>
                        <a href=#'password.request' class="text-sm text-barber-red hover:text-barber-red-600 font-semibold">
                            ¿Olvidaste tu contraseña?
                        </a>
                    </div>

                    <!-- Botón de Login -->
                    <button 
                        type="submit"
                        class="w-full bg-linear-to-r from-barber-red to-barber-red-600 hover:from-barber-red-600 hover:to-barber-red-700 text-white font-bold py-3 px-4 rounded-lg transition-all transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-barber-red-200"
                    >
                        Iniciar Sesión
                    </button>

                </form>

                <!-- Divider -->
                <div class="relative my-8">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t-2 border-cream-200"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white text-ink-600">¿No tienes cuenta?</span>
                    </div>
                </div>

                <!-- Link a Registro -->
                <p class="text-center">
                    <a href="{{ route('register.create') }}" class=" text-center text-barber-red font-bold hover:text-barber-red-600">
                        Regístrate aquí
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
