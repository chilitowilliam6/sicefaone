@extends('sstsena::layouts.master')

@section('content')
<div class="container-fluid py-4">
    {{-- Success alert modal --}}
    @if (session('success'))
        <div id="successModal" class="modal-confirm">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Operación Exitosa</h3>
                </div>
                <div class="modal-body">
                    <p>{{ session('success') }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="corporate-btn" onclick="closeSuccessModal()">Aceptar</button>
                </div>
            </div>
        </div>
    @endif

    <div class="row g-4">
        <div class="col-12 section-item">
            {{-- Corporate card --}}
            <div class="corporate-card border-0 shadow-sm">
                {{-- Corporate section header --}}
                <div class="section-header" style="border-left: 4px solid #e63946;">
                    <div class="section-content d-flex justify-content-between align-items-center py-4 px-4">
                        <div class="d-flex align-items-center">
                            <div class="section-icon me-4" style="background-color: #e6394615;">
                                <i class="fas fa-exclamation-triangle fa-lg" style="color: #e63946;"></i>
                            </div>
                            <div>
                                <h4 class="mb-1 fw-semibold text-dark">Respuestas para Accidente #{{ $event->id }}</h4>
                                <small class="text-muted">Gestión de Respuestas</small>
                            </div>
                        </div>
                        <div class="stats-container">
                            <div class="stats-number">{{ $responses->count() }}</div>
                            <div class="stats-label">Respuestas</div>
                        </div>
                    </div>
                </div>

                {{-- Date filter --}}
                <div class="px-4 py-3">
                    <form method="GET" action="{{ route('sstsena.accidents.responses.index', $event->id) }}" class="d-flex align-items-end mb-3 gap-3">
                        <div style="max-width: 180px;">
                            <label for="date_filter" class="form-label small text-muted mb-1">Filtrar por fecha</label>
                            <input type="date" name="date_filter" id="date_filter" class="form-control form-control-sm" value="{{ request('date_filter') }}">
                        </div>
                        <button type="submit" class="corporate-btn" style="border-color: #007bff;">
                            <i class="fas fa-filter me-2"></i>
                            <span>Filtrar</span>
                        </button>
                        <a href="{{ route('sstsena.accidents.responses.index', $event->id) }}" class="corporate-btn" style="border-color: #dc3545;">
                            <i class="fas fa-times me-2"></i>
                            <span>Limpiar Filtro</span>
                        </a>
                    </form>

                    {{-- Add response button --}}
                    <a href="{{ route('sstsena.accidents.responses.create', $event->id) }}"
                       class="corporate-btn" style="border-color: #28a745;">
                        <i class="fas fa-plus me-2"></i>
                        <span>Agregar Respuesta</span>
                    </a>
                </div>

                {{-- Corporate table --}}
                <div class="table-container">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 corporate-table">
                            <thead>
                                <tr class="corporate-header-row">
                                    <th class="corporate-th midterm-ignore">
                                        <div class="th-content">
                                            <i class="fas fa-hashtag me-2"></i>
                                            <span></span>
                                        </div>
                                    </th>
                                    <th class="corporate-th midterm-ignore">
                                        <div class="th-content">
                                            <i class="fas fa-calendar-alt me-2"></i>
                                            <span>Fecha de Respuesta</span>
                                        </div>
                                    </th>
                                    <th class="corporate-th midterm-ignore" style="width: 25%;">
                                        <div class="th-content">
                                            <i class="fas fa-file-alt me-2"></i>
                                            <span>Respuesta</span>
                                        </div>
                                    </th>
                                    <th class="corporate-th midterm-ignore">
                                        <div class="th-content">
                                            <i class="fas fa-tools me-2"></i>
                                            <span>Acciones Tomadas</span>
                                        </div>
                                    </th>
                                    <th class="corporate-th midterm-ignore">
                                        <div class="th-content">
                                            <i class="fas fa-thermometer-half me-2"></i>
                                            <span>Gravedad</span>
                                        </div>
                                    </th>
                                    <th class="corporate-th midterm-ignore">
                                        <div class="th-content">
                                            <i class="fas fa-info-circle me-2"></i>
                                            <span>Estado</span>
                                        </div>
                                    </th>
                                    <th class="corporate-th midterm-ignore">
                                        <div class="th-content">
                                            <i class="fas fa-user me-2"></i>
                                            <span>Creado Por</span>
                                        </div>
                                    </th>
                                    <th class="corporate-th text-center midterm-ignore">
                                        <div class="th-content justify-content-center">
                                            <i class="fas fa-tools me-2"></i>
                                            <span>Acciones</span>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($responses as $response)
                                    <tr class="corporate-row">
                                        <td class="corporate-cell midterm-ignore">
                                            <div class="reference-id">
                                                <span class="fw-bold" style="color: #e63946;">
                                                    {{ $response->id }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="corporate-cell midterm-ignore">
                                            <div class="datetime-info">
                                                <div class="fw-semibold text-dark">{{ \Carbon\Carbon::parse($response->response_date)->format('d M Y') }}</div>
                                                <small class="text-muted">
                                                    <i class="fas fa-clock me-1"></i>{{ \Carbon\Carbon::parse($response->response_date)->format('H:i') }}
                                                </small>
                                            </div>
                                        </td>
                                        <td class="corporate-cell midterm-ignore">
                                            <div class="description-content">
                                                <p class="mb-0 text-dark lh-sm expandable-text" id="response-{{ $response->id }}"
                                                   style="max-height: 3em; overflow: hidden; transition: max-height 0.3s ease;">
                                                    {{ $response->response }}
                                                </p>
                                                @if(strlen($response->response) > 65)
                                                    <small class="text-muted mt-1 d-block toggle-text" onclick="toggleText('response-{{ $response->id }}')">
                                                        <i class="fas fa-chevron-down me-1 toggle-icon"></i>
                                                        <span class="toggle-label">Mostrar más</span>
                                                    </small>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="corporate-cell midterm-ignore">
                                            <div class="description-content">
                                                <p class="mb-0 text-dark lh-sm expandable-text" id="actions-{{ $response->id }}"
                                                   style="max-height: 3em; overflow: hidden; transition: max-height 0.3s ease;">
                                                    {{ $response->actions_taken }}
                                                </p>
                                                @if(strlen($response->actions_taken) > 65)
                                                    <small class="text-muted mt-1 d-block toggle-text" onclick="toggleText('actions-{{ $response->id }}')">
                                                        <i class="fas fa-chevron-down me-1 toggle-icon"></i>
                                                        <span class="toggle-label">Mostrar más</span>
                                                    </small>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="corporate-cell midterm-ignore">
                                            @switch($response->severity)
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
                                        <td class="corporate-cell midterm-ignore">
                                            @if ($response->status === 'investigation')
                                                <span class="severity-badge severity-low">
                                                    <div class="severity-indicator"></div>
                                                    <span>Investigación</span>
                                                </span>
                                            @else
                                                <span class="severity-badge severity-medium">
                                                    <div class="severity-indicator"></div>
                                                    <span>Finalizado</span>
                                                </span>
                                            @endif
                                        </td>
                                        <td class="corporate-cell midterm-ignore">
                                            <div class="created-by-info">
                                                <span class="fw-semibold text-dark">{{ $response->createdBy->nickname ?? 'Administrador' }}</span>
                                                @if($response->createdBy)
                                                    <small class="text-muted d-block">{{ $response->createdBy->correo_electronico ?? '' }}</small>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="text-center corporate-cell midterm-ignore">
                                            <div class="d-flex justify-content-center gap-2">
                                                <a href="{{ route('sstsena.accidents.responses.edit', [$event->id, $response->id]) }}"
                                                   class="corporate-btn corporate-btn-edit" style="border-color: #28a745;">
                                                    <i class="fas fa-edit"></i>
                                                    <span>Editar</span>
                                                </a>
                                                <form action="{{ route('sstsena.accidents.responses.destroy', [$event->id, $response->id]) }}"
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
                                        <td colspan="8" class="text-center py-5">
                                            <div class="empty-state-corporate">
                                                <div class="empty-icon mb-3">
                                                    <i class="fas fa-exclamation-triangle fa-3x text-muted opacity-25"></i>
                                                </div>
                                                <h6 class="text-muted mb-2 fw-normal">No se encontraron respuestas</h6>
                                                <p class="text-muted mb-0 small">
                                                    Las nuevas respuestas se registrarán y mostrarán aquí automáticamente
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{-- Pagination --}}
                    @if($responses instanceof \Illuminate\Pagination\LengthAwarePaginator)
                        <div class="mt-3 px-4">
                            {{ $responses->links() }}
                        </div>
                    @endif
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
                <p>¿Estás seguro de que deseas eliminar esta respuesta? Esta acción no se puede deshacer.</p>
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
    --corporate-success: #28a745;
    --corporate-warning: #ffc107;
    --corporate-danger: #e63946;
    --corporate-info: #17a2b8;
}

/* Minimalist animations */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(15px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes fadeOut {
    from { opacity: 1; transform: translateY(0); }
    to { opacity: 0; transform: translateY(-15px); }
}

@keyframes slideInUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.fade-in { animation: fadeIn 0.4s ease-out; }
.fade-out { animation: fadeOut 0.3s ease-in forwards; }
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

.corporate-row:hover .corporate-cell {
    background-color: var(--corporate-hover);
}

/* Reference ID */
.reference-id {
    font-family: 'SF Mono', 'Monaco', 'Consolas', monospace;
    font-size: 0.9rem;
    font-weight: 600;
}

/* DateTime info */
.datetime-info {
    min-width: 120px;
}

/* Description and Evidence content */
.description-content p {
    font-size: 0.9rem;
    line-height: 1.4;
    margin-bottom: 0;
}

.toggle-text {
    cursor: pointer;
    transition: color 0.2s ease;
}

.toggle-text:hover {
    color: var(--corporate-primary);
}

.toggle-icon {
    transition: transform 0.3s ease;
}

.expanded .toggle-icon {
    transform: rotate(180deg);
}

.expanded .toggle-label {
    content: 'Mostrar menos';
}

.toggle-text:hover .toggle-label {
    text-decoration: underline;
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
    background: var(--corporate-primary);
    color: white;
    border-color: var(--corporate-primary);
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

.modal-content {
    background: white;
    border-radius: 12px;
    width: 90%;
    max-width: 600px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
    animation: fadeIn 0.3s ease-out;
    padding: 2rem;
}

.modal-header {
    padding-bottom: 1.5rem;
    border-bottom: 1px solid var(--corporate-border);
}

.modal-header h3 {
    margin: 0;
    font-size: 1.5rem;
    font-weight: 600;
    color: var(--corporate-text);
}

.modal-body {
    padding: 1.5rem 0;
}

.modal-body p {
    font-size: 1.1rem;
    color: var(--corporate-text);
    margin: 0;
}

.modal-footer {
    display: flex;
    justify-content: flex-end;
    gap: 1rem;
    padding-top: 1.5rem;
    border-top: 1px solid var(--corporate-border);
}

.modal-footer .corporate-btn {
    padding: 0.75rem 1.5rem;
    font-size: 1rem;
}

/* Corporate empty state */
.empty-state-corporate {
    padding: 3rem 2rem;
}

.empty-icon {
    margin-bottom: 1rem;
}

/* Corporate alert */
.corporate-alert {
    background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
    border: 1px solid #c3e6cb;
    color: #155724;
}

.alert-icon {
    width: 36px;
    height: 36px;
    background: rgba(21, 87, 36, 0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #155724;
}

/* Responsive design */
@media (max-width: 1200px) {
    .stats-container {
        display: none;
    }
    
    .section-content {
        justify-content: flex-start !important;
    }
}

@media (max-width: 992px) {
    .corporate-th {
        font-size: 0.7rem;
        padding: 1rem 0.75rem;
    }
    
    .corporate-cell {
        padding: 1rem 0.75rem;
    }
    
    .corporate-btn {
        padding: 0.4rem 0.8rem;
        font-size: 0.75rem;
    }
}

@media (max-width: 768px) {
    .section-content {
        flex-direction: column;
        align-items: flex-start !important;
        gap: 1rem;
    }
    
    .modal-content {
        width: 95%;
        padding: 1.5rem;
    }
    
    .modal-header h3 {
        font-size: 1.25rem;
    }
    
    .modal-body p {
        font-size: 1rem;
    }
}

/* Accessibility improvements */
.corporate-btn:focus,
.severity-badge:focus,
.toggle-text:focus {
    outline: 2px solid #007bff;
    outline-offset: 2px;
}

/* Print styles */
@media print {
    .corporate-btn, .modal-confirm, .toggle-text {
        display: none;
    }
    
    .expandable-text {
        max-height: none !important;
        overflow: visible !important;
    }
    
    .corporate-card {
        box-shadow: none !important;
        border: 1px solid #dee2e6 !important;
        break-inside: avoid;
    }
    
    .section-header {
        background: #f8f9fa !important;
    }
}

/* Smooth scrolling */
html {
    scroll-behavior: smooth;
}

/* Loading optimization */
.corporate-card {
    contain: layout style;
}

.corporate-table {
    contain: layout;
}
</style>

<script>
let activeForm = null;

function confirmDelete() {
    const modal = document.getElementById('confirmDeleteModal');
    activeForm = event.target.closest('form');
    modal.style.display = 'flex';
    return false; // Prevent immediate form submission
}

function closeModal() {
    const modal = document.getElementById('confirmDeleteModal');
    modal.style.display = 'none';
    activeForm = null;
}

function submitForm() {
    if (activeForm) {
        activeForm.submit();
    }
}

function closeSuccessModal() {
    const modal = document.getElementById('successModal');
    modal.style.display = 'none';
}

function toggleText(elementId) {
    const textElement = document.getElementById(elementId);
    const toggleElement = textElement.nextElementSibling;
    const isExpanded = textElement.classList.contains('expanded');

    if (isExpanded) {
        textElement.style.maxHeight = '3em';
        textElement.classList.remove('expanded');
        toggleElement.querySelector('.toggle-label').textContent = 'Mostrar más';
        toggleElement.querySelector('.toggle-icon').style.transform = 'rotate(0deg)';
    } else {
        textElement.style.maxHeight = textElement.scrollHeight + 'px';
        textElement.classList.add('expanded');
        toggleElement.querySelector('.toggle-label').textContent = 'Mostrar menos';
        toggleElement.querySelector('.toggle-icon').style.transform = 'rotate(180deg)';
    }
}
</script>
@endsection