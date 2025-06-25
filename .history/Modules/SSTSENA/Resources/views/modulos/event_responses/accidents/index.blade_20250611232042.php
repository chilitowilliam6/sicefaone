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
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1055">
        <div class="toast align-items-center text-bg-success border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    {{ session('success') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Cerrar"></button>
            </div>
        </div>
    </div>
@endif

        </tbody>
    </table>
</div>
@endsection
