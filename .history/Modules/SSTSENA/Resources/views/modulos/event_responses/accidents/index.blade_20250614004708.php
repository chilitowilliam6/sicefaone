@extends('sstsena::layouts.master')
@section('content')

<div class="container-fluid py-4">
    <div class="card shadow-sm rounded-3 mb-4" style="background-color: #077ef5;">
        <div class="card shadow-sm rounded-3" style="background-color: #ffffff;">
            <div class="card-header d-flex justify-content-between align-items-center" style="background-color: #f8f9fa; border-bottom: 1px solid #dee2e6;">
                <h3 class="text-center m-0" style="color: #1a3c6e; font-weight: 600;">Lista de Accidentes y Personas Involucradas</h3>
                <!-- Formulario de búsqueda -->
                <form action="{{ route('sstsena.funcionario.accidents_with_people.index') }}" method="GET" class="d-flex">
                    <input type="text" name="search_document" class="form-control me-2" placeholder="Buscar por cédula" value="{{ request('search_document') }}">
                    <button type="submit" class="btn btn-outline-primary">Buscar</button>
                </form>
            </div>

            <div class="card-body">
                @forelse($accidents as $accident)
                    <div class="mb-4">
                        <h4 class="text-dark fw-semibold mb-3">Accidente #{{ $accident->id }} - {{ $accident->description }}</h4>
                        <table class="table-fixed w-full table table-hover mb-0 corporate-table">
                            <thead>
                                <tr class="corporate-header-row">
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Tipo de Documento</th>
                                    <th>Número de Documento</th>
                                    <th>Fecha de Nacimiento</th>
                                    <th>Género</th>
                                    <th>Tipo de Persona</th>
                                    <th>Teléfono</th>
                                    <th>Dirección</th>
                                    <th>Acciones</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($accident->peopleInvolved as $people)
                                    <tr class="corporate-row">
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $people->name }}</td>
                                        <td>{{ $people->last_name }}</td>
                                        <td>{{ $people->document_type }}</td>
                                        <td>{{ $people->document_number }}</td>
                                        <td>{{ $people->birth_date }}</td>
                                        <td>{{ $people->gender }}</td>
                                        <td>{{ $people->personType->name }}</td>
                                        <td>{{ $people->phone }}</td>
                                        <td>{{ $people->address }}</td>
                                        <td>
                                            <a href="{{ route('sstsena.funcionario.people_involved.edit', $people->id) }}" class="btn btn-primary btn-sm">Editar</a>
                                        </td>
                                        <td>
                                            <form action="{{ route('sstsena.funcionario.people_involved.destroy', $people->id) }}" method="POST" style="display:inline;" onsubmit="return confirmDelete()">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="12" class="text-center text-muted">No hay personas involucradas en este accidente.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                @empty
                    <div class="text-center py-5">
                        <div class="empty-state-corporate">
                            <div class="empty-icon mb-3">
                                <i class="fas fa-exclamation-triangle fa-3x text-muted opacity-25"></i>
                            </div>
                            <h6 class="text-muted mb-2 fw-normal">No se encontraron accidentes</h6>
                            <p class="text-muted mb-0 small">No hay accidentes registrados en el sistema.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Delete confirmation modal -->
    <div id="confirmDeleteModal" class="modal-confirm" style="display: none;">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Confirmar Eliminación</h3>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro de que deseas eliminar esta persona? Esta acción no se puede deshacer.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="corporate-btn" onclick="closeModal()">Cancelar</button>
                <button type="button" class="corporate-btn corporate-btn-delete" onclick="submitForm()">Eliminar</button>
            </div>
        </div>
    </div>
</div>

<style>
/* Reuse the same styles from your second template for consistency */
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

/* Add relevant styles from your second template */
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

.corporate-btn-delete {
    background: #f8d7da;
    color: #721c24;
    border-color: #dc3545;
}

.corporate-btn-delete:hover {
    background: #f5c6cb;
    color: #721c24;
    border-color: #dc3545;
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.12);
}

.modal-confirm {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.6);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 1000;
}

.modal-content {
    background: white;
    border-radius: 12px;
    width: 90%;
    max-width: 600px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
    padding: 2rem;
}

.modal-header {
    padding-bottom: 1.5rem;
    border-bottom: 1px solid var(--corporate-border);
}

.modal-header h3 {
    margin: 0;
    font-size: 1.5rem;
    font-weight: 600;
    color: var(--corporate-text);
}

.modal-body {
    padding: 1.5rem 0;
}

.modal-body p {
    font-size: 1.1rem;
    color: var(--corporate-text);
    margin: 0;
}

.modal-footer {
    display: flex;
    justify-content: flex-end;
    gap: 1rem;
    padding-top: 1.5rem;
    border-top: 1px solid var(--corporate-border);
}

.empty-state-corporate {
    padding: 3rem 2rem;
}

.empty-icon {
    margin-bottom: 1rem;
}
</style>

<script>
let activeForm = null;

function confirmDelete() {
    const modal = document.getElementById('confirmDeleteModal');
    activeForm = event.target.closest('form');
    modal.style.display = 'flex';
    return false; // Prevent immediate form submission
}

function closeModal() {
    const modal = document.getElementById('confirmDeleteModal');
    modal.style.display = 'none';
    activeForm = null;
}

function submitForm() {
    if (activeForm) {
        activeForm.submit();
    }
}
</script>

@endsection