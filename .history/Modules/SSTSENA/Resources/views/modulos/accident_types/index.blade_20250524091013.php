@extends('sstsena::layouts.master')
@section('content')
<h1>Tipos de Accidentes</h1>
<a href="{{route('sstsena.admin.accident_types.create')}}">Crear Tipo de Accidente</a>
<table>
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($accidenttypes as $accident_type)
        <tr>
            <td>{{ $accident_type->name }}</td>
            <td>{{ $accident_type->description }}</td>
            <td>
                <a href="{{ route('sstsena.admin.accident_types.edit', $accident_type->id) }}">Editar</a>
                <form action="{{ route('sstsena.admin.accident_types.destroy', $accident_type->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>