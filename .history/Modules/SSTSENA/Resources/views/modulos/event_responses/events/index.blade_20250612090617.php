@extends('sstsena::layouts.master')

@section('content')
<div class="container-fluid py-4">
    {{-- Alerta de éxito mejorada --}}
    @if (session('success'))
        <div id="alertaExito" class="alert alert-success border-0 shadow-sm mx-auto mb-4 fade-in" style="max-width: 500px; border-radius: 12px;">
            <div class="d-flex align-items-center">
                <div class="alert-icon me-3">
                    <i class="fas fa-check-circle fa-lg text-success"></i>
                </div>
                <div class="flex-grow-1">
                    <strong>¡Operación exitosa!</strong><br>
                    <small class="text-muted">{{ session('success') }}</small>
                </div>
                <button type="button" class="btn-close btn-close-sm" onclick="document.getElementById('alertaExito')?.remove()"></button>
            </div>
        </div>
        <script>setTimeout(() => document.getElementById('alertaExito')?.classList.add('fade-out'), 4000);</script>
    @endif

    {{-- Header del Dashboard mejorado --}}
    <div class="row mb-5">
        <div class="col-12">
            <div class="hero-card border-0 shadow-lg">
                <div class="hero-content text-center py-5 px-4">
                    <div class="hero-icon mb-3">
                        <i class="fas fa-shield-halved fa-3x text-white opacity-90"></i>
                    </div>
                    <h2 class="mb-2 fw-bold text-white">Sistema de Gestión SST</h2>
                    <p class="mb-0 text-white-50 fs-5">Seguridad y Salud en el Trabajo</p>
                    <div class="hero-decoration"></div>
                </div>
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
                'color' => 'danger',
                'gradient' => 'linear-gradient(135deg, #dc3545 0%, #c82333 100%)'
            ],
            [
                'title' => 'Incidentes de Trabajo', 
                'items' => $incidents, 
                'route_prefix' => 'incidents', 
                'icon' => 'fa-clipboard-list',
                'color' => 'warning',
                'gradient' => 'linear-gradient(135deg, #ffc107 0%, #e0a800 100%)'
            ],
            [
                'title' => 'Situaciones de Emergencia', 
                'items' => $emergencies, 
                'route_prefix' => 'emergencies', 
                'icon' => 'fa-shield-alt',
                'color' => 'info',
                'gradient' => 'linear-gradient(135deg, #17a2b8 0%, #138496 100%)'
            ],
            [
                'title' => 'Comportamientos Inseguros', 
                'items' => $unsafeActs, 
                'route_prefix' => 'unsafe_acts', 
                'icon' => 'fa-eye-slash',
                'color' => 'secondary',
                'gradient' => 'linear-gradient(135deg, #6c757d 0%, #545b62 100%)'
            ],
        ];
    @endphp

    {{-- Grid de secciones mejorado --}}
    <div class="row g-4">
        @foreach ($sections as $index => $section)
            <div class="col-12 section-item" style="animation-delay: {{ $index * 0.1 }}s;">
                <div class="modern-card border-0 shadow-sm">
                    {{-- Header de la sección mejorado --}}
                    <div class="section-header position-relative overflow-hidden">
                        <div class="section-bg" style="background: {{ $section['gradient'] }};"></div>
                        <div class="section-content d-flex justify-content-between align-items-center py-4 px-4 position-relative">
                            <div class="d-flex align-items-center">
                                <div class="section-icon me-3">
                                    <i class="fas {{ $section['icon'] }} fa-lg text-white"></i>
                                </div>
                                <div>
                                    <h5 class="mb-1 text-white fw-bold">{{ $section['title'] }}</h5>
                                    <small class="text-white-50">Gestión y seguimiento</small>
                                </div>
                            </div>
                            <div class="stats-badge">
                                <span class="badge bg-white bg-opacity-90 text-dark px-4 py-2 fs-6 fw-bold">
                                    {{ $section['items']->count() }}
                                    <small class="text-muted ms-1">registros</small>
                                </span>
                            </div>
                        </div>
                        <div class="section-decoration"></div>
                    </div>

                    {{-- Contenido de la tabla mejorado --}}
                    <div class="table-container">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0 enhanced-table">
                                <thead>
                                    <tr class="table-header">
                                        <th class="table-th">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-hashtag me-2 text-muted"></i>
                                                ID
                                            </div>
                                        </th>
                                        <th class="table-th">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-calendar-alt me-2 text-muted"></i>
                                                Fecha y Hora
                                            </div>
                                        </th>
                                        <th class="table-th">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-file-alt me-2 text-muted"></i>
                                                Descripción
                                            </div>
                                        </th>
                                        <th class="table-th">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-thermometer-half me-2 text-muted"></i>
                                                Severidad
                                            </div>
                                        </th>
                                        <th class="table-th text-center">
                                            <div class="d-flex align-items-center justify-content-center">
                                                <i class="fas fa-comments me-2 text-muted"></i>
                                                Respuestas
                                            </div>
                                        </th>
                                        <th class="table-th text-center">
                                            <div class="d-flex align-items-center justify-content-center">
                                                <i class="fas fa-cogs me-2 text-muted"></i>
                                                Acciones
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($section['items'] as $itemIndex => $item)
                                        <tr class="table-row" style="animation-delay: {{ ($itemIndex * 0.05) }}s;">
                                            <td class="table-cell">
                                                <div class="id-badge">
                                                    <span class="fw-bold text-{{ $section['color'] }}">
                                                        #{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}
                                                    </span>
                                                </div>
                                            </td>
                                            <td class="table-cell">
                                                <div class="date-info">
                                                    <div class="fw-semibold text-dark">{{ $item->date_time->format('d/m/Y') }}</div>
                                                    <small class="text-muted">
                                                        <i class="fas fa-clock me-1"></i>{{ $item->date_time->format('H:i:s') }}
                                                    </small>
                                                </div>
                                            </td>
                                            <td class="table-cell">
                                                <div class="description-cell">
                                                    <p class="mb-1 text-dark">{{ Str::limit($item->description ?? 'Sin descripción disponible', 60) }}</p>
                                                    @if(strlen($item->description ?? '') > 60)
                                                        <small class="text-muted">
                                                            <i class="fas fa-ellipsis-h me-1"></i>Ver más detalles
                                                        </small>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="table-cell">
                                                @switch($item->severity)
                                                    @case('minor') 
                                                        <span class="severity-badge severity-minor">
                                                            <i class="fas fa-circle me-2"></i>Leve
                                                        </span> 
                                                    @break
                                                    @case('moderate') 
                                                        <span class="severity-badge severity-moderate">
                                                            <i class="fas fa-circle me-2"></i>Moderada
                                                        </span> 
                                                    @break
                                                    @case('serious') 
                                                        <span class="severity-badge severity-serious">
                                                            <i class="fas fa-circle me-2"></i>Grave
                                                        </span> 
                                                    @break
                                                    @case('fatal') 
                                                        <span class="severity-badge severity-fatal">
                                                            <i class="fas fa-circle me-2"></i>Crítica
                                                        </span> 
                                                    @break
                                                    @default 
                                                        <span class="severity-badge severity-pending">
                                                            <i class="fas fa-circle me-2"></i>Por evaluar
                                                        </span>
                                                @endswitch
                                            </td>
                                            <td class="text-center table-cell">
                                                <div class="response-count">
                                                    <span class="badge bg-{{ $section['color'] }} bg-opacity-15 text-{{ $section['color'] }} px-3 py-2 fw-bold">
                                                        <i class="fas fa-comment-dots me-1"></i>
                                                        {{ $item->eventResponses->count() }}
                                                    </span>
                                                </div>
                                            </td>
                                            <td class="text-center table-cell">
                                                <a href="{{ route('sstsena.' . $section['route_prefix'] . '.responses.index', $item->id) }}" 
                                                   class="action-btn btn btn-sm btn-outline-dark px-4 py-2">
                                                    <i class="fas fa-folder-open me-2"></i>
                                                    <span>Revisar</span>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center py-5">
                                                <div class="empty-state">
                                                    <div class="empty-icon mb-4">
                                                        <i class="fas {{ $section['icon'] }} fa-4x text-muted opacity-25"></i>
                                                    </div>
                                                    <h6 class="text-muted mb-2">No hay {{ strtolower($section['title']) }} registrados</h6>
                                                    <p class="text-muted mb-0">
                                                        <small>Los nuevos registros aparecerán automáticamente aquí</small>
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
/* Animaciones globales */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes fadeOut {
    from { opacity: 1; transform: translateY(0); }
    to { opacity: 0; transform: translateY(-20px); }
}

@keyframes slideInUp {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Clases de animación */
.fade-in {
    animation: fadeIn 0.5s ease-out;
}

.fade-out {
    animation: fadeOut 0.3s ease-in forwards;
}

.section-item {
    animation: slideInUp 0.6s ease-out both;
}

.table-row {
    animation: slideInUp 0.4s ease-out both;
}

/* Hero Card */
.hero-card {
    border-radius: 20px;
    overflow: hidden;
    position: relative;
}

.hero-content {
    background: linear-gradient(135deg, #1e3c72 0%, #2a5298 50%, #1e3c72 100%);
    position: relative;
    z-index: 2;
}

.hero-decoration {
    position: absolute;
    bottom: -50px;
    right: -50px;
    width: 200px;
    height: 200px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    z-index: 1;
}

.hero-icon {
    animation: fadeIn 1s ease-out 0.3s both;
}

/* Modern Cards */
.modern-card {
    border-radius: 16px;
    overflow: hidden;
    transition: all 0.4s ease;
    background: white;
}

.modern-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.1) !important;
}

/* Section Headers */
.section-header {
    position: relative;
    border-radius: 16px 16px 0 0;
}

.section-bg {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 1;
}

.section-content {
    z-index: 2;
}

.section-decoration {
    position: absolute;
    top: -30px;
    right: -30px;
    width: 100px;
    height: 100px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    z-index: 1;
}

.section-icon {
    width: 50px;
    height: 50px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(10px);
}

.stats-badge {
    animation: fadeIn 0.6s ease-out 0.4s both;
}

/* Enhanced Table */
.table-container {
    background: white;
    border-radius: 0 0 16px 16px;
}

.enhanced-table {
    margin: 0;
}

.table-header {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-bottom: 2px solid #dee2e6;
}

.table-th {
    font-weight: 600;
    font-size: 0.85rem;
    letter-spacing: 0.3px;
    text-transform: uppercase;
    color: #495057;
    padding: 1rem;
    border: none;
    position: relative;
}

.table-cell {
    padding: 1.25rem 1rem;
    vertical-align: middle;
    border-bottom: 1px solid #f1f3f4;
    transition: all 0.3s ease;
}

.table-row:hover .table-cell {
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
}

/* ID Badge */
.id-badge {
    font-size: 0.95rem;
    font-family: 'Monaco', 'Menlo', monospace;
}

/* Date Info */
.date-info {
    min-width: 120px;
}

/* Description Cell */
.description-cell p {
    line-height: 1.4;
    margin-bottom: 0.25rem;
}

/* Severity Badges */
.severity-badge {
    display: inline-flex;
    align-items: center;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.85rem;
    letter-spacing: 0.3px;
    border: 2px solid transparent;
    transition: all 0.3s ease;
}

.severity-minor {
    background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
    color: #155724;
    border-color: #c3e6cb;
}

.severity-moderate {
    background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%);
    color: #856404;
    border-color: #ffeaa7;
}

.severity-serious {
    background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
    color: #721c24;
    border-color: #f5c6cb;
}

.severity-fatal {
    background: linear-gradient(135deg, #d6d8db 0%, #c6c8ca 100%);
    color: #383d41;
    border-color: #c6c8ca;
}

.severity-pending {
    background: linear-gradient(135deg, #e2e3e5 0%, #d6d8db 100%);
    color: #383d41;
    border-color: #d6d8db;
}

/* Response Count */
.response-count .badge {
    font-size: 0.9rem;
    border-radius: 12px;
    transition: all 0.3s ease;
}

/* Action Button */
.action-btn {
    transition: all 0.3s ease;
    border-radius: 10px;
    font-weight: 600;
    border: 2px solid #6c757d;
    position: relative;
    overflow: hidden;
}

.action-btn:hover {
    background: linear-gradient(135deg, #343a40 0%, #495057 100%);
    color: white;
    border-color: #343a40;
    transform: translateY(-2px);
    box-shadow: 0 8px 16px rgba(52, 58, 64, 0.2);
}

.action-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
    transition: left 0.5s ease;
}

.action-btn:hover::before {
    left: 100%;
}

/* Empty State */
.empty-state {
    padding: 2rem;
}

.empty-icon {
    animation: fadeIn 0.8s ease-out;
}

/* Alert Mejorada */
.alert {
    border-radius: 12px;
    padding: 1rem 1.5rem;
}

.alert-icon {
    width: 40px;
    height: 40px;
    background: rgba(25, 135, 84, 0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Responsive Design */
@media (max-width: 768px) {
    .hero-content {
        padding: 2rem 1rem !important;
    }
    
    .section-content {
        flex-direction: column;
        align-items: flex-start !important;
        gap: 1rem;
    }
    
    .stats-badge {
        align-self: flex-end;
    }
    
    .table-responsive {
        font-size: 0.85rem;
    }
    
    .action-btn {
        padding: 0.5rem 1rem !important;
        font-size: 0.8rem;
    }
}

/* Smooth scrolling */
html {
    scroll-behavior: smooth;
}

/* Loading states */
.modern-card {
    opacity: 0;
    animation: slideInUp 0.6s ease-out forwards;
}

/* Accessibility improvements */
.action-btn:focus,
.severity-badge:focus {
    outline: 2px solid #007bff;
    outline-offset: 2px;
}

/* Print styles */
@media print {
    .hero-card,
    .action-btn {
        display: none;
    }
    
    .modern-card {
        box-shadow: none !important;
        border: 1px solid #dee2e6 !important;
    }
}
</style>
@endsection