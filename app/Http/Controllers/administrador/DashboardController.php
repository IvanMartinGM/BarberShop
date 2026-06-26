<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function calculateStatistics()
    {
        // Example logic to calculate statistics
            //'total_users' => \App\Models\User::count(),
            //'total_barbers' => \App\Models\Barbero::count(),
            //'total_clients' => \App\Models\Cliente::count(),
            // Add more statistics as needed
        
    }
}
