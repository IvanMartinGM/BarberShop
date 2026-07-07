@extends('layouts.barbero')

@section('title', 'Mis citas - BarberShop')
@section('page-title', 'Mis citas')

@section('content')

<section class="space-y-6">

    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="font-display text-3xl font-bold text-navy">
                Mis citas
            </h2>

            <p class="mt-2 text-sm text-ink-600">
                Consulta las citas que tienes asignadas.
            </p>
        </div>
    </div>

    <div class="rounded-panel border border-cream-200 bg-white p-5 shadow-card">

        <div class="flex flex-wrap gap-2">

            <a href="{{ route('barbero.citas.index') }}"
               class="rounded-full px-4 py-2 text-xs font-bold transition-colors
               {{ empty($estado) ? 'bg-barber-red text-white' : 'bg-cream-100 text-ink-600 hover:bg-cream-200' }}">
                Todas
            </a>

            <a href="{{ route('barbero.citas.index', ['estado' => 'pendiente']) }}"
               class="rounded-full px-4 py-2 text-xs font-bold transition-colors
               {{ $estado === 'pendiente' ? 'bg-warning text-white' : 'bg-warning-light text-warning hover:bg-warning/10' }}">
                Pendientes
            </a>

            <a href="{{ route('barbero.citas.index', ['estado' => 'confirmada']) }}"
               class="rounded-full px-4 py-2 text-xs font-bold transition-colors
               {{ $estado === 'confirmada' ? 'bg-info text-white' : 'bg-info-light text-info hover:bg-info/10' }}">
                Confirmadas
            </a>

            <a href="{{ route('barbero.citas.index', ['estado' => 'completada']) }}"
               class="rounded-full px-4 py-2 text-xs font-bold transition-colors
               {{ $estado === 'completada' ? 'bg-success text-white' : 'bg-success-light text-success hover:bg-success/10' }}">
                Completadas
            </a>

            <a href="{{ route('barbero.citas.index', ['estado' => 'cancelada']) }}"
               class="rounded-full px-4 py-2 text-xs font-bold transition-colors
               {{ $estado === 'cancelada' ? 'bg-danger text-white' : 'bg-danger-light text-danger hover:bg-danger/10' }}">
                Canceladas
            </a>

        </div>

    </div>

    <div class="overflow-hidden rounded-panel border border-cream-200 bg-white shadow-panel">

        <div class="border-b border-cream-200 px-6 py-5">
            <h3 class="font-display text-xl font-bold text-navy">
                Listado de citas
            </h3>

            <p class="mt-1 text-sm text-ink-500">
                Total encontradas: {{ $citas->count() }}
            </p>
        </div>

        @if ($citas->count() > 0)

            <div class="overflow-x-auto">

                <table class="min-w-full divide-y divide-cream-200">

                    <thead class="bg-cream-100">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wide text-ink-500">
                                Cita
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wide text-ink-500">
                                Cliente
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wide text-ink-500">
                                Fecha y hora
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wide text-ink-500">
                                Servicio
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wide text-ink-500">
                                Estado
                            </th>

                            <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wide text-ink-500">
                                Acciones
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-cream-200 bg-white">

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

                            <tr class="hover:bg-cream-50 transition-colors">

                                <td class="whitespace-nowrap px-6 py-4">
                                    <p class="font-bold text-navy">
                                        #{{ $cita->id }}
                                    </p>
                                </td>

                                <td class="px-6 py-4">
                                    <p class="font-semibold text-ink">
                                        {{ $cita->cliente?->user?->getFullName() ?? 'Cliente no disponible' }}
                                    </p>

                                    <p class="text-xs text-ink-500">
                                        {{ $cita->cliente?->user?->email ?? 'Sin correo' }}
                                    </p>
                                </td>

                                <td class="whitespace-nowrap px-6 py-4">
                                    <p class="font-semibold text-ink">
                                        {{ $cita->fecha_cita?->format('d/m/Y') }}
                                    </p>

                                    <p class="text-xs text-ink-500">
                                        {{ $cita->hora_inicio }} - {{ $cita->hora_fin }}
                                    </p>
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex flex-wrap gap-2">
                                        @forelse ($cita->servicios as $servicio)
                                            <span class="rounded-full bg-cream-100 px-3 py-1 text-xs font-bold text-navy">
                                                {{ $servicio->nombre_servicio }}
                                            </span>
                                        @empty
                                            <span class="text-sm text-ink-500">
                                                Sin servicios
                                            </span>
                                        @endforelse
                                    </div>
                                </td>

                                <td class="whitespace-nowrap px-6 py-4">
                                    <span class="inline-flex rounded-full border px-3 py-1 text-xs font-bold uppercase tracking-wide {{ $estadoClasses }}">
                                        {{ $cita->estado_cita }}
                                    </span>
                                </td>

                                <td class="whitespace-nowrap px-6 py-4 text-right">
                                    <a href="{{ route('barbero.citas.show', $cita->id) }}"
                                       class="inline-flex items-center justify-center rounded-card bg-navy px-4 py-2 text-xs font-bold text-white hover:bg-navy-800 transition-colors">
                                        Ver detalle
                                    </a>
                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @else

            <div class="px-6 py-16 text-center">
                <h3 class="font-display text-3xl font-bold text-navy">
                    No tienes citas asignadas
                </h3>

                <p class="mx-auto mt-3 max-w-xl text-sm leading-6 text-ink-600">
                    Cuando un cliente agende una cita contigo, aparecerá en este listado.
                </p>
            </div>

        @endif

    </div>

</section>

@endsection