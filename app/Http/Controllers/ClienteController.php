<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Role;

class ClienteController extends Controller
{
    public function create()
    {
        return view('register');
    }


    public function store(Request $request): RedirectResponse
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
            'fecha_nacimiento' => 'required|date',
            'celular' => 'required|string|max:20',

        ]);


        //search for the role with the name 'cliente' to assign it to the new user
        $clienterol = Role::where('nombre', 'cliente')->first();


        //Validates if the role exists, if not return an error message
        if (!$clienterol) {
            return back()->withErrors([
                'role' => 'Error con el sistema. Por favor, contacte al administrador del sistema.',
            ])->onlyInput('email');
        }

        //Use a transaction to ensure that both the user and the cliente are created successfully
        DB::transaction(function () use ($validatedData, $clienterol) {

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

            $newUser->cliente()->create([
                'fecha_nacimiento' => $validatedData['fecha_nacimiento'],
                'ultima_visita' => null,
                'tipo_cliente' => null,
                'puntos_fidelidad' => 0,
                'acepta_notificaciones' => 1,
                'notas_generales' => null,
                'total_visitas' => 0,
                'total_gastado' => 0.00,
            ]);


            //Attach the role to the new user with the current timestamp and estado = 1
            $newUser->roles()->attach($clienterol->id, [
                'estado' => 1,
                'fecha_asignacion' => now()
            ]);
        });

        return redirect()->route('login')->with("status", "Registro exitoso");
    }
}
