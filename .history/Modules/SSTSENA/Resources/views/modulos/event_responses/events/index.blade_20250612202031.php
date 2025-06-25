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

    {{-- Filtros por fecha --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="corporate-card border-0 shadow-sm p-4">
                <form id="filterForm" method="GET" class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label for="dateRange" class="form-label small text-muted">Rango de fechas</label>
                        <select class="form-select corporate-select" id="dateRange" name="date_range">
                            <option value="today" {{ request('date_range') == 'today' ? 'selected' : '' }}>Hoy</option>
                            <option value="yesterday" {{ request('date_range') == 'yesterday' ? 'selected' : '' }}>Ayer</option>
                            <option value="this_week" {{ request('date_range') == 'this_week' ? 'selected' : '' }}>Esta semana</option>
                            <option value="last_week" {{ request('date_range') == 'last_week' ? 'selected' : '' }}>Semana pasada</option>
                            <option value="this_month" {{ request('date_range') == 'this_month' ? 'selected' : '' }}>Este mes</option>
                            <option value="last_month" {{ request('date_range') == 'last_month' ? 'selected' : '' }}>Mes pasado</option>
                            <option value="custom" {{ request('date_range') == 'custom' ? 'selected' : '' }}>Personalizado</option>
                            <option value="all" {{ request('date_range') == 'all' || !request('date_range') ? 'selected' : '' }}>Todos los registros</option>
                        </select>
                    </div>
                    
                    <div class="col-md-3 custom-date-fields" style="{{ request('date_range') != 'custom' ? 'display: none;' : '' }}">
                        <label for="startDate" class="form-label small text-muted">Desde</label>
                        <input type="date" class="form-control corporate-input" id="startDate" name="start_date" 
                               value="{{ request('start_date') }}" max="{{ date('Y-m-d') }}">
                    </div>
                    
                    <div class="col-md-3 custom-date-fields" style="{{ request('date_range') != 'custom' ? 'display: none;' : '' }}">
                        <label for="endDate" class="form-label small text-muted">Hasta</label>
                        <input type="date" class="form-control corporate-input" id="endDate" name="end_date" 
                               value="{{ request('end_date') }}" max="{{ date('Y-m-d') }}">
                    </div>
                    
                    <div class="col-md-3">
                        <button type="submit" class="btn corporate-btn w-100">
                            <i class="fas fa-filter me-2"></i>Filtrar
                        </button>
                    </div>
                    
                    @if(request('date_range'))
                        <div class="col-md-12 mt-2">
                            <a href="{{ url()->current() }}" class="btn btn-sm btn-outline-secondary">
                                <i class="fas fa-times me-1"></i>Limpiar filtros
                            </a>
                        </div>
                    @endif
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

    {{-- Resto del código permanece igual... --}}
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
                                    @if(request('date_range'))
                                        Intenta con otro rango de fechas
                                    @else
                                        Los nuevos incidentes se registrarán y mostrarán aquí automáticamente
                                    @endif
                                </p>
                            </div>
                        @else
                            {{-- Resto del código de las tarjetas permanece igual... --}}
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<style>
/* Estilos existentes... */

/* Estilos para los filtros */
.corporate-select {
    border: 1px solid var(--corporate-border);
    border-radius: 6px;
    padding: 0.5rem 1rem;
    background-color: white;
    transition: all 0.2s;
}

.corporate-select:focus {
    border-color: var(--corporate-primary);
    box-shadow: 0 0 0 0.2rem rgba(var(--corporate-primary-rgb), 0.1);
}

.corporate-input {
    border: 1px solid var(--corporate-border);
    border-radius: 6px;
    padding: 0.5rem 1rem;
    background-color: white;
}

.corporate-input:focus {
    border-color: var(--corporate-primary);
    box-shadow: 0 0 0 0.2rem rgba(var(--corporate-primary-rgb), 0.1);
}

.form-label {
    font-weight: 500;
    color: var(--corporate-text);
    margin-bottom: 0.5rem;
}

/* Estilos para el botón de filtro */
.corporate-btn {
    background-color: var(--corporate-primary);
    color: white;
    border: none;
    padding: 0.5rem 1rem;
    border-radius: 6px;
    transition: all 0.2s;
}

.corporate-btn:hover {
    background-color: var(--corporate-primary-dark);
    color: white;
}

/* Estilos responsivos */
@media (max-width: 768px) {
    .custom-date-fields {
        display: block !important;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Mostrar/ocultar campos de fecha personalizada
    const dateRangeSelect = document.getElementById('dateRange');
    const customDateFields = document.querySelectorAll('.custom-date-fields');
    
    dateRangeSelect.addEventListener('change', function() {
        if (this.value === 'custom') {
            customDateFields.forEach(field => field.style.display = 'block');
        } else {
            customDateFields.forEach(field => field.style.display = 'none');
        }
    });
    
    // Validar fechas antes de enviar el formulario
    const filterForm = document.getElementById('filterForm');
    filterForm.addEventListener('submit', function(e) {
        const dateRange = dateRangeSelect.value;
        const startDate = document.getElementById('startDate').value;
        const endDate = document.getElementById('endDate').value;
        
        if (dateRange === 'custom' && (!startDate || !endDate)) {
            e.preventDefault();
            alert('Por favor, seleccione ambas fechas para el rango personalizado.');
            return false;
        }
        
        if (dateRange === 'custom' && startDate > endDate) {
            e.preventDefault();
            alert('La fecha de inicio no puede ser mayor que la fecha de fin.');
            return false;
        }
    });
    
    // Establecer fecha máxima para los campos de fecha
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('startDate').max = today;
    document.getElementById('endDate').max = today;
});
</script>
@endsection