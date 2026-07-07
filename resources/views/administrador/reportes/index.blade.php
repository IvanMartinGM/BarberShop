@extends('layouts.admin')

@section('title', 'Reportes - Panel Administrativo')
@section('page-title', 'Reportes')

@section('content')

<section class="space-y-6">

    <!-- Header -->
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="font-display text-3xl font-bold text-navy">
                Reportes
            </h2>

            <p class="mt-2 text-sm text-ink-600">
                Visualiza ingresos, pagos y servicios más solicitados dentro del sistema.
            </p>
        </div>
    </div>

    <!-- Cards resumen -->
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-4">

        <div class="rounded-panel border border-cream-200 bg-white p-6 shadow-card">
            <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                Ingresos totales
            </p>

            <p class="mt-3 font-display text-3xl font-bold text-success">
                ${{ number_format($totalIngresos, 2) }}
            </p>

            <p class="mt-2 text-sm text-ink-500">
                Pagos registrados como pagados.
            </p>
        </div>

        <div class="rounded-panel border border-cream-200 bg-white p-6 shadow-card">
            <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                Pagos realizados
            </p>

            <p class="mt-3 font-display text-3xl font-bold text-navy">
                {{ $totalPagos }}
            </p>

            <p class="mt-2 text-sm text-ink-500">
                Total de pagos en caja.
            </p>
        </div>

        <div class="rounded-panel border border-cream-200 bg-white p-6 shadow-card">
            <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                Citas completadas
            </p>

            <p class="mt-3 font-display text-3xl font-bold text-info">
                {{ $citasCompletadas }}
            </p>

            <p class="mt-2 text-sm text-ink-500">
                Citas finalizadas correctamente.
            </p>
        </div>

        <div class="rounded-panel border border-cream-200 bg-white p-6 shadow-card">
            <p class="text-xs font-bold uppercase tracking-wide text-ink-500">
                Citas pendientes
            </p>

            <p class="mt-3 font-display text-3xl font-bold text-warning">
                {{ $citasPendientes }}
            </p>

            <p class="mt-2 text-sm text-ink-500">
                Citas esperando confirmación.
            </p>
        </div>

    </div>

    <!-- Gráficas -->
    <div class="grid grid-cols-1 gap-6 xl:grid-cols-2">

        <!-- Ingresos por mes -->
        <div class="rounded-panel border border-cream-200 bg-white p-6 shadow-panel">
            <div class="mb-6">
                <h3 class="font-display text-2xl font-bold text-navy">
                    Ingresos por mes
                </h3>

                <p class="mt-1 text-sm text-ink-500">
                    Total de dinero generado por pagos completados.
                </p>
            </div>

            <div class="h-80">
                <canvas id="ingresosChart"></canvas>
            </div>
        </div>

        <!-- Servicios más solicitados -->
        <div class="rounded-panel border border-cream-200 bg-white p-6 shadow-panel">
            <div class="mb-6">
                <h3 class="font-display text-2xl font-bold text-navy">
                    Servicios más solicitados
                </h3>

                <p class="mt-1 text-sm text-ink-500">
                    Servicios con mayor cantidad de citas registradas.
                </p>
            </div>

            <div class="h-80">
                <canvas id="serviciosChart"></canvas>
            </div>
        </div>

    </div>

    <!-- Tabla resumen servicios -->
    <div class="overflow-hidden rounded-panel border border-cream-200 bg-white shadow-panel">

        <div class="border-b border-cream-200 px-6 py-5">
            <h3 class="font-display text-2xl font-bold text-navy">
                Ranking de servicios
            </h3>

            <p class="mt-1 text-sm text-ink-500">
                Lista de servicios ordenados por número de solicitudes.
            </p>
        </div>

        @if ($serviciosMasSolicitados->count() > 0)

            <div class="overflow-x-auto">

                <table class="min-w-full divide-y divide-cream-200">

                    <thead class="bg-cream-100">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wide text-ink-500">
                                Posición
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wide text-ink-500">
                                Servicio
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wide text-ink-500">
                                Solicitudes
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-cream-200 bg-white">

                        @foreach ($serviciosMasSolicitados as $index => $servicio)

                            <tr class="hover:bg-cream-50 transition-colors">

                                <td class="whitespace-nowrap px-6 py-4">
                                    <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-navy text-sm font-bold text-white">
                                        {{ $index + 1 }}
                                    </span>
                                </td>

                                <td class="px-6 py-4">
                                    <p class="font-semibold text-ink">
                                        {{ $servicio['servicio'] }}
                                    </p>

                                    @if ($index === 0)
                                        <p class="mt-1 text-xs font-semibold text-success">
                                            Servicio más solicitado
                                        </p>
                                    @endif
                                </td>

                                <td class="whitespace-nowrap px-6 py-4">
                                    <p class="font-display text-xl font-bold text-navy">
                                        {{ $servicio['total'] }}
                                    </p>
                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @else

            <div class="px-6 py-16 text-center">
                <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-info-light text-5xl">
                    📊
                </div>

                <h3 class="mt-6 font-display text-3xl font-bold text-navy">
                    No hay datos suficientes
                </h3>

                <p class="mx-auto mt-3 max-w-xl text-sm leading-6 text-ink-600">
                    Cuando existan citas con servicios asociados, aparecerá el ranking de servicios.
                </p>
            </div>

        @endif

    </div>

</section>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ingresosData = @json($ingresosPorMes);
    const serviciosData = @json($serviciosMasSolicitados);

    const ingresosCtx = document.getElementById('ingresosChart');

    if (ingresosCtx) {
        new Chart(ingresosCtx, {
            type: 'line',
            data: {
                labels: ingresosData.map(item => item.mes),
                datasets: [
                    {
                        label: 'Ingresos',
                        data: ingresosData.map(item => item.total),
                        tension: 0.35,
                        fill: true,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return '$' + Number(context.raw).toFixed(2);
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return '$' + value;
                            }
                        }
                    }
                }
            }
        });
    }

    const serviciosCtx = document.getElementById('serviciosChart');

    if (serviciosCtx) {
        new Chart(serviciosCtx, {
            type: 'bar',
            data: {
                labels: serviciosData.map(item => item.servicio),
                datasets: [
                    {
                        label: 'Solicitudes',
                        data: serviciosData.map(item => item.total),
                        borderRadius: 8,
                    }
                ]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0,
                        }
                    }
                }
            }
        });
    }
</script>

@endsection