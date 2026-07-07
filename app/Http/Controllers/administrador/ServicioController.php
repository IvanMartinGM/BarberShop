<?php

namespace App\Http\Controllers\administrador;

use App\Http\Controllers\Controller;
use App\Models\Servicio;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ServicioController extends Controller
{

    public function create()
    {
        return view('administrador.servicios.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'nombre_servicio' => [
                'required',
                'string',
                'max:100',
                Rule::unique('servicios', 'nombre_servicio'),
            ],
            'descripcion' => 'nullable|string|max:1000',
            'precio_base' => 'required|numeric|min:0|max:999999.99',
            'duracion_minutos' => 'required|integer|min:1|max:600',
            'categoria' => 'nullable|string|max:60',
            'imagen_servicio' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $serviceImagePath = null;

        if ($request->hasFile('imagen_servicio')) {
            $serviceImagePath = $request->file('imagen_servicio')->store('service_images', 'public');
        }
        Servicio::create([
            'nombre_servicio' => $validatedData['nombre_servicio'],
            'descripcion' => $validatedData['descripcion'] ?? null,
            'precio_base' => $validatedData['precio_base'],
            'duracion_minutos' => $validatedData['duracion_minutos'],
            'categoria' => $validatedData['categoria'] ?? null,
            'imagen_servicio' => $serviceImagePath,
            'estado' => 1,
        ]);

        return redirect()
            ->route('servicio.index')
            ->with('status', 'Servicio creado correctamente.');
    }

    public function show(int $id)
    {
        $servicio = Servicio::with('barberos.user')->find($id);

        if (!$servicio) {
            return redirect()
                ->route('servicio.index')
                ->with('error', 'Servicio no encontrado.');
        }

        return view('administrador.servicios.show', compact('servicio'));
    }

    public function edit(int $id)
    {
        $servicio = Servicio::find($id);

        if (!$servicio) {
            return redirect()
                ->route('servicio.index')
                ->with('error', 'Servicio no encontrado.');
        }

        return view('administrador.servicios.edit', compact('servicio'));
    }


    public function index()
    {
        $servicios = Servicio::orderBy('nombre_servicio')->get();

        return view('administrador.servicios.index', compact('servicios'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $servicio = Servicio::find($id);

        if (!$servicio) {
            return redirect()
                ->route('servicio.index')
                ->with('error', 'Servicio no encontrado.');
        }

        $validatedData = $request->validate([
            'nombre_servicio' => [
                'required',
                'string',
                'max:100',
                Rule::unique('servicios', 'nombre_servicio')->ignore($servicio->id),
            ],
            'descripcion' => 'nullable|string|max:1000',
            'precio_base' => 'required|numeric|min:0|max:999999.99',
            'duracion_minutos' => 'required|integer|min:1|max:600',
            'categoria' => 'nullable|string|max:60',
            'imagen_servicio' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'estado' => 'required|boolean',
        ]);

        $serviceData = [
            'nombre_servicio' => $validatedData['nombre_servicio'],
            'descripcion' => $validatedData['descripcion'] ?? null,
            'precio_base' => $validatedData['precio_base'],
            'duracion_minutos' => $validatedData['duracion_minutos'],
            'categoria' => $validatedData['categoria'] ?? null,
            'estado' => $validatedData['estado'],
        ];

        if ($request->hasFile('imagen_servicio')) {
            if (
                $servicio->imagen_servicio &&
                str_starts_with($servicio->imagen_servicio, 'service_images/') &&
                Storage::disk('public')->exists($servicio->imagen_servicio)
            ) {
                Storage::disk('public')->delete($servicio->imagen_servicio);
            }

            $serviceData['imagen_servicio'] = $request->file('imagen_servicio')->store('service_images', 'public');
        }

        $servicio->update($serviceData);

        return redirect()
            ->route('servicio.show', $servicio->id)
            ->with('status', 'Servicio actualizado correctamente.');
    }
    public function destroy(int $id): RedirectResponse
    {
        $servicio = Servicio::find($id);

        if (!$servicio) {
            return redirect()
                ->route('servicio.index')
                ->with('error', 'Servicio no encontrado.');
        }

        if ($servicio->estado == 0) {
            return redirect()
                ->route('servicio.index')
                ->with('error', 'El servicio ya está inactivo.');
        }

        $servicio->forceFill([
            'estado' => 0,
        ])->save();

        return redirect()
            ->route('servicio.index')
            ->with('status', 'Servicio desactivado correctamente.');
    }
}
