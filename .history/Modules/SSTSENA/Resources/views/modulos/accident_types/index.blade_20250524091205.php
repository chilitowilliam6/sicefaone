@extends('sstsena::layouts.master')
@section('content')

<div class="container mt-4">
    <h1 class="text-white">Tipos de Accidentes</h1>
    <a href="{{ route('sstsena.admin.accident_types.create') }}" class="btn btn-primary mb-3">Crear Tipo de Accidente</a>

    <div class="table-responsive">
        <table class="table table-dark table-bordered table-hover">
            <thead class="table-secondary text-dark">
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($AccidentTypes as $accident_type)
                <tr>
                    <td>{{ $accident_type->name }}</td>
                    <td>{{ $accident_type->description }}</td>
                    <td>
                        <a href="{{ route('sstsena.admin.accident_types.edit', $accident_type->id) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('sstsena.admin.accident_types.destroy', $accident_type->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar este tipo de accidente?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
