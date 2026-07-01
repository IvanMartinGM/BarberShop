<?php

namespace App\Http\Controllers\administrador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cliente;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use App\Models\Role;

class ClienteController extends Controller
{
    public function create()
    {
        return view('administrador.clientes.create');
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

        return redirect()->route('cliente.index')->with("status", "Registro exitoso");
    }

    public function index()
    {
        $clientes = Cliente::with('user')->get();
        return view('administrador.clientes.index', compact('clientes'));
    }

    public function show(Request $request, int $id)
    {
        //Search for the cliente with the given id and load the related user
        $cliente = Cliente::with('user')->find($id);

        if (!$cliente) {
            return redirect()->back()->with("error", "Cliente no encontrado");
        }

        return view('administrador.clientes.show', compact('cliente'));
    }

    public function edit(int $id)
    {
        //Search for the cliente with the given id and load the related user
        $cliente = Cliente::with('user')->find($id);

        if (!$cliente) {
            return redirect()
                ->route('cliente.index')
                ->with("error", "Cliente no encontrado");
        }

        if (!$cliente->user) {
            return redirect()
                ->route('cliente.index')
                ->with('error', 'El cliente no tiene un usuario asociado');
        }

        return view('administrador.clientes.edit', compact('cliente'));
    }


    public function update(Request $request, int $id)
    {
        $cliente = Cliente::with('user')->find($id);


        if (!$cliente) {
            return back()->withErrors([
                'error' => 'Cliente no encontrado.'
            ])->onlyInput('email');
        }


        if (!$cliente->user) {
            return redirect()
                ->route('cliente.index')
                ->with('error', 'El cliente no tiene un usuario asociado');
        }


        $user = $cliente->user;

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
            'estado' => 'required|boolean',
        ]);



        DB::transaction(function () use ($validatedData, $user, $cliente) {
            // Update the user data
            $userData = [
                'nombres' => $validatedData['nombres'],
                'primer_apellido' => $validatedData['primer_apellido'],
                'segundo_apellido' => $validatedData['segundo_apellido'] ?? null,
                'email' => $validatedData['email'],
                'nombre_usuario' => $validatedData['nombre_usuario'],
                'genero' => $validatedData['genero'],
                'celular' => $validatedData['celular'],
                'estado' => $validatedData['estado'],
            ];

            if (!empty($validatedData['password'])) {
                $userData['password'] = $validatedData['password'];
            }

            $user->update($userData);
        });

        return redirect()
            ->route('cliente.show', $cliente->id)
            ->with("status", "Cliente actualizado exitosamente");
    }


    public function destroy(int $id): RedirectResponse
    {
        $cliente = Cliente::with('user')->find($id);

        if (!$cliente) {
            return redirect()
                ->route('cliente.index')
                ->with('error', 'Cliente no encontrado.');
        }

        if (!$cliente->user) {
            return redirect()
                ->route('cliente.index')
                ->with('error', 'El cliente no tiene un usuario asociado.');
        }

        if ($cliente->user->estado == 0) {
            return redirect()
                ->route('cliente.index')
                ->with('error', 'El cliente ya está inactivo.');
        }

        $cliente->user->forceFill([
            'estado' => 0,
        ])->save();

        return redirect()
            ->route('cliente.index')
            ->with('status', 'Cliente eliminado correctamente.');
    }
}
