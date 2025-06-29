@extends('sstsena::layouts.master')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm rounded-3" style="background-color: #ffffff;">
        <div class="card-header" style="background-color: #f8f9fa; border-bottom: 1px solid #dee2e6;">
            <h3 class="text-center" style="color: #1a3c6e; font-weight: 600;">
                Respuestas a Todos los Eventos SST
            </h3>
        </div>
        <div class="card-body p-4">
            <!-- Filtro por fecha -->
            <form method="GET" class="d-flex align-items-center gap-2 mb-4">
                <input type="date" name="date_filter" value="{{ request('date_filter') }}" class="form-control w-auto" />
                <button type="submit" class="btn btn-outline-primary">Filtrar</button>
            </form>

            {{-- Sección por tipo de evento --}}
            @php
                $tipos = [
                    ['titulo' => 'Accidentes', 'items' => $accidentResponses],
                    ['titulo' => 'Incidentes', 'items' => $incidentResponses],
                    ['titulo' => 'Emergencias', 'items' => $emergencyResponses],
                    ['titulo' => 'Actos Inseguros', 'items' => $unsafeActResponses],
                ];
            @endphp

            @foreach ($tipos as $tipo)
                <h4 class="mt-4" style="color: #1a3c6e;">{{ $tipo['titulo'] }}</h4>

                @forelse ($tipo['items'] as $evento)
                    <div class="card mb-4 shadow-sm border-0">
                        <div class="card-header bg-light" style="color: #1a3c6e; font-weight: 500;">
                            {{ $evento->titulo ?? ($tipo['titulo'] . ' #' . $evento->id) }}
                        </div>
                        <div class="card-body">
                            @forelse ($evento->eventResponses as $response)
                                <div class="border-start ps-3 mb-3">
                                    <p style="margin-bottom: 0;">
                                        <strong style="color: #34495e;">{{ $response->createdBy->name ?? 'Sin usuario' }}</strong>
                                        <small class="text-muted">({{ $response->response_date }})</small>
                                    </p>
                                    <p class="mb-1">{{ $response->response }}</p>
                                    <div class="text-end">
                                     
                                        <form action="{{ route('sstsena.' . strtolower(str_replace(' ', '_', $tipo['titulo'])) . '.responses.destroy', [$evento->id, $response->id]) }}"
                                              method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Estás seguro de eliminar esta respuesta?')">
                                                <i class="bi bi-trash"></i> Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @empty
                                <p class="text-muted">No hay respuestas registradas.</p>
                            @endforelse
                        </div>
                    </div>
                @empty
                    <p class="text-muted">No se encontraron {{ strtolower($tipo['titulo']) }}.</p>
                @endforelse
            @endforeach
        </div>
    </div>
</div>
@endsection
