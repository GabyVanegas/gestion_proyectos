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

    // Eliminar tarea
    public function destroy(Task $task)
    {
        $task->delete();
        return back()->with('success', 'Tarea eliminada.');
    }

    // Mostrar formulario de edición
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    // Procesar la actualización
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'required|in:pendiente,en progreso,completada',
        'description' => 'nullable|string',
        ]);

        $task->update($request->all());
        // Redirigimos de vuelta al proyecto al que pertenece la tarea
        return redirect()->route('projects.show', $task->project_id)
                     ->with('success', 'Tarea actualizada correctamente.');
    }
}
