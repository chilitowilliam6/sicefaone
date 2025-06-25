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

                    {{-- Tabla corporativa --}}
                    <div class="table-container">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0 corporate-table">
                                @if ($section['title'] == 'Accidentes Laborales')
                                    {{-- Table for Accidentes Laborales with new order and added columns --}}
                                    <thead>
                                        <tr class="corporate-header-row">
                                            <th class="corporate-th">
                                                <div class="th-content">
                                                    <i class="fas fa-hashtag me-2"></i>
                                                    <span>#</span>
                                                </div>
                                            </th>
                                            <th class="corporate-th">
                                                <div class="th-content">
                                                    <i class="fas fa-calendar-alt me-2"></i>
                                                    <span>Fecha y Hora</span>
                                                </div>
                                            </th>
                                            <th class="corporate-th accidents-th-extra">
                                                <div class="th-content">
                                                    <i class="fas fa-map-marker-alt me-2"></i>
                                                    <span>Ubicación</span>
                                                </div>
                                            </th>
                                            <th class="corporate-th accidents-th-extra">
                                                <div class="th-content">
                                                    <i class="fas fa-medkit me-2"></i>
                                                    <span>Tipo de Lesión</span>
                                                </div>
                                            </th>
                                            <th class="corporate-th accidents-th-extra">
                                                <div class="th-content">
                                                    <i class="fas fa-exclamation-circle me-2"></i>
                                                    <span>Tipo de Riesgo</span>
                                                </div>
                                            </th>
                                            <th class="corporate-th accidents-th-extra">
                                                <div class="th-content">
                                                    <i class="fas fa-briefcase me-2"></i>
                                                    <span>Tipo de Accidente</span>
                                                </div>
                                            </th>
                                            <th class="corporate-th">
                                                <div class="th-content">
                                                    <i class="fas fa-file-alt me-2"></i>
                                                    <span>Descripción</span>
                                                </div>
                                            </th>
                                            <th class="corporate-th">
                                                <div class="th-content">
                                                    <i class="fas fa-thermometer-half me-2"></i>
                                                    <span>Gravedad</span>
                                                </div>
                                            </th>
                                            <th class="corporate-th accidents-th-extra">
                                                <div class="th-content">
                                                    <i class="fas fa-camera me-2"></i>
                                                    <span>Evidencia</span>
                                                </div>
                                            </th>
                                            <th class="corporate-th accidents-th-extra">
                                                <div class="th-content">
                                                    <i class="fas fa-user me-2"></i>
                                                    <span>Creado por</span>
                                                </div>
                                            </th>
                                            <th class="corporate-th text-center">
                                                <div class="th-content justify-content-center">
                                                    <i class="fas fa-comments me-2"></i>
                                                    <span>Respuestas</span>
                                                </div>
                                            </th>
                                            <th class="corporate-th text-center">
                                                <div class="th-content justify-content-center">
                                                    <i class="fas fa-tools me-2"></i>
                                                    <span>Acciones</span>
                                                </div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($section['items'] as $itemIndex => $item)
                                            <tr class="corporate-row">
                                                <td class="corporate-cell">
                                                    <div class="reference-id">
                                                        <span class="fw-bold" style="color: {{ $section['color'] }};">
                                                            #{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}
                                                        </span>
                                                    </div>
                                                </td>
                                                <td class="corporate-cell">
                                                    <div class="datetime-info">
                                                        <div class="fw-semibold text-dark">{{ $item->date_time->format('d M Y') }}</div>
                                                        <small class="text-muted">
                                                            <i class="fas fa-clock me-1"></i>{{ $item->date_time->format('H:i') }}
                                                        </small>
                                                    </div>
                                                </td>
                                                <td class="corporate-cell accidents-cell-extra">
                                                    <div class="environment-info">
                                                        <span class="fw-semibold text-dark">{{ $item->environment->name ?? 'N/A' }}</span>
                                                    </div>
                                                </td>
                                                <td class="corporate-cell accidents-cell-extra">
                                                    <div class="injury-type-info">
                                                        <span class="fw-semibold text-dark">{{ $item->injuryType->name ?? 'N/A' }}</span>
                                                    </div>
                                                </td>
                                                <td class="corporate-cell accidents-cell-extra">
                                                    <div class="risk-type-info">
                                                        <span class="fw-semibold text-dark">{{ $item->riskType->name ?? 'N/A' }}</span>
                                                    </div>
                                                </td>
                                                <td class="corporate-cell accidents-cell-extra">
                                                    <div class="accident-type-info">
                                                        <span class="fw-semibold text-dark">{{ $item->accidentType->name ?? 'N/A' }}</span>
                                                    </div>
                                                </td>
                                                <td class="corporate-cell">
                                                    <div class="description-content">
                                                        <p class="mb-0 text-dark lh-sm">{{ Str::limit($item->description ?? 'Sin descripción disponible', 65) }}</p>
                                                        @if(strlen($item->description ?? '') > 65)
                                                            <small class="text-muted mt-1 d-block">
                                                                <i class="fas fa-external-link-alt me-1"></i>Ver detalles completos
                                                            </small>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td class="corporate-cell">
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
                                                </td>
                                   <td class="corporate-cell accidents-cell-extra align-middle">
    <div class="evidence-container">
        @if($item->evidence)
            @php
                $ext = strtolower(pathinfo($item->evidence, PATHINFO_EXTENSION));
                $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                $isImage = in_array($ext, $imageExtensions);
                $modalId = 'evidenceModal' . $item->id;
                $evidenceAlt = "Evidencia del accidente #" . str_pad($item->id, 4, '0', STR_PAD_LEFT);
            @endphp
            
            @if($isImage)
                <div class="evidence-preview">
                    <!-- Imagen clickeable para abrir el modal -->
                    <button type="button" 
                            class="evidence-thumbnail-btn p-0 border-0 bg-transparent"
                            data-bs-toggle="modal"
                            data-bs-target="#{{ $modalId }}"
                            aria-label="Ampliar imagen de evidencia">
                        <img src="{{ asset('storage/evidences/' . $item->evidence) }}"
                             alt="{{ $evidenceAlt }}"
                             class="img-thumbnail evidence-thumbnail"
                             style="max-height: 80px; width: auto; object-fit: contain; cursor: pointer;"
                             loading="lazy">
                    </button>
                    
                    <div class="evidence-actions mt-2">
                        <a href="{{ asset('storage/evidences/' . $item->evidence) }}"
                           class="btn btn-sm corporate-btn"
                           download="{{ 'evidencia-accidente-' . str_pad($item->id, 4, '0', STR_PAD_LEFT) . '.' . $ext }}"
                           aria-label="Descargar evidencia">
                            <i class="fas fa-download me-1"></i> Descargar
                        </a>
                    </div>
                </div>

                <!-- Modal para la imagen -->
                <div class="modal fade" id="{{ $modalId }}" tabindex="-1" 
                     aria-labelledby="{{ $modalId }}Label" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content corporate-modal">
                            <div class="modal-header border-0 pb-0">
                                <h2 class="modal-title h5" id="{{ $modalId }}Label">
                                    <i class="fas fa-camera me-2"></i>{{ $evidenceAlt }}
                                </h2>
                                <button type="button" class="btn-close" 
                                        data-bs-dismiss="modal" 
                                        aria-label="Cerrar modal"></button>
                            </div>
                            <div class="modal-body p-0 d-flex justify-content-center">
                                <img src="{{ asset('storage/evidences/' . $item->evidence) }}"
                                     alt="{{ $evidenceAlt }}"
                                     class="img-fluid rounded-bottom"
                                     style="max-height: 70vh; width: auto; object-fit: contain;"
                                     loading="lazy">
                            </div>
                            <div class="modal-footer border-0 pt-0">
                                <a href="{{ asset('storage/evidences/' . $item->evidence) }}"
                                   class="btn corporate-btn me-2"
                                   download="{{ 'evidencia-accidente-' . str_pad($item->id, 4, '0', STR_PAD_LEFT) . '.' . $ext }}"
                                   aria-label="Descargar evidencia">
                                    <i class="fas fa-download me-2"></i>Descargar
                                </a>
                                <button type="button" class="btn corporate-btn" 
                                        data-bs-dismiss="modal"
                                        aria-label="Cerrar modal">
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
                   rel="noopener noreferrer"
                   aria-label="Ver archivo de evidencia">
                    <i class="fas fa-file-alt me-1"></i> Ver archivo
                </a>
            @endif
        @else
            <p class="text-muted mb-0">Sin evidencia</p>
        @endif
    </div>
</td>

                                               <td class="corporate-cell accidents-cell-extra">
    <div class="created-by-info">
        <span class="fw-semibold text-dark">{{ $item->user->nickname ?? 'N/A' }}</span>
        @if($item->user)
            <small class="text-muted d-block">{{ $item->user->email ?? '' }}</small>
            <small class="text-muted d-block">{{ $item->user->position ?? '' }}</small>
        @endif
    </div>
</td>
                                                <td class="text-center corporate-cell">
                                                    <div class="response-indicator">
                                                        <span class="response-count">{{ $item->eventResponses->count() }}</span>
                                                        <i class="fas fa-comment-dots ms-1 text-muted"></i>
                                                    </div>
                                                </td>
                                                <td class="text-center corporate-cell">
                                                    <a href="{{ route('sstsena.' . $section['route_prefix'] . '.responses.index', $item->id) }}"
                                                       class="corporate-btn">
                                                        <i class="fas fa-folder-open me-2"></i>
                                                        <span>Revisar Caso</span>
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="12" class="text-center py-5">
                                                    <div class="empty-state-corporate">
                                                        <div class="empty-icon mb-3">
                                                            <i class="fas {{ $section['icon'] }} fa-3x text-muted opacity-25"></i>
                                                        </div>
                                                        <h6 class="text-muted mb-2 fw-normal">No se encontraron registros de {{ strtolower($section['title']) }}</h6>
                                                        <p class="text-muted mb-0 small">
                                                            Los nuevos incidentes se registrarán y mostrarán aquí automáticamente
                                                        </p>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                       

                                    </tbody>
                                @else
                                    {{-- Table for other sections (Incidentes, Emergencias, Comportamientos) --}}
                                    <thead>
                                        <tr class="corporate-header-row">
                                            <th class="corporate-th">
                                                <div class="th-content">
                                                    <i class="fas fa-hashtag me-2"></i>
                                                    <span>ID</span>
                                                </div>
                                            </th>
                                            <th class="corporate-th">
                                                <div class="th-content">
                                                    <i class="fas fa-calendar-alt me-2"></i>
                                                    <span>Fecha y Hora</span>
                                                </div>
                                            </th>
                                            <th class="corporate-th">
                                                <div class="th-content">
                                                    <i class="fas fa-file-alt me-2"></i>
                                                    <span>Descripción</span>
                                                </div>
                                            </th>
                                            <th class="corporate-th">
                                                <div class="th-content">
                                                    <i class="fas fa-thermometer-half me-2"></i>
                                                    <span>Nivel de Gravedad</span>
                                                </div>
                                            </th>
                                            <th class="corporate-th text-center">
                                                <div class="th-content justify-content-center">
                                                    <i class="fas fa-comments me-2"></i>
                                                    <span>Respuestas</span>
                                                </div>
                                            </th>
                                            <th class="corporate-th text-center">
                                                <div class="th-content justify-content-center">
                                                    <i class="fas fa-tools me-2"></i>
                                                    <span>Acciones</span>
                                                </div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($section['items'] as $itemIndex => $item)
                                            <tr class="corporate-row">
                                                <td class="corporate-cell">
                                                    <div class="reference-id">
                                                        <span class="fw-bold" style="color: {{ $section['color'] }};">
                                                            #{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}
                                                        </span>
                                                    </div>
                                                </td>
                                                <td class="corporate-cell">
                                                    <div class="datetime-info">
                                                        <div class="fw-semibold text-dark">{{ $item->date_time->format('d M Y') }}</div>
                                                        <small class="text-muted">
                                                            <i class="fas fa-clock me-1"></i>{{ $item->date_time->format('H:i') }}
                                                        </small>
                                                    </div>
                                                </td>
                                                <td class="corporate-cell">
                                                    <div class="description-content">
                                                        <p class="mb-0 text-dark lh-sm">{{ Str::limit($item->description ?? 'Sin descripción disponible', 65) }}</p>
                                                        @if(strlen($item->description ?? '') > 65)
                                                            <small class="text-muted mt-1 d-block">
                                                                <i class="fas fa-external-link-alt me-1"></i>Ver detalles completos
                                                            </small>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td class="corporate-cell">
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
                                                </td>
                                                <td class="text-center corporate-cell">
                                                    <div class="response-indicator">
                                                        <span class="response-count">{{ $item->eventResponses->count() }}</span>
                                                        <i class="fas fa-comment-dots ms-1 text-muted"></i>
                                                    </div>
                                                </td>
                                                <td class="text-center corporate-cell">
                                                    <a href="{{ route('sstsena.' . $section['route_prefix'] . '.responses.index', $item->id) }}"
                                                       class="corporate-btn">
                                                        <i class="fas fa-folder-open me-2"></i>
                                                        <span>Revisar Caso</span>
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center py-5">
                                                    <div class="empty-state-corporate">
                                                        <div class="empty-icon mb-3">
                                                            <i class="fas {{ $section['icon'] }} fa-3x text-muted opacity-25"></i>
                                                        </div>
                                                        <h6 class="text-muted mb-2 fw-normal">No se encontraron registros de {{ strtolower($section['title']) }}</h6>
                                                        <p class="text-muted mb-0 small">
                                                            Los nuevos incidentes se registrarán y mostrarán aquí automáticamente
                                                        </p>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                @endif
                            </table>
                        </div>
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

.fade-in { animation: fadeIn 0.4s ease-out; }
.fade-out { animation: fadeOut 0.3s ease-in forwards; }
.section-item { animation: slideInUp 0.5s ease-out both; }
.corporate-row { animation: slideInUp 0.3s ease-out both; }

/* Header corporativo */
.corporate-header {
    background: linear-gradient(135deg, var(--corporate-primary) 0%, #2c2c2c 100%);
    border-radius: 12px;
    overflow: hidden;
}

.header-content {
    color: white;
    position: relative;
}

.header-icon {
    color: rgba(255, 255, 255, 0.9);
    margin-bottom: 1rem;
}

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
    justify-content: center;
    gap: 0.25rem;
}

.response-count {
    font-weight: 700;
    font-size: 1.1rem;
    color: var(--corporate-text);
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
    .accidents-th-extra,
    .accidents-cell-extra {
        display: none;
    }
}

@media (max-width: 768px) {
    .header-content {
        padding: 2.5rem 1rem !important;
    }
    
    .header-content h1 {
        font-size: 1.5rem;
    }
    
    .section-content {
        flex-direction: column;
        align-items: flex-start !important;
        gap: 1rem;
    }
    
    .corporate-th {
        font-size: 0.7rem;
        padding: 1rem 0.75rem;
    }
    
    .corporate-cell {
        padding: 1rem 0.75rem;
    }
    
    .corporate-btn {
        padding: 0.5rem 1rem;
        font-size: 0.8rem;
    }
}

/* Mejoras de accesibilidad */
.corporate-btn:focus,
.severity-badge:focus {
    outline: 2px solid #007bff;
    outline-offset: 2px;
}

/* Print styles */
@media print {
    .corporate-header,
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
/* Estilos para el contenedor de evidencia en la tabla */
.evidence-container {
    max-width: 200px;
}

.evidence-preview {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
}

.evidence-thumbnail {
    border: 1px solid #dee2e6;
    border-radius: 4px;
    transition: all 0.3s ease;
    max-width: 100%;
}

.evidence-thumbnail:hover {
    border-color: var(--corporate-primary);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.evidence-actions {
    display: flex;
    gap: 0.5rem;
}

.evidence-actions .btn {
    padding: 0.25rem 0.5rem;
    font-size: 0.8rem;
}

/* Ajustes para el modal */
.corporate-modal {
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
}

.corporate-modal .modal-header {
    background-color: var(--corporate-primary);
    color: white;
}

.corporate-modal .btn-close {
    filter: invert(1);
    opacity: 0.8;
}

.corporate-modal .btn-close:hover {
    opacity: 1;
}
</style>
@endsection
```