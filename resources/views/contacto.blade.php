@extends('layouts.guest')

@section('title', 'Contacto - BarberShop')

@section('content')

    <!-- ==================================================
         HERO SECTION
         ================================================== -->

    <section class="bg-linear-to-r from-navy to-barber-red text-white py-16 md:py-24">

        <div class="max-w-7xl mx-auto px-4 sm:px-6">

            <div class="text-center">
                <h1 class="font-display text-5xl md:text-6xl font-bold mb-4">
                    Contáctanos
                </h1>
                <p class="text-lg text-cream-100">
                    Estamos aquí para responder tus preguntas y brindarte el mejor servicio
                </p>
            </div>

        </div>

    </section>

    <!-- ==================================================
         INFORMACIÓN Y FORMULARIO
         ================================================== -->

    <section class="py-20 bg-cream">

        <div class="max-w-7xl mx-auto px-4 sm:px-6">

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">

                <!-- Información de contacto -->
                <div>

                    <h2 class="font-display text-3xl font-bold text-navy mb-8">
                        Información de Contacto
                    </h2>

                    <!-- Tarjeta de teléfono -->
                    <div class="bg-white rounded-lg p-6 mb-6 shadow-card hover:shadow-panel transition-shadow border-l-4 border-barber-red">
                        <div class="flex items-start">
                            <span class="text-3xl mr-4">📞</span>
                            <div>
                                <h3 class="font-bold text-navy text-lg mb-2">Teléfono</h3>
                                <p class="text-ink-600 mb-1">+34 123 456 789</p>
                                <p class="text-ink-600">+34 987 654 321</p>
                            </div>
                        </div>
                    </div>

                    <!-- Tarjeta de email -->
                    <div class="bg-white rounded-lg p-6 mb-6 shadow-card hover:shadow-panel transition-shadow border-l-4 border-navy">
                        <div class="flex items-start">
                            <span class="text-3xl mr-4">📧</span>
                            <div>
                                <h3 class="font-bold text-navy text-lg mb-2">Email</h3>
                                <p class="text-ink-600 mb-1">info@barbershop.es</p>
                                <p class="text-ink-600">soporte@barbershop.es</p>
                            </div>
                        </div>
                    </div>

                    <!-- Tarjeta de ubicación -->
                    <div class="bg-white rounded-lg p-6 mb-6 shadow-card hover:shadow-panel transition-shadow border-l-4 border-barber-red">
                        <div class="flex items-start">
                            <span class="text-3xl mr-4">📍</span>
                            <div>
                                <h3 class="font-bold text-navy text-lg mb-2">Ubicación</h3>
                                <p class="text-ink-600 mb-1">Calle Principal, 123</p>
                                <p class="text-ink-600">28001 Madrid, España</p>
                            </div>
                        </div>
                    </div>

                    <!-- Tarjeta de horario -->
                    <div class="bg-white rounded-lg p-6 shadow-card hover:shadow-panel transition-shadow border-l-4 border-navy">
                        <div class="flex items-start">
                            <span class="text-3xl mr-4">🕐</span>
                            <div>
                                <h3 class="font-bold text-navy text-lg mb-2">Horario</h3>
                                <p class="text-ink-600 mb-1">Lunes - Viernes: 9:00 - 19:00</p>
                                <p class="text-ink-600 mb-1">Sábado: 9:00 - 17:00</p>
                                <p class="text-ink-600">Domingo: Cerrado</p>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Formulario de contacto -->
                <div>

                    <div class="bg-white rounded-lg shadow-panel p-8">

                        <h2 class="font-display text-3xl font-bold text-navy mb-8">
                            Envíanos un Mensaje
                        </h2>

                        <form action="#" method="POST" class="space-y-6">

                            @csrf

                            <!-- Nombre -->
                            <div>
                                <label for="nombre" class="block text-sm font-semibold text-navy mb-2">
                                    Nombre Completo *
                                </label>
                                <input 
                                    type="text" 
                                    id="nombre" 
                                    name="nombre" 
                                    required
                                    placeholder="Juan Pérez"
                                    class="w-full px-4 py-3 rounded-lg border-2 border-cream-200 focus:border-barber-red focus:outline-none transition-colors text-ink"
                                >
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-semibold text-navy mb-2">
                                    Correo Electrónico *
                                </label>
                                <input 
                                    type="email" 
                                    id="email" 
                                    name="email" 
                                    required
                                    placeholder="juan@ejemplo.com"
                                    class="w-full px-4 py-3 rounded-lg border-2 border-cream-200 focus:border-barber-red focus:outline-none transition-colors text-ink"
                                >
                            </div>

                            <!-- Teléfono -->
                            <div>
                                <label for="telefono" class="block text-sm font-semibold text-navy mb-2">
                                    Teléfono
                                </label>
                                <input 
                                    type="tel" 
                                    id="telefono" 
                                    name="telefono" 
                                    placeholder="+34 123 456 789"
                                    class="w-full px-4 py-3 rounded-lg border-2 border-cream-200 focus:border-barber-red focus:outline-none transition-colors text-ink"
                                >
                            </div>

                            <!-- Asunto -->
                            <div>
                                <label for="asunto" class="block text-sm font-semibold text-navy mb-2">
                                    Asunto *
                                </label>
                                <select 
                                    id="asunto" 
                                    name="asunto" 
                                    required
                                    class="w-full px-4 py-3 rounded-lg border-2 border-cream-200 focus:border-barber-red focus:outline-none transition-colors text-ink"
                                >
                                    <option value="">Selecciona un asunto</option>
                                    <option value="cita">Agendar Cita</option>
                                    <option value="consulta">Consulta General</option>
                                    <option value="servicio">Información de Servicios</option>
                                    <option value="disponibilidad">Disponibilidad de Barbero</option>
                                    <option value="otro">Otro</option>
                                </select>
                            </div>

                            <!-- Mensaje -->
                            <div>
                                <label for="mensaje" class="block text-sm font-semibold text-navy mb-2">
                                    Mensaje *
                                </label>
                                <textarea 
                                    id="mensaje" 
                                    name="mensaje" 
                                    rows="5" 
                                    required
                                    placeholder="Escribe tu mensaje aquí..."
                                    class="w-full px-4 py-3 rounded-lg border-2 border-cream-200 focus:border-barber-red focus:outline-none transition-colors text-ink resize-none"
                                ></textarea>
                            </div>

                            <!-- Checkbox términos -->
                            <div class="flex items-start">
                                <input 
                                    type="checkbox" 
                                    id="terminos" 
                                    name="terminos" 
                                    required
                                    class="w-4 h-4 mt-1 accent-barber-red"
                                >
                                <label for="terminos" class="ml-3 text-sm text-ink-600">
                                    Acepto la <span class="font-semibold text-navy">política de privacidad</span> y autorizo el contacto
                                </label>
                            </div>

                            <!-- Botones -->
                            <div class="flex flex-col sm:flex-row gap-4 pt-4">
                                <button 
                                    type="submit"
                                    class="flex-1 bg-linear-to-r from-barber-red to-barber-red-600 hover:from-barber-red-600 hover:to-barber-red-700 text-white font-bold py-3 px-6 rounded-lg transition-all transform hover:scale-105"
                                >
                                    Enviar Mensaje
                                </button>
                                <button 
                                    type="reset"
                                    class="flex-1 bg-cream-200 hover:bg-cream-300 text-navy font-bold py-3 px-6 rounded-lg transition-colors"
                                >
                                    Limpiar
                                </button>
                            </div>

                            <p class="text-xs text-ink-500 text-center">
                                * Campos requeridos. Responderemos tu mensaje en las próximas 24 horas.
                            </p>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- ==================================================
         MAPA (Opcional)
         ================================================== -->

    <section class="bg-white py-12">

        <div class="max-w-7xl mx-auto px-4 sm:px-6">

            <h2 class="font-display text-3xl font-bold text-navy mb-8 text-center">
                Encuéntranos en el Mapa
            </h2>

            <div class="rounded-lg overflow-hidden shadow-panel h-96 bg-cream-100 border-2 border-cream-200 flex items-center justify-center">
                <div class="text-center">
                    <span class="text-6xl block mb-4">📍</span>
                    <p class="text-ink-600 font-semibold">Mapa - Por integrar</p>
                    <p class="text-ink-400 text-sm mt-2">Calle Principal, 123 - Madrid, España</p>
                </div>
            </div>

        </div>

    </section>

@endsection
