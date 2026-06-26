<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\administrador\BarberoController as AdministradorBarberoController;
use App\Http\Controllers\administrador\ClienteController as AdministradorClienteController;






//Public Routes without authentication
Route::get('/', function () {
    return view('home');
})->name('home');



//Public Routes without authentication
Route::get('/layout/guest', function () {
    return view('layouts.guest');
})->name('guest');


//Public Routes without authentication
Route::get('/layout/admin', function () {
    return view('layouts.admin');
})->name('admin');

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
Route::middleware(['auth', 'role:administrador'])->group(function () {

    Route::get('/dashboard', function () {
        return view('administrador.dashboard');
    })->name('dashboard');


    // Routes for managing barberos
    // The route to show the form to create a new barbero
    Route::get('/barberos/create', [AdministradorBarberoController::class, 'create'])->name('barbero.create');
    // The route to store the new barbero in the database
    Route::post('/barberos', [AdministradorBarberoController::class, 'store'])->name('barbero.store');
    // The route to show the list of barberos
    Route::get('/barberos', [AdministradorBarberoController::class, 'index'])->name('barbero.index');
    // The route to show the details of a specific barbero
    Route::get('/barberos/{id}', [AdministradorBarberoController::class, 'show'])->name('barbero.show');
    // The route to show the form to edit a specific barbero
    Route::get('/barberos/{id}/edit', [AdministradorBarberoController::class, 'edit'])->name('barbero.edit');
    // The route to update a specific barbero
    Route::put('/barberos/{id}', [AdministradorBarberoController::class, 'update'])->name('barbero.update');


    //Routes for managing clientes
    // The route to show the form to create a new cliente
    Route::get('/clientes/create', [AdministradorClienteController::class, 'create'])->name('cliente.create');
    // The route to store the new cliente in the database
    Route::post('/clientes', [ClienteController::class, 'store'])->name('cliente.store');
    // The route to show the list of clientes
    Route::get('/clientes', [AdministradorClienteController::class, 'index'])->name('cliente.index');
    // The route to show the details of a specific cliente
    Route::get('/clientes/{id}', [AdministradorClienteController::class, 'show'])->name('cliente.show');
    // The route to show the form to edit a specific cliente
    Route::get('/clientes/{id}/edit', [AdministradorClienteController::class, 'edit'])->name('cliente.edit');
    // The route to update a specific cliente
    Route::put('/clientes/{id}', [AdministradorClienteController::class, 'update'])->name('cliente.update');    

});


//Private Routes with authentication and role-based access control for Barbero
Route::middleware(['auth', 'role:barbero'])->group(function () {
    // Their proper dashboard route for barbero


});



//Private Routes with authentication and role-based access control for Cliente
Route::middleware(['auth', 'role:cliente'])->group(function () {
    //

});
