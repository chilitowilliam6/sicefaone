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

    {{-- Sección: Accidentes Laborales --}}
    <div class="row g-4 mb-4">
        <div class="col-12 section-item">
            {{-- Card corporativa --}}
            <div class="corporate-card border-0 shadow-sm">
                {{-- Header de sección corporativo --}}
                <div class="section-header" style="border-left: 4px solid #DC143C;">
                    <div class="section-content d-flex justify-content-between align-items-center py-4 px-4">
                        <div class="d-flex align-items-center">
                            <div class="section-icon me-4" style="background-color: #DC143C15;">
                                <i class="fas fa-exclamation-triangle fa-lg" style="color: #DC143C;"></i>
                            </div>
                            <div>
                                <h4 class="mb-1 fw-semibold text-dark">Accidentes Laborales</h4>
                                <small class="text-muted">Evaluación y Gestión de Riesgos</small>
                            </div>
                        </div>
                        <div class="stats-container">
                            <div class="stats-number">{{ $accidents->count() }}</div>
                            <div class="stats-label">Registros</div>
                        </div>
                    </div>
                </div>

                {{-- Tabla corporativa --}}
                <div class="table-container">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 corporate-table">
                            <thead>
                                <tr class="corporate-header-row">
                                    <th class="corporate-th" style="width: 5%;">
                                        <div class="th-content">
                                            <i class="fas fa-hashtag me-2"></i>
                                            <span>#</span>
                                        </div>
                                    </th>
                                    <th class="corporate-th" style="width: 8%;">
                                        <div class="th-content">
                                            <i class="fas fa-calendar-alt me-2"></i>
                                            <span>Fecha y Hora</span>
                                        </div>
                                    </th>
                                    <th class="corporate-th accidents-th-extra" style="width: 8%;">
                                        <div class="th-content">
                                            <i class="fas fa-map-marker-alt me-2"></i>
                                            <span>Ubicación</span>
                                        </div>
                                    </th>
                                    <th class="corporate-th accidents-th-extra" style="width: 8%;">
                                        <div class="th-content">
                                            <i class="fas fa-medkit me-2"></i>
                                            <span>Tipo de Lesión</span>
                                        </div>
                                    </th>
                                    <th class="corporate-th accidents-th-extra" style="width: 8%;">
                                        <div class="th-content">
                                            <i class="fas fa-exclamation-circle me-2"></i>
                                            <span>Tipo de Riesgo</span>
                                        </div>
                                    </th>
                                    <th class="corporate-th accidents-th-extra" style="width: 8%;">
                                        <div class="th-content">
                                            <i class="fas fa-briefcase me-2"></i>
                                            <span>Tipo de Accidente</span>
                                        </div>
                                    </th>
                                    <th class="corporate-th" style="width: 30%;">
                                        <div class="th-content">
                                            <i class="fas fa-file-alt me-3"></i>
                                            <span>Descripción del accidente</span>
                                        </div>
                                    </th>
                                    <th class="corporate-th" style="width: 8%;">
                                        <div class="th-content">
                                            <i class="fas fa-thermometer-half me-2"></i>
                                            <span>Gravedad</span>
                                        </div>
                                    </th>
                                    <th class="corporate-th accidents-th-extra" style="width: 8%;">
                                        <div class="th-content">
                                            <i class="fas fa-camera me-2"></i>
                                            <span>Evidencia</span>
                                        </div>
                                    </th>
                                    <th class="corporate-th accidents-th-extra" style="width: 8%;">
                                        <div class="th-content">
                                            <i class="fas fa-user me-2"></i>
                                            <span>Creado por</span>
                                        </div>
                                    </th>
                                    <th class="corporate-th text-center" style="width: 8%;">
                                        <div class="th-content justify-content-center">
                                            <i class="fas fa-comments me-2"></i>
                                            <span>Respuestas</span>
                                        </div>
                                    </th>
                                    <th class="corporate-th text-center" style="width: 8%;">
                                        <div class="th-content justify-content-center">
                                            <i class="fas fa-tools me-2"></i>
                                            <span>Acciones</span>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($accidents as $itemIndex => $item)
                                    <tr class="corporate-row">
                                        <td class="corporate-cell" style="width: 5%;">
                                            <div class="reference-id">
                                                <span class="fw-bold" style="color: #DC143C;">
                                                    #{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="corporate-cell" style="width: 8%;">
                                            <div class="datetime-info">
                                                <div class="fw-semibold text-dark">{{ $item->date_time->format('d M Y') }}</div>
                                                <small class="text-muted">
                                                    <i class="fas fa-clock me-1"></i>{{ $item->date_time->format('H:i') }}
                                                </small>
                                            </div>
                                        </td>
                                        <td class="corporate-cell accidents-cell-extra" style="width: 8%;">
                                            <div class="environment-info">
                                                <span class="fw-semibold text-dark">{{ $item->environment->name ?? 'N/A' }}</span>
                                            </div>
                                        </td>
                                        <td class="corporate-cell accidents-cell-extra" style="width: 8%;">
                                            <div class="injury-type-info">
                                                <span class="fw-semibold text-dark">{{ $item->injuryType->name ?? 'N/A' }}</span>
                                            </div>
                                        </td>
                                        <td class="corporate-cell accidents-cell-extra" style="width: 8%;">
                                            <div class="risk-type-info">
                                                <span class="fw-semibold text-dark">{{ $item->riskType->name ?? 'N/A' }}</span>
                                            </div>
                                        </td>
                                        <td class="corporate-cell accidents-cell-extra" style="width: 8%;">
                                            <div class="accident-type-info">
                                                <span class="fw-semibold text-dark">{{ $item->accidentType->name ?? 'N/A' }}</span>
                                            </div>
                                        </td>
                                        <td class="corporate-cell" style="width: 30%;">
                                            <div class="description-content">
                                                <p class="mb-0 text-dark lh-sm expandable-text" id="description-accidents-{{ $item->id }}"
                                                   style="max-height: 3em; overflow: hidden; transition: max-height 0.3s ease;">
                                                    {{ $item->description ?? 'Sin descripción disponible' }}
                                                </p>
                                                @if(strlen($item->description ?? '') > 65)
                                                    <small class="text-muted mt-1 d-block toggle-text" onclick="toggleText('description-accidents-{{ $item->id }}')">
                                                        <i class="fas fa-chevron-down me-1 toggle-icon"></i>
                                                        <span class="toggle-label">Mostrar más</span>
                                                    </small>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="corporate-cell" style="width: 8%;">
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
                                        <td class="corporate-cell accidents-cell-extra align-middle" style="width: 8%;">
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
                                                            <button type="button"
                                                                    class="evidence-thumbnail-btn p-0 border-0 bg-transparent"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#{{ $modalId }}"
                                                                    aria-label="Ampliar imagen de evidencia">
                                                                <img src="{{ asset('storage/evidences/' . $item->evidence) }}"
                                                                     alt="{{ $evidenceAlt }}"
                                                                     class="img-thumbnail evidence-thumbnail"
                                                                     style="max-height: 60px; width: auto; object-fit: contain; cursor: pointer;"
                                                                     loading="lazy">
                                                            </button>
                                                            <div class="evidence-actions mt-2">
                                                                <a href="{{ asset('storage/evidences/' . $item->evidence) }}"
                                                                   class="btn btn-sm corporate-btn"
                                                                   download="{{ 'evidencia-accidente-' . str_pad($item->id, 4, '0', STR_PAD_LEFT) . '.' . $ext }}">
                                                                    <center><i class="fas fa-download me-1"></i>Descargar</center>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="modal fade" id="{{ $modalId }}" tabindex="-1"
                                                             aria-labelledby="{{ $modalId }}Label" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered modal-xl">
                                                                <div class="modal-content bg-white rounded-3 shadow">
                                                                    <div class="modal-header border-bottom-0">
                                                                        <h5 class="modal-title text-dark" id="{{ $modalId }}Label">
                                                                            <i class="fas fa-image me-2"></i>{{ $evidenceAlt }}
                                                                        </h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                                                    </div>
                                                                    <div class="modal-body d-flex justify-content-center p-4" style="min-height: 300px;">
                                                                        <img src="{{ asset('storage/evidences/' . $item->evidence) }}"
                                                                             alt="{{ $evidenceAlt }}"
                                                                             class="img-fluid rounded"
                                                                             style="max-height: 80vh; object-fit: contain; width: auto;"
                                                                             loading="lazy">
                                                                    </div>
                                                                    <div class="modal-footer border-top-0 justify-content-between px-4 pb-3">
                                                                        <a href="{{ asset('storage/evidences/' . $item->evidence) }}"
                                                                           class="btn btn-primary"
                                                                           download="{{ 'evidencia-accidente-' . str_pad($item->id, 4, '0', STR_PAD_LEFT) . '.' . $ext }}">
                                                                            <i class="fas fa-download me-2"></i> Descargar
                                                                        </a>
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                                            <i class="fas fa-times me-2"></i> Cerrar
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <a href="{{ asset('storage/evidences/' . $item->evidence) }}"
                                                           class="btn btn-sm corporate-btn"
                                                           target="_blank"
                                                           rel="noopener noreferrer">
                                                            <i class="fas fa-file-alt me-1"></i> Ver archivo
                                                        </a>
                                                    @endif
                                                @else
                                                    <p class="text-muted mb-0">Sin evidencia</p>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="corporate-cell accidents-cell-extra" style="width: 8%;">
                                            <div class="created-by-info">
                                                <span class="fw-semibold text-dark">{{ $item->user->nickname ?? 'Funcionario' }}</span>
                                                @if($item->user)
                                                    <small class="text-muted d-block">{{ $item->user->email ?? '' }}</small>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="text-center corporate-cell" style="width: 8%;">
                                            <div class="response-indicator">
                                                <span class="response-count">{{ $item->eventResponses->count() }}</span>
                                                <i class="fas fa-comment-dots ms-1 text-muted"></i>
                                            </div>
                                        </td>
                                        <td class="text-center corporate-cell" style="width: 8%;">
                                            <a href="{{ route('sstsena.accidents.responses.index', $item->id) }}"
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
                                                    <i class="fas fa-exclamation-triangle fa-3x text-muted opacity-25"></i>
                                                </div>
                                                <h6 class="text-muted mb-2 fw-normal">No se encontraron registros de accidentes laborales</h6>
                                                <p class="text-muted mb-0 small">
                                                    Los nuevos incidentes se registrarán y mostrarán aquí automáticamente
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

 {{-- Sección: Incidentes de Trabajo --}}
<div class="row g-4 mb-4">
    <div class="col-12 section-item">
        <div class="corporate-card border-0 shadow-sm">
            {{-- Header de sección corporativo --}}
            <div class="section-header" style="border-left: 4px solid #FF8C00;">
                <div class="section-content d-flex justify-content-between align-items-center py-4 px-4">
                    <div class="d-flex align-items-center">
                        <div class="section-icon me-4" style="background-color: #FF8C0015;">
                            <i class="fas fa-clipboard-list fa-lg" style="color: #FF8C00;"></i>
                        </div>
                        <div>
                            <h4 class="mb-1 fw-semibold text-dark">Incidentes de Trabajo</h4>
                            <small class="text-muted">Evaluación y Gestión de Riesgos</small>
                        </div>
                    </div>
                    <div class="stats-container">
                        <div class="stats-number">{{ $incidents->count() }}</div>
                        <div class="stats-label">Registros</div>
                    </div>
                </div>
            </div>

            {{-- Tabla corporativa --}}
            <div class="table-container">
                <div class="table-responsive">
                    <table class="table table-hover mb-0 corporate-table">
                        <thead>
                            <tr class="corporate-header-row">
                                <th class="corporate-th"><i class="fas fa-calendar-alt me-2"></i>Fecha y Hora</th>
                                <th class="corporate-th"><i class="fas fa-map-marker-alt me-2"></i>Ubicación</th>
                                <th class="corporate-th"><i class="fas fa-exclamation-triangle me-2"></i>Tipo de Riesgo</th>
                                <th class="corporate-th"><i class="fas fa-briefcase me-2"></i>Tipo de incidente</th>
                                <th class="corporate-th"><i class="fas fa-file-alt me-2"></i>Descripción del Incidente</th>
                                <th class="corporate-th"><i class="fas fa-thermometer-half me-2"></i>Gravedad</th>
                                <th class="corporate-th"><i class="fas fa-camera me-2"></i>Evidencia</th>
                                <th class="corporate-th"><i class="fas fa-user me-2"></i>Creado por</th>
                                <th class="corporate-th text-center"><i class="fas fa-comments me-2"></i>Respuestas</th>
                                <th class="corporate-th text-center"><i class="fas fa-tools me-2"></i>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($incidents as $item)
                                <tr class="corporate-row">
                                    {{-- Fecha y Hora --}}
                                    <td class="corporate-cell">
                                        <div class="fw-semibold text-dark">{{ $item->date_time->format('d M Y') }}</div>
                                        <small class="text-muted"><i class="fas fa-clock me-1"></i>{{ $item->date_time->format('H:i') }}</small>
                                    </td>

                                    {{-- Ubicación --}}
                                    <td class="corporate-cell">
                                        <span class="fw-semibold text-dark">{{ $item->environment->name ?? 'N/A' }}</span>
                                    </td>

                                    {{-- Tipo de Riesgo --}}
                                    <td class="corporate-cell">
                                        <span class="fw-semibold text-dark">{{ $item->riskType->name ?? 'N/A' }}</span>
                                    </td>

                                    {{-- Tipo de Incidente --}}
                                    <td class="corporate-cell">
                                        <span class="fw-semibold text-dark">{{ $item->incidentType->name ?? 'N/A' }}</span>
                                    </td>

                                    {{-- Descripción --}}
                                    <td class="corporate-cell">
                                        <p class="mb-0 text-dark lh-sm expandable-text" id="description-incidents-{{ $item->id }}"
                                           style="max-height: 3em; overflow: hidden; transition: max-height 0.3s ease;">
                                            {{ $item->description ?? 'Sin descripción disponible' }}
                                        </p>
                                        @if(strlen($item->description ?? '') > 65)
                                            <small class="text-muted mt-1 d-block toggle-text" onclick="toggleText('description-incidents-{{ $item->id }}')">
                                                <i class="fas fa-chevron-down me-1 toggle-icon"></i>
                                                <span class="toggle-label">Mostrar más</span>
                                            </small>
                                        @endif
                                    </td>

                                    {{-- Gravedad --}}
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

                   {{-- Evidencia --}}
{{-- Evidencia --}}
<td class="corporate-cell text-center align-middle">
    @if($item->evidence)
        @php
            $ext = strtolower(pathinfo($item->evidence, PATHINFO_EXTENSION));
            $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            $isImage = in_array($ext, $imageExtensions);
            $modalId = 'incidentEvidenceModal' . $item->id;
            $evidencePath = asset('storage/evidences/' . $item->evidence);
        @endphp

        @if($isImage)
            <!-- Miniatura de imagen con enlace al modal -->
            <a href="#" data-bs-toggle="modal" data-bs-target="#{{ $modalId }}">
                <img src="{{ $evidencePath }}"
                     alt="Evidencia"
                     class="img-thumbnail shadow-sm"
                     style="width: 60px; height: 60px; object-fit: cover;">
            </a>

            <!-- Botón de descarga -->
            <div class="mt-1">
                <a href="{{ $evidencePath }}" download
                   class="btn btn-light border d-inline-flex align-items-center gap-1 px-2 py-0 small rounded"
                   style="font-size: 0.7rem; line-height: 1rem;" title="Descargar imagen">
                    <i class="fas fa-download" style="font-size: 0.75rem;"></i>
                    Descargar
                </a>
            </div>

            <!-- Modal de imagen grande -->
            <div class="modal fade" id="{{ $modalId }}" tabindex="-1" aria-labelledby="{{ $modalId }}Label" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content rounded-3">
                        <div class="modal-header">
                            <h5 class="modal-title fw-semibold" id="{{ $modalId }}Label">Evidencia del Incidente</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                        </div>
                        <div class="modal-body text-center">
                            <img src="{{ $evidencePath }}"
                                 alt="Evidencia"
                                 class="img-fluid rounded shadow"
                                 style="max-height: 600px; object-fit: contain;">
                        </div>
                    </div>
                </div>
            </div>
        @else
            <!-- Solo botón de descarga para archivos no imagen -->
            <a href="{{ $evidencePath }}" download
               class="btn btn-light border d-inline-flex align-items-center gap-1 px-2 py-0 small rounded mt-1"
               style="font-size: 0.7rem; line-height: 1rem;" title="Descargar archivo">
                <i class="fas fa-download" style="font-size: 0.75rem;"></i>
                Descargar
            </a>
        @endif
    @else
        <span class="text-muted fst-italic">Sin evidencia</span>
    @endif
</td>



                                   
                                      {{-- Creado por --}}
                                 <td class="corporate-cell accidents-cell-extra" style="width: 8%;">
                                            <div class="created-by-info">
                                                <span class="fw-semibold text-dark">{{ $item->user->nickname ?? 'Funcionario' }}</span>
                                                @if($item->user)
                                                    <small class="text-muted d-block">{{ $item->user->email ?? '' }}</small>
                                                @endif
                                            </div>
                                        </td>

                                    {{-- Respuestas --}}
                                    <td class="text-center corporate-cell">
                                        <span class="response-count">{{ $item->eventResponses->count() }}</span>
                                        <i class="fas fa-comment-dots ms-1 text-muted"></i>
                                    </td>

                                    {{-- Acciones --}}
                                    <td class="text-center corporate-cell">
                                        <a href="{{ route('sstsena.incidents.responses.index', $item->id) }}" class="corporate-btn">
                                            <i class="fas fa-folder-open me-2"></i>
                                            <span>Revisar Caso</span>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="11" class="text-center py-5">
                                        <div class="empty-state-corporate">
                                            <div class="empty-icon mb-3">
                                                <i class="fas fa-clipboard-list fa-3x text-muted opacity-25"></i>
                                            </div>
                                            <h6 class="text-muted mb-2 fw-normal">No se encontraron registros de incidentes de trabajo</h6>
                                            <p class="text-muted mb-0 small">Los nuevos incidentes se registrarán y mostrarán aquí automáticamente</p>
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

{{-- Sección: Situaciones de Emergencia --}}
<div class="row g-4 mb-4">
    <div class="col-12 section-item">
        <div class="corporate-card border-0 shadow-sm">
            {{-- Header de sección corporativo --}}
            <div class="section-header" style="border-left: 4px solid #4169E1;">
                <div class="section-content d-flex justify-content-between align-items-center py-4 px-4">
                    <div class="d-flex align-items-center">
                        <div class="section-icon me-4" style="background-color: #4169E115;">
                            <i class="fas fa-shield-alt fa-lg" style="color: #4169E1;"></i>
                        </div>
                        <div>
                            <h4 class="mb-1 fw-semibold text-dark">Situaciones de Emergencia</h4>
                            <small class="text-muted">Evaluación y Gestión de Riesgos</small>
                        </div>
                    </div>
                    <div class="stats-container">
                        <div class="stats-number">{{ $emergencies->count() }}</div>
                        <div class="stats-label">Registros</div>
                    </div>
                </div>
            </div>

            {{-- Tabla corporativa --}}
            <div class="table-container">
                <div class="table-responsive">
                    <table class="table table-hover mb-0 corporate-table">
                        <thead>
                            <tr class="corporate-header-row">
                                <th class="corporate-th"><i class="fas fa-id-badge me-2"></i>ID</th>
                                <th class="corporate-th"><i class="fas fa-calendar-alt me-2"></i>Fecha y Hora</th>
                                <th class="corporate-th"><i class="fas fa-map-marker-alt me-2"></i>Ambiente</th>
                                <th class="corporate-th"><i class="fas fa-exclamation-triangle me-2"></i>Tipo de Riesgo</th>
                                <th class="corporate-th"><i class="fas fa-bullhorn me-2"></i>Tipo de Emergencia</th>
                                <th class="corporate-th"><i class="fas fa-file-alt me-2"></i>Descripción de emergencia</th>
                                <th class="corporate-th"><i class="fas fa-thermometer-half me-2"></i>Gravedad</th>
                                <th class="corporate-th"><i class="fas fa-camera me-2"></i>Evidencia</th>
                                <th class="corporate-th"><i class="fas fa-user me-2"></i>Creado por</th>
                                <th class="corporate-th text-center"><i class="fas fa-comments me-2"></i>Respuestas</th>
                                <th class="corporate-th text-center"><i class="fas fa-tools me-2"></i>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($emergencies as $item)
                                <tr class="corporate-row">
                                    {{-- ID --}}
                                    <td class="corporate-cell">
                                        <div class="fw-semibold text-dark">{{ $item->id }}</div>
                                    </td>

                                    {{-- Fecha y Hora --}}
                                    <td class="corporate-cell">
                                        <div class="fw-semibold text-dark">{{ $item->date_time->format('d M Y') }}</div>
                                        <small class="text-muted"><i class="fas fa-clock me-1"></i>{{ $item->date_time->format('H:i') }}</small>
                                    </td>

                                    {{-- Ambiente --}}
                                    <td class="corporate-cell">
                                        <p class="mb-0 text-dark lh-sm expandable-text" id="environment-emergencies-{{ $item->id }}"
                                           style="max-height: 3em; overflow: hidden; transition: max-height 0.3s ease;">
                                            {{ $item->environment->name ?? 'N/A' }}
                                        </p>
                                        @if(strlen($item->environment->name ?? '') > 65)
                                            <small class="text-muted mt-1 d-block toggle-text" onclick="toggleText('environment-emergencies-{{ $item->id }}')">
                                                <i class="fas fa-chevron-down me-1 toggle-icon"></i>
                                                <span class="toggle-label">Mostrar más</span>
                                            </small>
                                        @endif
                                    </td>

                                    {{-- Tipo de Riesgo --}}
                                    <td class="corporate-cell">
                                        <p class="mb-0 text-dark lh-sm expandable-text" id="riskType-emergencies-{{ $item->id }}"
                                           style="max-height: 3em; overflow: hidden; transition: max-height 0.3s ease;">
                                            {{ $item->riskType->name ?? 'N/A' }}
                                        </p>
                                        @if(strlen($item->riskType->name ?? '') > 65)
                                            <small class="text-muted mt-1 d-block toggle-text" onclick="toggleText('riskType-emergencies-{{ $item->id }}')">
                                                <i class="fas fa-chevron-down me-1 toggle-icon"></i>
                                                <span class="toggle-label">Mostrar más</span>
                                            </small>
                                        @endif
                                    </td>

                                    {{-- Tipo de Emergencia --}}
                                    <td class="corporate-cell">
                                        <p class="mb-0 text-dark lh-sm expandable-text" id="emergencyType-emergencies-{{ $item->id }}"
                                           style="max-height: 3em; overflow: hidden; transition: max-height 0.3s ease;">
                                            {{ $item->emergencyType->name ?? 'N/A' }}
                                        </p>
                                        @if(strlen($item->emergencyType->name ?? '') > 65)
                                            <small class="text-muted mt-1 d-block toggle-text" onclick="toggleText('emergencyType-emergencies-{{ $item->id }}')">
                                                <i class="fas fa-chevron-down me-1 toggle-icon"></i>
                                                <span class="toggle-label">Mostrar más</span>
                                            </small>
                                        @endif
                                    </td>

                                    {{-- Descripción --}}
                                    <td class="corporate-cell">
                                        <p class="mb-0 text-dark lh-sm expandable-text" id="description-emergencies-{{ $item->id }}"
                                           style="max-height: 3em; overflow: hidden; transition: max-height 0.3s ease;">
                                            {{ $item->description ?? 'Sin descripción disponible' }}
                                        </p>
                                        @if(strlen($item->description ?? '') > 65)
                                            <small class="text-muted mt-1 d-block toggle-text" onclick="toggleText('description-emergencies-{{ $item->id }}')">
                                                <i class="fas fa-chevron-down me-1 toggle-icon"></i>
                                                <span class="toggle-label">Mostrar más</span>
                                            </small>
                                        @endif
                                    </td>

                                    {{-- Gravedad --}}
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

                                    {{-- Evidencia --}}
                                    <td class="corporate-cell text-center align-middle">
                                        @if($item->evidence)
                                            @php
                                                $ext = strtolower(pathinfo($item->evidence, PATHINFO_EXTENSION));
                                                $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                                                $isImage = in_array($ext, $imageExtensions);
                                                $modalId = 'emergencyEvidenceModal' . $item->id;
                                                $evidencePath = asset('storage/evidences/' . $item->evidence);
                                            @endphp

                                            @if($isImage)
                                                <!-- Miniatura de imagen con enlace al modal -->
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#{{ $modalId }}">
                                                    <img src="{{ $evidencePath }}"
                                                         alt="Evidencia"
                                                         class="img-thumbnail shadow-sm"
                                                         style="width: 60px; height: 60px; object-fit: cover;">
                                                </a>

                                                <!-- Botón de descarga -->
                                                <div class="mt-1">
                                                    <a href="{{ $evidencePath }}" download
                                                       class="btn btn-light border d-inline-flex align-items-center gap-1 px-2 py-0 small rounded"
                                                       style="font-size: 0.7rem; line-height: 1rem;" title="Descargar imagen">
                                                        <i class="fas fa-download" style="font-size: 0.75rem;"></i>
                                                        Descargar
                                                    </a>
                                                </div>

                                                <!-- Modal de imagen grande -->
                                                <div class="modal fade" id="{{ $modalId }}" tabindex="-1" aria-labelledby="{{ $modalId }}Label" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                                        <div class="modal-content rounded-3">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title fw-semibold" id="{{ $modalId }}Label">Evidencia de la Emergencia</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                                            </div>
                                                            <div class="modal-body text-center">
                                                                <img src="{{ $evidencePath }}"
                                                                     alt="Evidencia"
                                                                     class="img-fluid rounded shadow"
                                                                     style="max-height: 600px; object-fit: contain;">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <!-- Solo botón de descarga para archivos no imagen -->
                                                <a href="{{ $evidencePath }}" download
                                                   class="btn btn-light border d-inline-flex align-items-center gap-1 px-2 py-0 small rounded mt-1"
                                                   style="font-size: 0.7rem; line-height: 1rem;" title="Descargar archivo">
                                                    <i class="fas fa-download" style="font-size: 0.7rem;"></i>
                                                    Descargar
                                                </a>
                                            @endif
                                        @else
                                            <span class="text-muted fst-italic">Sin evidencia</span>
                                        @endif
                                    </td>

                                    {{-- Creado por --}}
                                    <td class="corporate-cell" style="width: 8%;">
                                        <div class="created-by-info">
                                            <span class="text-dark">{{ $item->user->nickname ?? 'Funcionario' }}</span>
                                            @if($item->createdBy)
                                                <span class="text-muted">{{ $item->user->email ?? '' }}</span>
                                            @endif
                                        </div>
                                    </td>

                                    <!-- Respuestas -->
                                    <td class="text-center">
                                        <span class="response-count">{{ $item->eventResponses->count() }}</span>
                                        <i class="fas fa-comment-dots ms-1 text-muted"></i>
                                    </td>

                                    <!-- Acciones -->
                                    <td colspan="text-center">
                                        <a href="{{ route('sstsena.emergencies.responses.index', $item->id) }}" class="corporate-btn">
                                            <i class="fas fa-folder-open me-1"></i>
                                            <span>Revisar Caso</span>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="11" class="text-center py-5">
                                        <div class="empty-state-corporate">
                                            <div class="empty-icon mb-3">
                                                <i class="fas fa-shield-alt fa-3x text-muted opacity-25"></i>
                                            </div>
                                            <h6 class="text-muted mb-0 fw-normal">No se encontraron registros de situaciones de emergencia</h6>
                                            <small class="text-muted">
                                                Los nuevos incidentes registrados se mostraran aqui automaticamente y
                                            </small>
                                        </div>
                                    </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

  {{-- Sección: Comportamientos Inseguros --}}
<div class="row g-4">
    <div class="col-12 section-item">
        {{-- Card corporativa --}}
        <div class="corporate-card border-0 shadow-sm">
            {{-- Header de sección corporativo --}}
            <div class="section-header" style="border-left: 4px solid #708090;">
                <div class="section-content d-flex justify-content-between align-items-center py-4 px-4">
                    <div class="d-flex align-items-center">
                        <div class="section-icon me-4" style="background-color: #70809015;">
                            <i class="fas fa-eye-slash fa-lg" style="color: #708090;"></i>
                        </div>
                        <div>
                            <h4 class="mb-1 fw-semibold text-dark">Comportamientos Inseguros</h4>
                            <small class="text-muted">Evaluación y Gestión de Riesgos</small>
                        </div>
                    </div>
                    <div class="stats-container">
                        <div class="stats-number">{{ $unsafeActs->count() }}</div>
                        <div class="stats-label">Registros</div>
                    </div>
                </div>
            </div>

            {{-- Tabla corporativa --}}
            <div class="table-container">
                <div class="table-responsive">
                    <table class="table table-hover mb-0 corporate-table">
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
                                        <i class="fas fa-map-marker-alt me-2"></i>
                                        <span>Ambiente</span>
                                    </div>
                                </th>
                                <th class="corporate-th">
                                    <div class="th-content">
                                        <i class="fas fa-exclamation-triangle me-2"></i>
                                        <span>Tipo de Riesgo</span>
                                    </div>
                                </th>
                                <th class="corporate-th">
                                    <div class="th-content">
                                        <i class="fas fa-user-times me-2"></i>
                                        <span>Tipo de Comportamiento</span>
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
                                <th class="corporate-th">
                                    <div class="th-content">
                                        <i class="fas fa-camera me-2"></i>
                                        <span>Evidencia</span>
                                    </div>
                                </th>
                                <th class="corporate-th">
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
                            @forelse ($unsafeActs as $itemIndex => $item)
                                <tr class="corporate-row">
                                    <td class="corporate-cell">
                                        <div class="reference-id">
                                            <span class="fw-bold" style="color: #708090;">
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
                                        <p class="mb-0 text-dark lh-sm expandable-text" id="environment-unsafe_acts-{{ $item->id }}"
                                           style="max-height: 3em; overflow: hidden; transition: max-height 0.3s ease;">
                                            {{ $item->environment->name ?? 'N/A' }}
                                        </p>
                                        @if(strlen($item->environment->name ?? '') > 65)
                                            <small class="text-muted mt-1 d-block toggle-text" onclick="toggleText('environment-unsafe_acts-{{ $item->id }}')">
                                                <i class="fas fa-chevron-down me-1 toggle-icon"></i>
                                                <span class="toggle-label">Mostrar más</span>
                                            </small>
                                        @endif
                                    </td>
                                    <td class="corporate-cell">
                                        <p class="mb-0 text-dark lh-sm expandable-text" id="riskType-unsafe_acts-{{ $item->id }}"
                                           style="max-height: 3em; overflow: hidden; transition: max-height 0.3s ease;">
                                            {{ $item->riskType->name ?? 'N/A' }}
                                        </p>
                                        @if(strlen($item->riskType->name ?? '') > 65)
                                            <small class="text-muted mt-1 d-block toggle-text" onclick="toggleText('riskType-unsafe_acts-{{ $item->id }}')">
                                                <i class="fas fa-chevron-down me-1 toggle-icon"></i>
                                                <span class="toggle-label">Mostrar más</span>
                                            </small>
                                        @endif
                                    </td>
                                    <td class="corporate-cell">
                                        <p class="mb-0 text-dark lh-sm expandable-text" id="unsafeActType-unsafe_acts-{{ $item->id }}"
                                           style="max-height: 3em; overflow: hidden; transition: max-height 0.3s ease;">
                                            {{ $item->unsafeActType->name ?? 'N/A' }}
                                        </p>
                                        @if(strlen($item->unsafeActType->name ?? '') > 65)
                                            <small class="text-muted mt-1 d-block toggle-text" onclick="toggleText('unsafeActType-unsafe_acts-{{ $item->id }}')">
                                                <i class="fas fa-chevron-down me-1 toggle-icon"></i>
                                                <span class="toggle-label">Mostrar más</span>
                                            </small>
                                        @endif
                                    </td>
                                    <td class="corporate-cell">
                                        <div class="description-content">
                                            <p class="mb-0 text-dark lh-sm expandable-text" id="description-unsafe_acts-{{ $item->id }}"
                                               style="max-height: 3em; overflow: hidden; transition: max-height 0.3s ease;">
                                                {{ $item->description ?? 'Sin descripción disponible' }}
                                            </p>
                                            @if(strlen($item->description ?? '') > 65)
                                                <small class="text-muted mt-1 d-block toggle-text" onclick="toggleText('description-unsafe_acts-{{ $item->id }}')">
                                                    <i class="fas fa-chevron-down me-1 toggle-icon"></i>
                                                    <span class="toggle-label">Mostrar más</span>
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
                                    <td class="corporate-cell text-center align-middle">
                                        @if($item->evidence)
                                            @php
                                                $ext = strtolower(pathinfo($item->evidence, PATHINFO_EXTENSION));
                                                $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                                                $isImage = in_array($ext, $imageExtensions);
                                                $modalId = 'unsafeActEvidenceModal' . $item->id;
                                                $evidencePath = asset('storage/evidences/' . $item->evidence);
                                            @endphp

                                            @if($isImage)
                                                <!-- Miniatura de imagen con enlace al modal -->
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#{{ $modalId }}">
                                                    <img src="{{ $evidencePath }}"
                                                         alt="Evidencia"
                                                         class="img-thumbnail shadow-sm"
                                                         style="width: 60px; height: 60px; object-fit: cover;">
                                                </a>

                                                <!-- Botón de descarga -->
                                                <div class="mt-1">
                                                    <a href="{{ $evidencePath }}" download
                                                       class="btn btn-light border d-inline-flex align-items-center gap-1 px-2 py-0 small rounded"
                                                       style="font-size: 0.7rem; line-height: 1rem;" title="Descargar imagen">
                                                        <i class="fas fa-download" style="font-size: 0.75rem;"></i>
                                                        Descargar
                                                    </a>
                                                </div>

                                                <!-- Modal de imagen grande -->
                                                <Treasure: System: <div class="modal fade" id="{{ $modalId }}" tabindex="-1" aria-labelledby="{{ $modalId }}Label" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                                        <div class="modal-content rounded-3">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title fw-semibold" id="{{ $modalId }}Label">Evidencia de Comportamiento Inseguro</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                                            </div>
                                                            <div class="modal-body text-center">
                                                                <img src="{{ $evidencePath }}"
                                                                     alt="Evidencia"
                                                                     class="img-fluid rounded shadow"
                                                                     style="max-height: 600px; object-fit: contain;">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <!-- Solo botón de descarga para archivos no imagen -->
                                                <a href="{{ $evidencePath }}" download
                                                   class="btn btn-light border d-inline-flex align-items-center gap-1 px-2 py-0 small rounded mt-1"
                                                   style="font-size: 0.7rem; line-height: 1rem;" title="Descargar archivo">
                                                    <i class="fas fa-download" style="font-size: 0.7rem;"></i>
                                                    Descargar
                                                </a>
                                            @endif
                                        @else
                                            <span class="text-muted fst-italic">Sin evidencia</span>
                                        @endif
                                    </td>
                                    <td class="corporate-cell" style="width: 8%;">
                                        <div class="created-by-info">
                                            <span class="text-dark">{{ $item->user->nickname ?? 'Funcionario' }}</span>
                                            @if($item->user->email)
                                                <span class="text-muted">{{ $item->user->email }}</span>
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
                                        <a href="{{ route('sstsena.unsafe_acts.responses.index', $item->id) }}"
                                           class="corporate-btn">
                                            <i class="fas fa-folder-open me-2"></i>
                                            <span>Revisar Caso</span>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="11" class="text-center py-5">
                                        <div class="empty-state-corporate">
                                            <div class="empty-icon mb-3">
                                                <i class="fas fa-eye-slash fa-3x text-muted opacity-25"></i>
                                            </div>
                                            <h6 class="text-muted mb-2 fw-normal">No se encontraron registros de comportamientos inseguros</h6>
                                            <p class="text-muted mb0 small">
                                                Los nuevos incidentes se registrarán y mostrarán aquí automáticamente
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

.toggle-text:hover .toggle-label {
    text-decoration: underline;
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
.severity-badge:focus,
.toggle-text:focus {
    outline: 2px solid #007bff;
    outline-offset: 2px;
}

/* Print styles */
@media print {
    .corporate-btn,
    .toggle-text {
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
</style>

<script>
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
```