@extends('sstsena::layouts.master')
@section('content')

<div class="container mt-5">
    <h1 class="mb-4" style="color: #1a3c6e; font-weight: 600;">Tipos de personas</h1>
    <a href="{{ route('sstsena.admin.TypePerson.create') }}" 
       class="btn btn-primary mb-4" 
       style="background-color: #1a3c6e; border-color: #1a3c6e;">Crear Tipo de Persona</a>
    <div class="table-responsive">
        <table class="table table-bordered table-hover rounded shadow-sm" style="background-color: #ffffff;">
            <thead style="background-color: #f8f9fa;">
                <tr>
                    <th style="color: #34495e; font-weight: 600;">Nombre</th>
                    <th style="color: #34495e; font-weight: 600;">Descripción</th>
                    <th style="color: #34495e; font-weight: 600;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ( $personTypes as $person_type)
                <tr>
                    <td>{{ $person_type->name }}</td>
                    <td>{{ $person_type->description }}</td>
                    <td>
                        <a href="{{ route('sstsena.admin.TypePerson.edit', $person_type->id) }}" 
                           class="btn btn-sm btn-outline-success me-2"
                           style="border-color: #28a745; color: #28a745;">Editar</a>
                        <form action="{{ route('sstsena.admin.TypePerson.destroy', $person_type->id) }}" 
                              method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="btn btn-sm btn-outline-danger" 
                                    style="border-color: #dc3545; color: #dc3545;" 
                                    onclick="return confirm('¿Estás seguro de eliminar este tipo de persona?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>






@endsection