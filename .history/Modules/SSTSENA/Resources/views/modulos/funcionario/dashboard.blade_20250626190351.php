@extends('sstsena::layouts.master')

@section('content')
<div class="container-fluid py-4">
    <div class="row g-4">
        <!-- Welcome Section -->
        <div class="col-12 section-item">
            <div class="corporate-card border-0 shadow-sm">
                <div class="section-header" style="border-left: 4px solid #e63946;">
                    <div class="section-content d-flex justify-content-between align-items-center py-4 px-4">
                        <div class="d-flex align-items-center">
                            <div class="section-icon me-4" style="background-color: #e6394615;">
                                <i class="fas fa-home fa-lg" style="color: #e63946;"></i>
                            </div>
                            <div>
                                <h4 class="mb-1 fw-semibold text-dark">Bienvenido al Panel de Gestión del Funcionario</h4>
                                <small class="text-muted">Centro de Formación Agroindustrial La Angostura</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body p-5" style="color: #2c3e50; font-size: 1.15rem; line-height: 1.6;">
                    <p class="mb-4 text-center">
                        <strong>Estimado Funcionario o Instructor</strong> del <span style="color: #1a3c6e; font-weight: 600;">Centro de Formación Agroindustrial La Angostura</span>,
                    </p>
                    <p>
                        Nos complace darle la más cordial bienvenida a su plataforma de gestión integral. Desde este panel, usted podrá reportar y administrar de manera ágil y eficiente accidentes, incidentes, emergencias y actos inseguros, desempeñando un rol clave en la promoción de la seguridad y el bienestar de nuestra comunidad educativa.
                    </p>
                    <p>
                        Su compromiso con el registro oportuno y preciso de estos eventos es esencial para fortalecer un entorno de aprendizaje seguro, productivo y alineado con los más altos estándares de calidad. Le invitamos a utilizar las herramientas disponibles en esta plataforma para cumplir con sus responsabilidades y contribuir al desarrollo continuo de nuestro centro.
                    </p>
                    <div class="text-center mt-4">
                        <a href="#" class="corporate-btn" style="border: 2px solid #adb5bd;">
                            <i class="fas fa-rocket me-2"></i>
                            <span>Comenzar Ahora</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Corporate color palette */
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
    --corporate-danger: #e63946;
    --corporate-info: #17a2b8;
}

/* Minimalist animations */
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

/* Corporate cards */
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

/* Section headers */
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

/* Corporate button */
.corporate-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    background: white;
    color: var(--corporate-text);
    border: 2px solid var(--corporate-border);
    border-radius: 6px;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.85rem;
    transition: all 0.2s ease;
    white-space: nowrap;
}

.corporate-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.12);
    text-decoration: none;
}

/* Responsive design */
@media (max-width: 1200px) {
    .stats-container {
        display: none;
    }
    
    .section-content {
        justify-content: flex-start !important;
    }
}

@media (max-width: 992px) {
    .corporate-btn {
        padding: 0.4rem 0.8rem;
        font-size: 0.75rem;
    }
}

@media (max-width: 768px) {
    .section-content {
        flex-direction: column;
        align-items: flex-start !important;
        gap: 1rem;
    }
}

/* Accessibility improvements */
.corporate-btn:focus {
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
}

/* Smooth scrolling */
html {
    scroll-behavior: smooth;
}

/* Loading optimization */
.corporate-card {
    contain: layout style;
}
</style>
@endsection