@extends('sstsena::layouts.master')

@section('content')
<div class="container mt-4">
    <h2 class="text-white mb-4">📋 Todas las Respuestas a Eventos SST</h2>

    <!-- Filtro por fecha -->
    <form method="GET" class="d-flex align-items-center gap-2 mb-4">
        <input type="date" name="date_filter" value="{{ request('date_filter') }}" class="form-control w-auto" />
        <button type="submit" class="btn btn-outline-primary">Filtrar</button>
    </form>

    <div class="accordion" id="eventResponsesAccordion">
        <!-- ACCIDENTES -->
        <div class="accordion-item bg-dark border-secondary mb-3">
            <h2 class="accordion-header">
                <button class="accordion-button bg-black text-white" type="button" data-bs-toggle="collapse" data-bs-target="#accidentes">
                    🚑 Accidentes
                </button>
            </h2>
            <div id="accidentes" class="accordion-collapse collapse show" data-bs-parent="#eventResponsesAccordion">
                <div class="accordion-body">
                    @forelse ($accidentResponses as $accident)
                        <div class="card bg-secondary text-white mb-3">
                            <div class="card-header fw-bold">
                                {{ $accident->titulo ?? 'Accidente #' . $accident->id }}
                            </div>
                            <div class="card-body">
                                @forelse ($accident->eventResponses as $response)
                                    <div class="mb-2">
                                        <span class="fw-bold">{{ $response->createdBy->name ?? 'Sin usuario' }}</span> —
                                        <span class="text-info">{{ $response->response_date }}</span><br>
                                        <span>{{ $response->response }}</span>
                                    </div>
                                @empty
                                    <p class="text-warning">No hay respuestas registradas.</p>
                                @endforelse
                            </div>
                        </div>
                    @empty
                        <p class="text-muted">No hay accidentes con respuestas.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- INCIDENTES -->
        <div class="accordion-item bg-dark border-secondary mb-3">
            <h2 class="accordion-header">
                <button class="accordion-button bg-black text-white collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#incidentes">
                    ⚠️ Incidentes
                </button>
            </h2>
            <div id="incidentes" class="accordion-collapse collapse" data-bs-parent="#eventResponsesAccordion">
                <div class="accordion-body">
                    @forelse ($incidentResponses as $incident)
                        <div class="card bg-secondary text-white mb-3">
                            <div class="card-header fw-bold">
                                {{ $incident->titulo ?? 'Incidente #' . $incident->id }}
                            </div>
                            <div class="card-body">
                                @forelse ($incident->eventResponses as $response)
                                    <div class="mb-2">
                                        <span class="fw-bold">{{ $response->createdBy->name ?? 'Sin usuario' }}</span> —
                                        <span class="text-info">{{ $response->response_date }}</span><br>
                                        <span>{{ $response->response }}</span>
                                    </div>
                                @empty
                                    <p class="text-warning">No hay respuestas registradas.</p>
                                @endforelse
                            </div>
                        </div>
                    @empty
                        <p class="text-muted">No hay incidentes con respuestas.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- EMERGENCIAS -->
        <div class="accordion-item bg-dark border-secondary mb-3">
            <h2 class="accordion-header">
                <button class="accordion-button bg-black text-white collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#emergencias">
                    🔥 Emergencias
                </button>
            </h2>
            <div id="emergencias" class="accordion-collapse collapse" data-bs-parent="#eventResponsesAccordion">
                <div class="accordion-body">
                    @forelse ($emergencyResponses as $emergency)
                        <div class="card bg-secondary text-white mb-3">
                            <div class="card-header fw-bold">
                                {{ $emergency->titulo ?? 'Emergencia #' . $emergency->id }}
                            </div>
                            <div class="card-body">
                                @forelse ($emergency->eventResponses as $response)
                                    <div class="mb-2">
                                        <span class="fw-bold">{{ $response->createdBy->name ?? 'Sin usuario' }}</span> —
                                        <span class="text-info">{{ $response->response_date }}</span><br>
                                        <span>{{ $response->response }}</span>
                                    </div>
                                @empty
                                    <p class="text-warning">No hay respuestas registradas.</p>
                                @endforelse
                            </div>
                        </div>
                    @empty
                        <p class="text-muted">No hay emergencias con respuestas.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- ACTOS INSEGUROS -->
        <div class="accordion-item bg-dark border-secondary">
            <h2 class="accordion-header">
                <button class="accordion-button bg-black text-white collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#actos">
                    ❌ Actos Inseguros
                </button>
            </h2>
            <div id="actos" class="accordion-collapse collapse" data-bs-parent="#eventResponsesAccordion">
                <div class="accordion-body">
                    @forelse ($unsafeActResponses as $unsafeAct)
                        <div class="card bg-secondary text-white mb-3">
                            <div class="card-header fw-bold">
                                {{ $unsafeAct->titulo ?? 'Acto Inseguro #' . $unsafeAct->id }}
                            </div>
                            <div class="card-body">
                                @forelse ($unsafeAct->eventResponses as $response)
                                    <div class="mb-2">
                                        <span class="fw-bold">{{ $response->createdBy->name ?? 'Sin usuario' }}</span> —
                                        <span class="text-info">{{ $response->response_date }}</span><br>
                                        <span>{{ $response->response }}</span>
                                    </div>
                                @empty
                                    <p class="text-warning">No hay respuestas registradas.</p>
                                @endforelse
                            </div>
                        </div>
                    @empty
                        <p class="text-muted">No hay actos inseguros con respuestas.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
