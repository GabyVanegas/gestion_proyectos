<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectApiController extends Controller
{
    // Listar solo los proyectos del usuario autenticado
    public function index()
    {
        /** @var \App\Models\User $user */
        // Usamos el ID del usuario autenticado por Sanctum
        $user = auth()->user();
        

        if (!$user) {
        return response()->json(['message' => 'No autenticado'], 401);
        }

        $projects = $user->projects()->with('tasks')->get();
        return response()->json($projects, 200);
    }

    // Crear un proyecto asignado automáticamente al usuario
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Se crea a través de la relación para asignar el user_id
        $project = auth()->user()->projects()->create($validated);
        
        return response()->json($project, 201);
    }

    // Mostrar un proyecto solo si le pertenece al usuario
    public function show($id)
    {
        $project = auth()->user()->projects()->with('tasks')->find($id);

        if (!$project) {
            return response()->json(['message' => 'Proyecto no encontrado o no autorizado'], 404);
        }

        return response()->json($project, 200);
    }
}