@extends('sstsena::layouts.master')
@section('content')

<!-- Título con estilo moderno -->
<h2 class="text-center fw-bold mb-4" style="color: #1a1a1a; font-size: 2rem;">Lista de Accidentes</h2>

<!-- Botones con diseño premium -->
<div class="text-center mb-4 d-flex justify-content-center gap-3 flex-wrap">
    <a href="{{ route('sstsena.funcionario.accidents.create') }}" class="btn btn-lg btn-success shadow-sm rounded-pill px-4 py-2 d-flex align-items-center justify-content-center">
        <i class="fas fa-plus-circle me-2"></i> Agregar Accidente
    </a>
    <button class="btn btn-lg btn-primary shadow-sm rounded-pill px-4 py-2 d-flex align-items-center justify-content-center"
            data-bs-toggle="modal" data-bs-target="#agregarPersonaModal">
        <i class="fas fa-user-injured me-2"></i> Agregar Personas Involucradas
    </button>
</div>

<!-- Modal para Registrar Persona Involucrada -->
<div class="modal fade" id="agregarPersonaModal" tabindex="-1" aria-labelledby="agregarPersonaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header bg-gradient text-white" style="background-color: #007bff;">
                <h5 class="modal-title fw-bold" id="agregarPersonaModalLabel">Registrar Persona Involucrada</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body p-4">
                <form action="{{ route('sstsena.funcionario.people_involved.store') }}" method="POST">
                    @csrf

                    <div class="row g-3">
                        <!-- Tipo de Documento -->
                        <div class="col-md-6">
                            <label for="document_type" class="form-label fw-semibold">Tipo de Documento</label>
                            <select name="document_type" id="document_type" class="form-select form-select-sm rounded-pill" required>
                                <option value="">Seleccione una opción</option>
                                <option value="CC">Cédula de Ciudadanía</option>
                                <option value="TI">Tarjeta de Identidad</option>
                                <option value="CE">Cédula de Extranjería</option>
                                <option value="PAS">Pasaporte</option>
                                <option value="OTRO">Otro</option>
                            </select>
                        </div>

                        <!-- Número de Documento -->
                        <div class="col-md-6">
                            <label for="document_number" class="form-label fw-semibold">Número de Documento</label>
                            <input type="text" name="document_number" id="document_number" class="form-control form-control-sm rounded-pill" required>
                        </div>

                        <!-- Nombre -->
                        <div class="col-md-6">
                            <label for="name" class="form-label fw-semibold">Nombre</label>
                            <input type="text" name="name" id="name" class="form-control form-control-sm rounded-pill" required>
                        </div>

                        <!-- Apellido -->
                        <div class="col-md-6">
                            <label for="last_name" class="form-label fw-semibold">Apellido</label>
                            <input type="text" name="last_name" id="last_name" class="form-control form-control-sm rounded-pill" required>
                        </div>

                        <!-- Fecha de Nacimiento -->
                        <div class="col-md-6">
                            <label for="birth_date" class="form-label fw-semibold">Fecha de Nacimiento</label>
                            <input type="date" name="birth_date" id="birth_date" class="form-control form-control-sm rounded-pill" required>
                        </div>

                        <!-- Género -->
                        <div class="col-md-6">
                            <label for="gender" class="form-label fw-semibold">Género</label>
                            <select name="gender" id="gender" class="form-select form-select-sm rounded-pill" required>
                                <option value="">Selecciona una opción</option>
                                <option value="Masculino">Masculino</option>
                                <option value="Femenino">Femenino</option>
                                <option value="Otro">Otro</option>
                            </select>
                        </div>

                        <!-- Tipo de Persona -->
                        <div class="col-md-6">
                            <label for="person_type_id" class="form-label fw-semibold">Tipo de Persona</label>
                            <select name="person_type_id" id="person_type_id" class="form-select form-select-sm rounded-pill" required>
                                <option value="">Seleccione una opción</option>
                                @foreach ($typePersons as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Teléfono -->
                        <div class="col-md-6">
                            <label for="phone" class="form-label fw-semibold">Teléfono</label>
                            <input type="text" name="phone" id="phone" class="form-control form-control-sm rounded-pill">
                        </div>

                        <!-- Dirección -->
                        <div class="col-md-12">
                            <label for="address" class="form-label fw-semibold">Dirección</label>
                            <input type="text" name="address" id="address" class="form-control form-control-sm rounded-pill">
                        </div>

                        <!-- Relación con Accidente -->
                        <div class="col-md-12">
                            <label for="accident_id" class="form-label fw-semibold">Accidente Asociado</label>
                            <select name="accident_id" id="accident_id" class="form-select form-select-sm rounded-pill" required>
                                <option value="">Seleccione un accidente</option>
                                @foreach ($accidents as $accident)
                                    <option value="{{ $accident->id }}">
                                        {{ $accident->id . ' - ' . $accident->description }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Botón Guardar -->
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary btn-lg px-5 py-2 rounded-pill shadow-sm">
                            <i class="fas fa-save me-2"></i>Guardar Persona
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Tabla de Accidentes -->
<div class="container mt-5">
    <div class="table-responsive shadow rounded border overflow-hidden">
        <table class="table table-hover align-middle mb-0 bg-white">
            <thead class="bg-light text-uppercase small text-muted fw-semibold">
                <tr>
                    <th>#</th>
                    <th>Fecha y Hora</th>
                    <th>Ubicación</th>
                    <th>Tipo de Lesión</th>
                    <th>Tipo de Riesgo</th>
                    <th>Tipo de Accidente</th>
                    <th>Descripción</th>
                    <th>Gravedad</th>
                    <th>Evidencia</th>
                    <th>Creado por</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($accidents as $accident)
                <tr class="align-middle">
                    <td><strong>{{ $loop->iteration }}</strong></td>
                    <td>{{ $accident->date_time }}</td>
                    <td>{{ $accident->environment->name ?? 'N/A' }}</td>
                    <td>{{ $accident->injuryType->name ?? 'N/A' }}</td>
                    <td>{{ $accident->riskType->name ?? 'N/A' }}</td>
                    <td>{{ $accident->accidentType->name ?? 'N/A' }}</td>
                    <td class="text-truncate" style="max-width: 200px;" title="{{ $accident->description }}">
                        {{ $accident->description }}
                    </td>
                    <td>
                        <span class="badge rounded-pill fs-6
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
                                $isImage = in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp']);
                                $modalId = 'evidenceModal' . $accident->id;
                            @endphp
                            @if($isImage)
                                <a href="#" data-bs-toggle="modal" data-bs-target="#{{ $modalId }}">
                                    <img src="{{ asset('storage/evidences/' . $accident->evidence) }}"
                                         alt="Evidencia"
                                         class="img-thumbnail rounded shadow-sm"
                                         style="width: 60px; height: 60px; object-fit: cover;">
                                </a>
                                <!-- Modal Imagen -->
                                <div class="modal fade" id="{{ $modalId }}" tabindex="-1" aria-labelledby="{{ $modalId }}Label" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Evidencia del Accidente</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <img src="{{ asset('storage/evidences/' . $accident->evidence) }}"
                                                     alt="Evidencia Ampliada"
                                                     class="img-fluid rounded shadow"
                                                     style="max-height: 600px; object-fit: contain;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <a href="{{ asset('storage/evidences/' . $accident->evidence) }}"
                                   class="btn btn-sm btn-outline-primary"
                                   target="_blank">
                                    <i class="fas fa-file-alt me-1"></i>Ver Archivo
                                </a>
                            @endif
                        @else
                            <span class="text-muted">Sin evidencia</span>
                        @endif
                    </td>
                    <td>{{ $accident->user->nickname ?? 'Desconocido' }}</td>
                    <td>
                        <a href="{{ route('sstsena.funcionario.accidents.edit', $accident->id) }}"
                           class="btn btn-sm btn-outline-success rounded-circle">
                            <i class="fas fa-edit"></i>
                        </a>
                    </td>
                    <td>
                        <form action="{{ route('sstsena.funcionario.accidents.destroy', $accident->id) }}" method="POST"
                              onsubmit="return confirm('¿Estás seguro de eliminar este accidente?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="12" class="text-center py-4 text-muted">
                        <i class="fas fa-exclamation-triangle me-2"></i>No hay accidentes registrados.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection