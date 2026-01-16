<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
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

// Rutas para el CRUD de Proyectos 
Route::resource('projects', ProjectController::class);

//Rutas para la gestión de Tareas dentro de Proyectos
Route::post('projects/{project}/tasks', [TaskController::class, 'store'])->name('tasks.store');
Route::patch('tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
Route::delete('tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
