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

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">

                <!-- Servicio 1 -->
                <div class="bg-cream rounded-lg shadow-card hover:shadow-panel transition-shadow overflow-hidden border border-cream-200">
                    <div class="bg-barber-red-100 h-40 flex items-center justify-center">
                        <span class="text-6xl">💇</span>
                    </div>
                    <div class="p-6">
                        <h3 class="font-display text-xl font-bold text-navy mb-3">
                            Corte de Pelo
                        </h3>
                        <p class="text-ink-600 mb-4">
                            Cortes modernos y clásicos realizados por barberos profesionales con experiencia.
                        </p>
                        <p class="font-bold text-barber-red text-lg">
                            €20
                        </p>
                    </div>
                </div>

                <!-- Servicio 2 -->
                <div class="bg-cream rounded-lg shadow-card hover:shadow-panel transition-shadow overflow-hidden border border-cream-200">
                    <div class="bg-navy-100 h-40 flex items-center justify-center">
                        <span class="text-6xl">🪮</span>
                    </div>
                    <div class="p-6">
                        <h3 class="font-display text-xl font-bold text-navy mb-3">
                            Afeitado Clásico
                        </h3>
                        <p class="text-ink-600 mb-4">
                            Afeitado tradicional con navaja de seguridad y atención personalizada.
                        </p>
                        <p class="font-bold text-barber-red text-lg">
                            €15
                        </p>
                    </div>
                </div>

                <!-- Servicio 3 -->
                <div class="bg-cream rounded-lg shadow-card hover:shadow-panel transition-shadow overflow-hidden border border-cream-200">
                    <div class="bg-barber-red-100 h-40 flex items-center justify-center">
                        <span class="text-6xl">💈</span>
                    </div>
                    <div class="p-6">
                        <h3 class="font-display text-xl font-bold text-navy mb-3">
                            Combo Completo
                        </h3>
                        <p class="text-ink-600 mb-4">
                            Corte de pelo + afeitado clásico + tratamiento de barba incluido.
                        </p>
                        <p class="font-bold text-barber-red text-lg">
                            €30
                        </p>
                    </div>
                </div>

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
                        <h3 class="font-display text-xl font-bold text-navy mb-2">Profesionales</h3>
                        <p class="text-ink-600">Barberos certificados con años de experiencia en el sector</p>
                    </div>

                    <div class="text-center">
                        <div class="bg-barber-red rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                            <span class="text-2xl">🏆</span>
                        </div>
                        <h3 class="font-display text-xl font-bold text-navy mb-2">Calidad Premium</h3>
                        <p class="text-ink-600">Usamos productos y técnicas de la más alta calidad</p>
                    </div>

                    <div class="text-center">
                        <div class="bg-barber-red rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                            <span class="text-2xl">😊</span>
                        </div>
                        <h3 class="font-display text-xl font-bold text-navy mb-2">Satisfacción</h3>
                        <p class="text-ink-600">Garantía de satisfacción en cada uno de nuestros servicios</p>
                    </div>

                </div>

            </div>

        </div>

    </section>

@endsection
