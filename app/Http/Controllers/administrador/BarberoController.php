<?php

namespace App\Http\Controllers\administrador;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Barbero;
use App\Models\Servicio;
use App\Models\Role;
use App\Models\Horario;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;



class BarberoController extends Controller
{
    private const DEFAULT_PROFILE_PHOTO = 'images/default-avatar.svg';
    private const PROFILE_PHOTO_BASE_DIRECTORY = 'profile/users';


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
            'foto_perfil' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',

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
        $newBarbero =  DB::transaction(function () use ($validatedData, $barberRole, $request) {

            // Create a new user
            $newUser = User::create(
                [
                    'nombres' => $validatedData['nombres'],
                    'primer_apellido' => $validatedData['primer_apellido'],
                    'segundo_apellido' => $validatedData['segundo_apellido'] ?? null,
                    'email' => $validatedData['email'],
                    'password' => $validatedData['password'],
                    'nombre_usuario' => $validatedData['nombre_usuario'],
                    'genero' => $validatedData['genero'],
                    'celular' => $validatedData['celular'],
                    'estado' => 1,
                    'fecha_registro' => now(),
                    'ultimo_acceso' => null,
                    'foto_perfil' => self::DEFAULT_PROFILE_PHOTO,
                ]
            );

            if ($request->hasFile('foto_perfil')) {
                $profilePhotoPath = $request->file('foto_perfil')
                    ->store(self::PROFILE_PHOTO_BASE_DIRECTORY . '/' . $newUser->id, 'public');

                $newUser->forceFill([
                    'foto_perfil' => $profilePhotoPath,
                ])->save();
            }

            $newBarbero = $newUser->barbero()->create([
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

            // Return the new user to the outer scope
            return $newBarbero;
        });

        return redirect()
            ->route('barbero.show', ['id' => $newBarbero->id])
            ->with("status", "Barbero registrado exitosamente");
    }

    public function index()
    {
        $barberos = Barbero::with('user')->get();
        return view('administrador.barberos.index', compact('barberos'));
    }

    public function show(int $id)
    {
        $barbero = Barbero::with([
            'user',
            'horarios.diasSemana',
        ])->find($id);

        if (!$barbero) {
            return redirect()
                ->route('barbero.index')
                ->with('error', 'Barbero no encontrado.');
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
            'foto_perfil' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',

            'estado_disponibilidad' => 'required|in:disponible,ocupado,inactivo',
            'especialidad' => 'required|string|max:150',
            'biografia' => 'nullable|string',
            'fecha_contratacion' => 'required|date',
            'experiencia_anos' => 'required|integer|min:0',
        ]);

        // Use a transaction to ensure that the user, barber profile and role are created successfully
        DB::transaction(function () use ($request, $validatedData, $barbero, $user) {
            // Update a new user
            $userData = [
                'nombres' => $validatedData['nombres'],
                'primer_apellido' => $validatedData['primer_apellido'],
                'segundo_apellido' => $validatedData['segundo_apellido'] ?? null,
                'email' => $validatedData['email'],
                'nombre_usuario' => $validatedData['nombre_usuario'],
                'genero' => $validatedData['genero'],
                'celular' => $validatedData['celular'],

            ];

            if (!empty($validatedData['password'])) {
                $userData['password'] = $validatedData['password'];
            }

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

            // Update the user
            $user->update($userData);

            $barbero->update(
                [
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

    public function destroy(int $id): RedirectResponse
    {
        $barbero = Barbero::with(['user.roles'])->find($id);

        if (!$barbero) {
            return redirect()
                ->route('barbero.index')
                ->with('error', 'Barbero no encontrado.');
        }

        if (!$barbero->user) {
            return redirect()
                ->route('barbero.index')
                ->with('error', 'El barbero no tiene un usuario asociado.');
        }

        if ($barbero->estado_disponibilidad === 'inactivo' && $barbero->user->estado == 0) {
            return redirect()
                ->route('barbero.index')
                ->with('error', 'El barbero ya está inactivo.');
        }

        $barberRole = Role::where('nombre', 'barbero')->first();

        if (!$barberRole) {
            return redirect()
                ->route('barbero.index')
                ->with('error', 'No se encontró el rol de barbero en el sistema.');
        }

        DB::transaction(function () use ($barbero, $barberRole) {
            $user = $barbero->user;

            // Desactivar el perfil laboral del barbero
            $barbero->forceFill([
                'estado_disponibilidad' => 'inactivo',
            ])->save();

            // Desactivar el usuario en la tabla usuarios
            $barbero->user->forceFill([
                'estado' => 0,
                'fecha_baja' => now(),
            ])->save();

            // Desactivar el rol de barbero en la tabla pivote
            $user->roles()->updateExistingPivot($barberRole->id, [
                'estado' => 0,
            ]);


            // Verificar si el usuario tiene otros roles activos, por ejemplo administrador
            $hasOtherActiveRoles = $user->roles()
                ->where('roles.id', '!=', $barberRole->id)
                ->wherePivot('estado', 1)
                ->exists();

            // Si no tiene otros roles activos, se desactiva el usuario completo
            if (!$hasOtherActiveRoles) {
                $user->forceFill([
                    'estado' => 0,
                ])->save();
            }
        });

        return redirect()
            ->route('barbero.index')
            ->with('status', 'Barbero desactivado correctamente.');
    }

    public function editHorarios(int $id)
    {
        $barbero = Barbero::with(['user', 'horarios.diasSemana'])->find($id);

        if (!$barbero) {
            return redirect()
                ->route('barbero.index')
                ->with('error', 'Barbero no encontrado.');
        }

        if (!$barbero->user) {
            return redirect()
                ->route('barbero.index')
                ->with('error', 'El barbero no tiene un usuario asociado.');
        }

        $horarios = Horario::with('diasSemana')
            ->where('estado', 1)
            ->get();

        return view('administrador.barberos.horarios', compact('barbero', 'horarios'));
    }


    public function updateHorarios(Request $request, int $id): RedirectResponse
    {
        $barbero = Barbero::with('horarios')->find($id);

        if (!$barbero) {
            return redirect()
                ->route('barbero.index')
                ->with('error', 'Barbero no encontrado.');
        }

        $validatedData = $request->validate([
            'horarios' => 'nullable|array',
            'horarios.*' => 'exists:horarios,id',
        ]);

        $horariosSeleccionados = $validatedData['horarios'] ?? [];

        DB::transaction(function () use ($barbero, $horariosSeleccionados) {
            $syncData = [];

            foreach ($horariosSeleccionados as $idHorario) {
                $syncData[$idHorario] = [
                    'fecha_asignacion' => now(),
                    'estado' => 1,
                ];
            }

            $barbero->horarios()->sync($syncData);
        });

        return redirect()
            ->route('barbero.show', $barbero->id)
            ->with('status', 'Horarios asignados correctamente.');
    }


    public function editServicios(int $id)
    {
        $barbero = Barbero::with(['user', 'servicios'])->find($id);

        if (!$barbero) {
            return redirect()
                ->route('barbero.index')
                ->with('error', 'Barbero no encontrado.');
        }

        if (!$barbero->user) {
            return redirect()
                ->route('barbero.index')
                ->with('error', 'El barbero no tiene un usuario asociado.');
        }

        $servicios = Servicio::where('estado', 1)
            ->orderBy('categoria')
            ->orderBy('nombre_servicio')
            ->get();

        return view('administrador.barberos.servicios', compact('barbero', 'servicios'));
    }

    public function updateServicios(Request $request, int $id)
    {
        $barbero = Barbero::with('user')->find($id);

        if (!$barbero) {
            return redirect()
                ->route('barbero.index')
                ->with('error', 'Barbero no encontrado.');
        }

        if (!$barbero->user) {
            return redirect()
                ->route('barbero.index')
                ->with('error', 'El barbero no tiene un usuario asociado.');
        }

        $validatedData = $request->validate([
            'servicios' => 'nullable|array',
            'servicios.*' => 'exists:servicios,id',
        ]);

        $servicios = $validatedData['servicios'] ?? [];

        $barbero->servicios()->syncWithPivotValues($servicios, [
            'estado' => 1,
        ]);

        return redirect()
            ->route('barbero.show', $barbero->id)
            ->with('status', 'Servicios del barbero actualizados correctamente.');
    }


    public function pdf()
    {
        $barberos = Barbero::with('user')
            ->orderBy('id')
            ->get();

        $fechaGeneracion = now()->format('d/m/Y H:i:s');

        $pdf = Pdf::loadView('administrador.barberos.pdf', compact('barberos', 'fechaGeneracion'))
            ->setPaper('a4', 'landscape');

        return $pdf->stream('reporte-barberos.pdf');
    }
}
