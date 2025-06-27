@extends('sstsena::layouts.master')

@section('content')
<div class="container mt-5">
    <h1 style="color: #1a3c6e; font-weight: 600;">Tipos de Actos Inseguros</h1>
    <a href="{{ route('sstsena.admin.unsafe_act_types.create') }}" class="btn btn-primary mb-4" style="background-color: #1a3c6e; border-color: #1a3c6e;">Registrar Tipo de Actos Inseguros</a>

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
                @foreach ($unsafe_act_types as $unsafe_act_type)
                <tr>
                    <td>{{ $unsafe_act_type->name }}</td>
                    <td>{{ $unsafe_act_type->description }}</td>
                    <td>
                        <a href="{{ route('sstsena.admin.unsafe_act_types.edit', $unsafe_act_type->id) }}" class="btn btn-sm btn-outline-warning px-3" style="border-color: #ffc107; color: #34495e;">Editar</a>
                        <form action="{{ route('sstsena.admin.unsafe_act_types.destroy', $unsafe_act_type->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger px-3" style="border-color: #dc3545; color: #34495e;" onclick="return confirm('¿Estás seguro de eliminar este tipo de riesgo?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
