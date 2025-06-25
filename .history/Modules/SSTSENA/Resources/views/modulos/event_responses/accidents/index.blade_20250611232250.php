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
    <div id="customAlert" class="position-fixed bottom-0 end-0 p-3" style="z-index: 1055;">
        <div class="card shadow rounded-4 border-0" style="width: 320px; background-color: #fff7ed;">
            <div class="card-body">
                <div class="text-center">
                    <div class="mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="#f97316" class="bi bi-check-circle" viewBox="0 0 16 16">
                            <path d="M15.854 7.646a.5.5 0 1 1-.708.708L7.5 1.707 1.854 7.354a.5.5 0 1 1-.708-.708L7.146.293a.5.5 0 0 1 .708 0l7.999 7.353z"/>
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0-1A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"/>
                        </svg>
                    </div>
                    <h5 class="fw-bold text-dark">¡Éxito!</h5>
                    <p class="text-secondary small mb-3">{{ session('success') }}</p>
                    <button class="btn btn-sm btn-warning px-3" onclick="document.getElementById('customAlert').remove()">OK, entendido</button>
                </div>
            </div>
        </div>
    </div>
@endif

        </tbody>
    </table>
</div>
@endsection
