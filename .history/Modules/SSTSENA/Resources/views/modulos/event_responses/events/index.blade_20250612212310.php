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

                    {{-- Contenedor de tarjetas alineado a la derecha solo para Accidentes --}}
                    <div class="cards-container p-4 @if($section['title'] == 'Accidentes Laborales') right-aligned-cards @endif">
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
                                            {{-- Contenido de la tarjeta --}}
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
                                                {{-- Resto del contenido de la tarjeta --}}
                                            </div>
                                            <div class="card-footer d-flex justify-content-between">
                                                {{-- Botones de la tarjeta --}}
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

@section('scripts')
    {{-- Scripts de exportación --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/docx/7.8.2/docx.min.js"></script>
    <script>
        // Funciones de exportación (igual que antes)
    </script>
@endsection

@section('styles')
<style>
    /* Estilos para alinear las tarjetas de Accidentes a la derecha */
    .right-aligned-cards {
        margin-left: auto;
        max-width: 90%;
    }

    .right-aligned-cards .row {
        justify-content: flex-end;
        margin-right: 0;
    }

    .right-aligned-cards .card-item {
        max-width: 350px;
        margin-left: auto;
    }

    /* Estilos responsivos */
    @media (max-width: 768px) {
        .right-aligned-cards {
            max-width: 100%;
            margin-left: 0;
        }
        
        .right-aligned-cards .row {
            justify-content: center;
        }
        
        .right-aligned-cards .card-item {
            margin-left: 0;
        }
    }

    /* Estilos corporativos existentes */
    .corporate-modal {
        background: white;
        border-radius: 8px;
        border: 1px solid var(--corporate-border);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
    }

    /* Resto de tus estilos existentes... */
</style>
@endsection