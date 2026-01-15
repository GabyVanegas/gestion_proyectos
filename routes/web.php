<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Ruta protegida por autenticación Y por el rol de admin
Route::get('/admin', function () {
    return "Bienvenido a la sección administrativa";
})->middleware(['auth', 'admin']);
