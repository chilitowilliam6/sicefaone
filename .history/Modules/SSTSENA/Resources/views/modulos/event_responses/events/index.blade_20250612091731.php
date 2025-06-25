@extends('sstsena::layouts.master')

@section('content')
<div class="container-fluid py-5">
    {{-- Alerta de éxito --}}
    @if (session('success'))
        <div id="alertaExito" class="alert alert-success alert-dismissible fade show mx-auto mb-5" role="alert" style="max-width: 600px;">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <script>
            setTimeout(() => {
                const alert = document.getElementById('alertaExito');
                if (alert) {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }
            }, 3000);
        </script>
    @endif

    {{-- Encabezado del Dashboard --}}
    <div class="row mb-5">
        <div class="col-12">
            <div class="card border-0 shadow-lg rounded-3 overflow-hidden">
                <div class="card-body text-center py-5" style="background: linear-gradient(135deg, #1a2a44 0%, #2c3e50 100%); color: white;">
                    <h2 class="mb-2 fw-bold">Sistema de Gestión SST</h2>
                    <p class="mb-0 opacity-75 fs-5">Seguridad y Salud en el Trabajo</p>
                </div>
            </div>
        </div>
    </div>

    @php
        $sections = [
            ['title' => 'Accidentes Laborales', 'items' => $accidents, 'route_prefix' => 'accidents', 'icon' => 'fa-exclamation-triangle'],
            ['title' => 'Incidentes de Trabajo', 'items' => $incidents, 'route_prefix' => 'incidents', 'icon' => 'fa-clipboard-list'],
            ['title' => 'Situaciones de Emergencia', 'items' => $emergencies, 'route_prefix' => 'emergencies', 'icon' => 'fa-shield-alt'],
            ['title' => 'Comportamientos Inseguros', 'items' => $unsafeActs, 'route_prefix' => 'unsafe_acts', 'icon' => 'fa-eye-slash'],
        ];
    @endphp

    {{-- Cuadrícula de secciones --}}
    <div class="row g-4">
        @foreach ($sections as $section)
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-3 hover-card overflow-hidden">
                    {{-- Encabezado de la sección --}}
                    <div class="card-header bg-white border-bottom py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0 fw-bold text-dark">
                                <i class="fas {{ $section['icon'] }} me-2 text-primary"></i>{{ $section['title'] }}
                            </h5>
                            <span class="badge bg-primary text-white px-3 py-2 rounded-pill">
                                {{ $section['items']->count() }} registros
                            </span>
                        </div>
                    </div>

                    {{-- Contenido de la tabla --}}
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped align-middle professional-table mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="fw-semibold text-muted text-uppercase small py-3 px-4">Identificador</th>
                                        <th class="fw-semibold text-muted text-uppercase small py-3 px-4">Fecha y Hora</th>
                                        <th class="fw-semibold text-muted text-uppercase small py-3 px-4">Descripción</th>
                                        <th class="fw-semibold text-muted text-uppercase small py-3 px-4">Severidad</th>
                                        <th class="fw-semibold text-muted text-uppercase small py-3 px-4 text-center">Respuestas</th>
                                        <th class="fw-semibold text-muted text-uppercase small py-3 px-4 text-center">Gestión</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($section['items'] as $item)
                                        <tr class="border-light transition-row">
                                            <td class="py-3 px-4">
                                                <span class="fw-semibold text-primary badge bg-light border border-primary">
                                                    #{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}
                                                </span>
                                            </td>
                                            <td class="py-3 px-4 text-muted">
                                                <div>{{ $item->date_time->format('d/m/Y') }}</div>
                                                <small class="text-secondary">{{ $item->date_time->format('H:i:s') }}</small>
                                            </td>
                                            <td class="py-3 px-4">
                                                <span data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $item->description ?? 'Sin descripción disponible' }}">
                                                    {{ Str::limit($item->description ?? 'Sin descripción disponible', 50) }}
                                                </span>
                                            </td>
                                            <td class="py-3 px-4">
                                                @switch($item->severity)
                                                    @case('minor')
                                                        <span class="badge bg-success text-white px-3 py-2 rounded-pill">Leve</span>
                                                    @break
                                                    @case('moderate')
                                                        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">Moderada</span>
                                                    @break
                                                    @case('serious')
                                                        <span class="badge bg-danger text-white px-3 py-2 rounded-pill">Grave</span>
                                                    @break
                                                    @case('fatal')
                                                        <span class="badge bg-dark text-white px-3 py-2 rounded-pill">Crítica</span>
                                                    @break
                                                    @default
                                                        <span class="badge bg-secondary text-white px-3 py-2 rounded-pill">Por evaluar</span>
                                                @endswitch
                                            </td>
                                            <td class="text-center py-3 px-4">
                                                <span class="badge bg-info text-white px-3 py-2 rounded-pill">
                                                    {{ $item->eventResponses->count() }}
                                                </span>
                                            </td>
                                            <td class="text-center py-3 px-4">
                                                <a href="{{ route('sstsena.' . $section['route_prefix'] . '.responses.index', $item->id) }}"
                                                   class="btn btn-sm btn-outline-primary professional-btn rounded-pill px-4 py-2">
                                                    <i class="fas fa-folder-open me-2"></i>Revisar
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center py-5 text-muted">
                                                <div>
                                                    <i class="fas fa-inbox fa-3x mb-3 opacity-50"></i>
                                                    <p class="mb-1 fw-semibold">No se han registrado {{ strtolower($section['title']) }}</p>
                                                    <small>Los registros aparecerán aquí cuando sean reportados</small>
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
.hover-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.hover-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 30px rgba(0,0,0,0.15) !important;
}
.professional-table th {
    font-size: 0.8rem;
    letter-spacing: 0.75px;
    background-color: #f8f9fa;
}
.professional-table td {
    font-size: 0.9rem;
    transition: background-color 0.2s ease;
}
.professional-table tr.transition-row:hover {
    background-color: #f1f5f9;
}
.professional-btn {
    transition: all 0.3s ease;
    font-weight: 600;
    border-width: 2px;
}
.professional-btn:hover {
    background-color: #0d6efd;
    color: white;
    border-color: #0d6efd;
    transform: translateY(-1px);
}
.badge.rounded-pill {
    font-weight: 600;
    font-size: 0.85rem;
    padding: 0.5em 1.2em;
}
.alert-success {
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}
</style>

<script>
    // Inicializar tooltips de Bootstrap
    document.addEventListener('DOMContentLoaded', function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
@endsection