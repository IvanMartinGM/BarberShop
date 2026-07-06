@extends('layouts.admin')

@section('title', 'Videos - BarberShop')
@section('page-title', 'Videos')

@section('content')

<section class="space-y-6">

    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="font-display text-3xl font-bold text-navy">
                Videos subidos
            </h2>

            <p class="mt-2 text-sm text-ink-600">
                Archivos almacenados en el disco virtual de videos.
            </p>

            <p class="mt-1 text-xs font-semibold text-ink-500">
                Fecha y hora: {{ now()->format('d/m/Y H:i:s') }}
            </p>
        </div>

        <a href="{{ route('asset.create') }}"
            class="inline-flex items-center justify-center rounded-panel bg-barber-red px-5 py-3 text-sm font-bold text-white shadow-card hover:bg-barber-red-700 transition-colors">
            Subir archivo
        </a>
    </div>

    <div class="grid grid-cols-1 gap-5 xl:grid-cols-2">
        @forelse ($videos as $video)
            <article class="overflow-hidden rounded-panel border border-cream-200 bg-white shadow-card">
                <video controls class="w-full bg-ink-950">
                    <source src="{{ $video->url }}" type="{{ $video->mime_type }}">
                    Tu navegador no soporta la reproducción de video.
                </video>

                <div class="space-y-2 p-5">
                    <h3 class="font-display text-xl font-bold text-navy">
                        {{ $video->titulo ?? 'Video sin título' }}
                    </h3>

                    <p class="text-sm text-ink-600">
                        {{ $video->original_name }}
                    </p>

                    <p class="text-xs font-semibold text-ink-500">
                        Disco: {{ $video->disk }} | Ruta: {{ $video->path }}
                    </p>

                    <p class="text-xs text-ink-500">
                        Subido: {{ $video->created_at?->format('d/m/Y H:i:s') }}
                    </p>
                </div>
            </article>
        @empty
            <div class="rounded-panel border border-cream-200 bg-white p-6 text-sm text-ink-600 shadow-card">
                No hay videos registrados.
            </div>
        @endforelse
    </div>

</section>

@endsection