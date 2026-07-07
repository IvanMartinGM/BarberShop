<?php

namespace App\Http\Controllers\administrador;

use App\Http\Controllers\Controller;
use App\Models\Cita;
use App\Models\Pago;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ReporteController extends Controller
{
    public function index(): View
    {
        $fechaInicio = now()->subMonths(5)->startOfMonth();
        $fechaFin = now()->endOfMonth();

        $ingresosPorMesRaw = Pago::selectRaw('YEAR(fecha_pago) as year, MONTH(fecha_pago) as month, SUM(monto) as total')
            ->where('estado_pago', 'pagado')
            ->whereBetween('fecha_pago', [$fechaInicio, $fechaFin])
            ->groupByRaw('YEAR(fecha_pago), MONTH(fecha_pago)')
            ->orderByRaw('YEAR(fecha_pago), MONTH(fecha_pago)')
            ->get();

        $ingresosPorMes = collect();

        for ($date = $fechaInicio->copy(); $date <= $fechaFin; $date->addMonth()) {
            $registro = $ingresosPorMesRaw->first(function ($item) use ($date) {
                return (int) $item->year === (int) $date->year
                    && (int) $item->month === (int) $date->month;
            });

            $ingresosPorMes->push([
                'mes' => ucfirst($date->translatedFormat('M Y')),
                'total' => $registro ? (float) $registro->total : 0,
            ]);
        }

        $serviciosMasSolicitados = DB::table('citas_servicios')
            ->join('servicios', 'servicios.id', '=', 'citas_servicios.id_servicio')
            ->select(
                'servicios.nombre_servicio',
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('servicios.id', 'servicios.nombre_servicio')
            ->orderByDesc('total')
            ->limit(8)
            ->get()
            ->map(function ($servicio) {
                return [
                    'servicio' => $servicio->nombre_servicio,
                    'total' => (int) $servicio->total,
                ];
            });

        $totalIngresos = Pago::where('estado_pago', 'pagado')
            ->sum('monto');

        $totalPagos = Pago::where('estado_pago', 'pagado')
            ->count();

        $citasCompletadas = Cita::where('estado_cita', 'completada')
            ->count();

        $citasPendientes = Cita::where('estado_cita', 'pendiente')
            ->count();

        $servicioMasSolicitado = $serviciosMasSolicitados->first();

        return view('administrador.reportes.index', compact(
            'ingresosPorMes',
            'serviciosMasSolicitados',
            'totalIngresos',
            'totalPagos',
            'citasCompletadas',
            'citasPendientes',
            'servicioMasSolicitado'
        ));
    }
}