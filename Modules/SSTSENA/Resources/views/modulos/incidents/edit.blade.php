@extends('sstsena::layouts.master')
@section('content')
<div class="container mt-5">
    <div class="card shadow-sm rounded-3">
        <div class="card-header bg-light">
            <h3 class="text-center text-primary fw-bold">Editar Incidente</h3>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('sstsena.funcionario.incidents.update', $incident->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="date_time" class="form-label">Fecha y Hora</label>
                    <input type="datetime-local" name="date_time" id="date_time" class="form-control" value="{{ $incident->date_time }}" required>
                </div>
                <div class="mb-3">
                    <label for="environment_id" class="form-label">Entorno</label>
                    <select name="environment_id" id="environment_id" class="form-select" required>
                        @foreach($environments as $env)
                        <option value="{{ $env->id }}" {{ $incident->environment_id == $env->id ? 'selected' : '' }}>{{ $env->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="risk_type_id" class="form-label">Tipo de Riesgo</label>
                    <select name="risk_type_id" id="risk_type_id" class="form-select" required>
                        @foreach($riskTypes as $risk)
                        <option value="{{ $risk->id }}" {{ $incident->risk_type_id == $risk->id ? 'selected' : '' }}>{{ $risk->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="incident_type_id" class="form-label">Tipo de Incidente</label>
                    <select name="incident_type_id" id="incident_type_id" class="form-select" required>
                        @foreach($incidentTypes as $type)
                        <option value="{{ $type->id }}" {{ $incident->incident_type_id == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Descripción</label>
                    <textarea name="description" id="description" class="form-control" rows="4">{{ $incident->description }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="evidence" class="form-label">Evidencia</label>
                    <input type="file" name="evidence" id="evidence" class="form-control">

                    @if ($incident->evidence)
                    <div class="mt-3">
                        <label class="form-label">Vista previa actual:</label>
                        <div class="border p-2 rounded" style="max-width: 200px;">
                            <!-- Botón que abre el modal -->
                            <a href="#" data-bs-toggle="modal" data-bs-target="#evidenceModal">
                                <img src="{{ asset('storage/evidences/' . $incident->evidence) }}"
                                    alt="Evidencia actual"
                                    class="img-fluid rounded"
                                    style="max-height: 150px; object-fit: cover;">
                            </a>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="evidenceModal" tabindex="-1" aria-labelledby="evidenceModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <br>
                                <div class="modal-header">
                                    <h5 class="modal-title" id="evidenceModalLabel">Evidencia</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                </div>
                                <div class="modal-body text-center">
                                    <img src="{{ asset('storage/evidences/' . $incident->evidence) }}"
                                        alt="Evidencia actual"
                                        class="img-fluid rounded"
                                        style="max-height: 600px; object-fit: contain;">
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>


                <div class="mb-3">
                    <label for="severity" class="form-label">Severidad</label>
                    <select name="severity" id="severity" class="form-select" required>
                        <option value="minor" {{ $incident->severity == 'minor' ? 'selected' : '' }}>Leve</option>
                        <option value="moderate" {{ $incident->severity == 'moderate' ? 'selected' : '' }}>Moderada</option>
                        <option value="serious" {{ $incident->severity == 'serious' ? 'selected' : '' }}>Grave</option>
                        <option value="fatal" {{ $incident->severity == 'fatal' ? 'selected' : '' }}>Fatal</option>
                    </select>
                </div>
                <div class="text-end">
                    <a href="{{ route('sstsena.funcionario.incidents.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection