<?php

namespace App\Http\Controllers\administrador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DiaSemana;
use App\Models\Horario;
use Illuminate\Support\Facades\DB;

class HorarioController extends Controller
{
    public function create()
    {

        // Return the view for creating a new horario with the days of the week and the time slots available for each day
        $dias = DiaSemana::all();

        return view('administrador.horarios.create', compact('dias'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre_horario' => 'required|string|max:80',
            'descripcion' => 'nullable|string|max:255',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
            'dias' => 'required|array',
            'dias.*' => 'exists:dias_semana,id',
        ]);

        DB::transaction(function () use ($validatedData) {

            $newHorario = Horario::create([
                'nombre_horario' => $validatedData['nombre_horario'],
                'descripcion' => $validatedData['descripcion'],
                'hora_inicio' => $validatedData['hora_inicio'],
                'hora_fin' => $validatedData['hora_fin'],
                'estado' => 1,
            ]);

            // Attach the selected days of the week to the new horario
            $newHorario->diasSemana()->attach($validatedData['dias']);
        });

        return redirect()->route('dashboard')->with('success', 'Horario creado exitosamente.');
    }

    //This method will show the list of horarios in the system, with their details and the days of the week they are assigned to
    public function index()
    {
        $horarios = Horario::with('diasSemana')->get();
        return view('administrador.horarios.index', compact('horarios'));
    }

    //This method will show the details of a specific horario, including its assigned days of the week
    public function show(int $id)
    {
        $horario = Horario::with(['diasSemana', 'barberos.user'])->find($id);

        if (!$horario) {
            return redirect()
                ->route('horario.index')
                ->with('error', 'Horario no encontrado.');
        }

        return view('administrador.horarios.show', compact('horario'));
    }

    public function edit(int $id)
    {
        $horario = Horario::with('diasSemana')->find($id);
        $dias = DiaSemana::all();

        if (!$horario) {
            return redirect()
                ->route('horario.index')
                ->with('error', 'Horario no encontrado.');
        }

        return view('administrador.horarios.edit', compact('horario', 'dias'));
    }

    public function update(Request $request, int $id)
    {
        // Buscar el horario
        $horario = Horario::find($id);

        if (!$horario) {
            return redirect()
                ->route('horario.index')
                ->with('error', 'Horario no encontrado.');
        }

        // Validar datos
        $validatedData = $request->validate([
            'nombre_horario' => 'required|string|max:80',
            'descripcion' => 'nullable|string|max:255',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
            'estado' => 'required|boolean',
            'dias' => 'required|array|min:1',
            'dias.*' => 'exists:dias_semana,id',
        ]);

        DB::transaction(function () use ($validatedData, $horario) {
            // Actualizar datos principales del horario
            $horario->update([
                'nombre_horario' => $validatedData['nombre_horario'],
                'descripcion' => $validatedData['descripcion'] ?? null,
                'hora_inicio' => $validatedData['hora_inicio'],
                'hora_fin' => $validatedData['hora_fin'],
                'estado' => $validatedData['estado'],
            ]);

            // Actualizar días asignados al horario
            $horario->diasSemana()->sync($validatedData['dias']);
        });

        return redirect()
            ->route('horario.show', $horario->id)
            ->with('status', 'Horario actualizado exitosamente.');
    }


    // The next method will softdelete a specific horario 
    // changing its estado to 0 and detaching all its assigned days of the week
}
