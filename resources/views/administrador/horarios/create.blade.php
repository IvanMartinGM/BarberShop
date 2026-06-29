@extends('layouts.admin')

@section('title', 'Agregar horario - BarberShop')
@section('page-title', 'Agregar horario')

@section('content')

<section class="max-w-5xl mx-auto">

    <!-- Header interno -->
    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="font-display text-3xl font-bold text-navy">
                Registrar nuevo horario
            </h2>

            <p class="mt-2 text-sm text-ink-600">
                Crea un horario de trabajo y selecciona los días en los que estará disponible.
            </p>
        </div>

        <a href="{{ route('horario.index') }}" class="inline-flex items-center justify-center rounded-panel border border-cream-300 bg-white px-5 py-3 text-sm font-bold text-navy hover:bg-cream-100 transition-colors">
            Volver
        </a>
    </div>

    <!-- Card principal -->
    <div class="rounded-panel border border-cream-200 bg-white shadow-card">

        <form method="POST" action="{{ route('horario.store') }}" class="p-6 sm:p-8 space-y-8">
            @csrf

            <!-- Información del horario -->
            <div>
                <div class="mb-5 border-b border-cream-200 pb-4">
                    <h3 class="font-display text-2xl font-bold text-navy">
                        Información del horario
                    </h3>

                    <p class="mt-1 text-sm text-ink-600">
                        Define el nombre, descripción y rango de horas del horario.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">

                    <div class="md:col-span-2">
                        <label for="nombre_horario" class="block text-sm font-semibold text-navy mb-2">
                            Nombre del horario *
                        </label>

                        <input type="text" id="nombre_horario" name="nombre_horario" value="{{ old('nombre_horario') }}" required placeholder="Turno matutino" class="w-full px-4 py-3 rounded-card border border-cream-300 bg-white text-ink placeholder:text-ink-500 focus:border-barber-red focus:outline-none focus:ring-4 focus:ring-barber-red-100 transition-colors">

                        @error('nombre_horario')
                        <p class="text-sm text-barber-red mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="hora_inicio" class="block text-sm font-semibold text-navy mb-2">
                            Hora de inicio *
                        </label>

                        <input type="time" id="hora_inicio" name="hora_inicio" value="{{ old('hora_inicio') }}" required class="w-full px-4 py-3 rounded-card border border-cream-300 bg-white text-ink focus:border-barber-red focus:outline-none focus:ring-4 focus:ring-barber-red-100 transition-colors">

                        @error('hora_inicio')
                        <p class="text-sm text-barber-red mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="hora_fin" class="block text-sm font-semibold text-navy mb-2">
                            Hora de fin *
                        </label>

                        <input type="time" id="hora_fin" name="hora_fin" value="{{ old('hora_fin') }}" required class="w-full px-4 py-3 rounded-card border border-cream-300 bg-white text-ink focus:border-barber-red focus:outline-none focus:ring-4 focus:ring-barber-red-100 transition-colors">

                        @error('hora_fin')
                        <p class="text-sm text-barber-red mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="descripcion" class="block text-sm font-semibold text-navy mb-2">
                            Descripción
                        </label>

                        <textarea id="descripcion" name="descripcion" rows="4" placeholder="Ejemplo: Horario principal para barberos del turno matutino." class="w-full px-4 py-3 rounded-card border border-cream-300 bg-white text-ink placeholder:text-ink-500 focus:border-barber-red focus:outline-none focus:ring-4 focus:ring-barber-red-100 transition-colors resize-none">{{ old('descripcion') }}</textarea>

                        @error('descripcion')
                        <p class="text-sm text-barber-red mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
            </div>

            <!-- Días de la semana -->
            <div>
                <div class="mb-5 border-b border-cream-200 pb-4">
                    <h3 class="font-display text-2xl font-bold text-navy">
                        Días de la semana
                    </h3>

                    <p class="mt-1 text-sm text-ink-600">
                        Selecciona los días en los que aplicará este horario.
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">

                    @foreach ($dias as $dia)
                    <label class="flex items-center gap-3 rounded-card border border-cream-300 bg-cream-50 px-4 py-3 text-sm font-semibold text-ink hover:bg-cream-100 transition-colors cursor-pointer">
                        <input type="checkbox" 
                        name="dias[]" 
                        value="{{ $dia->id }}" 
                        {{ in_array($dia->id, old('dias', [])) ? 'checked' : '' }}
                         class="h-4 w-4 rounded border-cream-300 text-barber-red focus:ring-barber-red">

                        <span>
                            {{ ucfirst($dia->nombre_dia) }}
                        </span>
                    </label>
                    @endforeach

                </div>

                @error('dias')
                <p class="text-sm text-barber-red mt-2">{{ $message }}</p>
                @enderror

                @error('dias.*')
                <p class="text-sm text-barber-red mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Botones -->
            <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 border-t border-cream-200 pt-6">

                <button type="reset" class="rounded-panel bg-cream-200 px-6 py-3 text-sm font-bold text-navy hover:bg-cream-300 transition-colors">
                    Limpiar
                </button>

                <button type="submit" class="rounded-panel bg-barber-red px-6 py-3 text-sm font-bold text-white hover:bg-barber-red-700 focus:outline-none focus:ring-4 focus:ring-barber-red-100 transition-colors">
                    Guardar horario
                </button>

            </div>

        </form>

    </div>

</section>

@endsection
