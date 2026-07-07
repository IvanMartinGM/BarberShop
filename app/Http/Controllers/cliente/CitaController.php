<?php

namespace App\Http\Controllers\cliente;

use App\Http\Controllers\Controller;
use App\Models\Barbero;
use App\Models\Cita;
use App\Models\Servicio;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CitaController extends Controller
{
    public function index(): View
    {
        /** @var User $user */
        $user = auth()->user();

        $cliente = $user->cliente()->firstOrFail();

        $citas = Cita::with(['barbero.user', 'servicios'])
            ->where('id_cliente', $cliente->id)
            ->orderByDesc('fecha_cita')
            ->orderByDesc('hora_inicio')
            ->get();

        return view('cliente.citas.index', compact('cliente', 'citas'));
    }

    public function create(): View
    {
        $servicios = Servicio::where('estado', 1)
            ->orderBy('nombre_servicio')
            ->get();

        return view('cliente.citas.create', compact('servicios'));
    }

    public function barberosPorServicio(Servicio $servicio): JsonResponse
    {
        if ((int) $servicio->estado !== 1) {
            return response()->json([
                'barberos' => [],
            ]);
        }

        $barberos = Barbero::with('user')
            ->where('estado_disponibilidad', '!=', 'inactivo')
            ->whereHas('user', function ($query) {
                $query->where('estado', 1);
            })
            ->whereHas('servicios', function ($query) use ($servicio) {
                $query->where('servicios.id', $servicio->id)
                    ->where('barberos_servicios.estado', 1);
            })
            ->get()
            ->map(function (Barbero $barbero) {
                return [
                    'id' => $barbero->id,
                    'nombre' => $barbero->user?->getFullName() ?? 'Barbero sin nombre',
                    'especialidad' => $barbero->especialidad,
                    'experiencia_anos' => $barbero->experiencia_anos,
                    'estado_disponibilidad' => $barbero->estado_disponibilidad,
                ];
            })
            ->values();

        return response()->json([
            'barberos' => $barberos,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'id_servicio' => ['required', 'integer', 'exists:servicios,id'],
            'id_barbero' => ['required', 'integer', 'exists:barberos,id'],
            'fecha_cita' => ['required', 'date', 'after_or_equal:today'],
            'hora_inicio' => ['required', 'date_format:H:i'],
            'observaciones' => ['nullable', 'string', 'max:500'],
        ], [
            'id_servicio.required' => 'Selecciona un servicio.',
            'id_servicio.exists' => 'El servicio seleccionado no existe.',
            'id_barbero.required' => 'Selecciona un barbero.',
            'id_barbero.exists' => 'El barbero seleccionado no existe.',
            'fecha_cita.required' => 'Selecciona la fecha de la cita.',
            'fecha_cita.after_or_equal' => 'La fecha de la cita no puede ser anterior a hoy.',
            'hora_inicio.required' => 'Selecciona la hora de inicio.',
            'hora_inicio.date_format' => 'La hora debe tener un formato válido.',
            'observaciones.max' => 'Las observaciones no deben superar los 500 caracteres.',
        ]);

        /** @var User $user */
        $user = auth()->user();

        $cliente = $user->cliente()->firstOrFail();

        $servicio = Servicio::where('estado', 1)
            ->findOrFail($validatedData['id_servicio']);

        $barbero = Barbero::with('user')
            ->where('estado_disponibilidad', '!=', 'inactivo')
            ->findOrFail($validatedData['id_barbero']);

        $barberoOfreceServicio = $barbero->servicios()
            ->where('servicios.id', $servicio->id)
            ->wherePivot('estado', 1)
            ->exists();

        if (!$barberoOfreceServicio) {
            return back()
                ->withInput()
                ->with('error', 'El barbero seleccionado no ofrece este servicio.');
        }

        $duracionMinutos = (int) ($servicio->duracion_minutos ?? 30);

        if ($duracionMinutos <= 0) {
            $duracionMinutos = 30;
        }

        $horaInicio = Carbon::createFromFormat('H:i', $validatedData['hora_inicio']);
        $horaFin = $horaInicio->copy()->addMinutes($duracionMinutos);

        $horaInicioFormato = $horaInicio->format('H:i');
        $horaFinFormato = $horaFin->format('H:i');

        $citaEmpalmada = Cita::where('id_barbero', $barbero->id)
            ->where('fecha_cita', $validatedData['fecha_cita'])
            ->whereIn('estado_cita', ['pendiente', 'confirmada'])
            ->where(function ($query) use ($horaInicioFormato, $horaFinFormato) {
                $query->where('hora_inicio', '<', $horaFinFormato)
                    ->where('hora_fin', '>', $horaInicioFormato);
            })
            ->exists();

        if ($citaEmpalmada) {
            return back()
                ->withInput()
                ->with('error', 'Ese horario ya está ocupado para el barbero seleccionado.');
        }

        $precioAplicado = $servicio->precio_base
            ?? $servicio->precio
            ?? 0;

        DB::transaction(function () use (
            $cliente,
            $barbero,
            $servicio,
            $validatedData,
            $horaInicioFormato,
            $horaFinFormato,
            $duracionMinutos,
            $precioAplicado
        ) {
            $cita = Cita::create([
                'id_cliente' => $cliente->id,
                'id_barbero' => $barbero->id,
                'fecha_cita' => $validatedData['fecha_cita'],
                'hora_inicio' => $horaInicioFormato,
                'hora_fin' => $horaFinFormato,
                'estado_cita' => 'pendiente',
                'observaciones' => $validatedData['observaciones'] ?? null,
            ]);
            $cita->servicios()->attach($servicio->id, [
                'precio_aplicado' => $precioAplicado,
                'estado_servicio' => 'pendiente',
                'observaciones_servicio' => null,
            ]);
        });

        return redirect()
            ->route('cliente.citas.index')
            ->with('status', 'Tu cita fue agendada correctamente. Estado: pendiente.');
    }

    public function show(int $id): View
    {
        /** @var User $user */
        $user = auth()->user();

        $cliente = $user->cliente()->firstOrFail();

        $cita = Cita::with(['barbero.user', 'servicios'])
            ->where('id_cliente', $cliente->id)
            ->findOrFail($id);

        return view('cliente.citas.show', compact('cliente', 'cita'));
    }

    public function cancel(int $id): RedirectResponse
    {
        /** @var User $user */
        $user = auth()->user();

        $cliente = $user->cliente()->firstOrFail();

        $cita = Cita::where('id_cliente', $cliente->id)
            ->findOrFail($id);

        if (in_array($cita->estado_cita, ['completada', 'cancelada'])) {
            return back()
                ->with('error', 'Esta cita ya no puede cancelarse.');
        }

        $cita->forceFill([
            'estado_cita' => 'cancelada',
        ])->save();

        return redirect()
            ->route('cliente.citas.index')
            ->with('status', 'Tu cita fue cancelada correctamente.');
    }
}
