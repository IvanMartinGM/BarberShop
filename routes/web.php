<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\administrador\BarberoController as AdministradorBarberoController;
use App\Http\Controllers\administrador\ClienteController as AdministradorClienteController;
use App\Http\Controllers\administrador\HorarioController as AdministradorHorarioController;
use App\Http\Controllers\administrador\ServicioController as AdministradorServicioController;
use App\Http\Controllers\administrador\AssetController as AdministradorAssetController;
use App\Http\Controllers\auth\PasswordResetController;
use App\Http\Controllers\administrador\CitaController as AdministradorCitaController;
use App\Http\Controllers\administrador\PagoController as AdministradorPagoController;
use App\Http\Controllers\administrador\ReporteController as AdministradorReporteController;
use App\Http\Controllers\administrador\DashboardController as AdministradorDashboardController;


use App\Http\Controllers\barbero\HorarioController as BarberoHorarioController;
use App\Http\Controllers\barbero\ServicioController as BarberoServicioController;
use App\Http\Controllers\barbero\CitaController as BarberoCitaController;
use App\Http\Controllers\barbero\DashboardController as BarberoDashboardController;

use App\Http\Controllers\cliente\ClienteController;
use App\Http\Controllers\cliente\CitaController as ClienteCitaController;

use App\Http\Controllers\ServicioController as PublicServicioController;
use App\Models\Asset;
/* 

Public Routes without authentication

*/

Route::get('/contacto', function () {
    return view('contacto');
})->name('contacto');

Route::get('/servicios', [PublicServicioController::class, 'index'])->name('servicios');


Route::get('/', [HomeController::class, 'index'])->name('home');


/* 

Guest Routes  

*/
Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    // The route shows the registration form for new clientes
    Route::get('/register', [ClienteController::class, 'create'])->name('register.create');
    // The route to store the new cliente in the database
    Route::post('/register', [ClienteController::class, 'store'])->name('register.store');



    Route::get('/forgot-password', [PasswordResetController::class, 'showForgotPasswordForm'])->name('password.request');

    Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLinkEmail'])->name('password.email');

    Route::get('/reset-password/{token}', [PasswordResetController::class, 'showResetPasswordForm'])->name('password.reset');

    Route::post('/reset-password', [PasswordResetController::class, 'resetPassword'])->name('password.update');
});

/*
Private Routes with authentication 

*/

Route::middleware('auth')->group(function () {
    // The route to logout the user, 
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // The routes for profile of the administrador, including edit and update
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});


/* 

Private Routes with authentication and role-based access control for Administrador 

*/
Route::middleware(['auth', 'role:administrador'])
    ->prefix('administrador')
    ->group(function () {


        Route::get('/dashboard', [AdministradorDashboardController::class, 'index'])->name('administrador.dashboard');

        /*

        Routes for managing barberos 
        
        */
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

        /*
        
        Horarios assigned for barberos
        
        */

        // The route to show the form to edit the horarios of a specific barbero
        Route::get('/barberos/{id}/horarios', [AdministradorBarberoController::class, 'editHorarios'])
            ->name('barbero.horarios.edit');
        // The route to update the horarios of a specific barbero
        Route::patch('/barberos/{id}/horarios', [AdministradorBarberoController::class, 'updateHorarios'])
            ->name('barbero.horarios.update');

        /*
        
        Servicios assigned for barberos
        
        */
        // Routes for managing the relationship between barberos and servicios 
        Route::get('/barbero/servicios/{id}/edit', [AdministradorBarberoController::class, 'editServicios'])
            ->name('barbero.servicios.edit');
        Route::patch('/barbero/servicios/{id}', [AdministradorBarberoController::class, 'updateServicios'])
            ->name('barbero.servicios.update');

        /*

        Routes for managing clientes 
        
        */

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


        /*

        Routes for managing horarios 
        
        */
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


        /*

        Routes for managing servicios
        
        */

        // The route to show the form to create a new servicio
        Route::get('/servicios/create', [AdministradorServicioController::class, 'create'])->name('servicio.create');
        Route::post('/servicios', [AdministradorServicioController::class, 'store'])->name('servicio.store');
        Route::get('/servicios', [AdministradorServicioController::class, 'index'])->name('servicio.index');
        Route::get('/servicios/{id}', [AdministradorServicioController::class, 'show'])->name('servicio.show');
        Route::get('/servicios/{id}/edit', [AdministradorServicioController::class, 'edit'])->name('servicio.edit');
        Route::put('/servicios/{id}', [AdministradorServicioController::class, 'update'])->name('servicio.update');
        Route::delete('/servicios/{id}', [AdministradorServicioController::class, 'destroy'])->name('servicio.destroy');



        /* Routes for create reportes */

        Route::get('/reportes/clientes/pdf', [AdministradorClienteController::class, 'pdf'])->name('reportes.clientes.pdf');
        Route::get('/reportes/barberos/pdf', [AdministradorBarberoController::class, 'pdf'])->name('reportes.barberos.pdf');


        Route::get('/reportes', [AdministradorReporteController::class, 'index'])->name('administrador.reportes.index');


        // Routes for landing assets
        Route::get('/assets/create', [AdministradorAssetController::class, 'create'])->name('asset.create');

        Route::post('/assets', [AdministradorAssetController::class, 'store'])->name('asset.store');

        Route::get('/assets/images', [AdministradorAssetController::class, 'getImage'])->name('asset.images');

        Route::get('/assets/videos', [AdministradorAssetController::class, 'getVideo'])->name('asset.videos');


        /* Routes for managing citas  */

        // Routes for appointments management
        Route::get('/citas', [AdministradorCitaController::class, 'index'])->name('administrador.citas.index');

        Route::get('/citas/{id}', [AdministradorCitaController::class, 'show'])->name('administrador.citas.show');

        Route::patch('/citas/{id}/estado', [AdministradorCitaController::class, 'updateStatus'])->name('administrador.citas.estado.update');

        /* Routes for managing pagos  */
        Route::get('/pagos', [AdministradorPagoController::class, 'index'])->name('administrador.pagos.index');

        Route::get('/pagos/create', [AdministradorPagoController::class, 'create'])->name('administrador.pagos.create');

        Route::post('/pagos', [AdministradorPagoController::class, 'store'])->name('administrador.pagos.store');

        Route::get('/pagos/{id}', [AdministradorPagoController::class, 'show'])->name('administrador.pagos.show');
    });



/* 

Private Routes with authentication and role-based access control for Barbero 

*/

Route::middleware(['auth', 'role:barbero'])
    ->prefix('barbero')
    ->name('barbero.')
    ->group(function () {

        Route::get('/dashboard', [BarberoDashboardController::class, 'index'])->name('dashboard');

        Route::get('/citas', [BarberoCitaController::class, 'index'])->name('citas.index');

        Route::get('/citas/{id}', [BarberoCitaController::class, 'show'])->name('citas.show');

        Route::get('/horarios', [BarberoHorarioController::class, 'index'])->name('horarios.index');

        // The route to update the horarios of the barbero
        Route::get('/servicios', [BarberoServicioController::class, 'index'])->name('servicios.index');
        Route::patch('/servicios', [BarberoServicioController::class, 'updateSelfServices'])->name('servicios.self.update');
    });


/* 

Private Routes with authentication and role-based access control for Cliente 

*/

Route::middleware(['auth', 'role:cliente'])
    ->prefix('cliente')
    ->name('cliente.')
    ->group(function () {


        Route::get('/servicios/{servicio}/barberos', [ClienteCitaController::class, 'barberosPorServicio'])->name('servicios.barberos');


        Route::get('/citas/create', [ClienteCitaController::class, 'create'])->name('citas.create');

        Route::post('/citas', [ClienteCitaController::class, 'store'])->name('citas.store');

        Route::get('/citas', [ClienteCitaController::class, 'index'])->name('citas.index');

        Route::get('/citas/{id}', [ClienteCitaController::class, 'show'])->name('citas.show');

        Route::patch('/citas/{id}/cancelar', [ClienteCitaController::class, 'cancel'])->name('citas.cancel');
    });
