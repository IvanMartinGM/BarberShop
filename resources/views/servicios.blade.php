@extends('layouts.guest')

@section('title', 'Servicios - BarberShop')

@section('content')

<!-- ==================================================
     HERO SECTION
     ================================================== -->

<section class="bg-linear-to-r from-navy to-barber-red text-white py-16 md:py-24">

    <div class="max-w-7xl mx-auto px-4 sm:px-6">

        <div class="text-center">
            <h1 class="font-display text-5xl md:text-6xl font-bold mb-4">
                Nuestros Servicios
            </h1>

            <p class="text-lg text-cream-100">
                Ofrecemos una amplia variedad de servicios de barbería profesional
            </p>
        </div>

    </div>

</section>

<!-- ==================================================
     SERVICIOS
     ================================================== -->

<section class="py-20 bg-white">

    <div class="max-w-7xl mx-auto px-4 sm:px-6">

        <div class="text-center mb-12">
            <h2 class="font-display text-3xl md:text-4xl font-bold text-navy mb-4">
                Catálogo de servicios
            </h2>

            <p class="text-ink-500 text-base md:text-lg">
                Elige el servicio ideal para tu estilo y agenda tu próxima visita.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">

            @forelse ($serviciosDisponibles as $servicio)

                @php
                    $imagenServicio = $servicio->imagen_servicio;

                    if (!$imagenServicio) {
                        $imagenServicioUrl = null;
                    } elseif (str_starts_with($imagenServicio, 'http://') || str_starts_with($imagenServicio, 'https://')) {
                        $imagenServicioUrl = $imagenServicio;
                    } elseif (str_starts_with($imagenServicio, 'service_images/')) {
                        $imagenServicioUrl = asset('storage/' . $imagenServicio);
                    } elseif (str_starts_with($imagenServicio, 'images/')) {
                        $imagenServicioUrl = asset($imagenServicio);
                    } else {
                        $imagenServicioUrl = asset('storage/' . $imagenServicio);
                    }
                @endphp

                <div class="bg-cream rounded-lg shadow-card hover:shadow-panel transition-shadow overflow-hidden border border-cream-200">

                    <div class="h-56 bg-barber-red-100 overflow-hidden">
                        @if ($imagenServicioUrl)
                            <img
                                src="{{ $imagenServicioUrl }}"
                                alt="Imagen de {{ $servicio->nombre_servicio }}"
                                class="h-full w-full object-cover"
                            >
                        @else
                            <div class="h-full w-full flex items-center justify-center bg-linear-to-b from-barber-red-100 to-cream">
                                <span class="text-6xl">💈</span>
                            </div>
                        @endif
                    </div>

                    <div class="p-6">

                        @if ($servicio->categoria)
                            <span class="inline-flex rounded-full bg-barber-red-100 px-3 py-1 text-xs font-bold text-barber-red mb-4">
                                {{ $servicio->categoria }}
                            </span>
                        @endif

                        <h3 class="font-display text-xl font-bold text-navy mb-3">
                            {{ $servicio->nombre_servicio }}
                        </h3>

                        <p class="text-ink-600 mb-5 leading-6">
                            {{ $servicio->descripcion ?? 'Servicio profesional realizado por nuestros barberos especializados.' }}
                        </p>

                        <div class="flex items-center justify-between gap-4 border-t border-cream-200 pt-5">

                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-ink-500">
                                    Precio
                                </p>

                                <p class="font-bold text-barber-red text-xl">
                                    ${{ number_format((float) $servicio->precio_base, 2) }}
                                </p>
                            </div>

                            <div class="text-right">
                                <p class="text-xs font-semibold uppercase tracking-wide text-ink-500">
                                    Duración
                                </p>

                                <p class="font-bold text-navy">
                                    {{ $servicio->duracion_minutos }} min
                                </p>
                            </div>

                        </div>

                    </div>

                </div>

            @empty

                <div class="sm:col-span-2 lg:col-span-3 rounded-panel border border-cream-200 bg-cream p-10 text-center">
                    <span class="block text-6xl mb-4">💈</span>

                    <h3 class="font-display text-2xl font-bold text-navy">
                        Aún no hay servicios disponibles
                    </h3>

                    <p class="mt-2 text-sm text-ink-600">
                        Pronto agregaremos servicios al catálogo de la barbería.
                    </p>
                </div>

            @endforelse

        </div>

        <!-- Sección de características -->
        <div class="border-t-2 border-cream-200 pt-16">

            <div class="text-center mb-12">
                <h2 class="font-display text-3xl md:text-4xl font-bold text-navy mb-4">
                    ¿Por qué elegirnos?
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">

                <div class="text-center">
                    <div class="bg-barber-red rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl">⭐</span>
                    </div>

                    <h3 class="font-display text-xl font-bold text-navy mb-2">
                        Profesionales
                    </h3>

                    <p class="text-ink-600">
                        Barberos certificados con años de experiencia en el sector.
                    </p>
                </div>

                <div class="text-center">
                    <div class="bg-barber-red rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl">🏆</span>
                    </div>

                    <h3 class="font-display text-xl font-bold text-navy mb-2">
                        Calidad Premium
                    </h3>

                    <p class="text-ink-600">
                        Usamos productos y técnicas de la más alta calidad.
                    </p>
                </div>

                <div class="text-center">
                    <div class="bg-barber-red rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl">😊</span>
                    </div>

                    <h3 class="font-display text-xl font-bold text-navy mb-2">
                        Satisfacción
                    </h3>

                    <p class="text-ink-600">
                        Garantía de satisfacción en cada uno de nuestros servicios.
                    </p>
                </div>

            </div>

        </div>

    </div>

</section>

@endsection