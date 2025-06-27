@extends('sstsena::layouts.master')

@section('content')
<div class="container mt-5">
    <h1 style="color: #1a3c6e; font-weight: 600;">Tipos de Emergencias</h1>
    <a href="{{ route('sstsena.admin.emergency_type.create') }}" class="btn btn-primary mb-4" style="background-color: #1a3c6e; border-color: #1a3c6e;">Registrar Tipo de Emergencia</a>

    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-hover" style="background-color: #ffffff; border: 1px solid #dee2e6;">
            <thead style="background-color: #f8f9fa; color: #34495e;">
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($emergencyType as $emergencyType)
                <tr>
                    <td>{{ $emergencyType->name }}</td>
                    <td>{{ $emergencyType->description }}</td>
                    <td>
                        <a href="{{ route('sstsena.admin.emergency_type.edit', $emergencyType->id) }}" class="btn btn-sm btn-outline-warning px-3" style="border-color: #ffc107; color: #34495e;">Editar</a>
                        <form action="{{ route('sstsena.admin.emergency_type.destroy', $emergencyType->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger px-3" style="border-color: #dc3545; color: #34495e;" onclick="return confirm('¿Estás seguro de eliminar este tipo de emergencia?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection