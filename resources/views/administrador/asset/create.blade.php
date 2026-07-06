@extends('layouts.admin')

@section('title', 'Subir assets - BarberShop')
@section('page-title', 'Subir archivos')

@section('content')

<section class="space-y-6">

    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="font-display text-3xl font-bold text-navy">
                Assets de Landing Page
            </h2>

            <p class="mt-2 text-sm text-ink-600">
                Sube imágenes y videos para usarlos como contenido visual del sistema.
            </p>

            <p class="mt-1 text-xs font-semibold text-ink-500">
                Fecha y hora: {{ now()->format('d/m/Y H:i:s') }}
            </p>
        </div>

        <div class="flex flex-col gap-3 sm:flex-row">
            <a href="{{ route('asset.images') }}"
                class="inline-flex items-center justify-center rounded-panel bg-navy px-5 py-3 text-sm font-bold text-white shadow-card hover:bg-navy-800 transition-colors">
                Ver imágenes
            </a>

            <a href="{{ route('asset.videos') }}"
                class="inline-flex items-center justify-center rounded-panel bg-barber-red px-5 py-3 text-sm font-bold text-white shadow-card hover:bg-barber-red-700 transition-colors">
                Ver videos
            </a>
        </div>
    </div>

    @if (session('status'))
        <div class="rounded-panel border border-success bg-success-light px-5 py-4 text-sm font-bold text-success">
            {{ session('status') }}
        </div>
    @endif

    <div class="rounded-panel border border-cream-200 bg-white shadow-card">
        <div class="border-b border-cream-200 px-6 py-5">
            <h3 class="font-display text-xl font-bold text-navy">
                Subir nuevo archivo
            </h3>
            <p class="mt-1 text-sm text-ink-500">
                Selecciona si el archivo será imagen o video.
            </p>
        </div>

        <form method="POST" action="{{ route('asset.store') }}" enctype="multipart/form-data" class="space-y-5 p-6">
            @csrf

            <div>
                <label class="block text-sm font-bold text-ink">
                    Título
                </label>

                <input type="text" name="titulo" value="{{ old('titulo') }}"
                    class="mt-2 w-full rounded-card border border-cream-300 px-4 py-3 text-sm text-ink focus:border-navy focus:outline-none focus:ring-4 focus:ring-navy-100">

                @error('titulo')
                    <p class="mt-1 text-sm font-semibold text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-bold text-ink">
                    Tipo de archivo
                </label>

                <select name="tipo"
                    class="mt-2 w-full rounded-card border border-cream-300 px-4 py-3 text-sm text-ink focus:border-navy focus:outline-none focus:ring-4 focus:ring-navy-100">
                    <option value="">Selecciona una opción</option>
                    <option value="image" @selected(old('tipo') === 'image')>Imagen</option>
                    <option value="video" @selected(old('tipo') === 'video')>Video</option>
                </select>

                @error('tipo')
                    <p class="mt-1 text-sm font-semibold text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-bold text-ink">
                    Archivo
                </label>

                <input type="file" name="archivo"
                    class="mt-2 w-full rounded-card border border-cream-300 bg-cream-50 px-4 py-3 text-sm text-ink">

                <p class="mt-2 text-xs text-ink-500">
                    Imágenes: jpg, jpeg, png, webp. Videos: mp4, mov, avi, webm.
                </p>

                @error('archivo')
                    <p class="mt-1 text-sm font-semibold text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit"
                    class="inline-flex items-center justify-center rounded-panel bg-barber-red px-6 py-3 text-sm font-bold text-white shadow-card hover:bg-barber-red-700 focus:outline-none focus:ring-4 focus:ring-barber-red-100 transition-colors">
                    Subir archivo
                </button>
            </div>
        </form>
    </div>

</section>

@endsection