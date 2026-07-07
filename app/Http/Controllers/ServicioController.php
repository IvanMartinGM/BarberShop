<?php

namespace App\Http\Controllers;

use App\Models\Servicio;

class ServicioController extends Controller
{
    public function index()
    {
        $serviciosDisponibles = Servicio::where('estado', 1)
            ->orderBy('nombre_servicio')
            ->get();

        return view('servicios', compact('serviciosDisponibles'));
    }
}