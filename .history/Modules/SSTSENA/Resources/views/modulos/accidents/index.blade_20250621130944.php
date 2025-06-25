@extends('sstsena::layouts.master')
@section('content')



<div class="card shadow-sm p-3 mb-4 bg-white rounded border-0">
    <div class="d-flex flex-wrap justify-content-between align-items-center">
        <!-- Ícono animado + cantidad -->
        <div class="d-flex align-items-center mb-2 mb-md-0">
            <div class="me-3 d-flex justify-content-center align-items-center bg-light rounded-circle shadow-sm" style="width: 45px; height: 45px; animation: pulse 2s infinite;">
                <i class="bi bi-activity text-primary" style="font-size: 1.5rem;"></i>
            </div>
            <div class="d-flex flex-column">
                <span class="fw-bold text-dark" style="font-size: 1.4rem;">{{ $accidents->count() }}</span>
                <small class="text-uppercase text-muted" style="font-size: 0.75rem;">Registros</small>
            </div>
        </div>

     
        </div>
    </div>
</div>


        <!-- Botones de acción -->
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

<!-- Modal -->
<div class="modal fade" id="agregarPersonaModal" tabindex="-1" aria-labelledby="agregarPersonaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <br>
            <div class="modal-header bg-light">
                <h5 class="modal-title text-primary" id="agregarPersonaModalLabel">Crear Persona Involucrada</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('sstsena.funcionario.people_involved.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <!-- Campos del formulario -->
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
                                <option value="{{ $accident->id }}">{{ $accident->id . ' - ' . $accident->description }}</option>
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

<!-- Tabla con misma anchura que el card -->
<div class="card shadow-sm p-3 bg-white rounded border-0">
    <table class="table table-bordered table-hover mb-0" style="background-color: #ffffff;">
        <thead style="background-color: #f8f9fa;">
            <tr>
                <th style="color: #34495e; font-weight: 600;">#</th>
                <th style="color: #34495e; font-weight: 600;">Fecha y Hora</th>
                <th style="color: #34495e; font-weight: 600;">Ubicacion</th>
                <th style="color: #34495e; font-weight: 600;">Tipo de Lesión</th>
                <th style="color: #34495e; font-weight: 600;">Tipo de Riesgo</th>
                <th style="color: #34495e; font-weight: 600;">Tipo de Accidente</th>
                <th style="color: #34495e; font-weight: 600;">Descripción</th>
                <th style="color: #34495e; font-weight: 600;">Gravedad</th>
                <th style="color: #34495e; font-weight: 600;">Evidencia</th>
                <th style="color: #34495e; font-weight: 600;">Creado por</th>
                <th style="color: #34495e; font-weight: 600;">Acciones</th>
                <th style="color: #34495e; font-weight: 600;">Acciones</th>
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
                        @if($accident->severity == 'Minor') bg-success text-white
                        @elseif($accident->severity == 'Moderate') bg-warning text-dark
                        @elseif($accident->severity == 'Serious') bg-danger text-white
                        @elseif($accident->severity == 'Fatal') bg-dark text-white
                        @endif"
                        style="padding: 0.5em 1em; border-radius: 0.25rem;">
                        {{ ucfirst($accident->severity) }}
                    </span>
                </td>
                <td class="text-center align-middle">
                    @if($accident->evidence)
                    @php
                    $ext = strtolower(pathinfo($accident->evidence, PATHINFO_EXTENSION));
                    $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                    $isImage = in_array($ext, $imageExtensions);
                    $modalId = 'evidenceModal' . $accident->id;
                    @endphp

                    @if($isImage)
                    <a href="#" data-bs-toggle="modal" data-bs-target="#{{ $modalId }}">
                        <img src="{{ asset('storage/evidences/' . $accident->evidence) }}" alt="Evidencia"
                            class="img-thumbnail" style="inline-size: 60px; block-size: 60px; object-fit: cover;">
                    </a>
                    <div class="modal fade" id="{{ $modalId }}" tabindex="-1" aria-labelledby="{{ $modalId }}Label" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="{{ $modalId }}Label">Evidencia</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                </div>
                                <div class="modal-body text-center">
                                    <img src="{{ asset('storage/evidences/' . $accident->evidence) }}"
                                        alt="Evidencia" class="img-fluid rounded"
                                        style="max-height: 600px; object-fit: contain;">
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <a href="{{ asset('storage/evidences/' . $accident->evidence) }}"
                        class="btn btn-sm btn-primary" target="_blank">Ver archivo</a>
                    @endif
                    @else
                    <span class="text-muted">Sin evidencia</span>
                    @endif
                </td>
                <td>{{ $accident->user->nickname ?? 'Desconocido' }}</td>
                <td>
                    <a href="{{ route('sstsena.funcionario.accidents.edit', $accident->id) }}"
                        class="btn btn-sm btn-outline-success" style="border-color: #28a745; color: #28a745;">Editar</a>
                </td>
                <td>
                    <form action="{{ route('sstsena.funcionario.accidents.destroy', $accident->id) }}"
                        method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este accidente?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="11" class="text-center text-muted" style="padding: 1.5rem;">
                    No hay accidentes registrados.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
