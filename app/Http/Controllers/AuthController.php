<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin (Request $request) {
        
        return view('login');
    }

    public function login (Request $request) {
        
    //First we retrieve the email and password from the request
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    $remember = $request->boolean('remember');

    if (auth()->attempt($credentials, $remember)) {
        $request->session()->regenerate();


        return redirect()->intended('dashboard');
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ])->onlyInput('email');


    }
}
