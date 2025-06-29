@extends('sstsena::layouts.master')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm rounded-3" style="background-color: #ffffff;">
        <div class="card-header" style="background-color: #f8f9fa;">
            <h3 class="text-center" style="color: #1a3c6e; font-weight: 600;">
                Respuestas a Todos los Eventos de SST
            </h3>
        </div>
        <div class="card-body p-4">
            <!-- Filtro por fecha -->
            <form method="GET" class="d-flex align-items-center gap-2 mb-4">
                <input type="date" name="date_filter" value="{{ request('date_filter') }}" class="form-control w-auto" />
                <button type="submit" class="btn btn-outline-primary">Filtrar</button>
            </form>

            {{-- ACCIDENTES --}}
            <h4 class="mt-4" style="color: #1a3c6e;"><i class="bi bi-activity"></i> Accidentes</h4>
            @forelse ($accidentResponses as $accident)
                <div class="card mb-3 shadow-sm border-0">
                    <div class="card-header bg-light">
                        <strong style="color: #1a3c6e;">Accidente #{{ $accident->id }}: </strong>
                        {{ $accident->titulo ?? 'Sin título' }}
                    </div>
                    <div class="card-body">
                        @forelse ($accident->eventResponses as $response)
                            <div class="mb-3">
                                <strong style="color: #34495e;">{{ $response->createdBy->name ?? 'Sin usuario' }}</strong>
                                <span class="text-muted">({{ $response->response_date }})</span>
                                <p>{{ $response->response }}</p>
                            </div>
                        @empty
                            <p class="text-muted">No hay respuestas registradas.</p>
                        @endforelse
                    </div>
                </div>
            @empty
                <p class="text-muted">No se encontraron accidentes.</p>
            @endforelse

            {{-- INCIDENTES --}}
            <h4 class="mt-4" style="color: #1a3c6e;"><i class="bi bi-exclamation-circle"></i> Incidentes</h4>
            @forelse ($incidentResponses as $incident)
                <div class="card mb-3 shadow-sm border-0">
                    <div class="card-header bg-light">
                        <strong style="color: #1a3c6e;">Incidente #{{ $incident->id }}: </strong>
                        {{ $incident->titulo ?? 'Sin título' }}
                    </div>
                    <div class="card-body">
                        @forelse ($incident->eventResponses as $response)
                            <div class="mb-3">
                                <strong style="color: #34495e;">{{ $response->createdBy->name ?? 'Sin usuario' }}</strong>
                                <span class="text-muted">({{ $response->response_date }})</span>
                                <p>{{ $response->response }}</p>
                            </div>
                        @empty
                            <p class="text-muted">No hay respuestas registradas.</p>
                        @endforelse
                    </div>
                </div>
            @empty
                <p class="text-muted">No se encontraron incidentes.</p>
            @endforelse

            {{-- EMERGENCIAS --}}
            <h4 class="mt-4" style="color: #1a3c6e;"><i class="bi bi-fire"></i> Emergencias</h4>
            @forelse ($emergencyResponses as $emergency)
                <div class="card mb-3 shadow-sm border-0">
                    <div class="card-header bg-light">
                        <strong style="color: #1a3c6e;">Emergencia #{{ $emergency->id }}: </strong>
                        {{ $emergency->titulo ?? 'Sin título' }}
                    </div>
                    <div class="card-body">
                        @forelse ($emergency->eventResponses as $response)
                            <div class="mb-3">
                                <strong style="color: #34495e;">{{ $response->createdBy->name ?? 'Sin usuario' }}</strong>
                                <span class="text-muted">({{ $response->response_date }})</span>
                                <p>{{ $response->response }}</p>
                            </div>
                        @empty
                            <p class="text-muted">No hay respuestas registradas.</p>
                        @endforelse
                    </div>
                </div>
            @empty
                <p class="text-muted">No se encontraron emergencias.</p>
            @endforelse

            {{-- ACTOS INSEGUROS --}}
            <h4 class="mt-4" style="color: #1a3c6e;"><i class="bi bi-shield-exclamation"></i> Actos Inseguros</h4>
            @forelse ($unsafeActResponses as $unsafeAct)
                <div class="card mb-3 shadow-sm border-0">
                    <div class="card-header bg-light">
                        <strong style="color: #1a3c6e;">Acto Inseguro #{{ $unsafeAct->id }}: </strong>
                        {{ $unsafeAct->titulo ?? 'Sin título' }}
                    </div>
                    <div class="card-body">
                        @forelse ($unsafeAct->eventResponses as $response)
                            <div class="mb-3">
                                <strong style="color: #34495e;">{{ $response->createdBy->name ?? 'Sin usuario' }}</strong>
                                <span class="text-muted">({{ $response->response_date }})</span>
                                <p>{{ $response->response }}</p>
                            </div>
                        @empty
                            <p class="text-muted">No hay respuestas registradas.</p>
                        @endforelse
                    </div>
                </div>
            @empty
                <p class="text-muted">No se encontraron actos inseguros.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
