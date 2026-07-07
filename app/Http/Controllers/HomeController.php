<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Barbero;

class HomeController extends Controller
{
    public function index()
    {
        $carouselImages = Asset::where('tipo', 'image')
            ->latest()
            ->take(6)
            ->get();

        $barberosDisponibles = Barbero::with('user')
            ->where('estado_disponibilidad', 'disponible')
            ->whereHas('user', function ($query) {
                $query->where('estado', 1);
            })
            ->take(3)
            ->get();

        return view('home', compact('carouselImages', 'barberosDisponibles'));
    }
}