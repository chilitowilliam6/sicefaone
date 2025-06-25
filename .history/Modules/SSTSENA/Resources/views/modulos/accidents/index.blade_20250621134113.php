@extends('sstsena::layouts.master')
@section('content')

<!-- Script de tooltips -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl, {
                customClass: 'custom-tooltip'
            });
        });
    });
</script>

<!-- Estilo para tooltip visualmente mejorado -->
<style>
    .custom-tooltip .tooltip-inner {
        max-width: 300px;
        font-size: 1rem;
        padding: 10px 14px;
        background-color: #333;
        border-radius: 8px;
        text-align: left;
    }
</style>

<!-- Tarjeta superior con total y botones -->
<div class="card shadow-sm p-3 mb-4 bg-white rounded border-0">
    <div class="d-flex flex-wrap justify-content-between align-items-center">
        <div class="d-flex align-items-center mb-2 mb-md-0">
            <i class="{{ $accidents->count() > 0 ? 'bi bi-clipboard-check' : 'bi bi-clipboard-data' }} text-primary me-2" style="font-size: 1.8rem;"></i>
            <h5 class="mb-0 text-dark">Total de Registros: <span class="text-primary">{{ $accidents->count() }}</span></h5>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('sstsena.funcionario.accidents.create') }}" class="btn btn-success shadow-sm">
                <i class="bi bi-plus-circle-fill me-1"></i> Nuevo Accidente
            </a>
            <button class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#agregarPersonaModal">
                <i class="bi bi-person-plus-fill me-1"></i> Personas Involucradas
            </button>
        </div>
    </div>
</div>

<!-- MODAL -->
<div class="modal fade" id="agregarPersonaModal" tabindex="-1" aria-labelledby="agregarPersonaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" style="margin-top: 60px; max-width: 800px;">
        <div class="modal-content">
            <div class="modal-header bg-light justify-content-center">
                <h5 class="modal-title text-primary" id="agregarPersonaModalLabel" style="font-size: 1.1rem;">Crear Persona Involucrada</h5>
                <button type="button" class="btn-close position-absolute end-0 me-3" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('sstsena.funcionario.people_involved.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <!-- Campos -->
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
                            <select name="accident_id" id="accident_id" class="form-select text-truncate" required>
                                <option value="">Seleccione un accidente</option>
                                @foreach ($accidents as $accident)
                                    <option 
                                        value="{{ $accident->id }}" 
                                        data-bs-toggle="tooltip" 
                                        data-bs-placement="right"
                                        title="{{ $accident->description }}">
                                        {{ $accident->id . ' - ' . Str::limit($accident->description, 60) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="text-center mt-3">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Tabla -->
<div class="card shadow-sm p-3 bg-white rounded border-0">
    <table class="table table-bordered table-hover mb-0" style="background-color: #ffffff;">
        <thead style="background-color: #f8f9fa;">
            <tr>
                <th>#</th><th>Fecha y Hora</th><th>Ubicacion</th><th>Tipo de Lesión</th>
                <th>Tipo de Riesgo</th><th>Tipo de Accidente</th><th>Descripción</th><th>Gravedad</th>
                <th>Evidencia</th><th>Creado por</th><th>Acciones</th><th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($accidents as $accident)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $accident->date_time }}</td>
                <td>{{ $accident->environment->name ?? 'N/A' }}</td>
                <td>{{ $accident->injuryType->name ?? 'N/A' }}</td>
                <td>{{ $accident->riskType->name ?? 'N/A' }}</td>
                <td>{{ $accident->accidentType->name ?? 'N/A' }}</td>
                <td>{{ $accident->description }}</td>
                <td>
                    <span class="badge 
                        @if($accident->severity == 'Minor') bg-success
                        @elseif($accident->severity == 'Moderate') bg-warning text-dark
                        @elseif($accident->severity == 'Serious') bg-danger
                        @elseif($accident->severity == 'Fatal') bg-dark
                        @endif">
                        {{ ucfirst($accident->severity) }}
                    </span>
                </td>
                <td class="text-center">
                    @if($accident->evidence)
                        @php
                            $ext = strtolower(pathinfo($accident->evidence, PATHINFO_EXTENSION));
                            $isImage = in_array($ext, ['jpg','jpeg','png','gif','webp']);
                            $modalId = 'evidenceModal'.$accident->id;
                        @endphp
                        @if($isImage)
                            <a href="#" data-bs-toggle="modal" data-bs-target="#{{ $modalId }}">
                                <img src="{{ asset('storage/evidences/' . $accident->evidence) }}" class="img-thumbnail" style="width:60px; height:60px; object-fit:cover;">
                            </a>
                            <div class="modal fade" id="{{ $modalId }}" tabindex="-1">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Evidencia</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <img src="{{ asset('storage/evidences/' . $accident->evidence) }}" class="img-fluid rounded" style="max-height:600px; object-fit:contain;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <a href="{{ asset('storage/evidences/' . $accident->evidence) }}" class="btn btn-sm btn-primary" target="_blank">Ver archivo</a>
                        @endif
                    @else
                        <span class="text-muted">Sin evidencia</span>
                    @endif
                </td>
                <td>{{ $accident->user->nickname ?? 'Desconocido' }}</td>
                <td>
                    <a href="{{ route('sstsena.funcionario.accidents.edit', $accident->id) }}" class="btn btn-sm btn-outline-success">Editar</a>
                </td>
                <td>
                    <form action="{{ route('sstsena.funcionario.accidents.destroy', $accident->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este accidente?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="12" class="text-center text-muted">No hay accidentes registrados.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
