@extends('layouts.guest')

@section('title', 'Recuperar contraseña - BarberShop')

@section('content')

<section class="min-h-screen bg-ink-700 flex items-center justify-center px-4 py-12">

    <div class="w-full max-w-md rounded-panel bg-white px-8 py-10 shadow-elevated">

        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="font-display text-4xl font-bold text-navy">
                BARBERSHOP
            </h1>

            <p class="mt-2 text-sm text-ink-600">
                Recupera el acceso a tu cuenta
            </p>
        </div>

        <!-- Mensaje de éxito -->
        @if (session('status'))
            <div class="mb-6 rounded-card border border-success bg-success-light px-4 py-3 text-sm font-semibold text-success">
                {{ session('status') }}
            </div>
        @endif

        <!-- Errores -->
        @if ($errors->any())
            <div class="mb-6 rounded-card border border-danger bg-danger-light px-4 py-3 text-sm text-danger">
                <p class="font-bold mb-2">
                    Revisa lo siguiente:
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

        <p class="mb-6 text-sm leading-6 text-ink-600">
            Ingresa el correo electrónico asociado a tu cuenta. Te enviaremos un enlace para crear una nueva contraseña.
        </p>

        <!-- Formulario -->
        <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
            @csrf

            <div>
                <label for="email" class="block text-sm font-bold text-navy mb-2">
                    Correo Electrónico
                </label>

                <input
                    type="email"
                    name="email"
                    id="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    placeholder="tu@email.com"
                    class="w-full rounded-card border border-cream-300 px-4 py-3 text-ink placeholder:text-ink-400 shadow-sm focus:border-barber-red focus:outline-none focus:ring-4 focus:ring-barber-red-100"
                >
            </div>

            <button
                type="submit"
                class="w-full rounded-card bg-barber-red px-5 py-3 font-bold text-white shadow-card hover:bg-barber-red-700 focus:outline-none focus:ring-4 focus:ring-barber-red-100 transition-colors"
            >
                Enviar enlace de recuperación
            </button>
        </form>

        <!-- Volver -->
        <div class="mt-8 text-center">
            <a href="{{ route('login') }}" class="font-bold text-navy hover:text-barber-red transition-colors">
                ← Volver al inicio de sesión
            </a>
        </div>

    </div>

</section>

@endsection