<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

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


Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', function () {
    return view('register');
})->name('register');