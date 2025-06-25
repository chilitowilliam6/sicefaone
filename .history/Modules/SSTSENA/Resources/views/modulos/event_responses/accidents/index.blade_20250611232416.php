@extends('sstsena::layouts.master')

@section('content')
<div class="container mt-5">
    <h1>Respuestas para Accidente #{{ $event->id }}</h1>
    
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('sstsena.accidents.responses.create', $event->id) }}" class="btn btn-primary mb-3">Agregar Respuesta</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Respuesta</th>
                <th>Acciones Tomadas</th>
                <th>Gravedad</th>
                <th>Estado</th>
                <th>Fecha de Respuesta</th>
                <th>Creado Por</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($responses as $response)
                <tr>
                    <td>{{ $response->id }}</td>
                    <td>{{ Str::limit($response->response, 50) }}</td>
                    <td>{{ Str::limit($response->actions_taken, 50) }}</td>
                    <td>
                        @switch($response->severity)
                            @case('minor') Leve @break
                            @case('moderate') Moderada @break
                            @case('serious') Grave @break
                            @case('fatal') Fatal @break
                            @default No definido
                        @endswitch
                    </td>
                    <td>
                        @if ($response->status === 'investigation')
                            <span class="badge bg-warning text-dark">Investigación</span>
                        @else
                            <span class="badge bg-success">Finalizado</span>
                        @endif
                    </td>
                    <td>{{ \Carbon\Carbon::parse($response->response_date)->format('Y-m-d H:i') }}</td>
                    <td>{{ $response->createdBy->name ?? 'Desconocido' }}</td>
                    
                    <td>
                        <a href="{{ route('sstsena.accidents.responses.edit', [$event->id, $response->id]) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('sstsena.accidents.responses.destroy', [$event->id, $response->id]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9">No se encontraron respuestas.</td>
                </tr>
            @endforelse
            @if(session('success'))
    <div class="position-fixed top-50 start-50 translate-middle bg-light border shadow-lg rounded-4 text-center p-5" style="z-index: 9999; width: 400px;">
        <div class="mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="#16a34a" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM6.97 11.03a.75.75 0 0 0 1.08 0l3.992-3.993a.75.75 0 0 0-1.08-1.04L7.5 9.44 5.53 7.47a.75.75 0 0 0-1.06 1.06l2.5 2.5z"/>
            </svg>
        </div>
        <h4 class="fw-bold text-success">¡Éxito!</h4>
        <p class="text-secondary">{{ session('success') }}</p>
        <button onclick="this.parentElement.remove()" class="btn btn-success mt-3 px-4">Cerrar</button>
    </div>
@endif

        </tbody>
    </table>
</div>
@endsection
