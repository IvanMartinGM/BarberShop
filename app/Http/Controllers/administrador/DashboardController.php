<?php

namespace App\Http\Controllers\administrador;

use App\Models\Barbero;
use App\Http\Controllers\Controller;
use App\Models\Cita;
use App\Models\Cliente;
use App\Models\Pago;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $citasHoy = Cita::with([
            'cliente.user',
            'barbero.user',
            'servicios',
        ])
            ->whereDate('fecha_cita', today())
            ->orderBy('hora_inicio')
            ->get();

        $totalCitasHoy = $citasHoy->count();

        $totalClientes = Cliente::count();

        $totalBarberosActivos = Barbero::where('estado_disponibilidad', '!=', 'inactivo')
            ->count();

        $pagosPendientes = Pago::where('estado_pago', 'pendiente')
            ->count();

        $barberos = Barbero::with('user')
            ->orderBy('estado_disponibilidad')
            ->get();

        $ingresosHoy = Pago::where('estado_pago', 'pagado')
            ->whereDate('fecha_pago', today())
            ->sum('monto');

        return view('administrador.dashboard', compact(
            'citasHoy',
            'totalCitasHoy',
            'totalClientes',
            'totalBarberosActivos',
            'pagosPendientes',
            'barberos',
            'ingresosHoy'
        ));
    }
}
