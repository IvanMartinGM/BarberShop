<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/svg+xml" href="{{ asset('razor-electric.svg') }}">

    @vite('resources/css/app.css')

    <title>@yield('title', 'Panel Administrativo - BarberShop')</title>
</head>

<body class="min-h-screen overflow-x-hidden bg-cream text-ink font-sans antialiased">

    <div class="min-h-screen grid grid-cols-[76px_minmax(0,1fr)] md:grid-cols-[280px_minmax(0,1fr)]">

        <!-- ==================================================
             SIDEBAR
             ================================================== -->

        <aside class="sticky top-0 h-screen bg-navy text-cream border-r border-navy-800 flex flex-col">

            <!-- Brand -->
            <div class="flex h-16 md:h-20 items-center justify-center md:justify-start px-3 md:px-6 border-b border-white/10">

                <a href="{{ route('administrador.dashboard') }}" class="flex items-center gap-3 min-w-0">

                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-panel bg-barber-red text-white shadow-card">
                        <img src="{{ asset('razor-electric.svg') }}" alt="BarberShop" class="h-6 w-6">
                    </div>

                    <div class="hidden md:block min-w-0">
                        <p class="font-display text-2xl font-bold leading-none text-white truncate">
                            BarberShop
                        </p>
                        <p class="mt-1 text-xs text-cream-300">
                            Panel administrativo
                        </p>
                    </div>

                </a>

            </div>

            <!-- Navigation -->
            <nav class="flex-1 space-y-2 px-3 md:px-4 py-4 md:py-6">
                <!-- Inicio / Home -->
                <a href="{{ route('home') }}" title="Inicio" class="flex items-center justify-center md:justify-start gap-3 rounded-panel px-3 md:px-4 py-3 text-sm transition-colors
   {{ request()->routeIs('home') ? 'bg-barber-red text-white font-semibold shadow-card' : 'text-cream-200 font-medium hover:bg-white/10 hover:text-white' }}">

                    <svg class="h-5 w-5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 11.5 12 4l9 7.5M5 10v10h5v-6h4v6h5V10" />
                    </svg>

                    <span class="hidden md:inline">Inicio</span>
                </a>

                <!-- Dashboard -->
                <a href="{{ route('administrador.dashboard') }}" title="Dashboard" class="flex items-center justify-center md:justify-start gap-3 rounded-panel px-3 md:px-4 py-3 text-sm transition-colors
                   {{ request()->is('dashboard') ? 'bg-barber-red text-white font-semibold shadow-card' : 'text-cream-200 font-medium hover:bg-white/10 hover:text-white' }}">

                    <svg class="h-5 w-5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 13h8V3H3v10Zm0 8h8v-6H3v6Zm10 0h8V11h-8v10Zm0-18v6h8V3h-8Z" />
                    </svg>

                    <span class="hidden md:inline">Dashboard</span>
                </a>

                <!-- Barberos -->
                <a href="{{ route('barbero.index') }}" title="Barberos" class="flex items-center justify-center md:justify-start gap-3 rounded-panel px-3 md:px-4 py-3 text-sm transition-colors
                   {{ request()->is('barberos*') ? 'bg-barber-red text-white font-semibold shadow-card' : 'text-cream-200 font-medium hover:bg-white/10 hover:text-white' }}">

                    <svg class="h-5 w-5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.121 14.121 19 19m-9.243-4.879L5 19m14-14-5.5 5.5M5 5l5.5 5.5M7 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm10 0a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z" />
                    </svg>

                    <span class="hidden md:inline">Barberos</span>
                </a>

                <!-- Clientes -->
                <a href="{{ route('cliente.index') }}" title="Clientes" class="flex items-center justify-center md:justify-start gap-3 rounded-panel px-3 md:px-4 py-3 text-sm transition-colors
                   {{ request()->is('clientes*') ? 'bg-barber-red text-white font-semibold shadow-card' : 'text-cream-200 font-medium hover:bg-white/10 hover:text-white' }}">

                    <svg class="h-5 w-5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 0 0-4-4h-1M9 20H4v-2a4 4 0 0 1 4-4h1m0-4a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm8 0a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z" />
                    </svg>

                    <span class="hidden md:inline">Clientes</span>
                </a>

                <!-- Horarios -->
                <a href="{{ route('horario.index') }}" class="flex items-center gap-3 rounded-panel px-4 py-3 text-sm font-bold transition-colors
                    {{ request()->routeIs('horario.*')
                    ? 'bg-barber-red text-white'
                     : 'text-cream-100 hover:bg-white/10 hover:text-white' }}">

                    <span class="inline-flex h-6 w-6 items-center justify-center">
                        🕒
                    </span>

                    <span class="hidden md:inline">
                        Horarios
                    </span>
                </a>

                <!-- Citas -->
                <a href="{{ route('administrador.citas.index') }}" title="Citas" class="flex items-center justify-center md:justify-start gap-3 rounded-panel px-3 md:px-4 py-3 text-sm transition-colors
                   {{ request()->is('citas*') ? 'bg-barber-red text-white font-semibold shadow-card' : 'text-cream-200 font-medium hover:bg-white/10 hover:text-white' }}">

                    <svg class="h-5 w-5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3M4 11h16M5 5h14a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1Z" />
                    </svg>

                    <span class="hidden md:inline">Citas</span>
                </a>

                <!-- Servicios -->
                <a href="{{ route('servicio.index') }}" title="Servicios" class="flex items-center justify-center md:justify-start gap-3 rounded-panel px-3 md:px-4 py-3 text-sm transition-colors
                   {{ request()->is('servicios*') ? 'bg-barber-red text-white font-semibold shadow-card' : 'text-cream-200 font-medium hover:bg-white/10 hover:text-white' }}">

                    <svg class="h-5 w-5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7h16M4 12h16M4 17h16" />
                    </svg>

                    <span class="hidden md:inline">Servicios</span>
                </a>
                <!-- Pagos -->
                <a href="{{ route('administrador.pagos.index') }}" title="Pagos" class="flex items-center justify-center md:justify-start gap-3 rounded-panel px-3 md:px-4 py-3 text-sm transition-colors
   {{ request()->routeIs('administrador.pagos.*') ? 'bg-barber-red text-white font-semibold shadow-card' : 'text-cream-200 font-medium hover:bg-white/10 hover:text-white' }}">

                    <svg class="h-5 w-5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 10h18M5 19h14a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2Z" />
                    </svg>

                    <span class="hidden md:inline">Pagos</span>
                </a>

                <!-- Reportes -->
                <a href="{{ route('administrador.reportes.index') }}" title="Reportes" class="flex items-center justify-center md:justify-start gap-3 rounded-panel px-3 md:px-4 py-3 text-sm transition-colors
   {{ request()->routeIs('administrador.reportes.*') ? 'bg-barber-red text-white font-semibold shadow-card' : 'text-cream-200 font-medium hover:bg-white/10 hover:text-white' }}">

                    <svg class="h-5 w-5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6m4 6V7m4 10v-3M5 21h14a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2Z" />
                    </svg>

                    <span class="hidden md:inline">Reportes</span>
                </a>

                <!-- Assets -->
                <a href="{{ route('asset.create') }}" title="Assets" class="flex items-center justify-center md:justify-start gap-3 rounded-panel px-3 md:px-4 py-3 text-sm transition-colors
   {{ request()->routeIs('asset.*') ? 'bg-barber-red text-white font-semibold shadow-card' : 'text-cream-200 font-medium hover:bg-white/10 hover:text-white' }}">

                    <svg class="h-5 w-5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 0 1 2.828 0L16 16m-2-2 1.586-1.586a2 2 0 0 1 2.828 0L20 14m-16 6h16a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2Zm4-12h.01" />
                    </svg>

                    <span class="hidden md:inline">Assets</span>
                </a>

            </nav>

            <!-- Bottom Navigation -->
            <div class="border-t border-white/10 px-3 md:px-4 py-4 space-y-2">

                <a href="{{ route('profile.show') }}" title="Mi perfil" class="flex w-full items-center justify-center md:justify-start gap-3 rounded-panel px-3 md:px-4 py-3 text-sm transition-colors
    {{ request()->routeIs('profile.*') ? 'bg-barber-red text-white font-semibold shadow-card' : 'text-cream-200 font-medium hover:bg-white/10 hover:text-white' }}">
                    <svg class="h-5 w-5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.75 7.5a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 20.25a8.25 8.25 0 0 1 15 0" />
                    </svg>

                    <span class="hidden md:inline">Mi perfil</span>
                </a>

                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit" title="Cerrar sesión" class="flex w-full items-center justify-center md:justify-start gap-3 rounded-panel px-3 md:px-4 py-3 text-sm font-medium text-cream-200 hover:bg-barber-red hover:text-white transition-colors">

                        <svg class="h-5 w-5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H3m0 0 4-4m-4 4 4 4m5-11h6a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-6" />
                        </svg>

                        <span class="hidden md:inline">Cerrar sesión</span>
                    </button>
                </form>

            </div>

        </aside>

        <!-- ==================================================
             MAIN AREA
             ================================================== -->

        <div class="min-w-0 flex flex-col">

            <!-- ==================================================
                 TOPBAR
                 ================================================== -->

            <header class="sticky top-0 z-40 bg-white/95 backdrop-blur border-b border-cream-200 shadow-card">

                <div class="flex min-h-16 items-center justify-between gap-4 px-4 sm:px-6 md:px-8">

                    <!-- Page Title -->
                    <div class="min-w-0">
                        <h1 class="font-display text-xl sm:text-2xl font-bold text-ink truncate">
                            @yield('page-title', 'Dashboard')
                        </h1>

                        <p class="hidden sm:block text-xs text-ink-500">
                            Panel administrativo de BarberShop
                        </p>
                    </div>

                    <!-- Admin Profile -->
                    @php
                    $authUser = auth()->user();

                    $defaultProfilePhoto = 'images/default-avatar.svg';

                    $fotoPerfil = $authUser?->foto_perfil;

                    if (!$fotoPerfil) {
                    $adminFotoPerfilUrl = asset($defaultProfilePhoto);
                    } elseif (\Illuminate\Support\Str::startsWith($fotoPerfil, ['http://', 'https://'])) {
                    $adminFotoPerfilUrl = $fotoPerfil;
                    } elseif (\Illuminate\Support\Str::startsWith($fotoPerfil, 'images/')) {
                    $adminFotoPerfilUrl = asset($fotoPerfil);
                    } else {
                    $adminFotoPerfilUrl = asset('storage/' . $fotoPerfil);
                    }
                    @endphp

                    <!-- Admin Profile -->
                    <a href="{{ route('profile.show') }}" title="Ver mi perfil" class="ml-auto flex items-center gap-3 shrink-0 rounded-panel px-2 py-2 hover:bg-cream-100 transition-colors">
                        <div class="hidden sm:block text-right">
                            <p class="text-sm font-semibold text-ink">
                                {{ $authUser?->nombres ?? 'Administrador' }}
                            </p>

                            <p class="text-xs text-ink-500">
                                Mi perfil
                            </p>
                        </div>

                        <div class="h-10 w-10 overflow-hidden rounded-full bg-white p-1 shadow-card ring-2 ring-cream-200">
                            <img src="{{ $adminFotoPerfilUrl }}" alt="Foto de perfil de {{ $authUser?->nombres ?? 'Administrador' }}" class="h-full w-full rounded-full object-cover">
                        </div>
                    </a>

                </div>

            </header>

            <!-- ==================================================
                 CONTENT
                 ================================================== -->

            <main class="flex-1 min-w-0 bg-cream px-4 py-6 sm:px-6 md:px-8 md:py-8">

                {{-- Mensajes globales del panel administrador --}}
                @php
                $successMessage = session('status') ?? session('success');
                @endphp

                @if ($successMessage)
                <div class="mb-6 rounded-card border border-success bg-success-light px-5 py-4 text-sm font-semibold text-success">
                    {{ $successMessage }}
                </div>
                @endif

                @if (session('error'))
                <div class="mb-6 rounded-card border border-danger bg-danger-light px-5 py-4 text-sm font-semibold text-danger">
                    {{ session('error') }}
                </div>
                @endif

                @if ($errors->any())
                <div class="mb-6 rounded-card border border-danger bg-danger-light px-5 py-4 text-sm text-danger">
                    <p class="font-bold mb-2">
                        Hay errores en el formulario:
                    </p>

                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                @yield('content')
            </main>

        </div>

    </div>

</body>
</html>
