<?php

namespace App\Http\Controllers\administrador;

use App\Http\Controllers\Controller;
use App\Models\Cita;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class CitaController extends Controller
{
    public function index(Request $request): View
    {
        $estado = $request->query('estado');

        $citas = Cita::with([
            'cliente.user',
            'barbero.user',
            'servicios',
            'pago'
        ])
            ->when($estado, function ($query) use ($estado) {
                $query->where('estado_cita', $estado);
            })
            ->orderByDesc('fecha_cita')
            ->orderByDesc('hora_inicio')
            ->get();

        return view('administrador.citas.index', compact('citas', 'estado'));
    }

    public function show(int $id): View
    {
        $cita = Cita::with([
            'cliente.user',
            'barbero.user',
            'servicios',
            'pago',
        ])
            ->findOrFail($id);

        return view('administrador.citas.show', compact('cita'));
    }

    public function updateStatus(Request $request, int $id): RedirectResponse
    {
        $validatedData = $request->validate([
            'estado_cita' => [
                'required',
                Rule::in(['pendiente', 'confirmada', 'completada', 'cancelada']),
            ],
        ], [
            'estado_cita.required' => 'Selecciona un estado para la cita.',
            'estado_cita.in' => 'El estado seleccionado no es válido.',
        ]);

        $cita = Cita::with('servicios')->findOrFail($id);

        if ($cita->estado_cita === 'cancelada' && $validatedData['estado_cita'] !== 'cancelada') {
            return back()->with('error', 'Una cita cancelada no puede cambiarse a otro estado.');
        }

        if ($cita->estado_cita === 'completada' && $validatedData['estado_cita'] !== 'completada') {
            return back()->with('error', 'Una cita completada no puede cambiarse a otro estado.');
        }

        $nuevoEstado = $validatedData['estado_cita'];

        $cita->forceFill([
            'estado_cita' => $nuevoEstado,
        ])->save();

        if ($nuevoEstado === 'completada') {
            foreach ($cita->servicios as $servicio) {
                $cita->servicios()->updateExistingPivot($servicio->id, [
                    'estado_servicio' => 'realizado',
                ]);
            }
        }

        if ($nuevoEstado === 'cancelada') {
            foreach ($cita->servicios as $servicio) {
                $cita->servicios()->updateExistingPivot($servicio->id, [
                    'estado_servicio' => 'cancelado',
                ]);
            }
        }

        if (in_array($nuevoEstado, ['pendiente', 'confirmada'])) {
            foreach ($cita->servicios as $servicio) {
                $cita->servicios()->updateExistingPivot($servicio->id, [
                    'estado_servicio' => 'pendiente',
                ]);
            }
        }

        return redirect()
            ->route('administrador.citas.show', $cita->id)
            ->with('status', 'El estado de la cita fue actualizado correctamente.');
    }
}
