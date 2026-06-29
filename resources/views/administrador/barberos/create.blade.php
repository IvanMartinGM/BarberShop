@extends('layouts.admin')

@section('title', 'Agregar barbero - BarberShop')
@section('page-title', 'Agregar barbero')

@section('content')

<section class="max-w-5xl mx-auto">

    <!-- Header interno -->
    <div class="mb-6">
        <h2 class="font-display text-3xl font-bold text-navy">
            Registrar nuevo barbero
        </h2>
        <p class="mt-2 text-sm text-ink-600">
            Crea el usuario del barbero y completa su información profesional.
        </p>
    </div>

    <!-- Card principal -->
    <div class="rounded-panel border border-cream-200 bg-white shadow-card">

        <form method="POST" action="{{ route('barbero.store') }}" class="p-6 sm:p-8 space-y-8">
            @csrf

            <!-- Información de usuario -->
            <div>
                <div class="mb-5 border-b border-cream-200 pb-4">
                    <h3 class="font-display text-2xl font-bold text-navy">
                        Información de usuario
                    </h3>
                    <p class="mt-1 text-sm text-ink-600">
                        Datos básicos para crear la cuenta de acceso.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">

                    <div>
                        <label for="nombres" class="block text-sm font-semibold text-navy mb-2">
                            Nombres *
                        </label>
                        <input type="text" id="nombres" name="nombres" value="{{ old('nombres') }}" required placeholder="Ivan Martin" class="w-full px-4 py-3 rounded-card border border-cream-300 bg-white text-ink placeholder:text-ink-500 focus:border-barber-red focus:outline-none focus:ring-4 focus:ring-barber-red-100 transition-colors">
                        @error('nombres')
                        <p class="text-sm text-barber-red mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="primer_apellido" class="block text-sm font-semibold text-navy mb-2">
                            Primer Apellido *
                        </label>
                        <input type="text" id="primer_apellido" name="primer_apellido" value="{{ old('primer_apellido') }}" required placeholder="Gomez" class="w-full px-4 py-3 rounded-card border border-cream-300 bg-white text-ink placeholder:text-ink-500 focus:border-barber-red focus:outline-none focus:ring-4 focus:ring-barber-red-100 transition-colors">
                        @error('primer_apellido')
                        <p class="text-sm text-barber-red mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="segundo_apellido" class="block text-sm font-semibold text-navy mb-2">
                            Segundo Apellido
                        </label>
                        <input type="text" id="segundo_apellido" name="segundo_apellido" value="{{ old('segundo_apellido') }}" placeholder="Magaña" class="w-full px-4 py-3 rounded-card border border-cream-300 bg-white text-ink placeholder:text-ink-500 focus:border-barber-red focus:outline-none focus:ring-4 focus:ring-barber-red-100 transition-colors">
                        @error('segundo_apellido')
                        <p class="text-sm text-barber-red mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="celular" class="block text-sm font-semibold text-navy mb-2">
                            Celular *
                        </label>
                        <input type="tel" id="celular" name="celular" value="{{ old('celular') }}" required placeholder="+52 333 456 7890" class="w-full px-4 py-3 rounded-card border border-cream-300 bg-white text-ink placeholder:text-ink-500 focus:border-barber-red focus:outline-none focus:ring-4 focus:ring-barber-red-100 transition-colors">
                        @error('celular')
                        <p class="text-sm text-barber-red mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="email" class="block text-sm font-semibold text-navy mb-2">
                            Correo Electrónico *
                        </label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="barbero@email.com" class="w-full px-4 py-3 rounded-card border border-cream-300 bg-white text-ink placeholder:text-ink-500 focus:border-barber-red focus:outline-none focus:ring-4 focus:ring-barber-red-100 transition-colors">
                        @error('email')
                        <p class="text-sm text-barber-red mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="nombre_usuario" class="block text-sm font-semibold text-navy mb-2">
                            Nombre de Usuario *
                        </label>
                        <input type="text" id="nombre_usuario" name="nombre_usuario" value="{{ old('nombre_usuario') }}" required placeholder="ivangomez123" class="w-full px-4 py-3 rounded-card border border-cream-300 bg-white text-ink placeholder:text-ink-500 focus:border-barber-red focus:outline-none focus:ring-4 focus:ring-barber-red-100 transition-colors">
                        @error('nombre_usuario')
                        <p class="text-sm text-barber-red mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="genero" class="block text-sm font-semibold text-navy mb-2">
                            Género *
                        </label>
                        <select id="genero" name="genero" required class="w-full px-4 py-3 rounded-card border border-cream-300 bg-white text-ink focus:border-barber-red focus:outline-none focus:ring-4 focus:ring-barber-red-100 transition-colors">
                            <option value="">Selecciona una opción</option>
                            <option value="M" {{ old('genero') === 'M' ? 'selected' : '' }}>Masculino</option>
                            <option value="F" {{ old('genero') === 'F' ? 'selected' : '' }}>Femenino</option>
                            <option value="otro" {{ old('genero') === 'otro' ? 'selected' : '' }}>Otro</option>
                        </select>
                        @error('genero')
                        <p class="text-sm text-barber-red mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
            </div>

            <!-- Información profesional -->
            <div>
                <div class="mb-5 border-b border-cream-200 pb-4">
                    <h3 class="font-display text-2xl font-bold text-navy">
                        Información profesional
                    </h3>
                    <p class="mt-1 text-sm text-ink-600">
                        Datos laborales y disponibilidad del barbero.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">

                    <div>
                        <label for="estado_disponibilidad" class="block text-sm font-semibold text-navy mb-2">
                            Estado de disponibilidad *
                        </label>
                        <select id="estado_disponibilidad" name="estado_disponibilidad" class="w-full px-4 py-3 rounded-card border border-cream-300 bg-white text-ink focus:border-barber-red focus:outline-none focus:ring-4 focus:ring-barber-red-100 transition-colors">
                            <option value="">Selecciona una opción</option>
                            <option value="disponible" {{ old('estado_disponibilidad') === 'disponible' ? 'selected' : '' }}>Disponible</option>
                            <option value="ocupado" {{ old('estado_disponibilidad') === 'ocupado' ? 'selected' : '' }}>Ocupado</option>
                            <option value="inactivo" {{ old('estado_disponibilidad') === 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                        </select>
                        @error('estado_disponibilidad')
                        <p class="text-sm text-barber-red mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="especialidad" class="block text-sm font-semibold text-navy mb-2">
                            Especialidad *
                        </label>

                        <select id="especialidad" name="especialidad" required class="w-full px-4 py-3 rounded-card border border-cream-300 bg-white text-ink focus:border-barber-red focus:outline-none focus:ring-4 focus:ring-barber-red-100 transition-colors">
                            <option value="">Selecciona una especialidad</option>
                            <option value="Corte clásico" {{ old('especialidad') === 'Corte clásico' ? 'selected' : '' }}>Corte clásico</option>
                            <option value="Barba" {{ old('especialidad') === 'Barba' ? 'selected' : '' }}>Barba</option>
                            <option value="Fade" {{ old('especialidad') === 'Fade' ? 'selected' : '' }}>Fade</option>
                            <option value="Afeitado" {{ old('especialidad') === 'Afeitado' ? 'selected' : '' }}>Afeitado</option>
                            <option value="Color" {{ old('especialidad') === 'Color' ? 'selected' : '' }}>Color</option>
                            <option value="General" {{ old('especialidad') === 'General' ? 'selected' : '' }}>General</option>
                        </select>

                        @error('especialidad')
                        <p class="text-sm text-barber-red mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="fecha_contratacion" class="block text-sm font-semibold text-navy mb-2">
                            Fecha de contratación *
                        </label>
                        <input type="date" id="fecha_contratacion" name="fecha_contratacion" value="{{ old('fecha_contratacion') }}" required class="w-full px-4 py-3 rounded-card border border-cream-300 bg-white text-ink focus:border-barber-red focus:outline-none focus:ring-4 focus:ring-barber-red-100 transition-colors">
                        @error('fecha_contratacion')
                        <p class="text-sm text-barber-red mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="experiencia_anos" class="block text-sm font-semibold text-navy mb-2">
                            Años de experiencia
                        </label>
                        <input type="number" id="experiencia_anos" name="experiencia_anos" value="{{ old('experiencia_anos', 0) }}" required placeholder="0" min="0" max="80" class="w-full px-4 py-3 rounded-card border border-cream-300 bg-white text-ink placeholder:text-ink-500 focus:border-barber-red focus:outline-none focus:ring-4 focus:ring-barber-red-100 transition-colors">
                        @error('experiencia_anos')
                        <p class="text-sm text-barber-red mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="biografia" class="block text-sm font-semibold text-navy mb-2">
                            Biografía
                        </label>
                        <textarea id="biografia" name="biografia" rows="4" placeholder="Describe brevemente la experiencia, estilo o especialidades del barbero..." class="w-full px-4 py-3 rounded-card border border-cream-300 bg-white text-ink placeholder:text-ink-500 focus:border-barber-red focus:outline-none focus:ring-4 focus:ring-barber-red-100 transition-colors resize-none">{{ old('biografia') }}</textarea>
                        @error('biografia')
                        <p class="text-sm text-barber-red mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
            </div>

            <!-- Credenciales -->
            <div>
                <div class="mb-5 border-b border-cream-200 pb-4">
                    <h3 class="font-display text-2xl font-bold text-navy">
                        Credenciales de acceso
                    </h3>
                    <p class="mt-1 text-sm text-ink-600">
                        Define la contraseña inicial del barbero.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">

                    <div>
                        <label for="password" class="block text-sm font-semibold text-navy mb-2">
                            Contraseña *
                        </label>
                        <input type="password" id="password" name="password" required placeholder="••••••••" class="w-full px-4 py-3 rounded-card border border-cream-300 bg-white text-ink placeholder:text-ink-500 focus:border-barber-red focus:outline-none focus:ring-4 focus:ring-barber-red-100 transition-colors">
                        @error('password')
                        <p class="text-sm text-barber-red mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-semibold text-navy mb-2">
                            Confirmar Contraseña *
                        </label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="••••••••" class="w-full px-4 py-3 rounded-card border border-cream-300 bg-white text-ink placeholder:text-ink-500 focus:border-barber-red focus:outline-none focus:ring-4 focus:ring-barber-red-100 transition-colors">
                        @error('password_confirmation')
                        <p class="text-sm text-barber-red mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
            </div>

            <!-- Botones -->
            <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 border-t border-cream-200 pt-6">
                <button type="reset" class="rounded-panel bg-cream-200 px-6 py-3 text-sm font-bold text-navy hover:bg-cream-300 transition-colors">
                    Limpiar
                </button>

                <button type="submit" class="rounded-panel bg-barber-red px-6 py-3 text-sm font-bold text-white hover:bg-barber-red-700 focus:outline-none focus:ring-4 focus:ring-barber-red-100 transition-colors">
                    Guardar barbero
                </button>
            </div>

        </form>

    </div>

</section>

@endsection
