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
                    <h4 class="mb-1 fw-semibold text-dark">Personas Involucradas</h4>
                    <small class="text-muted">Registro de personas asociadas a incidentes</small>
                </div>
            </div>
            <div class="stats-container">
                <div class="stats-number">{{ $peopleInvolved->count() }}</div>
                <div class="stats-label">Registros</div>
            </div>
        </div>
    </div>

    <div class="px-4 py-3">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
            <!-- Formulario de búsqueda -->
            <form method="GET" action="{{ route('sstsena.funcionario.people_involved.index') }}" class="d-flex align-items-center gap-2">
                <input type="text" name="search_document" class="form-control form-control-sm" placeholder="Buscar por cédula" value="{{ request('search_document') }}" style="width: 180px;">
                <button type="submit" class="corporate-btn" style="border-color: #007bff;">
                    <i class="bi bi-search"></i> Buscar
                </button>
                <a href="{{ route('sstsena.funcionario.people_involved.index') }}" class="corporate-btn" style="border-color: #6c757d;">
                    <i class="bi bi-x-circle"></i> Limpiar
                </a>
            </form>
        </div>
    </div>
</div>

<!-- Tabla -->
<div class="corporate-card shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover mb-0 corporate-table">
            <thead>
                <tr class="corporate-header-row">
                    <th class="corporate-th">ID</th>
                    <th class="corporate-th">Nombre</th>
                    <th class="corporate-th">Apellido</th>
                    <th class="corporate-th">Tipo Documento</th>
                    <th class="corporate-th">Nº de Documento</th>
                    <th class="corporate-th">Fecha de Nacimiento</th>
                    <th class="corporate-th">Género</th>
                    <th class="corporate-th">Tipo de Persona</th>
                    <th class="corporate-th">Teléfono</th>
                    <th class="corporate-th">Dirección</th>
                    <th class="corporate-th">Accidente Asociado</th>
                    <th class="corporate-th text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($peopleInvolved as $people)
                    <tr class="corporate-row">
                        <td class="corporate-cell">
                            <span class="fw-bold" style="color: #e63946;">{{ $loop->iteration }}</span>
                        </td>
                        <td class="corporate-cell">{{ $people->name }}</td>
                        <td class="corporate-cell">{{ $people->last_name }}</td>
                        <td class="corporate-cell">{{ $people->document_type }}</td>
                        <td class="corporate-cell">{{ $people->document_number }}</td>
                        <td class="corporate-cell">{{ $people->birth_date }}</td>
                        <td class="corporate-cell">{{ $people->gender }}</td>
                        <td class="corporate-cell">{{ $people->personType->name ?? 'N/A' }}</td>
                        <td class="corporate-cell">{{ $people->phone }}</td>
                        <td class="corporate-cell">{{ $people->address }}</td>
                        <td class="corporate-cell">
                            @php
                                $maxLength = 50;
                                $description = $people->accident->description ?? 'Sin descripción';
                                $isLong = strlen($description) > $maxLength;
                                $shortDescription = Str::limit($description, $maxLength);
                            @endphp
                            {{ $shortDescription }}
                            @if($isLong)
                                <button type="button" class="btn btn-link p-0 text-primary text-decoration-none" 
                                        onclick="showDescriptionModal('{{ $people->id }}', `{{ addslashes($description) }}`)">
                                    Ver más
                                </button>
                            @endif
                        </td>
                        <td class="corporate-cell text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('sstsena.funcionario.people_involved.edit', $people->id) }}" class="corporate-btn corporate-btn-edit">
                                    <i class="bi bi-pencil"></i> Editar
                                </a>
                                <form action="{{ route('sstsena.funcionario.people_involved.destroy', $people->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta persona?')">
                                    @csrf
                                    @method('DELETE')
                                    
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="12" class="text-center py-5">
                            <div class="empty-state-corporate">
                                <div class="empty-icon mb-3">
                                    <i class="fas fa-users fa-3x text-muted opacity-25"></i>
                                </div>
                                <h6 class="text-muted mb-2 fw-normal">No hay personas registradas</h6>
                                <p class="text-muted mb-0 small">Los nuevos registros aparecerán aquí automáticamente</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Universal para Descripción -->
<div class="modal fade" id="descriptionModal" tabindex="-1" aria-labelledby="descriptionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="descriptionModalLabel">Descripción Completa del Accidente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="descriptionContent"></p>
            </div>
        </div>
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

<script>
// Función para mostrar el modal de descripción
function showDescriptionModal(peopleId, description) {
    document.getElementById('descriptionContent').textContent = description;
    const modal = new bootstrap.Modal(document.getElementById('descriptionModal'));
    modal.show();
}

// Limpiar modal al cerrar para evitar conflictos
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('descriptionModal').addEventListener('hidden.bs.modal', function () {
        document.getElementById('descriptionContent').textContent = '';
    });
});
</script>

@endsection