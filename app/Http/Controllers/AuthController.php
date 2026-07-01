<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    /* This function returns the  view named 'login' when 
    the user accesses the login route. It does not require any parameters */
    public function showLogin(Request $request)
    {

        return view('login');
    }

    /* THis functions retrieve data from the request form  */
    public function login(Request $request)
    {

        //First we retrieve the email and password from the request
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Add the vaue of 'estado' to the credentials array
        $credentials['estado'] = 1;
        
        //Laravel check that the user is authenticated and has the 'estado' value of 1. 
        // Redirect the user to the intended page if authenticated, otherwise return back with an error message.
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redirect the user to the intended page after successful login depends on the role of the user
            $user = Auth::user();

            if ($user->hasRole('administrador')) {
                return redirect()->route('administrador.dashboard');
            } elseif ($user->hasRole('barbero')) {
                return redirect()->route('barbero.dashboard');
            } elseif ($user->hasRole('cliente')) {
                return redirect()->route('cliente.dashboard');
            }

        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }



    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
