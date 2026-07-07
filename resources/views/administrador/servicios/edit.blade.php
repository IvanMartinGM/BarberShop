@extends('layouts.admin')

@section('title', 'Editar servicio - BarberShop')
@section('page-title', 'Editar servicio')

@section('content')

@php
$imagenServicio = $servicio->imagen_servicio;

$imagenServicioUrl = $imagenServicio && str_starts_with($imagenServicio, 'service_images/')
? asset('storage/' . $imagenServicio)
: null;
@endphp

    <section class="max-w-5xl mx-auto">

        <!-- Header interno -->
        <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <h2 class="font-display text-3xl font-bold text-navy">
                    Editar servicio
                </h2>

                <p class="mt-2 text-sm text-ink-600">
                    Actualiza la información del servicio dentro del catálogo general.
                </p>
            </div>

            <div class="flex flex-col sm:flex-row gap-3">

                <a href="{{ route('servicio.show', $servicio->id) }}" class="inline-flex items-center justify-center rounded-panel border border-cream-300 bg-white px-5 py-3 text-sm font-bold text-navy hover:bg-cream-100 transition-colors">
                    Volver al detalle
                </a>

                <a href="{{ route('servicio.index') }}" class="inline-flex items-center justify-center rounded-panel bg-cream-200 px-5 py-3 text-sm font-bold text-navy hover:bg-cream-300 transition-colors">
                    Lista de servicios
                </a>

            </div>

        </div>

        <!-- Card principal -->
        <div class="rounded-panel border border-cream-200 bg-white shadow-card">

            <form method="POST" action="{{ route('servicio.update', $servicio->id) }}" enctype="multipart/form-data" class="p-6 sm:p-8 space-y-8">
                @csrf
                @method('PUT')

                <!-- Información del servicio -->
                <div>

                    <div class="mb-5 border-b border-cream-200 pb-4">
                        <h3 class="font-display text-2xl font-bold text-navy">
                            Información del servicio
                        </h3>

                        <p class="mt-1 text-sm text-ink-600">
                            Modifica los datos principales del servicio que aparece en el catálogo.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">

                        <!-- Imagen del servicio -->
                        <div class="md:col-span-2">
                            <label for="imagen_servicio" class="block text-sm font-semibold text-navy mb-2">
                                Imagen del servicio
                            </label>

                            <div class="rounded-panel border border-cream-200 bg-cream-50 p-4 sm:p-5">
                                <div class="flex flex-col gap-5 sm:flex-row sm:items-center">

                                    <div class="h-28 w-28 shrink-0 overflow-hidden rounded-card bg-white shadow-card ring-2 ring-cream-200">
                                        @if ($imagenServicioUrl)
                                        <img src="{{ $imagenServicioUrl }}" alt="Imagen de {{ $servicio->nombre_servicio }}" class="h-full w-full object-cover">
                                        @else
                                        <div class="flex h-full w-full items-center justify-center bg-cream-100 text-4xl">
                                            ✂️
                                        </div>
                                        @endif
                                    </div>

                                    <div class="flex-1">
                                        <input type="file" id="imagen_servicio" name="imagen_servicio" accept="image/jpeg,image/png,image/webp" class="block w-full rounded-card border border-cream-300 bg-white text-sm text-ink file:mr-4 file:border-0 file:bg-barber-red file:px-4 file:py-3 file:text-sm file:font-bold file:text-white hover:file:bg-barber-red-700 focus:border-barber-red focus:outline-none focus:ring-4 focus:ring-barber-red-100 transition-colors">

                                        <p class="mt-2 text-xs text-ink-600">
                                            Formatos permitidos: JPG, JPEG, PNG o WEBP. Tamaño máximo: 2 MB.
                                            Si no seleccionas una nueva imagen, se conservará la imagen actual.
                                        </p>

                                        @error('imagen_servicio')
                                        <p class="text-sm text-barber-red mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- Nombre -->
                        <div class="md:col-span-2">
                            <label for="nombre_servicio" class="block text-sm font-semibold text-navy mb-2">
                                Nombre del servicio *
                            </label>

                            <input type="text" id="nombre_servicio" name="nombre_servicio" value="{{ old('nombre_servicio', $servicio->nombre_servicio) }}" required maxlength="100" placeholder="Corte clásico, Fade, Arreglo de barba..." class="w-full px-4 py-3 rounded-card border border-cream-300 bg-white text-ink placeholder:text-ink-500 focus:border-barber-red focus:outline-none focus:ring-4 focus:ring-barber-red-100 transition-colors">

                            @error('nombre_servicio')
                            <p class="text-sm text-barber-red mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Precio base -->
                        <div>
                            <label for="precio_base" class="block text-sm font-semibold text-navy mb-2">
                                Precio base *
                            </label>

                            <input type="number" id="precio_base" name="precio_base" value="{{ old('precio_base', number_format((float) $servicio->precio_base, 2, '.', '')) }}" required min="0" max="999999.99" step="0.01" placeholder="150.00" class="w-full px-4 py-3 rounded-card border border-cream-300 bg-white text-ink placeholder:text-ink-500 focus:border-barber-red focus:outline-none focus:ring-4 focus:ring-barber-red-100 transition-colors">

                            @error('precio_base')
                            <p class="text-sm text-barber-red mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Duración -->
                        <div>
                            <label for="duracion_minutos" class="block text-sm font-semibold text-navy mb-2">
                                Duración en minutos *
                            </label>

                            <input type="number" id="duracion_minutos" name="duracion_minutos" value="{{ old('duracion_minutos', $servicio->duracion_minutos) }}" required min="1" max="600" placeholder="30" class="w-full px-4 py-3 rounded-card border border-cream-300 bg-white text-ink placeholder:text-ink-500 focus:border-barber-red focus:outline-none focus:ring-4 focus:ring-barber-red-100 transition-colors">

                            @error('duracion_minutos')
                            <p class="text-sm text-barber-red mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Categoría -->
                        <div>
                            <label for="categoria" class="block text-sm font-semibold text-navy mb-2">
                                Categoría
                            </label>

                            <select id="categoria" name="categoria" class="w-full px-4 py-3 rounded-card border border-cream-300 bg-white text-ink focus:border-barber-red focus:outline-none focus:ring-4 focus:ring-barber-red-100 transition-colors">
                                <option value="">Selecciona una categoría</option>

                                <option value="Corte" {{ old('categoria', $servicio->categoria) === 'Corte' ? 'selected' : '' }}>
                                    Corte
                                </option>

                                <option value="Barba" {{ old('categoria', $servicio->categoria) === 'Barba' ? 'selected' : '' }}>
                                    Barba
                                </option>

                                <option value="Afeitado" {{ old('categoria', $servicio->categoria) === 'Afeitado' ? 'selected' : '' }}>
                                    Afeitado
                                </option>

                                <option value="Color" {{ old('categoria', $servicio->categoria) === 'Color' ? 'selected' : '' }}>
                                    Color
                                </option>

                                <option value="Tratamiento" {{ old('categoria', $servicio->categoria) === 'Tratamiento' ? 'selected' : '' }}>
                                    Tratamiento
                                </option>

                                <option value="Paquete" {{ old('categoria', $servicio->categoria) === 'Paquete' ? 'selected' : '' }}>
                                    Paquete
                                </option>

                                <option value="Otro" {{ old('categoria', $servicio->categoria) === 'Otro' ? 'selected' : '' }}>
                                    Otro
                                </option>
                            </select>

                            @error('categoria')
                            <p class="text-sm text-barber-red mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Estado -->
                        <div>
                            <label for="estado" class="block text-sm font-semibold text-navy mb-2">
                                Estado *
                            </label>

                            <select id="estado" name="estado" required class="w-full px-4 py-3 rounded-card border border-cream-300 bg-white text-ink focus:border-barber-red focus:outline-none focus:ring-4 focus:ring-barber-red-100 transition-colors">
                                <option value="1" {{ (string) old('estado', (int) $servicio->estado) === '1' ? 'selected' : '' }}>
                                    Activo
                                </option>

                                <option value="0" {{ (string) old('estado', (int) $servicio->estado) === '0' ? 'selected' : '' }}>
                                    Inactivo
                                </option>
                            </select>

                            @error('estado')
                            <p class="text-sm text-barber-red mt-1">{{ $message }}</p>
                            @enderror

                            <p class="mt-2 text-xs text-ink-500">
                                Si el servicio queda inactivo, ya no será elegible para que los barberos lo seleccionen.
                            </p>
                        </div>

                        <!-- Descripción -->
                        <div class="md:col-span-2">
                            <label for="descripcion" class="block text-sm font-semibold text-navy mb-2">
                                Descripción
                            </label>

                            <textarea id="descripcion" name="descripcion" rows="4" maxlength="1000" placeholder="Describe qué incluye este servicio..." class="w-full px-4 py-3 rounded-card border border-cream-300 bg-white text-ink placeholder:text-ink-500 focus:border-barber-red focus:outline-none focus:ring-4 focus:ring-barber-red-100 transition-colors resize-none">{{ old('descripcion', $servicio->descripcion) }}</textarea>

                            @error('descripcion')
                            <p class="text-sm text-barber-red mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                </div>

                <!-- Botones -->
                <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 border-t border-cream-200 pt-6">

                    <a href="{{ route('servicio.show', $servicio->id) }}" class="inline-flex items-center justify-center rounded-panel bg-cream-200 px-6 py-3 text-sm font-bold text-navy hover:bg-cream-300 transition-colors">
                        Cancelar
                    </a>

                    <button type="submit" class="rounded-panel bg-barber-red px-6 py-3 text-sm font-bold text-white hover:bg-barber-red-700 focus:outline-none focus:ring-4 focus:ring-barber-red-100 transition-colors">
                        Actualizar servicio
                    </button>

                </div>

            </form>

        </div>

    </section>

    @endsection
