@extends('sstsena::layouts.master')
@section('content')
<h2 class="mb-4 text-center text-uppercase fw-bold text-primary-emphasis">
    <i class="bi bi-hospital-fill me-2"></i>Listado General de Accidentes Reportados
</h2>

<div class="card border-0 shadow-lg rounded-4 p-4 bg-light mb-5">
    <div class="row align-items-center">
        <div class="col-md-6 d-flex align-items-center mb-3 mb-md-0">
            <div class="bg-primary text-white rounded-circle d-flex justify-content-center align-items-center me-3 shadow" style="width: 50px; height: 50px;">
                <i class="bi bi-clipboard-data-fill fs-4"></i>
            </div>
            <div>
                <h5 class="mb-0 fw-semibold text-dark">Total de Accidentes</h5>
                <span class="fs-4 fw-bold text-primary">{{ $accidents->count() }}</span>
            </div>
        </div>
        <div class="col-md-6 text-md-end d-flex justify-content-start justify-content-md-end gap-2">
            <a href="{{ route('sstsena.funcionario.accidents.create') }}" class="btn btn-success btn-lg fw-semibold shadow-sm">
                <i class="bi bi-file-earmark-plus-fill me-1"></i> Nuevo Accidente
            </a>
            <button class="btn btn-primary btn-lg fw-semibold shadow-sm" data-bs-toggle="modal" data-bs-target="#agregarPersonaModal">
                <i class="bi bi-person-fill-add me-1"></i> Personas Involucradas
            </button>
        </div>
    </div>
</div>

<!-- Modal Personas Involucradas -->
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
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container mt-5">
    <!-- Aquí continúa tu tabla con lógica y rutas respetadas -->
    <!-- La tabla que mostraste ya está muy bien, si deseas puedo integrarla aquí con estilo mejorado -->
</div>
@endsection
