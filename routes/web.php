<?php

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


Route::get('/login', function () {
    return view('login');
})->name('login');


Route::get('/register', function () {
    return view('register');
})->name('register');