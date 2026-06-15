@extends('layouts.guest')

@section('title', 'Inicio - BarberShop')

@section('content')

    <!-- ==================================================
         HERO SECTION
         ================================================== -->

    <section class="relative bg-linear-to-r from-navy via-navy-800 to-barber-red text-white py-20 md:py-32">

        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 -left-4 w-72 h-72 bg-barber-red rounded-full mix-blend-multiply filter blur-3xl"></div>
            <div class="absolute bottom-0 right-4 w-72 h-72 bg-navy-600 rounded-full mix-blend-multiply filter blur-3xl"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">

                <div>
                    <h1 class="font-display text-5xl md:text-6xl font-bold mb-6">
                        Barbería de Calidad
                    </h1>
                    <p class="text-lg text-cream-100 mb-8">
                        Experimenta un servicio profesional de cortes y afeitados con los mejores barberos de la ciudad.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="/servicios"
                           class="inline-block bg-barber-red hover:bg-barber-red-600 text-white font-bold py-3 px-8 rounded-lg transition-colors text-center">
                            Ver Servicios
                        </a>
                        <a href="#contacto"
                           class="inline-block bg-white hover:bg-cream-100 text-navy font-bold py-3 px-8 rounded-lg transition-colors text-center">
                            Contactar
                        </a>
                    </div>
                </div>

                <div class="hidden md:block text-center">
                    <div class="inline-block">
                        <div class="bg-linear-to-r from-barber-red-200 to-barber-red-300 rounded-full w-64 h-64 flex items-center justify-center">
                            <span class="text-8xl">✂️</span>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </section>

    <!-- ==================================================
         CARRUSEL
         ================================================== -->

    <section class="py-20 bg-white">

        <div class="max-w-7xl mx-auto px-4 sm:px-6">

            <div class="text-center mb-12">
                <h2 class="font-display text-4xl md:text-5xl font-bold text-navy mb-4">
                    Galería
                </h2>
                <p class="text-lg text-ink-500">
                    Nuestros mejores trabajos
                </p>
            </div>

            <!-- Placeholder para carrusel -->
            <div class="bg-linear-to-r from-cream via-cream-100 to-cream border-2 border-dashed border-cream-300 rounded-lg h-96 flex items-center justify-center">
                <div class="text-center">
                    <span class="text-6xl block mb-4">🖼️</span>
                    <p class="text-ink-500 font-semibold">Carrusel de imágenes - Por implementar</p>
                    <p class="text-ink-400 text-sm mt-2">Aquí irá el carrusel con las fotos de trabajos realizados</p>
                </div>
            </div>

        </div>

    </section>

    <!-- ==================================================
         NUESTRO PERSONAL
         ================================================== -->

    <section class="py-20 bg-navy">

        <div class="max-w-7xl mx-auto px-4 sm:px-6">

            <div class="text-center mb-16">
                <h2 class="font-display text-4xl md:text-5xl font-bold text-white mb-4">
                    Nuestro Personal
                </h2>
                <p class="text-lg text-cream-100">
                    Conoce a los profesionales detrás de cada corte perfecto
                </p>
            </div>

            <!-- Grid de personal - Por implementar con PHP -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8"> 

                <!-- Barbero 1 - Placeholder -->
                <div class="bg-cream rounded-lg overflow-hidden shadow-panel hover:shadow-elevated transition-shadow">
                    <div class="bg-linear-to-b from-barber-red-100 to-cream h-56 flex items-center justify-center">
                        <span class="text-8xl">👨‍💼</span>
                    </div>
                    <div class="p-6 text-center">
                        <h3 class="font-display text-xl font-bold text-navy mb-2">
                            Nombre Barbero
                        </h3>
                        <p class="text-ink-600 text-sm mb-4">
                            Especialidad
                        </p>
                        <p class="text-ink-500 text-sm">
                            "Descripción breve sobre experiencia y especialidades"
                        </p>
                    </div>
                </div>

                <!-- Barbero 2 - Placeholder -->
                <div class="bg-cream rounded-lg overflow-hidden shadow-panel hover:shadow-elevated transition-shadow">
                    <div class="bg-linear-to-b from-barber-red-100 to-cream h-56 flex items-center justify-center">
                        <span class="text-8xl">👨‍💼</span>
                    </div>
                    <div class="p-6 text-center">
                        <h3 class="font-display text-xl font-bold text-navy mb-2">
                            Nombre Barbero
                        </h3>
                        <p class="text-ink-600 text-sm mb-4">
                            Especialidad
                        </p>
                        <p class="text-ink-500 text-sm">
                            "Descripción breve sobre experiencia y especialidades"
                        </p>
                    </div>
                </div>

                <!-- Barbero 3 - Placeholder -->
                <div class="bg-cream rounded-lg overflow-hidden shadow-panel hover:shadow-elevated transition-shadow">
                    <div class="bg-linear-to-b from-barber-red-100 to-cream h-56 flex items-center justify-center">
                        <span class="text-8xl">👨‍💼</span>
                    </div>
                    <div class="p-6 text-center">
                        <h3 class="font-display text-xl font-bold text-navy mb-2">
                            Nombre Barbero
                        </h3>
                        <p class="text-ink-600 text-sm mb-4">
                            Especialidad
                        </p>
                        <p class="text-ink-500 text-sm">
                            "Descripción breve sobre experiencia y especialidades"
                        </p>
                    </div>
                </div>

            </div>

        </div>

    </section>

    <!-- ==================================================
         CARACTERÍSTICAS
         ================================================== -->

    <section class="py-20 bg-navy text-white">

        <div class="max-w-7xl mx-auto px-4 sm:px-6">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">

                <div class="text-center">
                    <div class="bg-barber-red rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl">⭐</span>
                    </div>
                    <h3 class="font-display text-xl font-bold mb-2">Profesionales</h3>
                    <p class="text-cream-100">Barberos certificados con años de experiencia</p>
                </div>

                <div class="text-center">
                    <div class="bg-barber-red rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl">🏆</span>
                    </div>
                    <h3 class="font-display text-xl font-bold mb-2">Calidad Premium</h3>
                    <p class="text-cream-100">Productos y técnicas de la más alta calidad</p>
                </div>

                <div class="text-center">
                    <div class="bg-barber-red rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl">😊</span>
                    </div>
                    <h3 class="font-display text-xl font-bold mb-2">Satisfacción</h3>
                    <p class="text-cream-100">Garantía de satisfacción en cada servicio</p>
                </div>

            </div>

        </div>

    </section>

    <!-- ==================================================
         CONTACTO
         ================================================== -->

    <section id="contacto" class="py-20 bg-white">

        <div class="max-w-7xl mx-auto px-4 sm:px-6">

            <div class="text-center mb-16">
                <h2 class="font-display text-4xl md:text-5xl font-bold text-navy mb-4">
                    Contáctanos
                </h2>
                <p class="text-lg text-ink-500">
                    Estamos aquí para ayudarte y responder tus preguntas
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                <div class="bg-cream rounded-lg p-8 text-center border border-cream-200">
                    <div class="text-4xl mb-4">📍</div>
                    <h3 class="font-bold text-lg text-navy mb-2">Ubicación</h3>
                    <p class="text-ink-600">Calle Principal, 123<br>28001 Madrid, España</p>
                </div>

                <div class="bg-cream rounded-lg p-8 text-center border border-cream-200">
                    <div class="text-4xl mb-4">📞</div>
                    <h3 class="font-bold text-lg text-navy mb-2">Teléfono</h3>
                    <p class="text-ink-600">+34 123 456 789<br>+34 987 654 321</p>
                </div>

                <div class="bg-cream rounded-lg p-8 text-center border border-cream-200">
                    <div class="text-4xl mb-4">📧</div>
                    <h3 class="font-bold text-lg text-navy mb-2">Email</h3>
                    <p class="text-ink-600">info@barbershop.es<br>soporte@barbershop.es</p>
                </div>

            </div>

        </div>

    </section>

@endsection