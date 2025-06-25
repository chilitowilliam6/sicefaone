@extends('sstsena::layouts.master')
@section('content')

<!-- Success Alerts -->
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="corporate-card shadow-sm mb-4">
    <div class="section-header" style="border-left: 4px solid #4169E1;">
        <div class="section-content d-flex justify-content-between align-items-center py-4 px-4">
            <div class="d-flex align-items-center">
                <div class="section-icon me-4">
                    <i class="fas fa-users fa-lg" style="color: #4169E1;"></i>
                </div>
                <div>
                    <h4 class="mb-1 fw-semibold text-dark">Tipos de Personas</h4>
                    <small class="text-muted">Gestión de tipos de personas</small>
                </div>
            </div>
            <div class="stats-container">
                <div class="stats-number">{{ $typePersons
->count() }}</div>
                <div class="stats-label">Registros</div>
            </div>
        </div>
    </div>

    <div class="px-4 py-3">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
            <!-- Botón de acción -->
            <div class="d-flex gap-2">
                <a href="{{ route('sstsena.admin.TypePerson.create') }}" 
                   class="corporate-btn" 
                   style="border-color: #28a745; background: #d4edda; color: #155724;">
                    <i class="bi bi-plus-circle-fill me-1"></i> Crear Tipo de Persona
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Tabla -->
<div class="corporate-card shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover mb-0 corporate-table">
            <thead>
                <tr class="corporate-header-row">
                    <th class="corporate-th">Nombre</th>
                    <th class="corporate-th">Descripción</th>
                    <th class="corporate-th text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($personTypes as $person_type)
                <tr class="corporate-row">
                    <td class="corporate-cell">{{ $person_type->name }}</td>
                    <td class="corporate-cell">{{ $person_type->description }}</td>
                    <td class="corporate-cell text-center">
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('sstsena.admin.TypePerson.edit', $person_type->id) }}" 
                               class="corporate-btn corporate-btn-edit">
                                Editar
                            </a>
                            <form action="{{ route('sstsena.admin.TypePerson.destroy', $person_type->id) }}" 
                                  method="POST" 
                                  onsubmit="return confirm('¿Estás seguro de eliminar este tipo de persona?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="corporate-btn corporate-btn-delete">
                                    Eliminar
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center py-5">
                        <div class="empty-state-corporate">
                            <div class="empty-icon mb-3">
                                <i class="fas fa-users fa-3x text-muted opacity-25"></i>
                            </div>
                            <h6 class="text-muted mb-2 fw-normal">No hay tipos de personas registrados</h6>
                            <p class="text-muted mb-0 small">Los nuevos registros aparecerán aquí automáticamente</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<style>
/* Variables corporativas */
:root {
    --corporate-border: #e9ecef;
    --corporate-hover: #f1f3f4;
    --corporate-text: #343a40;
    --corporate-muted: #6c757d;
}

/* Tarjetas corporativas */
.corporate-card {
    background: white;
    border-radius: 8px;
    border: 1px solid var(--corporate-border);
    overflow: hidden;
}

/* Header de sección */
.section-header {
    background: #f8f9fa;
    border-bottom: 1px solid var(--corporate-border);
}

.section-icon {
    width: 48px;
    height: 48px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #e6394615;
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

.corporate-cell {
    padding: 1.25rem 1rem;
    vertical-align: middle;
    border-bottom: 1px solid #f8f9fa;
    transition: background-color 0.2s ease;
}

.corporate-row:hover .corporate-cell {
    background-color: var(--corporate-hover);
}

/* Botones corporativos */
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
    font-size: 0.875rem;
    transition: all 0.2s ease;
    white-space: nowrap;
}

.corporate-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.12);
    text-decoration: none;
}

.corporate-btn-edit {
    background: #d4edda;
    color: #155724;
    border-color: #28a745;
}

.corporate-btn-delete {
    background: #f8d7da;
    color: #721c24;
    border-color: #dc3545;
}

/* Estado vacío */
.empty-state-corporate {
    padding: 3rem 2rem;
}

/* Responsive */
@media (max-width: 768px) {
    .stats-container { display: none; }
    .section-content { flex-direction: column; align-items: flex-start !important; gap: 1rem; }
    .corporate-th { font-size: 0.7rem; padding: 1rem 0.75rem; }
    .corporate-cell { padding: 1rem 0.75rem; }
    .corporate-btn { padding: 0.4rem 0.8rem; font-size: 0.75rem; }
}
</style>

@endsection