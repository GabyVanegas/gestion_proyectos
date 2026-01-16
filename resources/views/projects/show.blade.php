@extends('layouts.app')

@section('content')
<div class="container">
    {{-- Información del Proyecto --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <h3>Proyecto: {{ $project->name }}</h3>
            <p class="text-muted">{{ $project->description }}</p>
            <a href="{{ route('projects.index') }}" class="btn btn-outline-secondary btn-sm">Volver al listado</a>
        </div>
    </div>

    {{-- Formulario para Añadir Tarea con Descripción --}}
    <div class="card mb-4 border-primary shadow-sm">
        <div class="card-header bg-primary text-white">Añadir Nueva Tarea</div>
        <div class="card-body">
            <form action="{{ route('tasks.store', $project) }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-md-7">
                        <label class="form-label small fw-bold">Título</label>
                        <input type="text" name="title" class="form-control" placeholder="Nombre de la tarea" required>
                    </div>
                    <div class="col-md-5">
                        <label class="form-label small fw-bold">Estado</label>
                        <select name="status" class="form-select">
                            <option value="pendiente">Pendiente</option>
                            <option value="en progreso">En progreso</option>
                            <option value="completada">Completada</option>
                        </select>
                    </div>
                    <div class="col-12 mt-2">
                        <label class="form-label small fw-bold">Descripción de la Tarea</label>
                        <textarea name="description" class="form-control" rows="2" placeholder="Detalles de lo que se debe hacer..."></textarea>
                    </div>
                    <div class="col-12 text-end mt-3">
                        <button type="submit" class="btn btn-success px-4">Agregar Tarea</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <h4>Tareas Registradas</h4>
    <div class="list-group shadow-sm">
        @forelse($project->tasks as $task)
            <div class="list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-between align-items-start">
                    <div>
                        <h5 class="mb-1 fw-bold">{{ $task->title }}</h5>
                        <p class="mb-1 text-secondary small">{{ $task->description ?? 'Sin descripción adicional.' }}</p>
                        <span class="badge {{ $task->status == 'completada' ? 'bg-success' : ($task->status == 'en progreso' ? 'bg-warning text-dark' : 'bg-secondary') }}">
                            {{ ucfirst($task->status) }}
                        </span>
                    </div>
                    <form action="{{ route('tasks.destroy', $task) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Eliminar tarea [cite: 39]">
                            <i class="bi bi-trash"></i> Eliminar
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="alert alert-info border-0 shadow-sm">No hay tareas asociadas a este proyecto.</div>
        @endforelse
    </div>
</div>
@endsection