@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Gestión de Proyectos</h2>
        <a href="{{ route('projects.create') }}" class="btn btn-primary">Nuevo Proyecto</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped border">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($projects as $project)
            <tr>
                <td>{{ $project->id }}</td>
                <td>{{ $project->name }}</td>
                <td>{{ Str::limit($project->description, 50) }}</td>
                <td>
                    <div class="btn-group">
                        <a href="{{ route('projects.show', $project) }}" class="btn btn-sm btn-info text-white">Ver Tareas</a>
                        <a href="{{ route('projects.edit', $project) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('projects.destroy', $project) }}" method="POST" onsubmit="return confirm('¿Eliminar proyecto y sus tareas?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection