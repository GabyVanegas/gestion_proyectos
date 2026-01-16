<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Guardar una tarea asociada a un proyecto
    public function store(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'required|in:pendiente,en progreso,completada',
            'description' => 'nullable|string',
        ]);

        $project->tasks()->create($request->all());

        return redirect()->route('projects.show', $project)->with('success', 'Tarea creada.');
    }

    // Actualizar estado de una tarea
    public function update(Request $request, Task $task)
    {
        $task->update($request->only('status'));
        return back()->with('success', 'Estado actualizado.');
    }

    // Eliminar tarea
    public function destroy(Task $task)
    {
        $task->delete();
        return back()->with('success', 'Tarea eliminada.');
    }
}
