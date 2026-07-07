<?php

namespace App\Http\Controllers\administrador;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    public function create()
    {
        $images = Asset::where('tipo', 'image')->latest()->take(6)->get();
        $videos = Asset::where('tipo', 'video')->latest()->take(6)->get();

        return view('administrador.asset.create', compact('images', 'videos'));
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'titulo' => ['nullable', 'string', 'max:150'],
            'tipo' => ['required', 'in:image,video'],
            'archivo' => ['required', 'file'],
        ], [
            'titulo.string' => 'El título debe ser texto.',
            'titulo.max' => 'El título no debe superar los 150 caracteres.',

            'tipo.required' => 'Debes seleccionar si el archivo es una imagen o un video.',
            'tipo.in' => 'El tipo de archivo seleccionado no es válido.',

            'archivo.required' => 'Debes seleccionar un archivo para subir.',
            'archivo.file' => 'El archivo seleccionado no es válido.',
        ]);

        if ($validatedData['tipo'] === 'image') {
            $request->validate([
                'archivo' => ['image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            ], [
                'archivo.image' => 'El archivo debe ser una imagen válida.',
                'archivo.mimes' => 'La imagen debe estar en formato JPG, JPEG, PNG o WEBP.',
                'archivo.max' => 'La imagen es demasiado pesada. El tamaño máximo permitido para imágenes es de 5 MB.',
            ]);

            $disk = 'images';
        } else {
            $request->validate([
                'archivo' => ['mimes:mp4,mov,avi,webm', 'max:102400'],
            ], [
                'archivo.mimes' => 'El video debe estar en formato MP4, MOV, AVI o WEBM.',
                'archivo.max' => 'El video es demasiado pesado. El tamaño máximo permitido para videos es de 100 MB.',
            ]);

            $disk = 'videos';
        }

        $file = $request->file('archivo');

        $path = $file->store('', $disk);

        Asset::create([
            'titulo' => $validatedData['titulo'] ?? null,
            'tipo' => $validatedData['tipo'],
            'disk' => $disk,
            'path' => $path,
            'original_name' => $file->getClientOriginalName(),
            'mime_type' => $file->getMimeType(),
            'size' => $file->getSize(),
        ]);

        return redirect()
            ->route('asset.create')
            ->with('status', 'Archivo subido correctamente.');
    }

    public function getImage()
    {
        $images = Asset::where('tipo', 'image')
            ->latest()
            ->get();

        return view('administrador.asset.images', compact('images'));
    }

    public function getVideo()
    {
        $videos = Asset::where('tipo', 'video')
            ->latest()
            ->get();

        return view('administrador.asset.videos', compact('videos'));
    }
}
