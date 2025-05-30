@extends('sstsena::layouts.master')
@section('content')

<div class="container mt-5">
    <div class="card shadow-sm rounded-3" style="background-color: #ffffff;">
        <div class="card-header d-flex justify-content-between align-items-center" style="background-color: #f8f9fa; border-bottom: 1px solid #dee2e6;">
            <h3 class="text-center m-0" style="color: #1a3c6e; font-weight: 600;">Personas Involucradas</h3>
            <!-- Formulario de búsqueda -->
            <form action="{{ route('sstsena.funcionario.people_involved.index') }}" method="GET" class="d-flex">
                <input type="text" name="search_document" class="form-control me-2" placeholder="Buscar por cédula" value="{{ request('search_document') }}">
                <button type="submit" class="btn btn-outline-primary">Buscar</button>
            </form>
        </div>

        <div class="card-body p-4">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>        
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Tipo de Documento</th>
                        <th>Número de Documento</th>
                        <th>Fecha de Nacimiento</th>
                        <th>Género</th>
                        <th>Tipo de Persona</th>
                        <th>Teléfono</th>
                        <th>Dirección</th>
                        <th>Accidente</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($peopleInvolved as $people)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $people->name }}</td>
                            <td>{{ $people->last_name }}</td>
                            <td>{{ $people->document_type }}</td>
                            <td>{{ $people->document_number }}</td>
                            <td>{{ $people->birth_date }}</td>
                            <td>{{ $people->gender }}</td>
                            <td>{{ $people->personType->name }}</td>
                            <td>{{ $people->phone }}</td>
                            <td>{{ $people->address }}</td>
                            <td>{{ $people->accident->description }}</td>
                            <td>
                                <a href="" class="btn btn-primary btn-sm">Editar</a>
                                <form action="" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="12" class="text-center text-muted">No se encontraron resultados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
