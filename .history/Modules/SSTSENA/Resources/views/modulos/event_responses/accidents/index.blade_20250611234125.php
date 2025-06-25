@extends('sstsena::layouts.master')

@section('content')
<div class="container mt-5">
    <h1 style="color: #1a3c6e; font-weight: 600;">Respuestas para Accidente #{{ $event->id }}</h1>
    
    <a href="{{ route('sstsena.accidents.responses.create', $event->id) }}" 
       class="btn btn-primary mb-4" 
       style="background-color: #1a3c6e; border-color: #1a3c6e;">
        Agregar Respuesta
    </a>

    <div class="table-responsive">
        <table class="table table-bordered table-hover" style="background-color: #ffffff; border: 1px solid #dee2e6;">
            <thead style="background-color: #f8f9fa; color: #34495e;">
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
                        <a href="{{ route('sstsena.accidents.responses.edit', [$event->id, $response->id]) }}" 
                           class="btn btn-sm btn-outline-warning px-3" 
                           style="border-color: #ffc107; color: #34495e;">Editar</a>

                        <form action="{{ route('sstsena.accidents.responses.destroy', [$event->id, $response->id]) }}" 
                              method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="btn btn-sm btn-outline-danger px-3" 
                                    style="border-color: #dc3545; color: #34495e;" 
                                    onclick="return confirm('¿Estás seguro?')">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted">No se encontraron respuestas.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Alerta de éxito --}}
    @if(session('success'))
        <div id="alertaExito" class="position-fixed top-50 start-50 translate-middle bg-white border border-success text-center p-4 rounded shadow" style="z-index:9999; width: 350px;">
            <div class="text-success fs-1">✔️</div>
            <h5 class="mt-2 text-success">¡Éxito!</h5>
            <p class="mb-0 text-muted">{{ session('success') }}</p>
        </div>

        <script>
            setTimeout(() => document.getElementById('alertaExito')?.remove(), 3000);
        </script>
    @endif
</div>
@endsection
