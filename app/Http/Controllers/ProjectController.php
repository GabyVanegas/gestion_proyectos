<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    
    public function __construct()
    {
        //Solo los usuarios autenticados pueden gestionar proyectos
        $this->middleware('auth');
    }

    public function index()
    {
        
        //Aquí se listaran los proyectos
        $projects = auth()->user()->projects; 
        return view('projects.index', compact('projects'));
    }

    
    public function create()
    {
        //Mostrar el formulario de creación de proyecto
        return view('projects.create');
    }

    
    public function store(Request $request)
    {
        //Guardar el nuevo proyecto
        $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        ]);

        // Creamos el proyecto a través del usuario autenticado
        auth()->user()->projects()->create($validated);

        return redirect()->route('projects.index')->with('success', 'Proyecto creado.');
    }

    
    public function show(Project $project)
    {
        //Ver los detalles de un proyecto
        $project->load('tasks'); // Carga las tareas asociadas al proyecto
        return view('projects.show', compact('project'));
    }

    
    public function edit(Project $project)
    {
        //Formulario para editar un proyecto
        return view('projects.edit', compact('project'));
    }

    
    public function update(Request $request, Project $project)
    {
        //actualizar un proyecto
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $project->update($request->all());

        return redirect()->route('projects.index')->with('success', 'Proyecto actualizado.');
    }

   
    public function destroy(Project $project)
    {
        //Eliminar un proyecto
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Proyecto eliminado.');
    }
}
