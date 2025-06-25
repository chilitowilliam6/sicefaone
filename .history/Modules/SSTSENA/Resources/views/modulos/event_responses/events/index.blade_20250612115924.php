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
                                                <i class="fas fa-user me-2"></i>
                                                <span>Creado por</span>
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
                                                <i class="fas fa-medkit me-2"></i>
                                                <span>Tipo de Lesión</span>
                                            </div>
                                        </th>
                                        <th class="corporate-th">
                                            <div class="th-content">
                                                <i class="fas fa-exclamation-circle me-2"></i>
                                                <span>Tipo de Riesgo</span>
                                            </div>
                                        </th>
                                        <th class="corporate-th">
                                            <div class="th-content">
                                                <i class="fas fa-briefcase me-2"></i>
                                                <span>Tipo de Accidente</span>
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
                                                <div class="created-by-info">
                                                    <span class="fw-semibold text-dark">{{ $item->createdBy->name ?? 'N/A' }}</span>
                                                </div>
                                            </td>
                                            <td class="corporate-cell">
                                                <div class="environment-info">
                                                    <span class="fw-semibold text-dark">{{ $item->environment->name ?? 'N/A' }}</span>
                                                </div>
                                            </td>
                                            <td class="corporate-cell">
                                                <div class="injury-type-info">
                                                    <span class="fw-semibold text-dark">{{ $item->injuryType->name ?? 'N/A' }}</span>
                                                </div>
                                            </td>
                                            <td class="corporate-cell">
                                                <div class="risk-type-info">
                                                    <span class="fw-semibold text-dark">{{ $item->riskType->name ?? 'N/A' }}</span>
                                                </div>
                                            </td>
                                            <td class="corporate-cell">
                                                <div class="accident-type-info">
                                                    <span class="fw-semibold text-dark">{{ $item->accidentType->name ?? 'N/A' }}</span>
                                                </div>
                                            </td>
                                            <td class="corporate-cell">
                                                <div class="evidence-content">
                                                    <p class="mb-0 text-dark lh-sm">{{ Str::limit($item->evidence ?? 'Sin evidencia disponible', 65) }}</p>
                                                    @if(strlen($item->evidence ?? '') > 65)
                                                        <small class="text-muted mt-1 d-block">
                                                            <i class="fas fa-external-link-alt me-1"></i>Ver evidencia completa
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
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<style>
/* ... (Existing styles remain unchanged) ... */
</style>
@endsection