<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectApiController extends Controller
{
    // Listar todos los proyectos con sus tareas
    public function index()
    {
        $projects = Project::with('tasks')->get();
        return response()->json($projects, 200);
    }

    // Crear un nuevo proyecto vía API
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $project = Project::create($validated);
        return response()->json($project, 201);
    }

    // Mostrar un proyecto específico
    public function show(Project $project)
    {
        return response()->json($project->load('tasks'), 200);
    }

    // Actualizar proyecto 
    public function update(Request $request, Project $project)
    {
        $project->update($request->all());
        return response()->json($project, 200);
    }

    // Eliminar proyecto 
    public function destroy(Project $project)
    {
        $project->delete();
        return response()->json(['message' => 'Proyecto eliminado'], 200);
    }
}
