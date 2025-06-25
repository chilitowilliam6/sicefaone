@extends('sstsena::layouts.master')
@section('content')

<div class="container-fluid py-4">
    <div class="row g-4">
        <div class="col-12 section-item">
            <!-- Corporate card principal -->
            <div class="corporate-card border-0 shadow-sm">
                <!-- Corporate section header -->
                <div class="section-header" style="border-left: 4px solid #e63946;">
                    <div class="section-content d-flex justify-content-between align-items-center py-4 px-4">
                        <div class="d-flex align-items-center">
                            <div class="section-icon me-4" style="background-color: #e6394615;">
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

                <!-- Buttons and filters -->
                <div class="px-4 py-3">
                    <div class="d-flex align-items-end mb-3 gap-3 justify-content-between">
                        <div class="d-flex align-items-end gap-3">
                            <a href="{{ route('sstsena.funcionario.accidents.create') }}" class="corporate-btn">
                                <i class="fas fa-plus me-2"></i>
                                <span>Nuevo Accidente</span>
                            </a>
                            <button class="corporate-btn" data-bs-toggle="modal" data-bs-target="#agregarPersonaModal">
                                <i class="fas fa-user-plus me-2"></i>
                                <span>Personas Involucradas</span>
                            </button>
                        </div>
                        <div class="d-flex align-items-end gap-3">
                            <form method="GET" action="{{ route('sstsena.funcionario.accidents.index') }}" class="d-flex align-items-end gap-2">
                                <div style="max-width: 140px;">
                                    <label for="fecha" class="form-label small text-muted mb-1">Filtrar por fecha</label>
                                    <input type="date" id="fecha" name="fecha" class="form-control form-control-sm" value="{{ request('fecha') }}">
                                </div>
                                <button type="submit" class="corporate-btn" style="border: 2px solid #adb5bd;">
                                    <i class="fas fa-filter me-2"></i>
                                    <span>Filtrar</span>
                                </button>
                                <a href="{{ route('sstsena.funcionario.accidents.index') }}" class="corporate-btn" style="border: 2px solid #adb5bd;">
                                    <i class="fas fa-times me-2"></i>
                                    <span>Limpiar</span>
                                </a>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Corporate table -->
                <div class="table-container">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 corporate-table">
                            <thead>
                                <tr class="corporate-header-row">
                                    <th class="corporate-th"><div class="th-content"><i class="fas fa-hashtag me-2"></i><span>#</span></div></th>
                                    <th class="corporate-th"><div class="th-content"><i class="fas fa-calendar-alt me-2"></i><span>Fecha y Hora</span></div></th>
                                    <th class="corporate-th"><div class="th-content"><i class="fas fa-map-marker-alt me-2"></i><span>Ubicación</span></div></th>
                                    <th class="corporate-th"><div class="th-content"><i class="fas fa-medkit me-2"></i><span>Tipo de Lesión</span></div></th>
                                    <th class="corporate-th"><div class="th-content"><i class="fas fa-exclamation-triangle me-2"></i><span>Tipo de Riesgo</span></div></th>
                                    <th class="corporate-th"><div class="th-content"><i class="fas fa-warning me-2"></i><span>Tipo de Accidente</span></div></th>
                                    <th class="corporate-th"><div class="th-content"><i class="fas fa-file-alt me-2"></i><span>Descripción</span></div></th>
                                    <th class="corporate-th"><div class="th-content"><i class="fas fa-thermometer-half me-2"></i><span>Gravedad</span></div></th>
                                    <th class="corporate-th"><div class="th-content"><i class="fas fa-camera me-2"></i><span>Evidencia</span></div></th>
                                    <th class="corporate-th"><div class="th-content"><i class="fas fa-user me-2"></i><span>Creado por</span></div></th>
                                    <th class="corporate-th text-center"><div class="th-content justify-content-center"><i class="fas fa-tools me-2"></i><span>Acciones</span></div></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($accidents as $accident)
                                <tr class="corporate-row">
                                    <td class="corporate-cell">
                                        <div class="reference-id">
                                            <span class="fw-bold" style="color: #e63946;">{{ $loop->iteration }}</span>
                                        </div>
                                    </td>
                                    <td class="corporate-cell">
                                        <div class="datetime-info">
                                            <div class="fw-semibold text-dark">{{ \Carbon\Carbon::parse($accident->date_time)->format('d M Y') }}</div>
                                            <small class="text-muted">
                                                <i class="fas fa-clock me-1"></i>{{ \Carbon\Carbon::parse($accident->date_time)->format('H:i') }}
                                            </small>
                                        </div>
                                    </td>
                                    <td class="corporate-cell">{{ $accident->environment->name ?? 'N/A' }}</td>
                                    <td class="corporate-cell">{{ $accident->injuryType->name ?? 'N/A' }}</td>
                                    <td class="corporate-cell">{{ $accident->riskType->name ?? 'N/A' }}</td>
                                    <td class="corporate-cell">{{ $accident->accidentType->name ?? 'N/A' }}</td>
                                    <td class="corporate-cell">
                                        <div class="description-content">
                                            @php
                                                $maxLength = 100;
                                                $description = $accident->description;
                                                $isLong = strlen($description) > $maxLength;
                                                $shortDescription = Str::limit($description, $maxLength);
                                                $modalId = 'descriptionModal' . $accident->id;
                                            @endphp
                                            <p class="mb-0 text-dark lh-sm expandable-text" id="desc-{{ $accident->id }}"
                                               style="max-height: 3em; overflow: hidden; transition: max-height 0.3s ease;">
                                                {{ $description }}
                                            </p>
                                            @if($isLong)
                                                <small class="text-muted mt-1 d-block toggle-text" onclick="toggleText('desc-{{ $accident->id }}')">
                                                    <i class="fas fa-chevron-down me-1 toggle-icon"></i>
                                                    <span class="toggle-label">Mostrar más</span>
                                                </small>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="corporate-cell">
                                        @switch($accident->severity)
                                            @case('Minor')
                                                <span class="severity-badge severity-low">
                                                    <div class="severity-indicator"></div>
                                                    <span>Leve</span>
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
                                            @default
                                                <span class="severity-badge severity-pending">
                                                    <div class="severity-indicator"></div>
                                                    <span>No definido</span>
                                                </span>
                                        @endswitch
                                    </td>
                                    <td class="corporate-cell text-center">
                                        @if($accident->evidence)
                                        @php
                                        $ext = strtolower(pathinfo($accident->evidence, PATHINFO_EXTENSION));
                                        $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                                        $isImage = in_array($ext, $imageExtensions);
                                        $evidenceModalId = 'evidenceModal' . $accident->id;
                                        @endphp
                                        @if($isImage)
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#{{ $evidenceModalId }}">
                                            <img src="{{ asset('storage/evidences/' . $accident->evidence) }}" alt="Evidencia"
                                                class="img-thumbnail" style="inline-size: 60px; block-size: 60px; object-fit: cover;">
                                        </a>
                                        <div class="modal fade" id="{{ $evidenceModalId }}" tabindex="-1" aria-labelledby="{{ $evidenceModalId }}Label" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="{{ $evidenceModalId }}Label">Evidencia</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <img src="{{ asset('storage/evidences/' . $accident->evidence) }}"
                                                            alt="Evidencia" class="img-fluid rounded"
                                                            style="max-height: 600px; object-fit: contain;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @else
                                        <a href="{{ asset('storage/evidences/' . $accident->evidence) }}"
                                            class="corporate-btn corporate-btn-edit" target="_blank">Ver archivo</a>
                                        @endif
                                        @else
                                        <span class="text-muted">Sin evidencia</span>
                                        @endif
                                    </td>
                                    <td class="corporate-cell">
                                        <div class="created-by-info">
                                            <span class="fw-semibold text-dark">{{ $accident->user->nickname ?? 'Desconocido' }}</span>
                                        </div>
                                    </td>
                                    <td class="text-center corporate-cell">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('sstsena.funcionario.accidents.edit', $accident->id) }}"
                                               class="corporate-btn corporate-btn-edit" style="border-color: #28a745;">
                                                <i class="fas fa-edit"></i>
                                                <span>Editar</span>
                                            </a>
                                            <form action="{{ route('sstsena.funcionario.accidents.destroy', $accident->id) }}"
                                                  method="POST" class="d-inline" onsubmit="return confirmDelete()">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="corporate-btn corporate-btn-delete" style="border-color: #dc3545;">
                                                    <i class="fas fa-trash"></i>
                                                    <span>Eliminar</span>
                                                </button>
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
                                            <p class="text-muted mb-0 small">
                                                Los nuevos accidentes se registrarán y mostrarán aquí automáticamente
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para personas involucradas -->
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
                                <select name="accident_id" id="accident_id" class="form-select text-truncate" style="max-width: 100%;" required>
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
                            <button type="submit" class="corporate-btn">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete confirmation modal -->
    <div id="confirmDeleteModal" class="modal-confirm" style="display: none;">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Confirmar Eliminación</h3>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro de que deseas eliminar este registro? Esta acción no se puede deshacer.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="corporate-btn" onclick="closeModal()">Cancelar</button>
                <button type="button" class="corporate-btn corporate-btn-delete" onclick="submitForm()">Eliminar</button>
            </div>
        </div>
    </div>
</div>

<style>
/* Corporate color palette */
:root {
    --corporate-primary: #1a1a1a;
    --corporate-secondary: #f8f9fa;
    --corporate-accent: #6c757d;
    --corporate-border: #e9ecef;
    --corporate-shadow: rgba(0, 0, 0, 0.08);
    --corporate-hover: #f1f3f4;
    --corporate-text: #343a40;
    --corporate-muted: #6c757d;
}

/* Animations */
@keyframes fadeIn { from { opacity: 0; transform: translateY(15px); } to { opacity: 1; transform: translateY(0); } }
@keyframes slideInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }

.section-item { animation: slideInUp 0.5s ease-out both; }
.corporate-row { animation: slideInUp 0.3s ease-out both; }

/* Corporate cards */
.corporate-card {
    background: white;
    border-radius: 8px;
    border: 1px solid var(--corporate-border);
    overflow: hidden;
    transition: all 0.3s ease;
}

.corporate-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 24px var(--corporate-shadow);
    border-color: #dee2e6;
}

/* Section headers */
.section-header {
    background: var(--corporate-secondary);
    border-bottom: 1px solid var(--corporate-border);
}

.section-icon {
    width: 48px;
    height: 48px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
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

/* Corporate table */
.corporate-table { font-size: 0.9rem; }

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

.th-content {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.corporate-cell {
    padding: 1.25rem 1rem;
    vertical-align: middle;
    border-bottom: 1px solid #f8f9fa;
    transition: background-color 0.2s ease;
}

.corporate-row:hover .corporate-cell { background-color: var(--corporate-hover); }

/* Reference ID */
.reference-id {
    font-family: 'SF Mono', 'Monaco', 'Consolas', monospace;
    font-size: 0.9rem;
    font-weight: 600;
}

/* DateTime info */
.datetime-info { min-width: 120px; }

/* Description content */
.description-content p {
    font-size: 0.9rem;
    line-height: 1.4;
    margin-bottom: 0;
}

.toggle-text {
    cursor: pointer;
    transition: color 0.2s ease;
}

.toggle-text:hover { color: var(--corporate-primary); }

.toggle-icon { transition: transform 0.3s ease; }

.expanded .toggle-icon { transform: rotate(180deg); }

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

.severity-pending {
    background-color: #e2e3e5;
    color: #383d41;
    border-color: #d6d8db;
}

.severity-pending .severity-indicator { background-color: #6c757d; }

/* Corporate button */
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

.corporate-btn-edit:hover {
    background: #c3e6cb;
    color: #155724;
    border-color: #28a745;
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.12);
}

.corporate-btn-delete {
    background: #f8d7da;
    color: #721c24;
    border-color: #dc3545;
}

.corporate-btn-delete:hover {
    background: #f5c6cb;
    color: #721c24;
    border-color: #dc3545;
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.12);
}

/* Confirmation modal styles */
.modal-confirm {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.6);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 1000;
}

.modal-confirm .modal-content {
    background: white;
    border-radius: 12px;
    width: 90%;
    max-width: 600px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
    animation: fadeIn 0.3s ease-out;
    padding: 2rem;
}

.modal-confirm .modal-header {
    padding-bottom: 1.5rem;
    border-bottom: 1px solid var(--corporate-border);
}

.modal-confirm .modal-header h3 {
    margin: 0;
    font-size: 1.5rem;
    font-weight: 600;
    color: var(--corporate-text);
}

.modal-confirm .modal-body {
    padding: 1.5rem 0;
}

.modal-confirm .modal-body p {
    font-size: 1.1rem;
    color: var(--corporate-text);
    margin: 0;
}

.modal-confirm .modal-footer {
    display: flex;
    justify-content: flex-end;
    gap: 1rem;
    padding-top: 1.5rem;
    border-top: 1px solid var(--corporate-border);
}

.modal-confirm .modal-footer .corporate-btn {
    padding: 0.75rem 1.5rem;
    font-size: 1rem;
}

/* Corporate empty state */
.empty-state-corporate { padding: 3rem 2rem; }

.empty-icon { margin-bottom: 1rem; }

/* Created by info */
.created-by-info span {
    display: block;
}

/* Responsive design */
@media (max-width: 1200px) {
    .stats-container { display: none; }
    .section-content { justify-content: flex-start !important; }