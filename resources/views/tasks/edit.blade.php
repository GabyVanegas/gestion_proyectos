@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark fw-bold">Editar Tarea</div>
                <div class="card-body">
                    <form action="{{ route('tasks.update', $task) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="mb-3">
                            <label class="form-label fw-bold">Título de la Tarea</label>
                            <input type="text" name="title" class="form-control" value="{{ old('title', $task->title) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Estado</label>
                            <select name="status" class="form-select">
                                <option value="pendiente" {{ $task->status == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                <option value="en progreso" {{ $task->status == 'en progreso' ? 'selected' : '' }}>En progreso</option>
                                <option value="completada" {{ $task->status == 'completada' ? 'selected' : '' }}>Completada</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Descripción</label>
                            <textarea name="description" class="form-control" rows="3">{{ old('description', $task->description) }}</textarea>
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                            <a href="{{ route('projects.show', $task->project_id) }}" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection