@extends('sstsena::layouts.master')
@section('content')

<!-- Success Alerts -->
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="corporate-card shadow-sm mb-4">
    <div class="section-header" style="border-left: 4px solid  #FF8C00;">
        <div class="section-content d-flex justify-content-between align-items-center py-4 px-4">
            <div class="d-flex align-items-center">
                <div class="section-icon me-4">
                    <i class="fas fa-exclamation-triangle fa-lg" style="color: #FF8C00;"></i>
                </div>
                <div>
                    <h4 class="mb-1 fw-semibold text-dark">Gestión de Incidentes</h4>
                    <small class="text-muted">Sistema de registro y seguimiento</small>
                </div>
            </div>
            <div class="stats-container">
                <div class="stats-number">{{ $incidents->count() }}</div>
                <div class="stats-label">Registros</div>
            </div>
        </div>
    </div>

    <div class="px-4 py-3">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
            <!-- Botones de acción -->
            <div class="d-flex gap-2">
                <a href="{{ route('sstsena.funcionario.incidents.create') }}" class="corporate-btn" style="border-color: #28a745; background: #d4edda; color: #155724;">
                    <i class="bi bi-plus-circle-fill me-1"></i> Nuevo Incidente
                </a>
            </div>

            <!-- Filtro por Fecha -->
            <form method="GET" action="{{ route('sstsena.funcionario.incidents.index') }}" class="d-flex align-items-center gap-2">
                <input type="date" name="fecha" class="form-control form-control-sm" value="{{ request('fecha') }}" style="width: 180px;">
                <button type="submit" class="corporate-btn" style="border-color: #007bff;">
                    <i class="bi bi-search"></i> Filtrar
                </button>
                <a href="{{ route('sstsena.funcionario.incidents.index') }}" class="corporate-btn" style="border-color: #6c757d;">
                    <i class="bi bi-x-circle"></i> Limpiar
                </a>
            </form>
        </div>
    </div>
</div>

<!-- Tabla -->
<div class="corporate-card shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover mb-0 corporate-table">
            <thead>
                <tr class="corporate-header-row">
                    <th class="corporate-th">#</th>
                    <th class="corporate-th">Fecha y Hora</th>
                    <th class="corporate-th">Ubicación</th>
                    <th class="corporate-th">Tipo de Riesgo</th>
                    <th class="corporate-th">Tipo de Incidente</th>
                    <th class="corporate-th">Descripción Del Incidente</th>
                    <th class="corporate-th">Gravedad</th>
                    <th class="corporate-th">Evidencia</th>
                    <th class="corporate-th">Creado por</th>
                    <th class="corporate-th text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($incidents as $incident)
                <tr class="corporate-row">
                    <td class="corporate-cell">
                        <span class="fw-bold" style="color: #e63946;">{{ $loop->iteration }}</span>
                    </td>
                    <td class="corporate-cell">{{ $incident->date_time }}</td>
                    <td class="corporate-cell">{{ $incident->environment->name ?? 'N/A' }}</td>
                    <td class="corporate-cell">{{ $incident->riskType->name ?? 'N/A' }}</td>
                    <td class="corporate-cell">{{ $incident->incidentType->name ?? 'N/A' }}</td>
                    <td class="corporate-cell">
                        @php
                            $maxLength = 100;
                            $description = $incident->description;
                            $isLong = strlen($description) > $maxLength;
                            $shortDescription = Str::limit($description, $maxLength);
                        @endphp
                        {{ $shortDescription }}
                        @if($isLong)
                            <button type="button" class="btn btn-link p-0 text-primary text-decoration-none" 
                                    onclick="showDescriptionModal('{{ $incident->id }}', `{{ addslashes($description) }}`)">
                                Ver más
                            </button>
                        @endif
                    </td>
                    <td class="corporate-cell">
                        @switch($incident->severity)
                            @case('minor')
                                <span class="severity-badge severity-low">
                                    <div class="severity-indicator"></div>
                                    <span>Leve</span>
                                </span>
                            @break
                            @case('moderate')
                                <span class="severity-badge severity-medium">
                                    <div class="severity-indicator"></div>
                                    <span>Moderada</span>
                                </span>
                            @break
                            @case('serious')
                                <span class="severity-badge severity-high">
                                    <div class="severity-indicator"></div>
                                    <span>Grave</span>
                                </span>
                            @break
                            @case('fatal')
                                <span class="severity-badge severity-critical">
                                    <div class="severity-indicator"></div>
                                    <span>Fatal</span>
                                </span>
                            @break
                            @default
                                <span class="severity-badge severity-pending">
                                    <div class="severity-indicator"></div>
                                    <span>No definido</span>
                                </span>
                        @endswitch
                    </td>
                    <td class="corporate-cell text-center">
                        @if($incident->evidence)
                        @php
                        $ext = strtolower(pathinfo($incident->evidence, PATHINFO_EXTENSION));
                        $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                        $isImage = in_array($ext, $imageExtensions);
                        @endphp
                        @if($isImage)
                        <button type="button" class="btn p-0 border-0 bg-transparent" 
                                onclick="showEvidenceModal('{{ $incident->id }}', '{{ asset('storage/evidences/' . $incident->evidence) }}')">
                            <img src="{{ asset('storage/evidences/' . $incident->evidence) }}" alt="Evidencia"
                                class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;">
                        </button>
                        @else
                        <a href="{{ asset('storage/evidences/' . $incident->evidence) }}"
                            class="corporate-btn" target="_blank" style="border-color: #007bff;">Ver archivo</a>
                        @endif
                        @else
                        <span class="text-muted">Sin evidencia</span>
                        @endif
                    </td>
                   <td class="corporate-cell midterm-ignore">
    <div class="created-by-info">
        <span class="fw-semibold text-dark">
            {{ $incident->user->person->first_name ?? 'Desconocido' }}
            {{ $incident->user->person->last_name ?? '' }}
        </span>
      
    </div>
</td>
                    <td class="corporate-cell text-center">
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('sstsena.funcionario.incidents.edit', $incident->id) }}"
                                class="corporate-btn corporate-btn-edit">Editar</a>
                            <form action="{{ route('sstsena.funcionario.incidents.destroy', $incident->id) }}"
                                method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este incidente?')">
                                @csrf
                                @method('DELETE')
                               
                            </form>
                        </div>
                    </td>
                    <td class="text-center corporate-cell">
                                            <a href="{{ route('sstsena.incidents.responses.index', $item->id) }}" class="corporate-btn">
                                                <i class="fas fa-folder-open me-2"></i>
                                                <span>Revisar Caso</span>
                                            </a>
                                        </td>

                </tr>
                @empty
                <tr>
                    <td colspan="10" class="text-center py-5">
                        <div class="empty-state-corporate">
                            <div class="empty-icon mb-3">
                                <i class="fas fa-exclamation-triangle fa-3x text-muted opacity-25"></i>
                            </div>
                            <h6 class="text-muted mb-2 fw-normal">No hay incidentes registrados</h6>
                            <p class="text-muted mb-0 small">Los nuevos registros aparecerán aquí automáticamente</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Universal para Descripción -->
<div class="modal fade" id="descriptionModal" tabindex="-1" aria-labelledby="descriptionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="descriptionModalLabel">Descripción Completa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="descriptionContent"></p>
            </div>
        </div>
    </div>
</div>

<!-- Modal Universal para Evidencia -->
<div class="modal fade" id="evidenceModal" tabindex="-1" aria-labelledby="evidenceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="evidenceModalLabel">Evidencia</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="evidenceImage" src="" alt="Evidencia" class="img-fluid rounded"
                    style="max-height: 400px; object-fit: contain;">
            </div>
        </div>
    </div>
</div>

<style>
/* Variables corporativas */
:root {
    --corporate-border: #e9ecef;
    --corporate-hover: #f1f3f4;
    --corporate-text: #343a40;
    --corporate-muted: #6c757d;
}

/* Tarjetas corporativas */
.corporate-card {
    background: white;
    border-radius: 8px;
    border: 1px solid var(--corporate-border);
    overflow: hidden;
}

/* Header de sección */
.section-header {
    background: #f8f9fa;
    border-bottom: 1px solid var(--corporate-border);
}

.section-icon {
    width: 48px;
    height: 48px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #e6394615;
    border: 1px solid rgba(0, 0, 0, 0.08);
}

.stats-container {
    text-align: center;
    min-width: 80px;
}

.stats-number {
    font-size: 1.75rem;
    font-weight: 700;
    color: var(--corporate-text);
    line-height: 1;
}

.stats-label {
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: var(--corporate-muted);
    font-weight: 600;
}

/* Tabla corporativa */
.corporate-table {
    font-size: 0.9rem;
}

.corporate-header-row {
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    border-bottom: 2px solid var(--corporate-border);
}

.corporate-th {
    font-weight: 600;
    font-size: 0.8rem;
    letter-spacing: 0.3px;
    text-transform: uppercase;
    color: var(--corporate-muted);
    padding: 1.25rem 1rem;
    border: none;
    white-space: nowrap;
}

.corporate-cell {
    padding: 1.25rem 1rem;
    vertical-align: middle;
    border-bottom: 1px solid #f8f9fa;
    transition: background-color 0.2s ease;
}

.corporate-row:hover .corporate-cell {
    background-color: var(--corporate-hover);
}

/* Botones corporativos */
.corporate-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    background: white;
    color: var(--corporate-text);
    border: 2px solid var(--corporate-border);
    border-radius: 6px;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.875rem;
    transition: all 0.2s ease;
    white-space: nowrap;
}

.corporate-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.12);
    text-decoration: none;
}

.corporate-btn-edit {
    background: #d4edda;
    color: #155724;
    border-color: #28a745;
}

.corporate-btn-delete {
    background: #f8d7da;
    color: #721c24;
    border-color: #dc3545;
}

/* Corporate severity badges */
.severity-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 0.875rem;
    border-radius: 6px;
    font-weight: 600;
    font-size: 0.8rem;
    text-transform: uppercase;
    letter-spacing: 0.3px;
    border: 1px solid transparent;
    transition: all 0.2s ease;
}

.severity-indicator {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    flex-shrink: 0;
}

.severity-low {
    background-color: #d4edda;
    color: #155724;
    border-color: #c3e6cb;
}

.severity-low .severity-indicator {
    background-color: #28a745;
}

.severity-medium {
    background-color: #fff3cd;
    color: #856404;
    border-color: #ffeaa7;
}

.severity-medium .severity-indicator {
    background-color: #ffc107;
}

.severity-high {
    background-color: #f8d7da;
    color: #721c24;
    border-color: #f5c6cb;
}

.severity-high .severity-indicator {
    background-color: #e63946;
}

.severity-critical {
    background-color: #f5f5f5;
    color: #495057;
    border-color: #dee2e6;
}

.severity-critical .severity-indicator {
    background-color: #343a40;
}

.severity-pending {
    background-color: #e2e3e5;
    color: #383d41;
    border-color: #d6d8db;
}

.severity-pending .severity-indicator {
    background-color: #6c757d;
}

/* Estado vacío */
.empty-state-corporate {
    padding: 3rem 2rem;
}

/* Responsive */
@media (max-width: 768px) {
    .stats-container { display: none; }
    .section-content { flex-direction: column; align-items: flex-start !important; gap: 1rem; }
    .corporate-th { font-size: 0.7rem; padding: 1rem 0.75rem; }
    .corporate-cell { padding: 1rem 0.75rem; }
    .corporate-btn { padding: 0.4rem 0.8rem; font-size: 0.75rem; }
}
</style>

<script>
// Función para mostrar el modal de descripción
function showDescriptionModal(incidentId, description) {
    document.getElementById('descriptionContent').textContent = description;
    const modal = new bootstrap.Modal(document.getElementById('descriptionModal'));
    modal.show();
}

// Función para mostrar el modal de evidencia
function showEvidenceModal(incidentId, imageSrc) {
    document.getElementById('evidenceImage').src = imageSrc;
    const modal = new bootstrap.Modal(document.getElementById('evidenceModal'));
    modal.show();
}

// Limpiar modales al cerrar para evitar conflictos
document.addEventListener('DOMContentLoaded', function() {
    // Limpiar modal de descripción
    document.getElementById('descriptionModal').addEventListener('hidden.bs.modal', function () {
        document.getElementById('descriptionContent').textContent = '';
    });
    
    // Limpiar modal de evidencia
    document.getElementById('evidenceModal').addEventListener('hidden.bs.modal', function () {
        document.getElementById('evidenceImage').src = '';
    });
});
</script>

@endsection