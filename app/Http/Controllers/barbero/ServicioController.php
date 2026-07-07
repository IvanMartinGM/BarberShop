<?php

namespace App\Http\Controllers\barbero;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Servicio;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class ServicioController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $barbero = $user->barbero()
            ->with('servicios')
            ->first();

        if (!$barbero) {
            return redirect()
                ->route('barbero.dashboard')
                ->with('error', 'No tienes un perfil de barbero asociado.');
        }

        $servicios = Servicio::where('estado', 1)
            ->orderBy('categoria')
            ->orderBy('nombre_servicio')
            ->get();

        $serviciosAsignados = $barbero->servicios
            ->pluck('id')
            ->map(fn($id) => (int) $id)
            ->toArray();

        return view('barbero.servicios.index', compact(
            'user',
            'barbero',
            'servicios',
            'serviciosAsignados'
        ));
    }

    public function updateSelfServices(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'servicios' => ['nullable', 'array'],
            'servicios.*' => ['integer', 'exists:servicios,id'],
        ]);

        /** @var \App\Models\User $user */
        $user = auth()->user();

        $barbero = $user->barbero()->firstOrFail();

        $barbero->servicios()->sync($validatedData['servicios'] ?? []);

        return redirect()
            ->route('barbero.servicios.index')
            ->with('status', 'Tus servicios fueron actualizados correctamente.');
    }
}
