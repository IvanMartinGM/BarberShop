@extends('layouts.guest')

@section('title', 'Mis citas - BarberShop')

@section('content')

<section class="bg-cream py-12 md:py-16">

    <div class="mx-auto max-w-7xl px-4 sm:px-6">

        <!-- Header -->
        <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="font-display text-4xl font-bold text-navy">
                    Mis citas
                </h1>

                <p class="mt-2 text-sm text-ink-600">
                    Consulta tus citas pendientes, confirmadas, completadas o canceladas.
                </p>
            </div>

            <a href="{{ route('cliente.citas.create') }}"
               class="inline-flex items-center justify-center rounded-panel bg-barber-red px-5 py-3 text-sm font-bold text-white shadow-card hover:bg-barber-red-700 transition-colors">
                Agendar nueva cita
            </a>
        </div>

        @if (session('status'))
            <div class="mb-6 rounded-card border border-success bg-success-light px-5 py-4 text-sm font-semibold text-success">
                {{ session('status') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-6 rounded-card border border-danger bg-danger-light px-5 py-4 text-sm font-semibold text-danger">
                {{ session('error') }}
            </div>
        @endif

        @if ($citas->count() > 0)

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">

                @foreach ($citas as $cita)

                    @php
                        $estadoClasses = match ($cita->estado_cita) {
                            'pendiente' => 'bg-warning-light text-warning border-warning',
                            'confirmada' => 'bg-info-light text-info border-info',
                            'completada' => 'bg-success-light text-success border-success',
                            'cancelada' => 'bg-danger-light text-danger border-danger',
                            default => 'bg-cream-100 text-ink-600 border-cream-300',
                        };
                    @endphp

                    <article class="overflow-hidden rounded-panel border border-cream-200 bg-white shadow-card transition-shadow hover:shadow-panel">

                        <div class="border-b border-cream-200 px-6 py-5">

                            <div class="flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">

                                <div>
                                    <h2 class="font-display text-2xl font-bold text-navy">
                                        Cita #{{ $cita->id }}
                                    </h2>

                                    <p class="mt-1 text-sm text-ink-500">
                                        {{ $cita->fecha_cita?->format('d/m/Y') }}
                                        —
                                        {{ $cita->hora_inicio }} a {{ $cita->hora_fin }}
                                    </p>
                                </div>

                                <span class="inline-flex w-fit rounded-full border px-3 py-1 text-xs font-bold uppercase tracking-wide {{ $estadoClasses }}">
                                    {{ $cita->estado_cita }}
                                </span>

                            </div>

                        </div>

                        <div class="space-y-5 p-6">

                            <div>
                                <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                                    Barbero
                                </p>

                                <p class="mt-1 font-semibold text-ink">
                                    {{ $cita->barbero?->user?->getFullName() ?? 'Barbero no disponible' }}
                                </p>
                            </div>

                            <div>
                                <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                                    Servicio(s)
                                </p>

                                <div class="mt-2 flex flex-wrap gap-2">
                                    @foreach ($cita->servicios as $servicio)
                                        <span class="rounded-full bg-cream-100 px-3 py-1 text-xs font-bold text-navy">
                                            {{ $servicio->nombre_servicio }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>

                            @if ($cita->observaciones)
                                <div>
                                    <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                                        Observaciones
                                    </p>

                                    <p class="mt-1 text-sm text-ink-600">
                                        {{ $cita->observaciones }}
                                    </p>
                                </div>
                            @endif

                        </div>

                        <div class="flex flex-col gap-3 border-t border-cream-200 bg-cream-50 px-6 py-5 sm:flex-row sm:justify-end">

                            <a href="{{ route('cliente.citas.show', $cita->id) }}"
                               class="inline-flex items-center justify-center rounded-panel border border-cream-300 bg-white px-5 py-3 text-sm font-bold text-navy hover:bg-cream-100 transition-colors">
                                Ver detalle
                            </a>

                            @if (!in_array($cita->estado_cita, ['completada', 'cancelada']))
                                <form method="POST"
                                      action="{{ route('cliente.citas.cancel', $cita->id) }}"
                                      onsubmit="return confirm('¿Seguro que deseas cancelar esta cita?');">
                                    @csrf
                                    @method('PATCH')

                                    <button type="submit"
                                            class="inline-flex w-full items-center justify-center rounded-panel bg-danger px-5 py-3 text-sm font-bold text-white hover:bg-barber-red-700 transition-colors">
                                        Cancelar cita
                                    </button>
                                </form>
                            @endif

                        </div>

                    </article>

                @endforeach

            </div>

        @else

            <div class="rounded-panel border border-cream-200 bg-white px-6 py-16 text-center shadow-panel">

                <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-barber-red-50 text-5xl">
                    📅
                </div>

                <h2 class="mt-6 font-display text-3xl font-bold text-navy">
                    Aún no tienes citas
                </h2>

                <p class="mx-auto mt-3 max-w-xl text-sm leading-6 text-ink-600">
                    Agenda tu primera cita y disfruta de un servicio profesional en BarberShop.
                </p>

                <a href="{{ route('cliente.citas.create') }}"
                   class="mt-8 inline-flex items-center justify-center rounded-panel bg-barber-red px-6 py-3 text-sm font-bold text-white shadow-card hover:bg-barber-red-700 transition-colors">
                    Agendar cita
                </a>

            </div>

        @endif

    </div>

</section>

@endsection