@extends('sstsena::layouts.master')
@section('content')

<div class="container mt-4">
    <h1 class="text-white">Tipos de Lesiones</h1>
    <a href="{{ route('sstsena.admin.injury_types.create') }}" class="btn btn-primary mb-3">Crear Tipo de Lesión</a>

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
                @foreach ($injurytypes as $injury_type)
                <tr>
                    <td>{{ $injury_type->name }}</td>
                    <td>{{ $injury_type->description }}</td>
                    <td>
                        <a href="{{ route('sstsena.admin.injury_types.edit', $injury_type->id) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('sstsena.admin.injury_types.destroy', $injury_type->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar este tipo de lesión?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
