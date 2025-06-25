@extends('sstsena::layouts.master')
@section('content')

<div class="corporate-card shadow-sm mb-4">
    <div class="section-header" style="border-left: 4px solid #e63946;">
        <div class="section-content d-flex justify-content-between align-items-center py-4 px-4">
            <div class="d-flex align-items-center">
                <div class="section-icon me-4">
                    <i class="fas fa-exclamation-triangle fa-lg" style="color: #e63946;"></i>
                </div>
                <div>
                    <h4 class="mb-1 fw-semibold text-dark">Gestión de Accidentes</h4>
                    <small class="text-muted">Sistema de registro y seguimiento</small>
                </div>
            </div>
            <div class="stats-container">
                <div class="stats-number">{{ $accidents->count() }}</div>
                <div class="stats-label">Registros</div>
            </div>
        </div>
    </div>

    <div class="px-4 py-3">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
            <!-- Botones de acción -->
            <div class="d-flex gap-2">
                <a href="{{ route('sstsena.funcionario.accidents.create') }}" class="corporate-btn" style="border-color: #28a745; background: #d4edda; color: #155724;">
                    <i class="bi bi-plus-circle-fill me-1"></i> Nuevo Accidente
                </a>
                <button class="corporate-btn" data-bs-toggle="modal" data-bs-target="#agregarPersonaModal" style="border-color: #007bff; background: #cce7ff; color: #004085;">
                    <i class="bi bi-person-plus-fill me-1"></i> Personas Involucradas
                </button>
            </div>

            <!-- Filtro por Fecha -->
            <form method="GET" action="{{ route('sstsena.funcionario.accidents.index') }}" class="d-flex align-items-center gap-2">
                <input type="date" name="fecha" class="form-control form-control-sm" value="{{ request('fecha') }}" style="width: 180px;">
                <button type="submit" class="corporate-btn" style="border-color: #007bff;">
                    <i class="bi bi-search"></i> Filtrar
                </button>
                <a href="{{ route('sstsena.funcionario.accidents.index') }}" class="corporate-btn" style="border-color: #6c757d;">
                    <i class="bi bi-x-circle"></i> Limpiar
                </a>
            </form>
        </div>
    </div>

    <!-- Modal personas involucradas -->
    <div class="modal fade" id="agregarPersonaModal" tabindex="-1" aria-labelledby="agregarPersonaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" style="margin-top: 60px; max-width: 800px;">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title text-primary" id="agregarPersonaModalLabel" style="font-size: 1.1rem; text-align: center; width: 100%;">
                        Crear Persona Involucrada
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('sstsena.funcionario.people_involved.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="document_type" class="form-label">Tipo de Documento</label>
                                <select name="document_type" id="document_type" class="form-select" required>
                                    <option value="">Seleccione una opción</option>
                                    <option value="CC">Cédula de Ciudadanía</option>
                                    <option value="TI">Tarjeta de Identidad</option>
                                    <option value="CE">Cédula de Extranjería</option>
                                    <option value="PAS">Pasaporte</option>
                                    <option value="OTRO">Otro</option>
                                </select>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="document_number" class="form-label">Número de Documento</label>
                                <input type="text" name="document_number" id="document_number" class="form-control" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="name" class="form-label">Nombre</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="last_name" class="form-label">Apellido</label>
                                <input type="text" name="last_name" id="last_name" class="form-control" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="birth_date" class="form-label">Fecha de Nacimiento</label>
                                <input type="date" name="birth_date" id="birth_date" class="form-control" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="gender" class="form-label">Género</label>
                                <select name="gender" id="gender" class="form-select" required>
                                    <option value="">Selecciona una opción</option>
                                    <option value="Masculino">Masculino</option>
                                    <option value="Femenino">Femenino</option>
                                    <option value="Otro">Otro</option>
                                </select>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="person_type_id" class="form-label">Tipo de Persona</label>
                                <select name="person_type_id" id="person_type_id" class="form-select" required>
                                    <option value="">Seleccione una opción</option>
                                    @foreach ($typePersons as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="phone" class="form-label">Teléfono</label>
                                <input type="text" name="phone" id="phone" class="form-control">
                            </div>
                            <div class="mb-3 col-md-12">
                                <label for="address" class="form-label">Dirección</label>
                                <input type="text" name="address" id="address" class="form-control">
                            </div>
                            <div class="mb-3 col-md-12">
                                <label for="accident_id" class="form-label">Accidente Asociado</label>
                                <select name="accident_id" id="accident_id" class="form-select" required>
                                    <option value="">Seleccione un accidente</option>
                                    @foreach ($accidents as $accident)
                                        <option value="{{ $accident->id }}" title="{{ $accident->description }}">
                                            {{ $accident->id . ' - ' . Str::limit($accident->description, 60) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="text-center mt-3">
                            <button type="submit" class="corporate-btn" style="border-color: #28a745; background: #d4edda; color: #155724;">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
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
                    <th class="corporate-th">Tipo de Lesión</th>
                    <th class="corporate-th">Tipo de Riesgo</th>
                    <th class="corporate-th">Tipo de Accidente</th>
                    <th class="corporate-th">Descripción de</th>
                    <th class="corporate-th">Gravedad</th>
                    <th class="corporate-th">Evidencia</th>
                    <th class="corporate-th">Creado por</th>
                    <th class="corporate-th text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($accidents as $accident)
                <tr class="corporate-row">
                    <td class="corporate-cell">
                        <span class="fw-bold" style="color: #e63946;">{{ $loop->iteration }}</span>
                    </td>
                    <td class="corporate-cell">{{ $accident->date_time }}</td>
                    <td class="corporate-cell">{{ $accident->environment->name ?? 'N/A' }}</td>
                    <td class="corporate-cell">{{ $accident->injuryType->name ?? 'N/A' }}</td>
                    <td class="corporate-cell">{{ $accident->riskType->name ?? 'N/A' }}</td>
                    <td class="corporate-cell">{{ $accident->accidentType->name ?? 'N/A' }}</td>
                    <td class="corporate-cell">
                        @php
                            $maxLength = 100;
                            $description = $accident->description;
                            $isLong = strlen($description) > $maxLength;
                            $shortDescription = Str::limit($description, $maxLength);
                        @endphp
                        {{ $shortDescription }}
                        @if($isLong)
                            <button type="button" class="btn btn-link p-0 text-primary text-decoration-none" 
                                    onclick="showDescriptionModal('{{ $accident->id }}', `{{ addslashes($description) }}`)">
                                Ver más
                            </button>
                        @endif
                    </td>
                    <td class="corporateced-cell">
                        @switch($accident->severity)
                            @case('Minor')
                                <span class="severity-badge severity-low">
                                    <div class="severity-indicator"></div>
                                    <span>Menor</span>
                                </span>
                            @break
                            @case('Moderate')
                                <span class="severity-badge severity-medium">
                                    <div class="severity-indicator"></div>
                                    <span>Moderada</span>
                                </span>
                            @break
                            @case('Serious')
                                <span class="severity-badge severity-high">
                                    <div class="severity-indicator"></div>
                                    <span>Grave</span>
                                </span>
                            @break
                            @case('Fatal')
                                <span class="severity-badge severity-critical">
                                    <div class="severity-indicator"></div>
                                    <span>Fatal</span>
                                </span>
                            @break
                        @endswitch
                    </td>
                    <td class="corporate-cell text-center">
                        @if($accident->evidence)
                        @php
                        $ext = strtolower(pathinfo($accident->evidence, PATHINFO_EXTENSION));
                        $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                        $isImage = in_array($ext, $imageExtensions);
                        @endphp
                        @if($isImage)
                        <button type="button" class="btn p-0 border-0 bg-transparent" 
                                onclick="showEvidenceModal('{{ $accident->id }}', '{{ asset('storage/evidences/' . $accident->evidence) }}')">
                            <img src="{{ asset('storage/evidences/' . $accident->evidence) }}" alt="Evidencia"
                                class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;">
                        </button>
                        @else
                        <a href="{{ asset('storage/evidences/' . $accident->evidence) }}"
                            class="corporate-btn" target="_blank" style="border-color: #007bff;">Ver archivo</a>
                        @endif
                        @else
                        <span class="text-muted">Sin evidencia</span>
                        @endif
                    </td>
                    <td class="corporate-cell">{{ $accident->user->nickname ?? 'Desconocido' }}</td>
                    <td class="corporate-cell text-center">
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('sstsena.funcionario.accidents.edit', $accident->id) }}"
                                class="corporate-btn corporate-btn-edit">Editar</a>
                            <form action="{{ route('sstsena.funcionario.accidents.destroy', $accident->id) }}"
                                method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este accidente?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="corporate-btn corporate-btn-delete">Eliminar</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="11" class="text-center py-5">
                        <div class="empty-state-corporate">
                            <div class="empty-icon mb-3">
                                <i class="fas fa-exclamation-triangle fa-3x text-muted opacity-25"></i>
                            </div>
                            <h6 class="text-muted mb-2 fw-normal">No hay accidentes registrados</h6>
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
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="descriptionModalLabel">Descripción Completa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <p id="descriptionContent"></p>
            </div>
        </div>
    </div>
</div>

<!-- Modal Universal para Evidencia -->
<div class="modal fade" id="evidenceModal" tabindex="-1" aria-labelledby="evidenceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="evidenceModalLabel">Evidencia</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body text-center">
                <img id="evidenceImage" src="" alt="Evidencia" class="img-fluid rounded"
                    style="max-height: 600px; object-fit: contain;">
            </div>
        </div>
    </div>
</div>

<style>
/* Variables corporativas */
:root {
:—corporate-border #e9ecef;
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

/* Badges de gravedad */
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
.severity-low .severity-indicator { background-color: #28a745; }

.severity-medium {
    background-color: #fff3cd;
    color: #856404;
    border-color: #ffeaa7;
}
.severity-medium .severity-indicator { background-color: #ffc107; }

.severity-high {
    background-color: #f8d7da;
    color: #721c24;
    border-color: #f5c6cb;
}
.severity-high .severity-indicator { background-color: #e63946; }

.severity-critical {
    background-color: #f5f5f5;
    color: #495057;
    border-color: #dee2e6;
}
.severity-critical .severity-indicator { background-color: #343a40; }

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
    font-size: 0.85rem;
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
function showDescriptionModal(accidentId, description) {
    document.getElementById('descriptionContent').textContent = description;
    const modal = new bootstrap.Modal(document.getElementById('descriptionModal'));
    modal.show();
}

// Función para mostrar el modal de evidencia
function showEvidenceModal(accidentId, imageSrc) {
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