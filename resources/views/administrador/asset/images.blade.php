@extends('layouts.admin')

@section('title', 'Imágenes - BarberShop')
@section('page-title', 'Imágenes')

@section('content')

<section class="space-y-6">

    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="font-display text-3xl font-bold text-navy">
                Imágenes subidas
            </h2>

            <p class="mt-2 text-sm text-ink-600">
                Archivos almacenados en el disco virtual de imágenes.
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

    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-3">
        @forelse ($images as $image)
            <article class="overflow-hidden rounded-panel border border-cream-200 bg-white shadow-card">
                <img src="{{ $image->url }}" alt="{{ $image->titulo ?? $image->original_name }}"
                    class="h-56 w-full object-cover">

                <div class="space-y-2 p-5">
                    <h3 class="font-display text-xl font-bold text-navy">
                        {{ $image->titulo ?? 'Imagen sin título' }}
                    </h3>

                    <p class="text-sm text-ink-600">
                        {{ $image->original_name }}
                    </p>

                    <p class="text-xs font-semibold text-ink-500">
                        Disco: {{ $image->disk }} | Ruta: {{ $image->path }}
                    </p>

                    <p class="text-xs text-ink-500">
                        Subido: {{ $image->created_at?->format('d/m/Y H:i:s') }}
                    </p>
                </div>
            </article>
        @empty
            <div class="rounded-panel border border-cream-200 bg-white p-6 text-sm text-ink-600 shadow-card">
                No hay imágenes registradas.
            </div>
        @endforelse
    </div>

</section>

@endsection