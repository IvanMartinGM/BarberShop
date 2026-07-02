<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function show()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($user->hasRole('administrador')) {
            return view('profile.administrador.show', compact('user'));
        }

        if ($user->hasRole('barbero')) {
            return view('profile.barbero.show', compact('user'));
        }

        if ($user->hasRole('cliente')) {
            return view('profile.cliente.show', compact('user'));
        }

        abort(403, 'No tienes un rol válido asignado.');
    }

    public function edit()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($user->hasRole('administrador')) {
            return view('profile.administrador.edit', compact('user'));
        }

        if ($user->hasRole('barbero')) {
            return view('profile.barbero.edit', compact('user'));
        }

        if ($user->hasRole('cliente')) {
            return view('profile.cliente.edit', compact('user'));
        }

        abort(403, 'No tienes un rol válido asignado.');
    }

    public function update(Request $request): RedirectResponse
    {
        /** @var \App\Models\User $user */
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
            'foto_perfil' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
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

        if ($request->hasFile('foto_perfil')) {
            $userData['foto_perfil'] = $request->file('foto_perfil')
                ->store('profile/users', 'public');
        }

        if (!empty($validatedData['password'])) {
            $userData['password'] = Hash::make($validatedData['password']);
        }

        $user->forceFill($userData)->save();

        return redirect()
            ->route('profile.show')
            ->with('status', 'Perfil actualizado correctamente.');
    }
}