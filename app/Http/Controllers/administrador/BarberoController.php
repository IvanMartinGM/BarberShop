<?php

namespace App\Http\Controllers\administrador;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Barbero;
use App\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Http\RedirectResponse;


class BarberoController extends Controller
{
    public function create()
    {
        return view('administrador.barberos.create');
    }


    public function store(Request $request)
    {
        // Validate data from the request
        $validatedData = $request->validate([
            'nombres' => 'required|string|max:100',
            'primer_apellido' => 'required|string|max:60',
            'segundo_apellido' => 'nullable|string|max:60',
            'email' => 'required|email|max:150|unique:usuarios,email',
            'password' => 'required|string|min:8|max:255|confirmed',
            'nombre_usuario' => 'required|string|max:60|unique:usuarios,nombre_usuario',
            'genero' => 'required|in:M,F,otro',
            'celular' => 'required|string|max:20',

            'estado_disponibilidad' => 'required|in:disponible,ocupado,inactivo',
            'especialidad' => 'required|string|max:150',
            'biografia' => 'nullable|string',
            'fecha_contratacion' => 'required|date',
            'experiencia_anos' => 'required|integer|min:0',
        ]);


        //search for the role with the name 'barbero' to assign it to the new user
        $barberRole = Role::where('nombre', 'barbero')->first();

        if (!$barberRole) {
            return back()->withErrors([
                'role' => 'Error con el sistema. Por favor, contacte al administrador del sistema.',
            ])->onlyInput('email');
        }

        // Use a transaction to ensure that the user, barber profile and role are created successfully
        DB::transaction(function () use ($validatedData, $barberRole) {

            // Create a new user
            $newUser = User::create(
                [
                    'nombres' => $validatedData['nombres'],
                    'primer_apellido' => $validatedData['primer_apellido'],
                    'segundo_apellido' => $validatedData['segundo_apellido'],
                    'email' => $validatedData['email'],
                    'password' => $validatedData['password'],
                    'nombre_usuario' => $validatedData['nombre_usuario'],
                    'genero' => $validatedData['genero'],
                    'celular' => $validatedData['celular'],
                    'estado' => 1,
                    'fecha_registro' => now(),
                    'ultimo_acceso' => null,
                    'foto_perfil' => 'images/default_profile.jpg',
                ]
            );

            $newUser->barbero()->create([
                'estado_disponibilidad' => $validatedData['estado_disponibilidad'],
                'especialidad' => $validatedData['especialidad'],
                'biografia' => $validatedData['biografia'] ?? null,
                'fecha_contratacion' => $validatedData['fecha_contratacion'],
                'calificacion_promedio' => 0.00,
                'experiencia_anos' => $validatedData['experiencia_anos'],
            ]);


            //Attach the role to the new user with the current timestamp and estado = 1
            $newUser->roles()->attach($barberRole->id, [
                'estado' => 1,
                'fecha_asignacion' => now()
            ]);
        });

        return redirect()
            ->route('dashboard')
            ->with("status", "Barbero registrado exitosamente");
    }

    public function index()
    {
        $barberos = Barbero::with('user')->get();
        return view('administrador.barberos.index', compact('barberos'));
    }

    public function show(Request $request, $id)
    {
        //Search for the barbero with the given id and load the related user
        $barbero = Barbero::with('user')->find($id);

        if (!$barbero) {
            return redirect()->back()->with("error", "Barbero no encontrado");
        }

        return view('administrador.barberos.show', compact('barbero'));
    }


    public function edit(int $id)
    {
        //Search for the barbero with the given id and load the related user
        $barbero = Barbero::with('user')->find($id);

        if (!$barbero) {
            return redirect()
                ->route('barbero.index')
                ->with("error", "Barbero no encontrado");
        }

        if (!$barbero->user) {
            return redirect()
                ->route('barbero.index')
                ->with('error', 'El barbero no tiene un usuario asociado');
        }

        return view('administrador.barberos.edit', compact('barbero'));
    }

    public function update(Request $request, int $id)
    {
        //Search for the barbero with the given id and load the related user
        $barbero = Barbero::with('user')->find($id);

        if (!$barbero) {
            return back()->withErrors([
                'error' => 'Barbero no encontrado.'
            ])->onlyInput('email');
        }


        if (!$barbero->user) {
            return redirect()
                ->route('barbero.index')
                ->with('error', 'El barbero no tiene un usuario asociado');
        }

        $user = $barbero->user;


        // Validate data from the request
        $validatedData = $request->validate([
            'nombres' => 'required|string|max:100',
            'primer_apellido' => 'required|string|max:60',
            'segundo_apellido' => 'nullable|string|max:60',
            'email' => [
                'required',
                'email',
                'max:150',
                Rule::unique('usuarios', 'email')->ignore($user->id),
            ],
            'password' => 'nullable|string|min:8|max:255|confirmed',
            'nombre_usuario' => [
                'required',
                'string',
                'max:60',
                Rule::unique('usuarios', 'nombre_usuario')->ignore($user->id),
            ],
            'genero' => 'required|in:M,F,otro',
            'celular' => 'required|string|max:20',

            'estado_disponibilidad' => 'required|in:disponible,ocupado,inactivo',
            'especialidad' => 'required|string|max:150',
            'biografia' => 'nullable|string',
            'fecha_contratacion' => 'required|date',
            'experiencia_anos' => 'required|integer|min:0',
        ]);

        // Use a transaction to ensure that the user, barber profile and role are created successfully
        DB::transaction(function () use ($validatedData, $barbero, $user) {
            // Update a new user
            $userData =[
                    'nombres' => $validatedData['nombres'],
                    'primer_apellido' => $validatedData['primer_apellido'],
                    'segundo_apellido' => $validatedData['segundo_apellido'] ?? null ,
                    'email' => $validatedData['email'],
                    'nombre_usuario' => $validatedData['nombre_usuario'],
                    'genero' => $validatedData['genero'],
                    'celular' => $validatedData['celular'],
                    //'foto_perfil' => 'images/default_profile.jpg',
                ];

                if(!empty($validatedData['password'])) {
                    $userData['password'] = $validatedData['password'];
                } 

                // Update the user
                $user->update($userData);

                $barbero->update([
                    'estado_disponibilidad' => $validatedData['estado_disponibilidad'],
                    'especialidad' => $validatedData['especialidad'],
                    'biografia' => $validatedData['biografia'] ?? null,
                    'fecha_contratacion' => $validatedData['fecha_contratacion'],
                    'experiencia_anos' => $validatedData['experiencia_anos'],
                ]
            );
        });

        return redirect()
            ->route('barbero.show', $barbero->id)
            ->with("status", "Barbero actualizado exitosamente");
    }
}
