<?php

namespace App\Http\Controllers\barbero;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HorarioController extends Controller
{
     public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $barbero = $user->barbero()
            ->with(['horarios.diasSemana'])
            ->first();

        if (!$barbero) {
            return redirect()
                ->route('barbero.dashboard')
                ->with('error', 'No tienes un perfil de barbero asociado.');
        }

        $horarios = $barbero->horarios
            ->sortBy('hora_inicio')
            ->values();

        return view('barbero.horarios.index', compact('user', 'barbero', 'horarios'));
    }
}
