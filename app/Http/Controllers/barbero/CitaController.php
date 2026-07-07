<?php

namespace App\Http\Controllers\barbero;

use App\Http\Controllers\Controller;
use App\Models\Cita;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CitaController extends Controller
{
    public function index(Request $request): View
    {
        /** @var User $user */
        $user = auth()->user();

        $barbero = $user->barbero()->firstOrFail();

        $estado = $request->query('estado');

        $citas = Cita::with(['cliente.user', 'servicios'])
            ->where('id_barbero', $barbero->id)
            ->when($estado, function ($query) use ($estado) {
                $query->where('estado_cita', $estado);
            })
            ->orderByDesc('fecha_cita')
            ->orderByDesc('hora_inicio')
            ->get();

        return view('barbero.citas.index', compact('barbero', 'citas', 'estado'));
    }

    public function show(int $id): View
    {
        /** @var User $user */
        $user = auth()->user();

        $barbero = $user->barbero()->firstOrFail();

        $cita = Cita::with(['cliente.user', 'servicios', 'pago.metodoPago'])
            ->where('id_barbero', $barbero->id)
            ->findOrFail($id);

        return view('barbero.citas.show', compact('barbero', 'cita'));
    }
}