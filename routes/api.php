<?php

use App\Http\Controllers\Api\ProjectApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// Ruta protegida para usuarios autenticados 
Route::group([], function () {
    Route::get('/projects', [ProjectApiController::class, 'index']);
    Route::post('/projects', [ProjectApiController::class, 'store']); // Crear proyecto
    Route::get('/projects/{project}', [ProjectApiController::class, 'show']); // Ver uno
    Route::put('/projects/{project}', [ProjectApiController::class, 'update']); // Actualizar
    Route::delete('/projects/{project}', [ProjectApiController::class, 'destroy']); // Eliminar
});



