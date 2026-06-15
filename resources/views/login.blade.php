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
                        <span class="px-2 bg-white text-ink-600">O continúa con</span>
                    </div>
                </div>

                <!-- Google Login -->
                <a href='#auth.google' 
                   class="w-full flex items-center justify-center px-4 py-3 border-2 border-cream-200 rounded-lg hover:bg-cream-50 transition-colors font-semibold text-navy mb-8">
                    <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                        <path fill="currentColor" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                        <path fill="currentColor" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2。09V7。07H2。18C1。43 8。55 1 10。２２ １ １２s。4３ ３。４５ １。１８ ４。９３l２。８５-２。２２。８１-.６２z"/>
                        <path fill="currentColor" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                    </svg>
                    Iniciar con Google
                </a>


                <!-- Link a Registro -->
                <p class="text-center text-ink-600">
                    ¿No tienes cuenta? 
                    <a href="{{ route('register') }}" class="text-barber-red font-bold hover:text-barber-red-600">
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
