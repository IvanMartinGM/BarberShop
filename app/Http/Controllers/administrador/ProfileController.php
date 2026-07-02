<?php

namespace App\Http\Controllers\administrador;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function edit()
    {
       // Usuario autenticado 
        $user = Auth::user();

        return view('administrador.profile.edit', compact('user'));
    }

    public function update(Request $request): RedirectResponse
    {
        /** Usuario autenticado */
        $user = Auth::user();

        $validatedData = $request->validate([
            'nombres' => 'required|string|max:100',
            'primer_apellido' => 'required|string|max:100',
            'segundo_apellido' => 'nullable|string|max:100',

            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('usuarios', 'email')->ignore($user->id),
            ],

            'nombre_usuario' => [
                'required',
                'string',
                'max:100',
                Rule::unique('usuarios', 'nombre_usuario')->ignore($user->id),
            ],

            'genero' => 'nullable|in:M,F,otro',
            'celular' => 'nullable|string|max:20',

            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $userData = [
            'nombres' => $validatedData['nombres'],
            'primer_apellido' => $validatedData['primer_apellido'],
            'segundo_apellido' => $validatedData['segundo_apellido'] ?? null,
            'email' => $validatedData['email'],
            'nombre_usuario' => $validatedData['nombre_usuario'],
            'genero' => $validatedData['genero'] ?? null,
            'celular' => $validatedData['celular'] ?? null,
        ];

        if (!empty($validatedData['password'])) {
            $userData['password'] = Hash::make($validatedData['password']);
        }

        $user->forceFill($userData)->save();

        return redirect()
            ->route('profile.edit')
            ->with('status', 'Perfil actualizado correctamente.');
    }
}

