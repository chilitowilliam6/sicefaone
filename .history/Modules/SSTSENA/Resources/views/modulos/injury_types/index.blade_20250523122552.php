@extends('sstsena::layouts.master')
@section('content')
<h1>tipos de lesiones</h1>
<a href="{{route('sstsena.admin.injury_types.create')}}">crear tipo de lesion</a>
<table>
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($injury_types as $injury_type)
        <tr>
            <td>{{ $injury_type->name }}</td>
            <td>{{ $injury_type->description }}</td>
            <td>
                <a href="{{ route('sstsena.admin.injury_types.edit', $injury_type->id) }}">Editar</a>
                <form action="{{ route('sstsena.admin.injury_types.destroy', $injury_type->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
@endsection
