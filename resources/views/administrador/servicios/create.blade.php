@extends('layouts.admin')

@section('title', 'Agregar servicio - BarberShop')
@section('page-title', 'Agregar servicio')

@section('content')

<section class="max-w-5xl mx-auto">

    <!-- Header interno -->
    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>
            <h2 class="font-display text-3xl font-bold text-navy">
                Registrar nuevo servicio
            </h2>

            <p class="mt-2 text-sm text-ink-600">
                Crea un servicio del catálogo general que después podrán ofrecer los barberos.
            </p>
        </div>

        <a href="{{ route('servicio.index') }}"
           class="inline-flex items-center justify-center rounded-panel border border-cream-300 bg-white px-5 py-3 text-sm font-bold text-navy hover:bg-cream-100 transition-colors">
            Volver
        </a>

    </div>

    <!-- Card principal -->
    <div class="rounded-panel border border-cream-200 bg-white shadow-card">

        <form method="POST" action="{{ route('servicio.store') }}" class="p-6 sm:p-8 space-y-8">
            @csrf

            <!-- Información del servicio -->
            <div>

                <div class="mb-5 border-b border-cream-200 pb-4">
                    <h3 class="font-display text-2xl font-bold text-navy">
                        Información del servicio
                    </h3>

                    <p class="mt-1 text-sm text-ink-600">
                        Datos principales del servicio que aparecerá en el catálogo.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">

                    <!-- Nombre -->
                    <div class="md:col-span-2">
                        <label for="nombre_servicio" class="block text-sm font-semibold text-navy mb-2">
                            Nombre del servicio *
                        </label>

                        <input
                            type="text"
                            id="nombre_servicio"
                            name="nombre_servicio"
                            value="{{ old('nombre_servicio') }}"
                            required
                            maxlength="100"
                            placeholder="Corte clásico, Fade, Arreglo de barba..."
                            class="w-full px-4 py-3 rounded-card border border-cream-300 bg-white text-ink placeholder:text-ink-500 focus:border-barber-red focus:outline-none focus:ring-4 focus:ring-barber-red-100 transition-colors"
                        >

                        @error('nombre_servicio')
                            <p class="text-sm text-barber-red mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Precio base -->
                    <div>
                        <label for="precio_base" class="block text-sm font-semibold text-navy mb-2">
                            Precio base *
                        </label>

                        <input
                            type="number"
                            id="precio_base"
                            name="precio_base"
                            value="{{ old('precio_base') }}"
                            required
                            min="0"
                            max="999999.99"
                            step="0.01"
                            placeholder="150.00"
                            class="w-full px-4 py-3 rounded-card border border-cream-300 bg-white text-ink placeholder:text-ink-500 focus:border-barber-red focus:outline-none focus:ring-4 focus:ring-barber-red-100 transition-colors"
                        >

                        @error('precio_base')
                            <p class="text-sm text-barber-red mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Duración -->
                    <div>
                        <label for="duracion_minutos" class="block text-sm font-semibold text-navy mb-2">
                            Duración en minutos *
                        </label>

                        <input
                            type="number"
                            id="duracion_minutos"
                            name="duracion_minutos"
                            value="{{ old('duracion_minutos') }}"
                            required
                            min="1"
                            max="600"
                            placeholder="30"
                            class="w-full px-4 py-3 rounded-card border border-cream-300 bg-white text-ink placeholder:text-ink-500 focus:border-barber-red focus:outline-none focus:ring-4 focus:ring-barber-red-100 transition-colors"
                        >

                        @error('duracion_minutos')
                            <p class="text-sm text-barber-red mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Categoría -->
                    <div>
                        <label for="categoria" class="block text-sm font-semibold text-navy mb-2">
                            Categoría
                        </label>

                        <select
                            id="categoria"
                            name="categoria"
                            class="w-full px-4 py-3 rounded-card border border-cream-300 bg-white text-ink focus:border-barber-red focus:outline-none focus:ring-4 focus:ring-barber-red-100 transition-colors"
                        >
                            <option value="">Selecciona una categoría</option>

                            <option value="Corte" {{ old('categoria') === 'Corte' ? 'selected' : '' }}>
                                Corte
                            </option>

                            <option value="Barba" {{ old('categoria') === 'Barba' ? 'selected' : '' }}>
                                Barba
                            </option>

                            <option value="Afeitado" {{ old('categoria') === 'Afeitado' ? 'selected' : '' }}>
                                Afeitado
                            </option>

                            <option value="Color" {{ old('categoria') === 'Color' ? 'selected' : '' }}>
                                Color
                            </option>

                            <option value="Tratamiento" {{ old('categoria') === 'Tratamiento' ? 'selected' : '' }}>
                                Tratamiento
                            </option>

                            <option value="Paquete" {{ old('categoria') === 'Paquete' ? 'selected' : '' }}>
                                Paquete
                            </option>

                            <option value="Otro" {{ old('categoria') === 'Otro' ? 'selected' : '' }}>
                                Otro
                            </option>
                        </select>

                        @error('categoria')
                            <p class="text-sm text-barber-red mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nota estado -->
                    <div>
                        <label class="block text-sm font-semibold text-navy mb-2">
                            Estado inicial
                        </label>

                        <div class="rounded-card border border-success bg-success-light px-4 py-3">
                            <p class="text-sm font-bold text-success">
                                Activo
                            </p>

                            <p class="mt-1 text-xs font-medium text-ink-600">
                                Los servicios nuevos se crean activos automáticamente.
                            </p>
                        </div>
                    </div>

                    <!-- Descripción -->
                    <div class="md:col-span-2">
                        <label for="descripcion" class="block text-sm font-semibold text-navy mb-2">
                            Descripción
                        </label>

                        <textarea
                            id="descripcion"
                            name="descripcion"
                            rows="4"
                            maxlength="1000"
                            placeholder="Describe qué incluye este servicio..."
                            class="w-full px-4 py-3 rounded-card border border-cream-300 bg-white text-ink placeholder:text-ink-500 focus:border-barber-red focus:outline-none focus:ring-4 focus:ring-barber-red-100 transition-colors resize-none"
                        >{{ old('descripcion') }}</textarea>

                        @error('descripcion')
                            <p class="text-sm text-barber-red mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

            </div>

            <!-- Botones -->
            <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 border-t border-cream-200 pt-6">

                <button
                    type="reset"
                    class="rounded-panel bg-cream-200 px-6 py-3 text-sm font-bold text-navy hover:bg-cream-300 transition-colors"
                >
                    Limpiar
                </button>

                <button
                    type="submit"
                    class="rounded-panel bg-barber-red px-6 py-3 text-sm font-bold text-white hover:bg-barber-red-700 focus:outline-none focus:ring-4 focus:ring-barber-red-100 transition-colors"
                >
                    Guardar servicio
                </button>

            </div>

        </form>

    </div>

</section>

@endsection