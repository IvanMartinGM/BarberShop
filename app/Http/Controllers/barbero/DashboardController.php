<?php

namespace App\Http\Controllers\barbero;

use App\Http\Controllers\Controller;
use App\Models\Cita;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(): View
    {
        /** @var User $user */
        $user = auth()->user();

        $barbero = $user->barbero()->firstOrFail();

        $citasHoy = Cita::with(['cliente.user', 'servicios'])
            ->where('id_barbero', $barbero->id)
            ->whereDate('fecha_cita', today())
            ->orderBy('hora_inicio')
            ->get();

        $totalCitasHoy = $citasHoy->count();

        $citasPendientes = Cita::where('id_barbero', $barbero->id)
            ->where('estado_cita', 'pendiente')
            ->count();

        $citasConfirmadas = Cita::where('id_barbero', $barbero->id)
            ->where('estado_cita', 'confirmada')
            ->count();

        $citasCompletadas = Cita::where('id_barbero', $barbero->id)
            ->where('estado_cita', 'completada')
            ->count();

        $proximasCitas = Cita::with(['cliente.user', 'servicios'])
            ->where('id_barbero', $barbero->id)
            ->whereDate('fecha_cita', '>=', today())
            ->whereIn('estado_cita', ['pendiente', 'confirmada'])
            ->orderBy('fecha_cita')
            ->orderBy('hora_inicio')
            ->take(5)
            ->get();

        return view('barbero.dashboard', compact(
            'barbero',
            'citasHoy',
            'totalCitasHoy',
            'citasPendientes',
            'citasConfirmadas',
            'citasCompletadas',
            'proximasCitas'
        ));
    }
}