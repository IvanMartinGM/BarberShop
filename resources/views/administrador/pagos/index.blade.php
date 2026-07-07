@extends('layouts.admin')

@section('title', 'Pagos - Panel Administrativo')
@section('page-title', 'Gestión de pagos')

@section('content')

<section class="space-y-6">

    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="font-display text-3xl font-bold text-navy">
                Pagos
            </h2>

            <p class="mt-2 text-sm text-ink-600">
                Consulta los pagos registrados en caja.
            </p>
        </div>

        <a href="{{ route('administrador.pagos.create') }}"
           class="inline-flex items-center justify-center rounded-panel bg-success px-5 py-3 text-sm font-bold text-white shadow-card hover:bg-success/90 transition-colors">
            Generar pago
        </a>
    </div>

    @if (session('status'))
        <div class="rounded-card border border-success bg-success-light px-5 py-4 text-sm font-semibold text-success">
            {{ session('status') }}
        </div>
    @endif

    <div class="overflow-hidden rounded-panel border border-cream-200 bg-white shadow-panel">

        <div class="border-b border-cream-200 px-6 py-5">
            <h3 class="font-display text-xl font-bold text-navy">
                Listado de pagos
            </h3>

            <p class="mt-1 text-sm text-ink-500">
                Total de pagos registrados: {{ $pagos->count() }}
            </p>
        </div>

        @if ($pagos->count() > 0)

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-cream-200">

                    <thead class="bg-cream-100">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wide text-ink-500">
                                Pago
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wide text-ink-500">
                                Cita
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wide text-ink-500">
                                Cliente
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wide text-ink-500">
                                Método
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wide text-ink-500">
                                Monto
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

                        @foreach ($pagos as $pago)

                            @php
                                $estadoClasses = match ($pago->estado_pago) {
                                    'pagado' => 'bg-success-light text-success border-success',
                                    'pendiente' => 'bg-warning-light text-warning border-warning',
                                    'cancelado' => 'bg-danger-light text-danger border-danger',
                                    default => 'bg-cream-100 text-ink-600 border-cream-300',
                                };
                            @endphp

                            <tr class="hover:bg-cream-50 transition-colors">

                                <td class="whitespace-nowrap px-6 py-4">
                                    <p class="font-bold text-navy">
                                        #{{ $pago->id }}
                                    </p>

                                    <p class="text-xs text-ink-500">
                                        {{ $pago->fecha_pago?->format('d/m/Y H:i') ?? 'Sin fecha' }}
                                    </p>
                                </td>

                                <td class="whitespace-nowrap px-6 py-4">
                                    <p class="font-semibold text-ink">
                                        Cita #{{ $pago->cita?->id ?? 'N/D' }}
                                    </p>

                                    <p class="text-xs text-ink-500">
                                        {{ $pago->cita?->fecha_cita?->format('d/m/Y') ?? 'N/D' }}
                                    </p>
                                </td>

                                <td class="px-6 py-4">
                                    <p class="font-semibold text-ink">
                                        {{ $pago->cita?->cliente?->user?->getFullName() ?? 'Cliente no disponible' }}
                                    </p>

                                    <p class="text-xs text-ink-500">
                                        {{ $pago->cita?->cliente?->user?->email ?? 'Sin correo' }}
                                    </p>
                                </td>

                                <td class="whitespace-nowrap px-6 py-4">
                                    <p class="font-semibold text-ink">
                                        {{ ucfirst($pago->metodoPago?->nombre_metodo ?? 'N/D') }}
                                    </p>
                                </td>

                                <td class="whitespace-nowrap px-6 py-4">
                                    <p class="font-display text-xl font-bold text-success">
                                        ${{ number_format($pago->monto, 2) }}
                                    </p>
                                </td>

                                <td class="whitespace-nowrap px-6 py-4">
                                    <span class="inline-flex rounded-full border px-3 py-1 text-xs font-bold uppercase tracking-wide {{ $estadoClasses }}">
                                        {{ $pago->estado_pago }}
                                    </span>
                                </td>

                                <td class="whitespace-nowrap px-6 py-4 text-right">
                                    <a href="{{ route('administrador.pagos.show', $pago->id) }}"
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
                <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-success-light text-5xl">
                    💵
                </div>

                <h3 class="mt-6 font-display text-3xl font-bold text-navy">
                    No hay pagos registrados
                </h3>

                <p class="mx-auto mt-3 max-w-xl text-sm leading-6 text-ink-600">
                    Cuando completes una cita, podrás generar su pago desde el detalle de la cita.
                </p>
            </div>

        @endif

    </div>

</section>

@endsection