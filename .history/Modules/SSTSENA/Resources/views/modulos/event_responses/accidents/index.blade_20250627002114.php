@extends('sstsena::layouts.master')

@section('content')
<div class="container-fluid py-4">
    {{-- Success alert modal --}}
    @if (session('success'))
        <div id="successModal" class="modal-confirm">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Operación Exitosa</h3>
                </div>
                <div class="modal-body">
                    <p>{{ session('success') }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="corporate-btn" onclick="closeSuccessModal()">Aceptar</button>
                </div>
            </div>
        </div>
    @endif

    <div class="row g-4">
        <!-- Respuestas Section -->
        <div class="col-12 section-item">
            <div class="corporate-card border-0 shadow-sm">
                <div class="section-header" style="border-left: 4px solid #e63946;">
                    <div class="section-content d-flex justify-content-between align-items-center py-4 px-4">
                        <div class="d-flex align-items-center">
                            <div class="section-icon me-4" style="background-color: #e6394615;">
                                <i class="fas fa-exclamation-triangle fa-lg" style="color: #e63946;"></i>
                            </div>
                            <div>
                                <h4 class="mb-1 fw-semibold text-dark">Respuestas para Accidente Nº{{ $event->id }}</h4>
                                <small class="text-muted">Gestión de Respuestas</small>
                            </div>
                        </div>
                        <div class="stats-container">
                            <div class="stats-number">{{ $responses->count() }}</div>
                            <div class="stats-label">Respuestas</div>
                        </div>
                    </div>
                </div>

                {{-- Buttons and Date filter --}}
                <div class="px-4 py-3">
                    <div class="d-flex align-items-end mb-3 gap-3 justify-content-between">
                        <div class="d-flex align-items-end gap-3">
                            <div style="max-width: 140px;">
                                <label for="date_filter" class="form-label small text-muted mb-1">Filtrar por fecha</label>
                                <input type="date" name="date_filter" id="date_filter" class="form-control form-control-sm" value="{{ request('date_filter') }}" onchange="handleDateChange()">
                            </div>
                            <button type="submit" form="dateFilterForm" class="corporate-btn" style="border: 2px solid #adb5bd;">
                                <i class="fas fa-filter me-2"></i>
                                <span>Filtrar</span>
                            </button>
                            <a href="{{ route('sstsena.accidents.responses.index', $event->id) }}" class="corporate-btn" style="border: 2px solid #adb5bd;">
                                <i class="fas fa-times me-2"></i>
                                <span>Limpiar Filtro</span>
                            </a>
                            @if (!checkRol('sstsena.funcionario'))
                                <a href="{{ route('sstsena.accidents.responses.create', $event->id) }}"
                                   class="corporate-btn" style="border: 2px solid #adb5bd;">
                                    <i class="fas fa-plus me-2"></i>
                                    <span>Agregar Respuesta</span>
                                </a>
                            @endif
                        </div>
                        <a href="{{ route('events.index') }}"
                           class="corporate-btn corporate-btn-delete" style="border-color: #dc3545;">
                            <i class="fas fa-arrow-left me-2"></i>
                            <span>Volver</span>
                        </a>
                    </div>
                    <form id="dateFilterForm" method="GET" action="{{ route('sstsena.accidents.responses.index', $event->id) }}" class="d-none">
                        <input type="date" name="date_filter" id="date_filter_hidden" value="{{ request('date_filter') }}">
                    </form>
                </div>

                {{-- Corporate table --}}
                <div class="table-container">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 corporate-table">
                            <thead>
                                <tr class="corporate-header-row">
                                    <th class="corporate-th midterm-ignore">...</th>
                                    <!-- Other table headers remain unchanged -->
                                    <th class="corporate-th text-center midterm-ignore" style="width: 10%;">
                                        <div class="th-content justify-content-center">
                                            <i class="fas fa-tools me-2"></i>
                                            <span>Acciones</span>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($responses as $response)
                                    <tr class="corporate-row">
                                        <!-- Other table cells remain unchanged -->
                                        <td class="text-center corporate-cell midterm-ignore">
                                            @if (!checkRol('sstsena.funcionario'))
                                                <div class="d-flex justify-content-center gap-2">
                                                    <a href="{{ route('sstsena.accidents.responses.edit', [$event->id, $response->id]) }}"
                                                       class="corporate-btn corporate-btn-edit" style="border-color: #28a745;">
                                                        <i class="fas fa-edit"></i>
                                                        <span>Editar</span>
                                                    </a>
                                                    <form action="{{ route('sstsena.accidents.responses.destroy', [$event->id, $response->id]) }}"
                                                          method="POST" class="d-inline" onsubmit="return confirmDelete()">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="corporate-btn corporate-btn-delete" style="border-color: #dc3545;">
                                                            <i class="fas fa-trash"></i>
                                                            <span>Eliminar</span>
                                                        </button>
                                                    </form>
                                                </div>
                                            @else
                                                <span class="text-muted">Sin acciones</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-5">
                                            <div class="empty-state-corporate">
                                                <div class="empty-icon mb-3">
                                                    <i class="fas fa-exclamation-triangle fa-3x text-muted opacity-25"></i>
                                                </div>
                                                <h6 class="text-muted mb-2 fw-normal">No se encontraron respuestas</h6>
                                                <p class="text-muted mb-0 small">
                                                    Las nuevas respuestas se registrarán y mostrarán aquí automáticamente
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if($responses instanceof \Illuminate\Pagination\LengthAwarePaginator)
                        <div class="mt-3 px-4">
                            {{ $responses->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Personas Involucradas Section -->
        <div class="col-12 section-item">
            <div class="corporate-card border-0 shadow-sm">
                <div class="section-header" style="border-left: 4px solid #e63946;">
                    <div class="section-content d-flex justify-content-between align-items-center py-4 px-4">
                        <div class="d-flex align-items-center">
                            <div class="section-icon me-4" style="background-color: #e6394615;">
                                <i class="fas fa-users fa-lg" style="color: #e63946;"></i>
                            </div>
                            <div>
                                <h4 class="mb-1 fw-semibold text-dark">Personas Involucradas en Accidente Nº{{ $event->id }}</h4>
                                <small class="text-muted">Listado de personas involucradas</small>
                            </div>
                        </div>
                        <div class="stats-container">
                            <div class="stats-number">{{ $event->peopleInvolved ? $event->peopleInvolved->count() : 0 }}</div>
                            <div class="stats-label">Personas</div>
                        </div>
                    </div>
                </div>

                <div class="table-container">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 corporate-table">
                            <thead>
                                <tr class="corporate-header-row">
                                    <th class="corporate-th midterm-ignore">...</th>
                                    <!-- Other table headers remain unchanged -->
                                    <th class="corporate-th text-center midterm-ignore">
                                        <div class="th-content justify-content-center">
                                            <i class="fas fa-tools me-2"></i>
                                            <span>Acciones</span>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($event->peopleInvolved ?? [] as $people)
                                    <tr class="corporate-row">
                                        <!-- Other table cells remain unchanged -->
                                        <td class="text-center corporate-cell midterm-ignore">
                                            @if (!checkRol('sstsena.funcionario'))
                                                <div class="d-flex justify-content-center gap-2">
                                                    <a href="{{ route('sstsena.funcionario.people_involved.edit', $people->id) }}"
                                                       class="corporate-btn corporate-btn-edit" style="border-color: #28a745;">
                                                        <i class="fas fa-edit"></i>
                                                        <span>Editar</span>
                                                    </a>
                                                    <form action="{{ route('sstsena.funcionario.people_involved.destroy', $people->id) }}"
                                                          method="POST" class="d-inline" onsubmit="return confirmDelete()">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="corporate-btn corporate-btn-delete" style="border-color: #dc3545;">
                                                            <i class="fas fa-trash"></i>
                                                            <span>Eliminar</span>
                                                        </button>
                                                    </form>
                                                </div>
                                            @else
                                                <span class="text-muted">Sin acciones</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="11" class="text-center py-5">
                                            <div class="empty-state-corporate">
                                                <div class="empty-icon mb-3">
                                                    <i class="fas fa-users fa-3x text-muted opacity-25"></i>
                                                </div>
                                                <h6 class="text-muted mb-2 fw-normal">No se encontraron personas involucradas</h6>
                                                <p class="text-muted mb-0 small">
                                                    No hay personas registradas para este accidente.
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
    </div>

    <!-- Delete confirmation modal -->
    <div id="confirmDeleteModal" class="modal-confirm" style="display: none;">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Confirmar Eliminación</h3>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro de que deseas eliminar este registro? Esta acción no se puede deshacer.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="corporate-btn" onclick="closeModal()">Cancelar</button>
                <button type="button" class="corporate-btn corporate-btn-delete" onclick="submitForm()">Eliminar</button>
            </div>
        </div>
    </div>
</div>

<!-- Styles and Scripts remain unchanged -->
<style>
    /* ... (Original styles unchanged) ... */
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

    function closeSuccessModal() {
        const modal = document.getElementById('successModal');
        modal.style.display = 'none';
    }

    function toggleText(elementId) {
        const textElement = document.getElementById(elementId);
        const toggleElement = textElement.nextElementSibling;
        const isExpanded = textElement.classList.contains('expanded');

        if (isExpanded) {
            textElement.style.maxHeight = '3em';
            textElement.classList.remove('expanded');
            toggleElement.querySelector('.toggle-label').textContent = 'Mostrar más';
            toggleElement.querySelector('.toggle-icon').style.transform = 'rotate(0deg)';
        } else {
            textElement.style.maxHeight = textElement.scrollHeight + 'px';
            textElement.classList.add('expanded');
            toggleElement.querySelector('.toggle-label').textContent = 'Mostrar menos';
            toggleElement.querySelector('.toggle-icon').style.transform = 'rotate(180deg)';
        }
    }

    function handleDateChange() {
        const dateInput = document.getElementById('date_filter');
        const hiddenInput = document.getElementById('date_filter_hidden');
        const form = document.getElementById('dateFilterForm');

        if (dateInput.value) {
            hiddenInput.value = dateInput.value;
            form.submit();
        } else {
            alert('Por favor, seleccione una fecha válida.');
        }
    }
</script>
@endsection