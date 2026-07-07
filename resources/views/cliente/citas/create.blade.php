@extends('layouts.guest')

@section('title', 'Agendar cita - BarberShop')

@section('content')

<section class="bg-cream py-12 md:py-16">

    <div class="mx-auto max-w-6xl px-4 sm:px-6">

        <!-- Header -->
        <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="font-display text-4xl font-bold text-navy">
                    Agendar cita
                </h1>

                <p class="mt-2 text-sm text-ink-600">
                    Selecciona el servicio, barbero, fecha y hora para reservar tu cita.
                </p>
            </div>

            <a href="{{ route('cliente.citas.index') }}"
               class="inline-flex items-center justify-center rounded-panel border border-cream-300 bg-white px-5 py-3 text-sm font-bold text-navy hover:bg-cream-100 transition-colors">
                Ver mis citas
            </a>
        </div>

        <!-- Errores globales -->
        @if (session('error'))
            <div class="mb-6 rounded-card border border-danger bg-danger-light px-5 py-4 text-sm font-semibold text-danger">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-6 rounded-card border border-danger bg-danger-light px-5 py-4 text-sm text-danger">
                <p class="mb-2 font-bold">
                    Hay errores en el formulario:
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

        <div 
            x-data="appointmentForm()"
            x-init="init()"
            class="grid grid-cols-1 gap-8 lg:grid-cols-[minmax(0,1fr)_360px]"
        >

            <!-- Formulario -->
            <form method="POST"
                  action="{{ route('cliente.citas.store') }}"
                  class="overflow-hidden rounded-panel border border-cream-200 bg-white shadow-panel">
                @csrf

                <div class="border-b border-cream-200 px-6 py-5">
                    <h2 class="font-display text-2xl font-bold text-navy">
                        Datos de la cita
                    </h2>

                    <p class="mt-1 text-sm text-ink-500">
                        Completa la información necesaria para reservar tu horario.
                    </p>
                </div>

                <div class="grid grid-cols-1 gap-6 p-6 md:grid-cols-2">

                    <!-- Servicio -->
                    <div class="md:col-span-2">
                        <label for="id_servicio" class="mb-2 block text-sm font-bold text-navy">
                            Servicio
                        </label>

                        <select
                            name="id_servicio"
                            id="id_servicio"
                            x-model="selectedServiceId"
                            x-on:change="loadBarbers()"
                            required
                            class="w-full rounded-card border border-cream-300 bg-white px-4 py-3 text-ink shadow-sm focus:border-barber-red focus:outline-none focus:ring-4 focus:ring-barber-red-100"
                        >
                            <option value="">Selecciona un servicio</option>

                            @foreach ($servicios as $servicio)
                                <option 
                                    value="{{ $servicio->id }}"
                                    data-name="{{ $servicio->nombre_servicio }}"
                                    data-price="{{ $servicio->precio_base ?? $servicio->precio ?? 0 }}"
                                    data-duration="{{ $servicio->duracion_minutos ?? 30 }}"
                                    {{ old('id_servicio') == $servicio->id ? 'selected' : '' }}
                                >
                                    {{ $servicio->nombre_servicio }}
                                    —
                                    ${{ number_format($servicio->precio_base ?? $servicio->precio ?? 0, 2) }}
                                    —
                                    {{ $servicio->duracion_minutos ?? 30 }} min
                                </option>
                            @endforeach
                        </select>

                        @error('id_servicio')
                            <p class="mt-2 text-sm font-semibold text-danger">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Barbero -->
                    <div class="md:col-span-2">
                        <label for="id_barbero" class="mb-2 block text-sm font-bold text-navy">
                            Barbero disponible
                        </label>

                        <select
                            name="id_barbero"
                            id="id_barbero"
                            x-model="selectedBarberId"
                            required
                            x-bind:disabled="!selectedServiceId || loadingBarbers"
                            class="w-full rounded-card border border-cream-300 bg-white px-4 py-3 text-ink shadow-sm disabled:bg-cream-100 disabled:text-ink-400 focus:border-barber-red focus:outline-none focus:ring-4 focus:ring-barber-red-100"
                        >
                            <option value="">
                                Selecciona primero un servicio
                            </option>

                            <template x-for="barbero in barberos" :key="barbero.id">
                                <option 
                                    :value="barbero.id"
                                    x-text="`${barbero.nombre} — ${barbero.especialidad ?? 'Sin especialidad'}`"
                                ></option>
                            </template>
                        </select>

                        <p x-show="loadingBarbers" class="mt-2 text-sm font-semibold text-info">
                            Buscando barberos disponibles...
                        </p>

                        <p x-show="selectedServiceId && !loadingBarbers && barberos.length === 0"
                           class="mt-2 text-sm font-semibold text-warning">
                            No hay barberos disponibles para este servicio.
                        </p>

                        @error('id_barbero')
                            <p class="mt-2 text-sm font-semibold text-danger">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Fecha -->
                    <div>
                        <label for="fecha_cita" class="mb-2 block text-sm font-bold text-navy">
                            Fecha
                        </label>

                        <input
                            type="date"
                            name="fecha_cita"
                            id="fecha_cita"
                            value="{{ old('fecha_cita') }}"
                            min="{{ now()->format('Y-m-d') }}"
                            required
                            class="w-full rounded-card border border-cream-300 px-4 py-3 text-ink shadow-sm focus:border-barber-red focus:outline-none focus:ring-4 focus:ring-barber-red-100"
                        >

                        @error('fecha_cita')
                            <p class="mt-2 text-sm font-semibold text-danger">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Hora -->
                    <div>
                        <label for="hora_inicio" class="mb-2 block text-sm font-bold text-navy">
                            Hora de inicio
                        </label>

                        <input
                            type="time"
                            name="hora_inicio"
                            id="hora_inicio"
                            value="{{ old('hora_inicio') }}"
                            required
                            class="w-full rounded-card border border-cream-300 px-4 py-3 text-ink shadow-sm focus:border-barber-red focus:outline-none focus:ring-4 focus:ring-barber-red-100"
                        >

                        @error('hora_inicio')
                            <p class="mt-2 text-sm font-semibold text-danger">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Observaciones -->
                    <div class="md:col-span-2">
                        <label for="observaciones" class="mb-2 block text-sm font-bold text-navy">
                            Observaciones
                        </label>

                        <textarea
                            name="observaciones"
                            id="observaciones"
                            rows="4"
                            placeholder="Ejemplo: quiero un corte clásico, barba perfilada, etc."
                            class="w-full rounded-card border border-cream-300 px-4 py-3 text-ink shadow-sm focus:border-barber-red focus:outline-none focus:ring-4 focus:ring-barber-red-100"
                        >{{ old('observaciones') }}</textarea>

                        @error('observaciones')
                            <p class="mt-2 text-sm font-semibold text-danger">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                </div>

                <div class="flex flex-col-reverse gap-3 border-t border-cream-200 bg-cream-50 px-6 py-5 sm:flex-row sm:justify-end">

                    <a href="{{ route('home') }}"
                       class="inline-flex items-center justify-center rounded-panel bg-cream-200 px-6 py-3 text-sm font-bold text-navy hover:bg-cream-300 transition-colors">
                        Cancelar
                    </a>

                    <button
                        type="submit"
                        class="inline-flex items-center justify-center rounded-panel bg-barber-red px-6 py-3 text-sm font-bold text-white shadow-card hover:bg-barber-red-700 focus:outline-none focus:ring-4 focus:ring-barber-red-100 transition-colors"
                    >
                        Confirmar cita
                    </button>

                </div>

            </form>

            <!-- Resumen -->
            <aside class="h-fit rounded-panel border border-cream-200 bg-white p-6 shadow-panel">

                <h3 class="font-display text-2xl font-bold text-navy">
                    Resumen
                </h3>

                <p class="mt-1 text-sm text-ink-500">
                    Revisa los datos antes de confirmar.
                </p>

                <div class="mt-6 space-y-4">

                    <div class="rounded-card bg-cream-50 p-4">
                        <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                            Servicio
                        </p>

                        <p class="mt-1 font-semibold text-ink" x-text="selectedServiceName || 'No seleccionado'">
                            No seleccionado
                        </p>
                    </div>

                    <div class="grid grid-cols-2 gap-4">

                        <div class="rounded-card bg-cream-50 p-4">
                            <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                                Precio
                            </p>

                            <p class="mt-1 font-semibold text-ink">
                                $<span x-text="selectedServicePrice"></span>
                            </p>
                        </div>

                        <div class="rounded-card bg-cream-50 p-4">
                            <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                                Duración
                            </p>

                            <p class="mt-1 font-semibold text-ink">
                                <span x-text="selectedServiceDuration"></span> min
                            </p>
                        </div>

                    </div>

                    <div class="rounded-card border border-info bg-info-light p-4">
                        <p class="text-sm font-semibold text-info">
                            Tu cita se registrará con estado pendiente.
                        </p>

                        <p class="mt-1 text-xs text-ink-600">
                            La barbería podrá confirmar o revisar la cita posteriormente.
                        </p>
                    </div>

                </div>

            </aside>

        </div>

    </div>

</section>

<script>
    function appointmentForm() {
        return {
            selectedServiceId: @json(old('id_servicio', '')),
            selectedBarberId: @json(old('id_barbero', '')),
            barberos: [],
            loadingBarbers: false,
            selectedServiceName: '',
            selectedServicePrice: '0.00',
            selectedServiceDuration: '0',

            init() {
                this.updateServiceSummary();

                if (this.selectedServiceId) {
                    this.loadBarbers();
                }
            },

            updateServiceSummary() {
                const select = document.getElementById('id_servicio');
                const option = select.options[select.selectedIndex];

                if (!option || !option.value) {
                    this.selectedServiceName = '';
                    this.selectedServicePrice = '0.00';
                    this.selectedServiceDuration = '0';
                    return;
                }

                this.selectedServiceName = option.dataset.name ?? '';
                this.selectedServicePrice = Number(option.dataset.price ?? 0).toFixed(2);
                this.selectedServiceDuration = option.dataset.duration ?? '0';
            },

            async loadBarbers() {
                this.updateServiceSummary();
                this.barberos = [];
                this.selectedBarberId = '';

                if (!this.selectedServiceId) {
                    return;
                }

                this.loadingBarbers = true;

                try {
                    const url = `/cliente/servicios/${this.selectedServiceId}/barberos`;
                    const response = await fetch(url, {
                        headers: {
                            'Accept': 'application/json',
                        }
                    });

                    const data = await response.json();

                    this.barberos = data.barberos ?? [];

                    const oldBarberId = @json(old('id_barbero', ''));

                    if (oldBarberId && this.barberos.some(barbero => String(barbero.id) === String(oldBarberId))) {
                        this.selectedBarberId = oldBarberId;
                    }

                } catch (error) {
                    console.error('Error al cargar barberos:', error);
                    this.barberos = [];
                } finally {
                    this.loadingBarbers = false;
                }
            }
        }
    }
</script>

@endsection