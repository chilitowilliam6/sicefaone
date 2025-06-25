```blade
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

    {{-- Navigation links --}}
    <nav class="nav nav-pills nav-fill mb-4" role="navigation">
        <a class="nav-link corporate-btn" href="#section-accidents">Respuesta Accidentes</a>
        <a class="nav-link corporate-btn" href="#section-incidents">Respuesta Incidentes</a>
        <a class="nav-link corporate-btn" href="#section-emergencies">Respuesta Emergencias</a>
        <a class="nav-link corporate-btn" href="#section-unsafe_acts">Respuesta Actos Inseguros</a>
    </nav>

    @php
        $sections = [
            [
                'id' => 'section-accidents',
                'title' => 'Accidentes Laborales',
                'items' => $accidents,
                'route_prefix' => 'accidents',
                'icon' => 'fa-exclamation-triangle',
                'color' => '#DC143C'
            ],
            [
                'id' => 'section-incidents',
                'title' => 'Incidentes de Trabajo',
                'items' => $incidents,
                'route_prefix' => 'incidents',
                'icon' => 'fa-clipboard-list',
                'color' => '#FF8C00'
            ],
            [
                'id' => 'section-emergencies',
                'title' => 'Situaciones de Emergencia',
                'items' => $emergencies,
                'route_prefix' => 'emergencies',
                'icon' => 'fa-shield-alt',
                'color' => '#4169E1'
            ],
            [
                'id' => 'section-unsafe_acts',
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
            <div class="col-12 section-item" id="{{ $section['id'] }}">
                {{-- Card corporativa --}}
                <div class="corporate-card border-0 shadow-sm">
                    {{-- Header de sección corporativo --}}
                    <div class="section-header" style="border-left: 4px solid {{ $section['color'] }};">
                        <div class="section-content d-flex justify-content-between align-items-center py-4 px-4">
                            <div class="d-flex align-items-center">
                                <div class="section-icon me-4" style="background-color: {{ $section['color'] }}15;">
                                    <i class="fas {{ section['icon'] }} fa-lg" style="color: {{ $section['color'] }};"></i>
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
                                                    @if(strlen($item->description ?? '') > 100)
                                                        <small class="text-muted mt-1 d-block">
                                                            <i class="fas fa-external-link-alt me-1"></i>Ver detalles completos
                                                        </small>
                                                    @endif
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
                                            <div class="card-footer text-center">
                                                <a href="{{ route('sstsena.' . $section['route_prefix'] . '.responses.index', $item->id) }}"
                                                   class="corporate-btn">
                                                    <i class="fas fa-folder-open me-2"></i>
                                                    <span>Revisar Caso</span>
                                                </a>
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
/* Paleta de colores corporativa */
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
    --corporate-danger: #dc3545;
    --corporate-info: #17a2b8;
}

/* Animaciones minimalistas */
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

@keyframes cardHover {
    from { transform: translateY(0); box-shadow: 0 4px 12px var(--corporate-shadow); }
    to { transform: translateY(-4px); box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12); }
}

.fade-in { animation: fadeIn 0.4s ease-out; }
.fade-out { animation: fadeOut 0.3s ease-in forwards; }
.section-item { animation: slideInUp 0.5s ease-out both; }
.card-item { animation: slideInUp 0.3s ease-out both; }

/* Cards corporativas */
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

/* Card item */
.card-item {
    border-radius: 8px;
    border: 1px solid var(--corporate-border);
    overflow: hidden;
    transition: all 0.3s ease;
    position: relative;
}

.card-item:hover {
    animation: cardHover 0.2s ease-out forwards;
}

.card-item::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 4px;
    background-color: var(--card-accent);
}

/* Card header */
.card-header {
    padding: 1rem 1.25rem;
    background: var(--corporate-secondary);
    border-bottom: 1px solid var(--corporate-border);
}

/* Card body */
.card-body {
    padding: 1.25rem;
}

/* Card footer */
.card-footer {
    padding: 1rem;
    background: var(--corporate-secondary);
    border-top: 1px solid var(--corporate-border);
}

/* Headers de sección */
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

/* Reference ID */
.reference-id {
    font-family: 'SF Mono', 'Monaco', 'Consolas', monospace;
    font-size: 1rem;
    font-weight: 600;
}

/* DateTime info */
.datetime-info {
    font-size: 0.9rem;
}

/* Description and Evidence content */
.description-content p,
.evidence-content p {
    font-size: 0.9rem;
    line-height: 1.4;
    margin-bottom: 0;
}

/* Severity badges corporativos */
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
    background-color: #dc3545;
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

/* Response indicator */
.response-indicator {
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

.response-count {
    font-weight: 700;
    font-size: 1.1rem;
    color: var(--corporate-text);
}

/* Additional info for Accidentes Laborales */
.additional-info {
    display: grid;
    gap: 0.5rem;
}

.info-item {
    display: flex;
    align-items: center;
    font-size: 0.85rem;
    color: var(--corporate-text);
}

.info-item i {
    color: var(--corporate-muted);
    width: 20px;
}

/* Corporate button */
.corporate-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.625rem 1.25rem;
    background: white;
    color: var(--corporate-text);
    border: 1.5px solid var(--corporate-border);
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

/* Navigation pills */
.nav-pills .nav-link {
    border-radius: 6px;
    margin: 0 0.25rem;
    transition: all 0.2s ease;
}

.nav-pills .nav-link:hover {
    background: var(--corporate-hover);
    color: var(--corporate-primary);
}

/* Empty state corporativo */
.empty-state-corporate {
    padding: 3rem 2rem;
}

.empty-icon {
    margin-bottom: 1rem;
}

/* Alert corporativa */
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

/* Responsive design empresarial */
@media (max-width: 1200px) {
    .stats-container {
        display: none;
    }
    
    .section-content {
        justify-content: flex-start !important;
    }
}

@media (max-width: 992px) {
    .row-cols-lg-3 {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .section-content {
        flex-direction: column;
        align-items: flex-start !important;
        gap: 1rem;
    }
    
    .corporate-btn {
        padding: 0.5rem 1rem;
        font-size: 0.8rem;
    }
    
    .row-cols-md-2 {
        grid-template-columns: 1fr;
    }
    
    .nav-pills {
        flex-direction: column;
    }
    
    .nav-pills .nav-link {
        margin: 0.25rem 0;
        width: 100%;
        text-align: center;
    }
}

/* Mejoras de accesibilidad */
.corporate-btn:focus,
.severity-badge:focus,
.nav-link:focus {
    outline: 2px solid #007bff;
    outline-offset: 2px;
}

/* Print styles */
@media print {
    .corporate-btn {
        display: none;
    }
    
    .corporate-card {
        box-shadow: none !important;
        border: 1px solid #dee2e6 !important;
        break-inside: avoid;
    }
    
    .section-header {
        background: #f8f9fa !important;
    }
    
    .nav {
        display: none;
    }
}

/* Smooth scrolling */
html {
    scroll-behavior: smooth;
}

/* Loading optimization */
.corporate-card,
.card-item {
    contain: layout style;
}
</style>
@endsection
```