<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\administrador\BarberoController as AdministradorBarberoController;
use App\Http\Controllers\administrador\ClienteController as AdministradorClienteController;
use App\Http\Controllers\administrador\HorarioController as AdministradorHorarioController;
use App\Http\Controllers\administrador\ServicioController as AdministradorServicioController;







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
    // The route shows the registration form for new clientes
    Route::get('/register', [ClienteController::class, 'create'])->name('register.create');
    // The route to store the new cliente in the database
    Route::post('/register', [ClienteController::class, 'store'])->name('register.store');
});



//Private Routes with authentication
Route::middleware('auth')->group(function () {
    // The route to logout the user, 
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // The routes for profile of the administrador, including edit and update
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});




//Private Routes with authentication and role-based access control for Administrador
Route::middleware(['auth', 'role:administrador'])->group(function () {


    Route::get('/dashboard', function () {
        return view('administrador.dashboard');
    })->name('administrador.dashboard');


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
    // The route to softdelete a specific barbero
    Route::delete('/barberos/{id}', [AdministradorBarberoController::class, 'destroy'])->name('barbero.destroy');

    // The route to show the form to edit the horarios of a specific barbero
    Route::get('/barberos/{id}/horarios', [AdministradorBarberoController::class, 'editHorarios'])->name('barbero.horarios.edit');
    // The route to update the horarios of a specific barbero
    Route::patch('/barberos/{id}/horarios', [AdministradorBarberoController::class, 'updateHorarios'])->name('barbero.horarios.update');


    //Routes for managing clientes
    // The route to show the form to create a new cliente
    Route::get('/clientes/create', [AdministradorClienteController::class, 'create'])->name('cliente.create');
    // The route to store the new cliente in the database
    Route::post('/clientes', [AdministradorClienteController::class, 'store'])->name('cliente.store');
    // The route to show the list of clientes
    Route::get('/clientes', [AdministradorClienteController::class, 'index'])->name('cliente.index');
    // The route to show the details of a specific cliente
    Route::get('/clientes/{id}', [AdministradorClienteController::class, 'show'])->name('cliente.show');
    // The route to show the form to edit a specific cliente
    Route::get('/clientes/{id}/edit', [AdministradorClienteController::class, 'edit'])->name('cliente.edit');
    // The route to update a specific cliente
    Route::put('/clientes/{id}', [AdministradorClienteController::class, 'update'])->name('cliente.update');
    // The route to softdelete a specific cliente
    Route::delete('/clientes/{id}', [AdministradorClienteController::class, 'destroy'])->name('cliente.destroy');

    //Routes for managing horarios
    // The route to show the form to create a new horario
    Route::get('/horarios/create', [AdministradorHorarioController::class, 'create'])->name('horario.create');
    // The route to store the new horario in the database
    Route::post('/horarios', [AdministradorHorarioController::class, 'store'])->name('horario.store');
    // The route to show the list of horarios
    Route::get('/horarios', [AdministradorHorarioController::class, 'index'])->name('horario.index');
    // The route to show the details of a specific horario
    Route::get('/horarios/{id}', [AdministradorHorarioController::class, 'show'])->name('horario.show');
    // The route to show the form to edit a specific horario
    Route::get('/horarios/{id}/edit', [AdministradorHorarioController::class, 'edit'])->name('horario.edit');
    // The route to update a specific horario
    Route::put('/horarios/{id}', [AdministradorHorarioController::class, 'update'])->name('horario.update');
    // The route to softdelete a specific horario
    Route::delete('/horarios/{id}', [AdministradorHorarioController::class, 'destroy'])->name('horario.destroy');

    //Routes for managing servicios
    // The route to show the form to create a new servicio
    Route::get('/admin/servicios/create', [AdministradorServicioController::class, 'create'])->name('servicio.create');
    Route::post('/admin/servicios', [AdministradorServicioController::class, 'store'])->name('servicio.store');
    Route::get('/admin/servicios', [AdministradorServicioController::class, 'index'])->name('servicio.index');
    Route::get('/admin/servicios/{id}', [AdministradorServicioController::class, 'show'])->name('servicio.show');
    Route::get('/admin/servicios/{id}/edit', [AdministradorServicioController::class, 'edit'])->name('servicio.edit');
    Route::put('/admin/servicios/{id}', [AdministradorServicioController::class, 'update'])->name('servicio.update');
    Route::delete('/admin/servicios/{id}', [AdministradorServicioController::class, 'destroy'])->name('servicio.destroy');
});

//Private Routes with authentication and role-based access control for Barbero
Route::middleware(['auth', 'role:barbero'])->group(function () {
    // Their proper dashboard route for barbero
    Route::get('/barbero/dashboard', function () {
        return view('barbero.dashboard');
    })->name('barbero.dashboard');
});



//Private Routes with authentication and role-based access control for Cliente
Route::middleware(['auth', 'role:cliente'])->group(function () {
    //

});
