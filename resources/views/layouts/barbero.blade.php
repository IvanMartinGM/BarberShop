<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="icon" type="image/svg+xml" href="{{ asset('razor-electric.svg') }}">

    @vite('resources/css/app.css')

    <title>@yield('title', 'Panel Barbero - BarberShop')</title>
</head>

<body class="min-h-screen overflow-x-hidden bg-cream text-ink font-sans antialiased">

    <div class="min-h-screen grid grid-cols-[76px_minmax(0,1fr)] md:grid-cols-[280px_minmax(0,1fr)]">

        <!-- ==================================================
             SIDEBAR BARBERO
             ================================================== -->

        <aside class="sticky top-0 h-screen bg-navy text-cream border-r border-navy-800 flex flex-col">

            <!-- Brand -->
            <div class="flex h-16 md:h-20 items-center justify-center md:justify-start px-3 md:px-6 border-b border-white/10">

                <a href="{{ route('barbero.dashboard') }}" class="flex items-center gap-3 min-w-0">

                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-panel bg-barber-red text-white shadow-card">
                        <img
                            src="{{ asset('razor-electric.svg') }}"
                            alt="BarberShop"
                            class="h-6 w-6"
                        >
                    </div>

                    <div class="hidden md:block min-w-0">
                        <p class="font-display text-2xl font-bold leading-none text-white truncate">
                            BarberShop
                        </p>

                        <p class="mt-1 text-xs text-cream-300">
                            Panel barbero
                        </p>
                    </div>

                </a>

            </div>

            <!-- Navigation -->
            <nav class="flex-1 space-y-2 px-3 md:px-4 py-4 md:py-6">

                <!-- Dashboard -->
                <a
                    href="{{ route('barbero.dashboard') }}"
                    title="Dashboard"
                    class="flex items-center justify-center md:justify-start gap-3 rounded-panel px-3 md:px-4 py-3 text-sm transition-colors
                    {{ request()->routeIs('barbero.dashboard') ? 'bg-barber-red text-white font-semibold shadow-card' : 'text-cream-200 font-medium hover:bg-white/10 hover:text-white' }}"
                >
                    <svg class="h-5 w-5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 13h8V3H3v10Zm0 8h8v-6H3v6Zm10 0h8V11h-8v10Zm0-18v6h8V3h-8Z" />
                    </svg>

                    <span class="hidden md:inline">Dashboard</span>
                </a>

                <!-- Mis citas -->
                <a
                    href="#barbero.citas.index"
                    title="Mis citas"
                    class="flex items-center justify-center md:justify-start gap-3 rounded-panel px-3 md:px-4 py-3 text-sm transition-colors
                    {{ request()->routeIs('barbero.citas.*') ? 'bg-barber-red text-white font-semibold shadow-card' : 'text-cream-200 font-medium hover:bg-white/10 hover:text-white' }}"
                >
                    <svg class="h-5 w-5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3M4 11h16M5 5h14a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1Z" />
                    </svg>

                    <span class="hidden md:inline">Mis citas</span>
                </a>

                <!-- Mi horario -->
                <a
                    href="{{ route('barbero.horarios.index') }}"
                    title="Mi horario"
                    class="flex items-center justify-center md:justify-start gap-3 rounded-panel px-3 md:px-4 py-3 text-sm transition-colors
                    {{ request()->routeIs('barbero.horarios.*') ? 'bg-barber-red text-white font-semibold shadow-card' : 'text-cream-200 font-medium hover:bg-white/10 hover:text-white' }}"
                >
                    <span class="inline-flex h-5 w-5 shrink-0 items-center justify-center">
                        🕒
                    </span>

                    <span class="hidden md:inline">Mi horario</span>
                </a>

                <!-- Mis servicios -->
                <a
                    href="{{ route('barbero.servicios.index') }}"
                    title="Mis servicios"
                    class="flex items-center justify-center md:justify-start gap-3 rounded-panel px-3 md:px-4 py-3 text-sm transition-colors
                    {{ request()->routeIs('barbero.servicios.*') ? 'bg-barber-red text-white font-semibold shadow-card' : 'text-cream-200 font-medium hover:bg-white/10 hover:text-white' }}"
                >
                    <svg class="h-5 w-5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7h16M4 12h16M4 17h16" />
                    </svg>

                    <span class="hidden md:inline">Mis servicios</span>
                </a>

            </nav>

            <!-- Bottom Navigation -->
            <div class="border-t border-white/10 px-3 md:px-4 py-4 space-y-2">

                <!-- Mi perfil -->
                <a
                    href="{{ route('profile.show') }}"
                    title="Mi perfil"
                    class="flex w-full items-center justify-center md:justify-start gap-3 rounded-panel px-3 md:px-4 py-3 text-sm transition-colors
                    {{ request()->routeIs('profile.*') ? 'bg-barber-red text-white font-semibold shadow-card' : 'text-cream-200 font-medium hover:bg-white/10 hover:text-white' }}"
                >
                    <svg class="h-5 w-5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.75 7.5a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 20.25a8.25 8.25 0 0 1 15 0" />
                    </svg>

                    <span class="hidden md:inline">Mi perfil</span>
                </a>

                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button
                        type="submit"
                        title="Cerrar sesión"
                        class="flex w-full items-center justify-center md:justify-start gap-3 rounded-panel px-3 md:px-4 py-3 text-sm font-medium text-cream-200 hover:bg-barber-red hover:text-white transition-colors"
                    >
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
                            @yield('page-title', 'Dashboard barbero')
                        </h1>

                        <p class="hidden sm:block text-xs text-ink-500">
                            Panel de trabajo del barbero
                        </p>
                    </div>

                    @php
                        $authUser = auth()->user();

                        $defaultProfilePhoto = 'images/default-avatar.svg';

                        $fotoPerfil = $authUser?->foto_perfil;

                        if (!$fotoPerfil) {
                            $barberoFotoPerfilUrl = asset($defaultProfilePhoto);
                        } elseif (\Illuminate\Support\Str::startsWith($fotoPerfil, ['http://', 'https://'])) {
                            $barberoFotoPerfilUrl = $fotoPerfil;
                        } elseif (\Illuminate\Support\Str::startsWith($fotoPerfil, 'images/')) {
                            $barberoFotoPerfilUrl = asset($fotoPerfil);
                        } else {
                            $barberoFotoPerfilUrl = asset('storage/' . $fotoPerfil);
                        }
                    @endphp

                    <!-- Barbero Profile -->
                    <a
                        href="{{ route('profile.show') }}"
                        title="Ver mi perfil"
                        class="ml-auto flex items-center gap-3 shrink-0 rounded-panel px-2 py-2 hover:bg-cream-100 transition-colors"
                    >
                        <div class="hidden sm:block text-right">
                            <p class="text-sm font-semibold text-ink">
                                {{ $authUser?->nombres ?? 'Barbero' }}
                            </p>

                            <p class="text-xs text-ink-500">
                                Mi perfil
                            </p>
                        </div>

                        <div class="h-10 w-10 overflow-hidden rounded-full bg-white p-1 shadow-card ring-2 ring-cream-200">
                            <img
                                src="{{ $barberoFotoPerfilUrl }}"
                                alt="Foto de perfil de {{ $authUser?->nombres ?? 'Barbero' }}"
                                class="h-full w-full rounded-full object-cover"
                            >
                        </div>
                    </a>

                </div>

            </header>

            <!-- ==================================================
                 CONTENT
                 ================================================== -->

            <main class="flex-1 min-w-0 bg-cream px-4 py-6 sm:px-6 md:px-8 md:py-8">

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