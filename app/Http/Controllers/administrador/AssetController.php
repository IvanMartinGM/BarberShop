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
            'archivo' => ['required', 'file', 'max:102400'],
        ]);

        if ($validatedData['tipo'] === 'image') {
            $request->validate([
                'archivo' => ['image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            ]);

            $disk = 'images';
        } else {
            $request->validate([
                'archivo' => ['mimes:mp4,mov,avi,webm', 'max:102400'],
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