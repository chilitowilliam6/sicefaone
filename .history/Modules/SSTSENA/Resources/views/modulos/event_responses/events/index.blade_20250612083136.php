@extends('sstsena::layouts.master')

@section('content')
<div class="container-fluid py-4">
    {{-- Alerta de éxito --}}
    @if (session('success'))
        <div id="alertaExito" class="alert alert-success alert-dismissible fade show mx-auto mb-4" style="max-width: 500px;">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        </div>
        <script>setTimeout(() => document.getElementById('alertaExito')?.remove(), 3000);</script>
    @endif

    {{-- Header del Dashboard --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body bg-primary text-white text-center py-4">
                    <h2 class="mb-0"><i class="fas fa-shield-alt me-2"></i>Sistema de Seguridad y Salud en el Trabajo</h2>
                </div>
            </div>
        </div>
    </div>

    @php
        $sections = [
            ['title' => 'Accidentes', 'items' => $accidents, 'route_prefix' => 'accidents', 'icon' => 'fa-exclamation-triangle', 'color' => 'danger'],
            ['title' => 'Incidentes', 'items' => $incidents, 'route_prefix' => 'incidents', 'icon' => 'fa-info-circle', 'color' => 'warning'],
            ['title' => 'Emergencias', 'items' => $emergencies, 'route_prefix' => 'emergencies', 'icon' => 'fa-fire', 'color' => 'danger'],
            ['title' => 'Actos Inseguros', 'items' => $unsafeActs, 'route_prefix' => 'unsafe_acts', 'icon' => 'fa-eye', 'color' => 'info'],
        ];
    @endphp

    {{-- Grid de secciones --}}
    <div class="row g-4">
        @foreach ($sections as $section)
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    {{-- Header de la sección --}}
                    <div class="card-header bg-{{ $section['color'] }} text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">
                                <i class="fas {{ $section['icon'] }} me-2"></i>{{ $section['title'] }}
                            </h5>
                            <span class="badge bg-light text-{{ $section['color'] }}">{{ $section['items']->count() }} registros</span>
                        </div>
                    </div>

                    {{-- Contenido de la tabla --}}
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="fw-semibold">ID</th>
                                        <th class="fw-semibold">Fecha</th>
                                        <th class="fw-semibold">Descripción</th>
                                        <th class="fw-semibold">Severidad</th>
                                        <th class="fw-semibold text-center">Respuestas</th>
                                        <th class="fw-semibold text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($section['items'] as $item)
                                        <tr>
                                            <td class="fw-bold text-muted">#{{ $item->id }}</td>
                                            <td>{{ $item->date_time->format('d/m/Y H:i') }}</td>
                                            <td>{{ Str::limit($item->description ?? 'Sin descripción', 50) }}</td>
                                            <td>
                                                @switch($item->severity)
                                                    @case('minor') <span class="badge bg-success">Leve</span> @break
                                                    @case('moderate') <span class="badge bg-warning">Moderada</span> @break
                                                    @case('serious') <span class="badge bg-danger">Grave</span> @break
                                                    @case('fatal') <span class="badge bg-dark">Fatal</span> @break
                                                    @default <span class="badge bg-secondary">N/A</span>
                                                @endswitch
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-primary">{{ $item->eventResponses->count() }}</span>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('sstsena.' . $section['route_prefix'] . '.responses.index', $item->id) }}" 
                                                   class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-eye me-1"></i>Ver
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-muted py-4">
                                                <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                                No hay {{ strtolower($section['title']) }} registrados
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
.card { border-radius: 10px; }
.table th { border-top: none; font-size: 0.9rem; }
.table td { vertical-align: middle; font-size: 0.9rem; }
.badge { font-size: 0.75rem; }
</style>
@endsection