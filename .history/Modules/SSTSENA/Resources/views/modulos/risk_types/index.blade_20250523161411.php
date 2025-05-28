@extends('sstsena::layouts.master')
@section('content')
    <h1>Tipos de Riesgo</h1>
    <a href="{{ route('sstsena.admin.risk_types.create') }}">Crear Tipo de Riesgo</a>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($risktype as $risk_type)
                <tr>
                    <td>{{ $risk_type->name }}</td>
                    <td>{{ $risk_type->description }}</td>
                    <td>
                        <a href="{{ route('sstsena.admin.risk_types.edit', $risk_type->id) }}">Editar</a>
                        <form action="{{ route('sstsena.admin.risk_types.destroy', $risk_type->id) }}" method="POST"
                            style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endsection