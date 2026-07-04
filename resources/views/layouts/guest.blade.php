<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/svg+xml" href="{{ asset('razor-electric.svg') }}">

    @vite('resources/css/app.css')

    <title>@yield('title', config('app.name'))</title>
</head>

<body class="min-h-screen bg-cream text-ink font-sans antialiased flex flex-col">

    <!-- ==================================================
         NAVBAR
         ================================================== -->

    <header class="sticky top-0 z-50 bg-white/95 backdrop-blur border-b border-cream-200 shadow-card">

        <div class="max-w-7xl mx-auto px-4 sm:px-6">

            <!-- Top navbar -->
            <div class="min-h-16 flex items-center justify-between gap-4 py-3 md:py-0">

                <!-- Logo -->
                <a href="{{ route('home') }}"
                   class="flex items-center gap-2 min-w-0 font-display font-bold text-navy hover:text-barber-red transition-colors">

                    <span class="text-xl sm:text-2xl leading-none">
                        ✂️
                    </span>

                    <span class="text-xl sm:text-2xl truncate">
                        BARBERSHOP
                    </span>
                </a>

                <!-- Desktop Navigation -->
                <nav class="hidden md:flex items-center gap-6 lg:gap-8">
                    <a href="{{ route('home') }}"
                       class="text-sm font-medium text-ink hover:text-barber-red transition-colors">
                        Inicio
                    </a>

                    <a href="{{ route('servicios') }}"
                       class="text-sm font-medium text-ink hover:text-barber-red transition-colors">
                        Servicios
                    </a>

                    <a href="{{ route('contacto') }}"
                       class="text-sm font-medium text-ink hover:text-barber-red transition-colors">
                        Contacto
                    </a>
                </nav>

                <!-- Desktop Auth Links -->
                <div class="hidden md:flex items-center gap-3">
                    @auth
                        <a href="{{ route('administrador.dashboard') }}"
                           class="text-sm font-medium text-ink hover:text-barber-red transition-colors">
                            Dashboard
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <button type="submit"
                                    class="text-sm font-medium text-ink hover:text-barber-red transition-colors">
                                Salir
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}"
                           class="text-sm font-medium text-ink hover:text-barber-red transition-colors">
                            Iniciar Sesión
                        </a>

                        <a href="{{ route('register.create') }}"
                           class="inline-flex items-center justify-center rounded-md bg-barber-red px-4 py-2 text-sm font-semibold text-white shadow-card hover:bg-barber-red-600 transition-colors">
                            Registrarse
                        </a>
                    @endauth
                </div>

                <!-- Mobile Auth Links -->
                <div class="flex md:hidden items-center gap-2 shrink-0">
                    @auth
                        <a href="{{ route('administrador.dashboard') }}"
                           class="rounded-md bg-cream-100 px-3 py-2 text-xs font-semibold text-navy hover:bg-cream-200 transition-colors">
                            Panel
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <button type="submit"
                                    class="rounded-md bg-barber-red px-3 py-2 text-xs font-semibold text-white hover:bg-barber-red-600 transition-colors">
                                Salir
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}"
                           class="rounded-md bg-cream-100 px-3 py-2 text-xs font-semibold text-navy hover:bg-cream-200 transition-colors">
                            Entrar
                        </a>

                        <a href="{{ route('register.create') }}"
                           class="rounded-md bg-barber-red px-3 py-2 text-xs font-semibold text-white hover:bg-barber-red-600 transition-colors">
                            Registro
                        </a>
                    @endauth
                </div>

            </div>

            <!-- Mobile Navigation -->
            <nav class="md:hidden border-t border-cream-200 py-3">
                <div class="grid grid-cols-3 gap-2 text-center">
                    <a href="{{ route('home') }}"
                       class="rounded-md px-3 py-2 text-sm font-medium text-ink hover:bg-cream-100 hover:text-barber-red transition-colors">
                        Inicio
                    </a>

                    <a href="{{ route('servicios') }}"
                       class="rounded-md px-3 py-2 text-sm font-medium text-ink hover:bg-cream-100 hover:text-barber-red transition-colors">
                        Servicios
                    </a>

                    <a href="{{ route('contacto') }}"
                       class="rounded-md px-3 py-2 text-sm font-medium text-ink hover:bg-cream-100 hover:text-barber-red transition-colors">
                        Contacto
                    </a>
                </div>
            </nav>

        </div>

    </header>

    <!-- ==================================================
         MAIN
         ================================================== -->

    <main class="flex-1">
        @yield('content')
    </main>

    <!-- ==================================================
         FOOTER
         ================================================== -->

    <footer class="bg-navy text-cream">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-10 sm:py-12">

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-10">

                <div>
                    <h3 class="font-display text-xl font-bold mb-3">
                        BARBERSHOP
                    </h3>

                    <p class="text-sm leading-6 text-cream-200 max-w-xs">
                        Tu barbería de confianza desde 2024.
                    </p>
                </div>

                <div>
                    <h4 class="font-semibold mb-3">
                        Navegación
                    </h4>

                    <ul class="space-y-2 text-sm">
                        <li>
                            <a href="{{ route('home') }}"
                               class="text-cream-200 hover:text-white transition-colors">
                                Inicio
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('servicios') }}"
                               class="text-cream-200 hover:text-white transition-colors">
                                Servicios
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('contacto') }}"
                               class="text-cream-200 hover:text-white transition-colors">
                                Contacto
                            </a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-semibold mb-3">
                        Horario
                    </h4>

                    <ul class="space-y-2 text-sm leading-6 text-cream-200">
                        <li>Lunes - Viernes: 9:00 - 19:00</li>
                        <li>Sábado: 9:00 - 17:00</li>
                        <li>Domingo: Cerrado</li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-semibold mb-3">
                        Contacto
                    </h4>

                    <ul class="space-y-2 text-sm leading-6 text-cream-200">
                        <li>📞 +34 123 456 789</li>
                        <li>📧 info@barbershop.es</li>
                        <li>📍 Calle Principal, 123</li>
                    </ul>
                </div>

            </div>

            <div class="mt-10 border-t border-navy-700 pt-6">
                <p class="text-center text-xs sm:text-sm text-cream-200">
                    © {{ date('Y') }} BarberShop. Todos los derechos reservados.
                </p>
            </div>

        </div>

    </footer>

</body>
</html>