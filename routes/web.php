<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClienteController;




//Public Routes without authentication
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/servicios', function () {
    return view('servicios');
})->name('servicios');

Route::get('/contacto', function () {
    return view('contacto');
})->name('contacto');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [ClienteController::class, 'create'])->name('cliente_register');
    Route::post('/register', [ClienteController::class, 'store'])->name('cliente_store');
});



//Private Routes with authentication
Route::middleware('auth')->group(function () {
    // The route to logout the user, 
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});


//Private Routes with authentication and role-based access control for Administrador
Route::middleware(['auth','role:administrador'])->group(function () {
    Route::get('/dashboard', function () {
        return 'Dashboard admin';
    })->name('dashboard');
});


//Private Routes with authentication and role-based access control for Barbero
Route::middleware(['auth','role:barbero'])->group(function () {
    //

});



//Private Routes with authentication and role-based access control for Cliente
Route::middleware(['auth', 'role:cliente'])->group(function () {
    //

});
