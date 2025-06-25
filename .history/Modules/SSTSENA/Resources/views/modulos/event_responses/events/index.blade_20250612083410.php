@extends('sstsena::layouts.master')

@section('content')
<div class="container-fluid py-4">
    {{-- Alerta de éxito --}}
    @if (session('success'))
        <div id="alertaExito" class="alert alert-light border-success text-success mx-auto mb-4" style="max-width: 500px;">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        </div>
        <script>setTimeout(() => document.getElementById('alertaExito')?.remove(), 3000);</script>
    @endif

    {{-- Header del Dashboard --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center py-4" style="background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%); color: white;">
                    <h3 class="mb-1 fw-light">Sistema de Gestión SST</h3>
                    <p class="mb-0 opacity-75">Seguridad y Salud en el Trabajo</p>
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

    {{-- Grid de secciones --}}
    <div class="row g-4">
        @foreach ($sections as $section)
            <div class="col-12">
                <div class="card border-0 shadow-sm hover-card">
                    {{-- Header de la sección --}}
                    <div class="card-header bg-light border-bottom">
                        <div class="d-flex justify-content-between align-items-center py-2">
                            <h6 class="mb-0 text-dark fw-semibold">
                                <i class="fas {{ $section['icon'] }} me-2 text-muted"></i>{{ $section['title'] }}
                            </h6>
                            <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2">
                                {{ $section['items']->count() }} registros
                            </span>
                        </div>
                    </div>

                    {{-- Contenido de la tabla --}}
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0 professional-table">
                                <thead>
                                    <tr class="bg-light bg-opacity-50">
                                        <th class="fw-semibold text-muted border-0 py-3">Identificador</th>
                                        <th class="fw-semibold text-muted border-0 py-3">Fecha y Hora</th>
                                        <th class="fw-semibold text-muted border-0 py-3">Descripción del Evento</th>
                                        <th class="fw-semibold text-muted border-0 py-3">Nivel de Severidad</th>
                                        <th class="fw-semibold text-muted border-0 py-3 text-center">Respuestas</th>
                                        <th class="fw-semibold text-muted border-0 py-3 text-center">Gestión</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($section['items'] as $item)
                                        <tr class="border-bottom border-light">
                                            <td class="py-3">
                                                <span class="fw-bold text-primary">#{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}</span>
                                            </td>
                                            <td class="py-3 text-muted">{{ $item->date_time->format('d/m/Y') }}<br><small>{{ $item->date_time->format('H:i:s') }}</small></td>
                                            <td class="py-3">{{ Str::limit($item->description ?? 'Sin descripción disponible', 60) }}</td>
                                            <td class="py-3">
                                                @switch($item->severity)
                                                    @case('minor') 
                                                        <span class="badge bg-success bg-opacity-15 text-success px-3 py-2">Leve</span> 
                                                    @break
                                                    @case('moderate') 
                                                        <span class="badge bg-warning bg-opacity-15 text-warning px-3 py-2">Moderada</span> 
                                                    @break
                                                    @case('serious') 
                                                        <span class="badge bg-danger bg-opacity-15 text-danger px-3 py-2">Grave</span> 
                                                    @break
                                                    @case('fatal') 
                                                        <span class="badge bg-dark bg-opacity-15 text-dark px-3 py-2">Crítica</span> 
                                                    @break
                                                    @default 
                                                        <span class="badge bg-secondary bg-opacity-15 text-secondary px-3 py-2">Por evaluar</span>
                                                @endswitch
                                            </td>
                                            <td class="text-center py-3">
                                                <span class="badge bg-primary bg-opacity-15 text-primary px-3 py-2">
                                                    {{ $item->eventResponses->count() }}
                                                </span>
                                            </td>
                                            <td class="text-center py-3">
                                                <a href="{{ route('sstsena.' . $section['route_prefix'] . '.responses.index', $item->id) }}" 
                                                   class="btn btn-sm btn-outline-dark px-3 py-2 professional-btn">
                                                    <i class="fas fa-folder-open me-1"></i>Revisar
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center py-5">
                                                <div class="text-muted">
                                                    <i class="fas fa-inbox fa-2x mb-3 opacity-50"></i>
                                                    <p class="mb-0">No se han registrado {{ strtolower($section['title']) }}</p>
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
    transition: all 0.3s ease;
    border-radius: 8px;
}
.hover-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.1) !important;
}
.professional-table th {
    font-size: 0.85rem;
    letter-spacing: 0.5px;
    text-transform: uppercase;
}
.professional-table td {
    font-size: 0.9rem;
    vertical-align: middle;
}
.professional-btn {
    transition: all 0.2s ease;
    border-radius: 6px;
    font-weight: 500;
}
.professional-btn:hover {
    background-color: #343a40;
    color: white;
    border-color: #343a40;
}
.badge {
    font-weight: 500;
    border-radius: 6px;
}
</style>
@endsection