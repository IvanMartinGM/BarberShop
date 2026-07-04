<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileController extends Controller
{

    private const DEFAULT_PROFILE_PHOTO = 'images/default-avatar.svg';
    private const PROFILE_PHOTO_BASE_DIRECTORY = 'profile/users';
    public function show()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($user->hasRole('administrador')) {
            return view('administrador.profile.show', compact('user'));
        }

        if ($user->hasRole('barbero')) {
            return view('barbero.profile.show', compact('user'));
        }

        if ($user->hasRole('cliente')) {
            return view('cliente.profile.show', compact('user'));
        }

        abort(403, 'No tienes un rol válido asignado.');
    }

    public function edit()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($user->hasRole('administrador')) {
            return view('administrador.profile.edit', compact('user'));
        }

        if ($user->hasRole('barbero')) {
            return view('barbero.profile.edit', compact('user'));
        }

        if ($user->hasRole('cliente')) {
            return view('cliente.profile.edit', compact('user'));
        }

        abort(403, 'No tienes un rol válido asignado.');
    }

    public function update(Request $request): RedirectResponse
    {
       /** @var User $user */
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
            $fotoAnterior = $user->foto_perfil;

            if (
                $fotoAnterior &&
                !str_starts_with($fotoAnterior, 'images/') &&
                !str_starts_with($fotoAnterior, 'http://') &&
                !str_starts_with($fotoAnterior, 'https://') &&
                Storage::disk('public')->exists($fotoAnterior)
            ) {
                Storage::disk('public')->delete($fotoAnterior);
            }

            $userData['foto_perfil'] = $request->file('foto_perfil')
                ->store(self::PROFILE_PHOTO_BASE_DIRECTORY . '/' . $user->id, 'public');
        }

        if (!empty($validatedData['password'])) {
            $userData['password'] = $validatedData['password'];
        }

        $user->update($userData);

        return redirect()
            ->route('profile.show')
            ->with('status', 'Perfil actualizado correctamente.');
    }
}
