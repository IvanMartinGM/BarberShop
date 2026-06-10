<?php


namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Usuario;


class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Lógica de autenticação aqui
        return response()->json(['message' => 'Login successful']);
    }

}