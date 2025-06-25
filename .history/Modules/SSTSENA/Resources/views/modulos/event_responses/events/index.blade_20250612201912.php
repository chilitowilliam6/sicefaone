@extends('sstsena::layouts.master')

@section('content')
<div class="container-fluid py-4">
    {{-- Alerta de éxito corporativa --}}
    @if (session('success'))
        <div id="alertaExito" class="alert alert-success border-0 shadow-sm mx-auto mb-4 fade-in corporate-alert" style="max-width: 500px;">
            <div class="d-flex align-items-center">
                <div class="alert-icon me-3">
                    <i class="fas fa-check-circle fa-lg"></i>
                </div>
                <div class="flex-grow-1">
                    <strong>Operación Exitosa</strong><br>
                    <small class="text-muted">{{ session('success') }}</small>
                </div>
                <button type="button" class="btn-close btn-close-sm" onclick="document.getElementById('alertaExito')?.remove()"></button>
            </div>
        </div>
        <script>setTimeout(() => document.getElementById('alertaExito')?.classList.add('fade-out'), 5000);</script>
    @endif

    {{-- Formulario de filtro por fecha --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="corporate-card border-0 shadow-sm p-4">
                <h5 class="fw-semibold mb-4">Filtro por Fecha</h5>
                <form action="{{ route(Route::currentRouteName()) }}" method="GET" class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label for="start_date" class="form-label">Fecha de Inicio</label>
                        <input type="date" class="form-control corporate-input" id="start_date" name="start_date" value="{{ request('start_date') }}" aria-label="Fecha de inicio">
                    </div>
                    <div class="col-md-4">
                        <label for="end_date" class="form-label">Fecha de Fin</label>
                        <input type="date" class="form-control corporate-input" id="end_date" name="end_date" value="{{ request('end_date') }}" aria-label="Fecha de fin">
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn corporate-btn w-100">
                            <i class="fas fa-filter me-2"></i>Filtrar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @php
        $sections = [
            [
                'title' => 'Accidentes Laborales',
                'items' => $accidents,
                'route_prefix' => 'accidents',
                'icon' => 'fa-exclamation-triangle',
                'color' => '#DC143C'
            ],
            [
                'title' => 'Incidentes de Trabajo',
                'items' => $incidents,
                'route_prefix' => 'incidents',
                'icon' => 'fa-clipboard-list',
                'color' => '#FF8C00'
            ],
            [
                'title' => 'Situaciones de Emergencia',
                'items' => $emergencies,
                'route_prefix' => 'emergencies',
                'icon' => 'fa-shield-alt',
                'color' => '#4169E1'
            ],
            [
                'title' => 'Comportamientos Inseguros',
                'items' => $unsafeActs,
                'route_prefix' => 'unsafe_acts',
                'icon' => 'fa-eye-slash',
                'color' => '#708090'
            ],
        ];
    @endphp

    {{-- Grid corporativo --}}
    <div class="row g-4">
        @foreach ($sections as $index => $section)
            <div class="col-12 section-item">
                {{-- Card corporativa --}}
                <div class="corporate-card border-0 shadow-sm">
                    {{-- Header de sección corporativo --}}
                    <div class="section-header" style="border-left: 4px solid {{ $section['color'] }};">
                        <div class="section-content d-flex justify-content-between align-items-center py-4 px-4">
                            <div class="d-flex align-items-center">
                                <div class="section-icon me-4" style="background-color: {{ $section['color'] }}15;">
                                    <i class="fas {{ $section['icon'] }} fa-lg" style="color: {{ $section['color'] }};"></i>
                                </div>
                                <div>
                                    <h4 class="mb-1 fw-semibold text-dark">{{ $section['title'] }}</h4>
                                    <small class="text-muted">Evaluación y Gestión de Riesgos</small>
                                </div>
                            </div>
                            <div class="stats-container">
                                <div class="stats-number">{{ $section['items']->count() }}</div>
                                <div class="stats-label">Registros</div>
                            </div>
                        </div>
                    </div>

                    {{-- Contenedor de tarjetas --}}
                    <div class="cards-container p-4">
                        @if ($section['items']->isEmpty())
                            <div class="empty-state-corporate text-center py-5">
                                <div class="empty-icon mb-3">
                                    <i class="fas {{ $section['icon'] }} fa-3x text-muted opacity-25"></i>
                                </div>
                                <h6 class="text-muted mb-2 fw-normal">No se encontraron registros de {{ strtolower($section['title']) }}</h6>
                                <p class="text-muted mb-0 small">
                                    Los nuevos incidentes se registrarán y mostrarán aquí automáticamente
                                </p>
                            </div>
                        @else
                            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                                @foreach ($section['items'] as $itemIndex => $item)
                                    <div class="col">
                                        <div class="card-item corporate-card shadow-sm h-100" style="--card-accent: {{ $section['color'] }};">
                                            <div class="card-header d-flex justify-content-between align-items-center">
                                                <span class="reference-id fw-bold" style="color: {{ $section['color'] }};">
                                                    #{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}
                                                </span>
                                                <div class="response-indicator">
                                                    <span class="response-count">{{ $item->eventResponses->count() }}</span>
                                                    <i class="fas fa-comment-dots ms-1 text-muted"></i>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="datetime-info mb-3">
                                                    <div class="fw-semibold text-dark">{{ $item->date_time->format('d M Y') }}</div>
                                                    <small class="text-muted">
                                                        <i class="fas fa-clock me-1"></i>{{ $item->date_time->format('H:i') }}
                                                    </small>
                                                </div>
                                                <div class="description-content mb-3">
                                                    <p class="mb-0 text-dark lh-sm">{{ Str::limit($item->description ?? 'Sin descripción disponible', 100) }}</p>
                                                </div>
                                                <div class="severity-info mb-3">
                                                    @switch($item->severity)
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
                                                                <span>En Revisión</span>
                                                            </span>
                                                    @endswitch
                                                </div>
                                                @if ($section['title'] == 'Accidentes Laborales')
                                                    <div class="additional-info mb-3">
                                                        <div class="info-item">
                                                            <i class="fas fa-map-marker-alt me-2"></i>
                                                            <span>{{ $item->environment->name ?? 'N/A' }}</span>
                                                        </div>
                                                        <div class="info-item">
                                                            <i class="fas fa-medkit me-2"></i>
                                                            <span>{{ $item->injuryType->name ?? 'N/A' }}</span>
                                                        </div>
                                                        <div class="info-item">
                                                            <i class="fas fa-exclamation-circle me-2"></i>
                                                            <span>{{ $item->riskType->name ?? 'N/A' }}</span>
                                                        </div>
                                                        <div class="info-item">
                                                            <i class="fas fa-briefcase me-2"></i>
                                                            <span>{{ $item->accidentType->name ?? 'N/A' }}</span>
                                                        </div>
                                                        <div class="info-item">
                                                            <i class="fas fa-user me-2"></i>
                                                            <span>{{ $item->createdBy->name ?? 'N/A' }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="evidence-content mb-3">
                                                        @if($item->evidence)
                                                            @php
                                                                $ext = strtolower(pathinfo($item->evidence, PATHINFO_EXTENSION));
                                                                $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                                                                $isImage = in_array($ext, $imageExtensions);
                                                                $modalId = 'evidenceModal' . $item->id;
                                                            @endphp
                                                            @if($isImage)
                                                                <a href="#"
                                                                   data-bs-toggle="modal"
                                                                   data-bs-target="#{{ $modalId }}"
                                                                   class="evidence-link"
                                                                   aria-label="Ver evidencia en tamaño completo"
                                                                   role="button">
                                                                    <img src="{{ asset('storage/evidences/' . $item->evidence) }}"
                                                                         alt="Evidencia del accidente #{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}"
                                                                         class="img-thumbnail evidence-thumbnail"
                                                                         style="width: 80px; height: 80px; object-fit: cover; cursor: pointer;"
                                                                         loading="lazy">
                                                                </a>
                                                                <div class="modal fade" id="{{ $modalId }}" tabindex="-1" aria-labelledby="{{ $modalId }}Label" aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                                                        <div class="modal-content corporate-modal">
                                                                            <div class="modal-header border-0">
                                                                                <h5 class="modal-title" id="{{ $modalId }}Label">Evidencia - Accidente #{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}</h5>
                                                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                                                            </div>
                                                                            <div class="modal-body text-center p-0">
                                                                                <img src="{{ asset('storage/evidences/' . $item->evidence) }}"
                                                                                     alt="Evidencia del accidente #{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}"
                                                                                     class="img-fluid rounded corporate-modal-image"
                                                                                     style="max-height: 80vh; width: 100%; object-fit: contain;">
                                                                            </div>
                                                                            <div class="modal-footer border-0">
                                                                                <a href="{{ asset('storage/evidences/' . $item->evidence) }}"
                                                                                   class="btn corporate-btn"
                                                                                   download
                                                                                   aria-label="Descargar evidencia">
                                                                                    <i class="fas fa-download me-2"></i>Descargar
                                                                                </a>
                                                                                <button type="button" class="btn corporate-btn" data-bs-dismiss="modal">
                                                                                    <i class="fas fa-times me-2"></i>Cerrar
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @else
                                                                <a href="{{ asset('storage/evidences/' . $item->evidence) }}"
                                                                   class="btn btn-sm corporate-btn"
                                                                   target="_blank"
                                                                   aria-label="Ver archivo de evidencia">
                                                                    <i class="fas fa-file-alt me-2"></i>Ver archivo
                                                                </a>
                                                            @endif
                                                        @else
                                                            <span class="text-muted">Sin evidencia</span>
                                                        @endif
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="card-footer d-flex justify-content-between">
                                                <a href="{{ route('sstsena.' . $section['route_prefix'] . '.responses.index', $item->id) }}"
                                                   class="corporate-btn">
                                                    <i class="fas fa-folder-open me-2"></i>
                                                    <span>Revisar Caso</span>
                                                </a>
                                                <button type="button"
                                                        class="corporate-btn"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#detailsModal{{ $item->id }}"
                                                        aria-label="Ver detalles completos del {{ strtolower($section['title']) }} #{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}">
                                                    <i class="fas fa-expand-alt me-2"></i>
                                                    <span>Ver Detalles</span>
                                                </button>
                                            </div>
                                        </div>

                                        {{-- Modal de Detalles --}}
                                        <div class="modal fade" id="detailsModal{{ $item->id }}" tabindex="-1" aria-labelledby="detailsModal{{ $item->id }}Label" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                <div class="modal-content corporate-modal">
                                                    <div class="modal-header border-0">
                                                        <h5 class="modal-title" id="detailsModal{{ $item->id }}Label">
                                                            {{ $section['title'] }} #{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}
                                                        </h5>
                                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-4">
                                                            <h6 class="fw-semibold">Descripción</h6>
                                                            <p class="text-dark">{{ $item->description ?? 'Sin descripción disponible' }}</p>
                                                        </div>
                                                        <div class="mb-4">
                                                            <h6 class="fw-semibold">Severidad</h6>
                                                            @switch($item->severity)
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
                                                                        <span>En Revisión</span>
                                                                    </span>
                                                            @endswitch
                                                        </div>
                                                        <div class="mb-4">
                                                            <h6 class="fw-semibold">Fecha y Hora</h6>
                                                            <p class="text-dark">
                                                                <i class="fas fa-calendar-alt me-2"></i>{{ $item->date_time->format('d M Y') }} a las {{ $item->date_time->format('H:i') }}
                                                            </p>
                                                        </div>
                                                        <div class="mb-4">
                                                            <h6 class="fw-semibold">Respuestas</h6>
                                                            <p class="text-dark">
                                                                <i class="fas fa-comment-dots me-2"></i>{{ $item->eventResponses->count() }} respuestas
                                                            </p>
                                                        </div>
                                                        @if ($section['title'] == 'Accidentes Laborales')
                                                            <div class="mb-4">
                                                                <h6 class="fw-semibold">Información Adicional</h6>
                                                                <div class="additional-info">
                                                                    <div class="info-item">
                                                                        <i class="fas fa-map-marker-alt me-2"></i>
                                                                        <span>{{ $item->environment->name ?? 'N/A' }}</span>
                                                                    </div>
                                                                    <div class="info-item">
                                                                        <i class="fas fa-medkit me-2"></i>
                                                                        <span>{{ $item->injuryType->name ?? 'N/A' }}</span>
                                                                    </div>
                                                                    <div class="info-item">
                                                                        <i class="fas fa-exclamation-circle me-2"></i>
                                                                        <span>{{ $item->riskType->name ?? 'N/A' }}</span>
                                                                    </div>
                                                                    <div class="info-item">
                                                                        <i class="fas fa-briefcase me-2"></i>
                                                                        <span>{{ $item->accidentType->name ?? 'N/A' }}</span>
                                                                    </div>
                                                                    <div class="info-item">
                                                                        <i class="fas fa-user me-2"></i>
                                                                        <span>{{ $item->createdBy->name ?? 'N/A' }}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mb-4">
                                                                <h6 class="fw-semibold">Evidencia</h6>
                                                                @if($item->evidence)
                                                                    @php
                                                                        $ext = strtolower(pathinfo($item->evidence, PATHINFO_EXTENSION));
                                                                        $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                                                                        $isImage = in_array($ext, $imageExtensions);
                                                                    @endphp
                                                                    @if($isImage)
                                                                        <img src="{{ asset('storage/evidences/' . $item->evidence) }}"
                                                                             alt="Evidencia del accidente #{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}"
                                                                             class="img-fluid rounded corporate-modal-image"
                                                                             style="max-height: 300px; width: 100%; object-fit: contain;">
                                                                        <div class="mt-2">
                                                                            <a href="{{ asset('storage/evidences/' . $item->evidence) }}"
                                                                               class="btn corporate-btn"
                                                                               download
                                                                               aria-label="Descargar evidencia">
                                                                                <i class="fas fa-download me-2"></i>Descargar
                                                                            </a>
                                                                            <a href="#"
                                                                               data-bs-toggle="modal"
                                                                               data-bs-target="#evidenceModal{{ $item->id }}"
                                                                               class="btn corporate-btn"
                                                                               aria-label="Ver evidencia en tamaño completo">
                                                                                <i class="fas fa-expand me-2"></i>Ampliar
                                                                            </a>
                                                                        </div>
                                                                    @else
                                                                        <a href="{{ asset('storage/evidences/' . $item->evidence) }}"
                                                                           class="btn corporate-btn"
                                                                           target="_blank"
                                                                           aria-label="Ver archivo de evidencia">
                                                                            <i class="fas fa-file-alt me-2"></i>Ver archivo
                                                                        </a>
                                                                    @endif
                                                                @else
                                                                    <p class="text-muted">Sin evidencia</p>
                                                                @endif
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="modal-footer border-0">
                                                        <a href="{{ route('sstsena.' . $section['route_prefix'] . '.responses.index', $item->id) }}"
                                                           class="btn corporate-btn">
                                                            <i class="fas fa-folder-open me-2"></i>Revisar Caso
                                                        </a>
                                                        <button type="button" class="btn corporate-btn" data-bs-dismiss="modal">
                                                            <i class="fas fa-times me-2"></i>Cerrar
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<style>
/* Existing styles remain unchanged, adding modal-specific and form-specific styles */
.corporate-modal {
    background: white;
    border-radius: 8px;
    border: 1px solid var(--corporate-border);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
}

.corporate-modal .modal-header {
    background: var(--corporate-secondary);
    padding: 1.25rem;
}

.corporate-modal .modal-title {
    color: var(--corporate-text);
    font-weight: 600;
}

.corporate-modal .modal-body {
    padding: 1.5rem;
}

.corporate-modal .modal-footer {
    padding: 1rem;
    background: var(--corporate-secondary);
}

.corporate-modal .btn-close-white {
    filter: invert(0.6);
}

.corporate-modal-image {
    border: 1px solid var(--corporate-border);
    border-radius: 6px;
}

/* Estilos para el formulario de filtro */
.corporate-input {
    border: 1px solid var(--corporate-border);
    border-radius: 6px;
    padding: 0.5rem;
    font-size: 0.9rem;
}

.corporate-input:focus {
    border-color: var(--corporate-primary);
    box-shadow: 0 0 0 0.2rem rgba(var(--corporate-primary-rgb), 0.25);
}

.form-label {
    font-size: 0.9rem;
    color: var(--corporate-text);
    margin-bottom: 0.5rem;
}

/* Ensure modals are accessible */
.modal-content {
    contain: layout style;
}

.modal-body h6 {
    color: var(--corporate-text);
    margin-bottom: 1rem;
    font-size: 1rem;
}

.modal-body p,
.modal-body .info-item {
    font-size: 0.9rem;
    line-height: 1.5;
}

@media (max-width: 576px) {
    .modal-dialog {
        margin: 0.5rem;
    }
    
    .modal-body {
        padding: 1rem;
    }
    
    .modal-footer .btn {
        width: 100%;
        margin-bottom: 0.5rem;
    }
}
</style>
@endsection