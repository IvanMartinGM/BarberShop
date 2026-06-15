<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>@yield('title', config('app.name'))</title>
</head>

<body class="bg-cream text-ink font-sans min-h-screen flex flex-col">

    <!-- ==================================================
         NAVBAR
         ================================================== -->

    <header class="sticky top-0 z-50 bg-white border-b border-cream-200 shadow-card">

        <div class="max-w-7xl mx-auto px-4 sm:px-6">

            <div class="h-16 flex items-center justify-between">

                <!-- Logo -->
                <a href="{{ route('home') }}"
                   class="font-display text-2xl font-bold text-navy hover:text-barber-red transition-colors">
                    ✂️ BARBERSHOP
                </a>

                <!-- Navigation Desktop -->
                <nav class="hidden md:flex items-center gap-8">
                    <a href="{{ route('home') }}"
                       class="text-ink hover:text-barber-red transition-colors">
                        Inicio
                    </a>
                    <a href="{{ route('servicios') }}"
                       class="text-ink hover:text-barber-red transition-colors">
                        Servicios
                    </a>
                    <a href="{{ route('contacto') }}"
                       class="text-ink hover:text-barber-red transition-colors">
                        Contacto
                    </a>
                </nav>

                <!-- Auth Links -->
                <div class="flex items-center gap-4">
                    @auth
                        <a href="{{ route('dashboard') }}"
                           class="text-ink hover:text-barber-red transition-colors">
                            Dashboard
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit"
                                    class="text-ink hover:text-barber-red transition-colors">
                                Salir
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}"
                           class="text-ink hover:text-barber-red transition-colors">
                            Iniciar Sesión
                        </a>
                        <a href="{{ route('register') }}"
                           class="bg-barber-red text-white px-4 py-2 rounded-md hover:bg-barber-red-600 transition-colors">
                            Registrarse
                        </a>
                    @endauth
                </div>

            </div>

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

    <footer class="bg-navy text-cream mt-16">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-12">

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8 mb-8">

                <div>
                    <h3 class="font-display text-lg mb-4">BARBERSHOP</h3>
                    <p class="text-cream-200 text-sm">Tu barbería de confianza desde 2024.</p>
                </div>

                <div>
                    <h4 class="font-semibold mb-3">Navegación</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('home') }}" class="text-cream-200 hover:text-white">Inicio</a></li>
                        <li><a href="{{ route('servicios') }}" class="text-cream-200 hover:text-white">Servicios</a></li>
                        <li><a href="{{ route('contacto') }}" class="text-cream-200 hover:text-white">Contacto</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-semibold mb-3">Horario</h4>
                    <ul class="space-y-2 text-sm text-cream-200">
                        <li>Lunes - Viernes: 9:00 - 19:00</li>
                        <li>Sábado: 9:00 - 17:00</li>
                        <li>Domingo: Cerrado</li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-semibold mb-3">Contacto</h4>
                    <ul class="space-y-2 text-sm text-cream-200">
                        <li>📞 +34 123 456 789</li>
                        <li>📧 info@barbershop.es</li>
                        <li>📍 Calle Principal, 123</li>
                    </ul>
                </div>

            </div>

            <div class="border-t border-navy-700 pt-8">
                <p class="text-center text-sm text-cream-200">
                    © {{ date('Y') }} BarberShop. Todos los derechos reservados.
                </p>
            </div>

        </div>

    </footer>

</body>
</html>