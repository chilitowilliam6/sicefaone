@extends('sstsena::layouts.master')
@section('content')
<div class="container-fluid py-4">
    <div class="row g-4">
        <!-- Lista de Accidentes -->
        <div class="col-12 section-item">
            <div class="corporate-card border-0 shadow-sm">
                <div class="section-header" style="border-left: 4px solid #FF8C00;">
                    <div class="section-content d-flex justify-content-between align-items-center py-4 px-4">
                        <div class="d-flex align-items-center">
                            <div class="section-icon me-4" style="background-color: #FF8C0015;">
                                <i class="fas fa-exclamation-triangle fa-lg" style="color: #FF8C00;"></i>
                            </div>
                            <div>
                                <h4 class="mb-1 fw-semibold text-dark">Lista de Accidentes</h4>
                                <small class="text-muted">Gestión de Accidentes</small>
                            </div>
                        </div>
                        <div class="stats-container">
                            <div class="stats-number">{{ $accidents->count() }}</div>
                            <div class="stats-label">Accidentes</div>
                        </div>
                    </div>
                </div>

                <div class="px-4 py-3">
                    <div class="d-flex flex-wrap gap-3 justify-content-between">
                        <div>
                            <a href="{{ route('sstsena.funcionario.accidents.create') }}" class="corporate-btn" style="border: 2px solid #adb5bd;">
                                <i class="fas fa-plus me-2"></i>
                                <span>Agregar Accidente</span>
                            </a>
                            <button class="corporate-btn" data-bs-toggle="modal" data-bs-target="#agregarPersonaModal"
                                    style="border: 2px solid #adb5bd;">
                                <i class="fas fa-user-friends me-2"></i>
                                <span>Agregar Personas Involucradas</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Tabla de Accidentes -->
                <div class="table-container">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 corporate-table">
                            <thead>
                                <tr class="corporate-header-row">
                                    <th class="corporate-th midterm-ignore"><i class="fas fa-hashtag me-2"></i>#</th>
                                    <th class="corporate-th midterm-ignore"><i class="fas fa-clock me-2"></i>Fecha y Hora</th>
                                    <th class="corporate-th midterm-ignore"><i class="fas fa-map-marker-alt me-2"></i>Ubicación</th>
                                    <th class="corporate-th midterm-ignore"><i class="fas fa-briefcase-medical me-2"></i>Tipo de Lesión</th>
                                    <th class="corporate-th midterm-ignore"><i class="fas fa-shield-alt me-2"></i>Tipo de Riesgo</th>
                                    <th class="corporate-th midterm-ignore"><i class="fas fa-car-crash me-2"></i>Tipo de Accidente</th>
                                    <th class="corporate-th midterm-ignore"><i class="fas fa-file-alt me-2"></i>Descripción</th>
                                    <th class="corporate-th midterm-ignore"><i class="fas fa-thermometer-half me-2"></i>Gravedad</th>
                                    <th class="corporate-th midterm-ignore"><i class="fas fa-image me-2"></i>Evidencia</th>
                                    <th class="corporate-th midterm-ignore"><i class="fas fa-user me-2"></i>Creado por</th>
                                    <th class="corporate-th text-center midterm-ignore"><i class="fas fa-tools me-2"></i>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($accidents as $accident)
                                    <tr class="corporate-row">
                                        <td class="corporate-cell midterm-ignore">{{ $loop->iteration }}</td>
                                        <td class="corporate-cell midterm-ignore">{{ $accident->date_time }}</td>
                                        <td class="corporate-cell midterm-ignore">{{ $accident->environment->name ?? 'N/A' }}</td>
                                        <td class="corporate-cell midterm-ignore">{{ $accident->injuryType->name ?? 'N/A' }}</td>
                                        <td class="corporate-cell midterm-ignore">{{ $accident->riskType->name ?? 'N/A' }}</td>
                                        <td class="corporate-cell midterm-ignore">{{ $accident->accidentType->name ?? 'N/A' }}</td>
                                        <td class="corporate-cell midterm-ignore expandable-text" id="desc-{{ $accident->id }}"
                                            style="max-height: 3em; overflow: hidden; transition: max-height 0.3s ease;">
                                            {{ $accident->description }}
                                        </td>
                                        @if(strlen($accident->description) > 65)
                                            <small class="text-muted mt-1 d-block toggle-text" onclick="toggleText('desc-{{ $accident->id }}')">
                                                <i class="fas fa-chevron-down me-1 toggle-icon"></i>
                                                <span class="toggle-label">Mostrar más</span>
                                            </small>
                                        @endif
                                        <td class="corporate-cell midterm-ignore">
                                            @switch(strtolower($accident->severity))
                                                @case('minor')
                                                    <span class="severity-badge severity-low"><div class="severity-indicator"></div><span>Leve</span></span>
                                                    @break
                                                @case('moderate')
                                                    <span class="severity-badge severity-medium"><div class="severity-indicator"></div><span>Moderada</span></span>
                                                    @break
                                                @case('serious')
                                                    <span class="severity-badge severity-high"><div class="severity-indicator"></div><span>Grave</span></span>
                                                    @break
                                                @case('fatal')
                                                    <span class="severity-badge severity-critical"><div class="severity-indicator"></div><span>Fatal</span></span>
                                                    @break
                                                @default
                                                    <span class="severity-badge severity-pending"><div class="severity-indicator"></div><span>No definida</span></span>
                                            @endswitch
                                        </td>
                                        <td class="corporate-cell midterm-ignore text-center">
                                            @if($accident->evidence)
                                                @php
                                                    $ext = pathinfo($accident->evidence, PATHINFO_EXTENSION);
                                                    $isImage = in_array(strtolower($ext), ['jpg','jpeg','png','gif','webp']);
                                                    $modalId = 'evidenceModal'.$accident->id;
                                                @endphp
                                                @if($isImage)
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#{{ $modalId }}">
                                                        <img src="{{ asset('storage/evidences/'.$accident->evidence) }}"
                                                             alt="Evidencia"
                                                             class="img-thumbnail"
                                                             style="width: 60px; height: 60px; object-fit: cover;">
                                                    </a>
                                                    <div class="modal fade" id="{{ $modalId }}" tabindex="-1" aria-labelledby="{{ $modalId }}Label" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Evidencia</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                                                </div>
                                                                <div class="modal-body text-center">
                                                                    <img src="{{ asset('storage/evidences/'.$accident->evidence) }}"
                                                                         alt="Evidencia"
                                                                         class="img-fluid rounded"
                                                                         style="max-height: 600px;">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <a href="{{ asset('storage/evidences/'.$accident->evidence) }}" target="_blank"
                                                       class="corporate-btn corporate-btn-edit">
                                                        <i class="fas fa-eye me-2"></i>
                                                        <span>Ver archivo</span>
                                                    </a>
                                                @endif
                                            @else
                                                <span class="text-muted">Sin evidencia</span>
                                            @endif
                                        </td>
                                        <td class="corporate-cell midterm-ignore">{{ $accident->user->nickname ?? 'Desconocido' }}</td>
                                        <td class="corporate-cell text-center midterm-ignore">
                                            <div class="d-flex justify-content-center gap-2">
                                                <a href="{{ route('sstsena.funcionario.accidents.edit', $accident->id) }}"
                                                   class="corporate-btn corporate-btn-edit">
                                                    <i class="fas fa-edit"></i>
                                                    <span>Editar</span>
                                                </a>
                                                <form action="{{ route('sstsena.funcionario.accidents.destroy', $accident->id) }}"
                                                      method="POST" class="d-inline" onsubmit="return confirmDelete()">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="corporate-btn corporate-btn-delete">
                                                        <i class="fas fa-trash"></i>
                                                        <span>Eliminar</span>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="11" class="text-center py-5">
                                            <div class="empty-state-corporate">
                                                <div class="empty-icon mb-3">
                                                    <i class="fas fa-exclamation-circle fa-3x text-muted opacity-25"></i>
                                                </div>
                                                <h6 class="text-muted mb-2 fw-normal">No hay accidentes registrados</h6>
                                                <p class="text-muted small">
                                                    Los nuevos accidentes se mostrarán automáticamente aquí
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

    <!-- Modal Agregar Persona Involucrada -->
    <div class="modal fade" id="agregarPersonaModal" tabindex="-1" aria-labelledby="agregarPersonaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title text-primary" id="agregarPersonaModalLabel">Crear Persona Involucrada</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('sstsena.funcionario.people_involved.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="document_type" class="form-label">Tipo de Documento</label>
                                <select name="document_type" id="document_type" class="form-select" required>
                                    <option value="">Seleccione una opción</option>
                                    <option value="CC">Cédula de Ciudadanía</option>
                                    <option value="TI">Tarjeta de Identidad</option>
                                    <option value="CE">Cédula de Extranjería</option>
                                    <option value="PAS">Pasaporte</option>
                                    <option value="OTRO">Otro</option>
                                </select>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="document_number" class="form-label">Número de Documento</label>
                                <input type="text" name="document_number" id="document_number" class="form-control" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="name" class="form-label">Nombre</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="last_name" class="form-label">Apellido</label>
                                <input type="text" name="last_name" id="last_name" class="form-control" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="birth_date" class="form-label">Fecha de Nacimiento</label>
                                <input type="date" name="birth_date" id="birth_date" class="form-control" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="gender" class="form-label">Género</label>
                                <select name="gender" id="gender" class="form-select" required>
                                    <option value="">Selecciona una opción</option>
                                    <option value="Masculino">Masculino</option>
                                    <option value="Femenino">Femenino</option>
                                    <option value="Otro">Otro</option>
                                </select>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="person_type_id" class="form-label">Tipo de Persona</label>
                                <select name="person_type_id" id="person_type_id" class="form-select" required>
                                    <option value="">Seleccione una opción</option>
                                    @foreach ($typePersons as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="phone" class="form-label">Teléfono</label>
                                <input type="text" name="phone" id="phone" class="form-control">
                            </div>
                            <div class="mb-3 col-md-12">
                                <label for="address" class="form-label">Dirección</label>
                                <input type="text" name="address" id="address" class="form-control">
                            </div>
                            <div class="mb-3 col-md-12">
                                <label for="accident_id" class="form-label">Accidente Asociado</label>
                                <select name="accident_id" id="accident_id" class="form-select" required>
                                    <option value="">Seleccione un accidente</option>
                                    @foreach ($accidents as $accident)
                                        <option value="{{ $accident->id }}">
                                            {{ $accident->id . ' - ' . $accident->description }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="text-center mt-3">
                            <button type="submit" class="corporate-btn corporate-btn-edit">
                                <i class="fas fa-save me-2"></i>
                                <span>Guardar</span>
                            </button>
                        </div>
                    </form>
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

<style>
/* Aquí puedes copiar todo el bloque <style> del archivo 1 */
</style>

<script>
let activeForm = null;

function confirmDelete() {
    const modal = document.getElementById('confirmDeleteModal');
    activeForm = event.target.closest('form');
    modal.style.display = 'flex';
    return false;
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

function toggleText(elementId) {
    const element = document.getElementById(elementId);
    const isExpanded = element.classList.contains('expanded');
    if (isExpanded) {
        element.style.maxHeight = '3em';
        element.classList.remove('expanded');
    } else {
        element.style.maxHeight = element.scrollHeight + 'px';
        element.classList.add('expanded');
    }
}
</script>
@endsection