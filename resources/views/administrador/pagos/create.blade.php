@extends('layouts.admin')

@section('title', 'Generar pago - Panel Administrativo')
@section('page-title', 'Generar pago')

@section('content')

@php
    $citaActual = $citaSeleccionada ?? null;

    $montoSugerido = 0;

    if ($citaActual) {
        $montoSugerido = $citaActual->servicios->sum(function ($servicio) {
            return $servicio->citas_servicios->precio_aplicado ?? 0;
        });
    }
@endphp

<section class="space-y-6">

    <!-- Header -->
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="font-display text-3xl font-bold text-navy">
                Generar pago
            </h2>

            <p class="mt-2 text-sm text-ink-600">
                Registra el pago en caja de una cita completada.
            </p>
        </div>

        <a href="{{ route('administrador.pagos.index') }}"
           class="inline-flex items-center justify-center rounded-panel border border-cream-300 bg-white px-5 py-3 text-sm font-bold text-navy hover:bg-cream-100 transition-colors">
            Ver pagos
        </a>
    </div>

    <!-- Mensajes -->
    @if (session('error'))
        <div class="rounded-card border border-danger bg-danger-light px-5 py-4 text-sm font-semibold text-danger">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="rounded-card border border-danger bg-danger-light px-5 py-4 text-sm text-danger">
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

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-[minmax(0,1fr)_380px]">

        <!-- Formulario -->
        <form method="POST"
              action="{{ route('administrador.pagos.store') }}"
              class="overflow-hidden rounded-panel border border-cream-200 bg-white shadow-panel">
            @csrf

            <div class="border-b border-cream-200 px-6 py-5">
                <h3 class="font-display text-2xl font-bold text-navy">
                    Datos del pago
                </h3>

                <p class="mt-1 text-sm text-ink-500">
                    Solo puedes generar pagos para citas completadas y sin pago registrado.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-6 p-6 md:grid-cols-2">

                <!-- Cita -->
                <div class="md:col-span-2">
                    <label for="id_cita" class="mb-2 block text-sm font-bold text-navy">
                        Cita completada
                    </label>

                    <select name="id_cita"
                            id="id_cita"
                            required
                            class="w-full rounded-card border border-cream-300 bg-white px-4 py-3 text-ink shadow-sm focus:border-barber-red focus:outline-none focus:ring-4 focus:ring-barber-red-100">

                        <option value="">Selecciona una cita</option>

                        @foreach ($citasCompletadasSinPago as $cita)
                            @php
                                $totalCita = $cita->servicios->sum(function ($servicio) {
                                    return $servicio->citas_servicios->precio_aplicado ?? 0;
                                });
                            @endphp

                            <option value="{{ $cita->id }}"
                                    data-total="{{ $totalCita }}"
                                    {{ old('id_cita', $citaActual?->id) == $cita->id ? 'selected' : '' }}>
                                Cita #{{ $cita->id }}
                                —
                                {{ $cita->cliente?->user?->getFullName() ?? 'Cliente no disponible' }}
                                —
                                {{ $cita->fecha_cita?->format('d/m/Y') }}
                                —
                                ${{ number_format($totalCita, 2) }}
                            </option>
                        @endforeach
                    </select>

                    @error('id_cita')
                        <p class="mt-2 text-sm font-semibold text-danger">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Método de pago -->
                <div>
                    <label for="id_metodo_pago" class="mb-2 block text-sm font-bold text-navy">
                        Método de pago
                    </label>

                    <select name="id_metodo_pago"
                            id="id_metodo_pago"
                            required
                            class="w-full rounded-card border border-cream-300 bg-white px-4 py-3 text-ink shadow-sm focus:border-barber-red focus:outline-none focus:ring-4 focus:ring-barber-red-100">

                        <option value="">Selecciona método</option>

                        @foreach ($metodosPago as $metodo)
                            <option value="{{ $metodo->id }}"
                                    {{ old('id_metodo_pago', $metodoEfectivo?->id) == $metodo->id ? 'selected' : '' }}>
                                {{ ucfirst($metodo->nombre_metodo) }}
                            </option>
                        @endforeach
                    </select>

                    @error('id_metodo_pago')
                        <p class="mt-2 text-sm font-semibold text-danger">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Estado pago -->
                <div>
                    <label for="estado_pago" class="mb-2 block text-sm font-bold text-navy">
                        Estado del pago
                    </label>

                    <select name="estado_pago"
                            id="estado_pago"
                            required
                            class="w-full rounded-card border border-cream-300 bg-white px-4 py-3 text-ink shadow-sm focus:border-barber-red focus:outline-none focus:ring-4 focus:ring-barber-red-100">

                        <option value="pagado" {{ old('estado_pago', 'pagado') === 'pagado' ? 'selected' : '' }}>
                            Pagado
                        </option>

                        <option value="pendiente" {{ old('estado_pago') === 'pendiente' ? 'selected' : '' }}>
                            Pendiente
                        </option>

                        <option value="cancelado" {{ old('estado_pago') === 'cancelado' ? 'selected' : '' }}>
                            Cancelado
                        </option>
                    </select>

                    @error('estado_pago')
                        <p class="mt-2 text-sm font-semibold text-danger">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Monto -->
                <div>
                    <label for="monto" class="mb-2 block text-sm font-bold text-navy">
                        Monto
                    </label>

                    <input type="number"
                           name="monto"
                           id="monto"
                           step="0.01"
                           min="0.01"
                           value="{{ old('monto', number_format($montoSugerido, 2, '.', '')) }}"
                           required
                           class="w-full rounded-card border border-cream-300 px-4 py-3 text-ink shadow-sm focus:border-barber-red focus:outline-none focus:ring-4 focus:ring-barber-red-100">

                    @error('monto')
                        <p class="mt-2 text-sm font-semibold text-danger">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Referencia -->
                <div>
                    <label for="referencia_transaccion" class="mb-2 block text-sm font-bold text-navy">
                        Referencia
                    </label>

                    <input type="text"
                           name="referencia_transaccion"
                           id="referencia_transaccion"
                           value="{{ old('referencia_transaccion') }}"
                           placeholder="Opcional"
                           class="w-full rounded-card border border-cream-300 px-4 py-3 text-ink shadow-sm focus:border-barber-red focus:outline-none focus:ring-4 focus:ring-barber-red-100">

                    @error('referencia_transaccion')
                        <p class="mt-2 text-sm font-semibold text-danger">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Concepto -->
                <div class="md:col-span-2">
                    <label for="concepto" class="mb-2 block text-sm font-bold text-navy">
                        Concepto
                    </label>

                    <textarea name="concepto"
                              id="concepto"
                              rows="3"
                              placeholder="Ejemplo: Pago en efectivo de cita completada"
                              class="w-full rounded-card border border-cream-300 px-4 py-3 text-ink shadow-sm focus:border-barber-red focus:outline-none focus:ring-4 focus:ring-barber-red-100">{{ old('concepto', $citaActual ? 'Pago en caja de la cita #' . $citaActual->id : '') }}</textarea>

                    @error('concepto')
                        <p class="mt-2 text-sm font-semibold text-danger">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

            </div>

            <div class="flex flex-col-reverse gap-3 border-t border-cream-200 bg-cream-50 px-6 py-5 sm:flex-row sm:justify-end">

                <a href="{{ route('administrador.citas.index') }}"
                   class="inline-flex items-center justify-center rounded-panel bg-cream-200 px-6 py-3 text-sm font-bold text-navy hover:bg-cream-300 transition-colors">
                    Cancelar
                </a>

                <button type="submit"
                        class="inline-flex items-center justify-center rounded-panel bg-success px-6 py-3 text-sm font-bold text-white shadow-card hover:bg-success/90 focus:outline-none focus:ring-4 focus:ring-success/20 transition-colors">
                    Registrar pago
                </button>

            </div>

        </form>

        <!-- Resumen -->
        <aside class="h-fit rounded-panel border border-cream-200 bg-white p-6 shadow-panel">

            <h3 class="font-display text-2xl font-bold text-navy">
                Resumen de cita
            </h3>

            @if ($citaActual)

                <div class="mt-5 space-y-4">

                    <div class="rounded-card bg-cream-50 p-4">
                        <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                            Cliente
                        </p>

                        <p class="mt-1 font-semibold text-ink">
                            {{ $citaActual->cliente?->user?->getFullName() ?? 'Cliente no disponible' }}
                        </p>
                    </div>

                    <div class="rounded-card bg-cream-50 p-4">
                        <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                            Barbero
                        </p>

                        <p class="mt-1 font-semibold text-ink">
                            {{ $citaActual->barbero?->user?->getFullName() ?? 'Barbero no disponible' }}
                        </p>
                    </div>

                    <div class="rounded-card bg-cream-50 p-4">
                        <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                            Fecha y hora
                        </p>

                        <p class="mt-1 font-semibold text-ink">
                            {{ $citaActual->fecha_cita?->format('d/m/Y') }}
                            —
                            {{ $citaActual->hora_inicio }} a {{ $citaActual->hora_fin }}
                        </p>
                    </div>

                    <div class="rounded-card bg-cream-50 p-4">
                        <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                            Servicios
                        </p>

                        <div class="mt-3 space-y-2">
                            @foreach ($citaActual->servicios as $servicio)
                                <div class="flex items-center justify-between gap-3 text-sm">
                                    <span class="text-ink-600">
                                        {{ $servicio->nombre_servicio }}
                                    </span>

                                    <span class="font-bold text-navy">
                                        ${{ number_format($servicio->citas_servicios->precio_aplicado ?? 0, 2) }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="rounded-card border border-success bg-success-light p-4">
                        <p class="text-xs font-bold uppercase tracking-wide text-success">
                            Total sugerido
                        </p>

                        <p class="mt-1 font-display text-3xl font-bold text-success">
                            ${{ number_format($montoSugerido, 2) }}
                        </p>
                    </div>

                </div>

            @else

                <div class="mt-5 rounded-card border border-warning bg-warning-light p-4 text-sm font-semibold text-warning">
                    Selecciona una cita completada para ver su resumen.
                </div>

            @endif

        </aside>

    </div>

</section>

<script>
    const citaSelect = document.getElementById('id_cita');
    const montoInput = document.getElementById('monto');
    const conceptoInput = document.getElementById('concepto');

    if (citaSelect && montoInput) {
        citaSelect.addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];
            const total = selectedOption.dataset.total ?? '';

            if (total) {
                montoInput.value = Number(total).toFixed(2);
            }

            if (conceptoInput && this.value) {
                conceptoInput.value = `Pago en caja de la cita #${this.value}`;
            }
        });
    }
</script>

@endsection