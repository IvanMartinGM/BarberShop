@extends('layouts.admin')

@section('title', 'Lista de clientes - BarberShop')
@section('page-title', 'Lista de clientes')

@section('content')

<section class="space-y-6">

    <!-- Header interno -->
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>
            <h2 class="font-display text-3xl font-bold text-navy">
                Clientes
            </h2>

            <p class="mt-2 text-sm text-ink-600">
                Administra los clientes registrados en el sistema.
            </p>
        </div>

        <a href="{{ route('cliente.create') }}" class="inline-flex items-center justify-center rounded-panel bg-barber-red px-5 py-3 text-sm font-bold text-white shadow-card hover:bg-barber-red-700 focus:outline-none focus:ring-4 focus:ring-barber-red-100 transition-colors">
            Agregar cliente
        </a>

    </div>

    <!-- Stats rápidas -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4">

        <div class="rounded-panel border border-cream-200 bg-white p-5 shadow-card">
            <p class="text-sm font-semibold text-ink-500">
                Total clientes
            </p>
            <p class="mt-2 font-display text-3xl font-bold text-navy">
                {{ $clientes->count() ?? 0 }}
            </p>
        </div>

        <div class="rounded-panel border border-cream-200 bg-white p-5 shadow-card">
            <p class="text-sm font-semibold text-ink-500">
                Activos
            </p>
            <p class="mt-2 font-display text-3xl font-bold text-success">
                {{ $clientes->filter(fn ($cliente) => $cliente->user?->estado == 1)->count() }}
            </p>
        </div>

        <div class="rounded-panel border border-danger bg-danger-light p-5 shadow-card">
            <p class="text-sm font-semibold text-danger">
                Inactivos
            </p>
            <p class="mt-2 font-display text-3xl font-bold text-danger">
                {{ $clientes->filter(fn ($cliente) => $cliente->user?->estado == 0)->count() }}
            </p>
        </div>

    </div>

    <!-- Tabla principal -->
    <div class="rounded-panel border border-cream-200 bg-white shadow-card overflow-hidden">

        <!-- Encabezado de tabla -->
        <div class="flex flex-col gap-4 border-b border-cream-200 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <h3 class="font-display text-xl font-bold text-navy">
                    Lista de clientes
                </h3>

                <p class="mt-1 text-sm text-ink-500">
                    Consulta la información principal de cada cliente.
                </p>
            </div>

            <div class="w-full sm:w-80">
                <input type="text" placeholder="Buscar cliente..." class="w-full rounded-card border border-cream-300 bg-white px-4 py-3 text-sm text-ink placeholder:text-ink-500 focus:border-barber-red focus:outline-none focus:ring-4 focus:ring-barber-red-100 transition-colors">
            </div>

        </div>

        <!-- Tabla desktop -->
        <div class="hidden lg:block overflow-x-auto">
            <table class="w-full text-sm">

                <thead class="bg-cream-100 text-ink-600">
                    <tr>
                        <th class="px-6 py-4 text-left font-bold">Cliente</th>
                        <th class="px-6 py-4 text-left font-bold">Usuario</th>
                        <th class="px-6 py-4 text-left font-bold">Celular</th>
                        <th class="px-6 py-4 text-left font-bold">Registro</th>
                        <th class="px-6 py-4 text-left font-bold">Estado</th>
                        <th class="px-6 py-4 text-right font-bold">Acciones</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-cream-200">

                    @forelse ($clientes as $cliente)

                    @php
                    $defaultProfilePhoto = 'images/default-avatar.svg';

                    $fotoPerfil = $cliente->user?->foto_perfil;

                    if (!$fotoPerfil) {
                    $fotoPerfilUrl = asset($defaultProfilePhoto);
                    } elseif (\Illuminate\Support\Str::startsWith($fotoPerfil, ['http://', 'https://'])) {
                    $fotoPerfilUrl = $fotoPerfil;
                    } elseif (\Illuminate\Support\Str::startsWith($fotoPerfil, 'images/')) {
                    $fotoPerfilUrl = asset($fotoPerfil);
                    } else {
                    $fotoPerfilUrl = asset('storage/' . $fotoPerfil);
                    }
                    @endphp

                    <tr class="hover:bg-cream-50 transition-colors">

                        <!-- Cliente -->
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-3">

                                <div class="h-11 w-11 overflow-hidden rounded-full bg-white p-1 shadow-card ring-2 ring-cream-200">
                                    <img src="{{ $fotoPerfilUrl }}" alt="Foto de perfil de {{ $cliente->user?->nombres ?? 'cliente' }}" class="h-full w-full rounded-full object-cover">
                                </div>

                                <div>
                                    <p class="font-bold text-ink">
                                        {{ $cliente->user?->nombres ?? 'Sin nombre' }}
                                        {{ $cliente->user?->primer_apellido ?? '' }}
                                    </p>

                                    <p class="text-xs text-ink-500">
                                        {{ $cliente->user?->email ?? 'Sin correo' }}
                                    </p>
                                </div>

                            </div>
                        </td>

                        <!-- Usuario -->
                        <td class="px-6 py-5 text-ink-700">
                            {{ $cliente->user?->nombre_usuario ?? 'No registrado' }}
                        </td>

                        <!-- Celular -->
                        <td class="px-6 py-5 text-ink-700">
                            {{ $cliente->user?->celular ?? 'No registrado' }}
                        </td>

                        <!-- Registro -->
                        <td class="px-6 py-5 text-ink-700">
                            {{ $cliente->user?->fecha_registro ?? 'No registrada' }}
                        </td>

                        <!-- Estado -->
                        <td class="px-6 py-5">
                            @if ($cliente->user?->estado == 1)
                            <span class="inline-flex rounded-full bg-success-light px-3 py-1 text-xs font-bold text-success">
                                Activo
                            </span>
                            @else
                            <span class="inline-flex rounded-full bg-danger-light px-3 py-1 text-xs font-bold text-danger">
                                Inactivo
                            </span>
                            @endif
                        </td>

                        <!-- Acciones -->
                        <td class="px-6 py-5">
                            <div class="flex items-center justify-end gap-2">

                                <a href="{{ route('cliente.show', $cliente->id) }}" title="Ver cliente" class="inline-flex h-10 w-10 items-center justify-center rounded-card border border-cream-300 bg-white text-navy hover:bg-navy hover:text-white transition-colors">
                                    👁
                                </a>

                                <a href="{{ route('cliente.edit', $cliente->id) }}" title="Editar cliente" class="inline-flex h-10 w-10 items-center justify-center rounded-card border border-cream-300 bg-white text-barber-red hover:bg-barber-red hover:text-white transition-colors">
                                    ✎
                                </a>
                                @if ($cliente->user?->estado == 1)
                                <form action="{{ route('cliente.destroy', $cliente->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas desactivar este cliente? Esta acción no se puede deshacer.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="Desactivar cliente" class="inline-flex h-10 w-10 items-center justify-center rounded-card border border-cream-300 bg-white text-danger hover:bg-danger hover:text-white transition-colors">
                                        🗑
                                    </button>
                                </form>
                                @else
                                <span class="inline-flex items-center justify-center rounded-card bg-cream-100 px-4 py-2 text-sm font-bold text-ink-500">
                                    Inactivo
                                </span>
                                @endif
                            </div>
                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="6" class="px-6 py-14 text-center">

                            <div class="mx-auto max-w-md">
                                <h3 class="font-display text-2xl font-bold text-navy">
                                    No hay clientes registrados
                                </h3>

                                <p class="mt-2 text-sm text-ink-600">
                                    Cuando registres clientes, aparecerán listados en esta sección.
                                </p>

                                <a href="{{ route('cliente.create') }}" class="mt-6 inline-flex items-center justify-center rounded-panel bg-barber-red px-5 py-3 text-sm font-bold text-white hover:bg-barber-red-700 transition-colors">
                                    Agregar primer cliente
                                </a>
                            </div>

                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>
        </div>

        <!-- Cards mobile/tablet -->
        <div class="lg:hidden divide-y divide-cream-200">

            @forelse ($clientes as $cliente)

            @php
            $defaultProfilePhoto = 'images/default-avatar.svg';

            $fotoPerfil = $cliente->user?->foto_perfil;

            if (!$fotoPerfil) {
            $fotoPerfilUrl = asset($defaultProfilePhoto);
            } elseif (\Illuminate\Support\Str::startsWith($fotoPerfil, ['http://', 'https://'])) {
            $fotoPerfilUrl = $fotoPerfil;
            } elseif (\Illuminate\Support\Str::startsWith($fotoPerfil, 'images/')) {
            $fotoPerfilUrl = asset($fotoPerfil);
            } else {
            $fotoPerfilUrl = asset('storage/' . $fotoPerfil);
            }
            @endphp

            <article class="p-5">

                <div class="flex items-start justify-between gap-4">

                    <div class="flex items-center gap-3">

                        <div class="h-12 w-12 overflow-hidden rounded-full bg-white p-1 shadow-card ring-2 ring-cream-200">
                            <img src="{{ $fotoPerfilUrl }}" alt="Foto de perfil de {{ $cliente->user?->nombres ?? 'cliente' }}" class="h-full w-full rounded-full object-cover">
                        </div>

                        <div>
                            <h3 class="font-bold text-ink">
                                {{ $cliente->user?->nombres ?? 'Sin nombre' }}
                                {{ $cliente->user?->primer_apellido ?? '' }}
                            </h3>

                            <p class="text-sm text-ink-500">
                                {{ $cliente->user?->email ?? 'Sin correo' }}
                            </p>
                        </div>

                    </div>

                    @if ($cliente->user?->estado == 1)
                    <span class="rounded-full bg-success-light px-3 py-1 text-xs font-bold text-success">
                        Activo
                    </span>
                    @else
                    <span class="rounded-full bg-danger-light px-3 py-1 text-xs font-bold text-danger">
                        Inactivo
                    </span>
                    @endif

                </div>

                <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-3 text-sm">

                    <div class="rounded-card bg-cream-50 px-4 py-3">
                        <p class="text-xs font-semibold text-ink-500">Usuario</p>
                        <p class="mt-1 font-medium text-ink">
                            {{ $cliente->user?->nombre_usuario ?? 'No registrado' }}
                        </p>
                    </div>

                    <div class="rounded-card bg-cream-50 px-4 py-3">
                        <p class="text-xs font-semibold text-ink-500">Celular</p>
                        <p class="mt-1 font-medium text-ink">
                            {{ $cliente->user?->celular ?? 'No registrado' }}
                        </p>
                    </div>

                    <div class="rounded-card bg-cream-50 px-4 py-3">
                        <p class="text-xs font-semibold text-ink-500">Registro</p>
                        <p class="mt-1 font-medium text-ink">
                            {{ $cliente->user?->fecha_registro ?? 'No registrada' }}
                        </p>
                    </div>

                </div>

                <div class="mt-4 flex justify-end gap-2">

                    <a href="{{ route('cliente.show', $cliente->id) }}" class="inline-flex items-center justify-center rounded-card border border-cream-300 bg-white px-4 py-2 text-sm font-bold text-navy hover:bg-navy hover:text-white transition-colors">
                        Ver
                    </a>

                    <a href="{{ route('cliente.edit', $cliente->id) }}" class="inline-flex items-center justify-center rounded-card bg-barber-red px-4 py-2 text-sm font-bold text-white hover:bg-barber-red-700 transition-colors">
                        Editar
                    </a>
                    @if ($cliente->user?->estado == 1)
                    <form action="{{ route('cliente.destroy', $cliente->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas desactivar este cliente? Esta acción no se puede deshacer.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" title="Desactivar cliente" class="inline-flex h-10 w-10 items-center justify-center rounded-card border border-cream-300 bg-white text-danger hover:bg-danger hover:text-white transition-colors">
                            🗑
                        </button>
                    </form>
                    @else
                    <span class="inline-flex items-center justify-center rounded-card bg-cream-100 px-4 py-2 text-sm font-bold text-ink-500">
                        Inactivo
                    </span>
                    @endif

                </div>

            </article>

            @empty

            <div class="px-6 py-14 text-center">
                <h3 class="font-display text-2xl font-bold text-navy">
                    No hay clientes registrados
                </h3>

                <p class="mt-2 text-sm text-ink-600">
                    Cuando registres clientes, aparecerán listados en esta sección.
                </p>

                <a href="{{ route('cliente.create') }}" class="mt-6 inline-flex items-center justify-center rounded-panel bg-barber-red px-5 py-3 text-sm font-bold text-white hover:bg-barber-red-700 transition-colors">
                    Agregar primer cliente
                </a>
            </div>

            @endforelse

        </div>

    </div>

</section>

@endsection
