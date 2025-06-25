@extends('sstsena::layouts.master')

@section('content')
<div class="container mt-5">
    <!-- Display success message if present -->
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert" style="background-color: #d4edda; border-color: #c3e6cb; color: #155724;">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card shadow-sm rounded-3" style="background-color: #ffffff;">
        <div class="card-header" style="background-color: #f8f9fa; border-bottom: 1px solid #dee2e6;">
            <h3 class="text-center" style="color: #1a3c6e; font-weight: 600;">Editar Accidente</h3>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('sstsena.funcionario.emergencies.update', $emergency->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="date_time" class="form-label" style="color: #34495e; font-weight: 500;">Fecha y Hora</label>
                    <input type="datetime-local" name="date_time" id="date_time" class="form-control border-light-subtle" value="{{ $emergency->date_time }}" required>
                </div>
                <div class="mb-4">
                    <label for="environment_id" class="form-label" style="color: #34495e; font-weight: 500;">Entorno</label>
                    <select name="environment_id" id="environment_id" class="form-select border-light-subtle" required>
                        @foreach($environments as $environment)
                        <option value="{{ $environment->id }}" {{ $emergency->environment_id == $environment->id ? 'selected' : '' }}>
                            {{ $environment->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="injury_type_id" class="form-label" style="color: #34495e; font-weight: 500;">Tipo de Lesión</label>
                    <select name="injury_type_id" id="injury_type_id" class="form-select border-light-subtle" required>
                        @foreach($injuryTypes as $injuryType)
                        <option value="{{ $injuryType->id }}" {{ $emergency->injury_type_id == $injuryType->id ? 'selected' : '' }}>
                            {{ $injuryType->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="risk_type_id" class="form-label" style="color: #34495e; font-weight: 500;">Tipo de Riesgo</label>
                    <select name="risk_type_id" id="risk_type_id" class="form-select border-light-subtle" required>
                        @foreach($riskTypes as $riskType)
                        <option

                            value="{{ $riskType->id }}" {{ $emergency->risk_type_id == $riskType->id ? 'selected' : '' }}>
                            {{ $riskType->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="emergency_types_id" class="form-label" style="color: #34495e; font-weight: 500;">Tipo de Emergencia</label>
                    <select name="emergency_types_id" id="emergency_types_id" class="form-select border-light-subtle" required>
                        @foreach($emergencyTypes as $emergencyType)
                        <option value="{{ $emergencyType->id }}" {{ $emergency->emergency_type_id == $emergencyType->id ? 'selected' : '' }}>
                            {{ $emergencyType->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="description" class="form-label" style="color: #34495e; font-weight: 500;">Descripción</label>
                    <textarea name="description" id="description" class="form-control border-light-subtle" rows="4">{{ $emergency->description }}</textarea>
                </div>
                <div class="mb-3">
    <label for="evidence" class="form-label">Evidencia</label>
    <input type="file" name="evidence" id="evidence" class="form-control">

    @if ($emergency->evidence)
        <div class="mt-3">
            <label class="form-label">Vista previa actual:</label>
            <div class="border p-2 rounded" style="max-width: 200px;">
                <!-- Botón que abre el modal -->
                <a href="#" data-bs-toggle="modal" data-bs-target="#evidenceModal">
                    <img src="{{ asset('storage/evidences/' . $emergency->evidence) }}"
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
                    <div class="modal-header">
                        <h5 class="modal-title" id="evidenceModalLabel">Evidencia</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body text-center">
                        <img src="{{ asset('storage/evidences/' . $emergency->evidence) }}"
                            alt="Evidencia actual"
                            class="img-fluid rounded"
                            style="max-block-size: 600px; object-fit: contain;">
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

                <div class="mb-4">
                    <label for="severity" class="form-label" style="color: #34495e; font-weight: 500;">Severidad</label>
                    <select name="severity" id="severity" class="form-select border-light-subtle" required>
                        <option value="minor" {{ $emergency->severity == 'minor' ? 'selected' : '' }}>Leve</option>
                        <option value="moderate" {{ $emergency->severity == 'moderate' ? 'selected' : '' }}>Moderada</option>
                        <option value="serious" {{ $emergency->severity == 'serious' ? 'selected' : '' }}>Grave</option>
                        <option value="fatal" {{ $emergency->severity == 'fatal' ? 'selected' : '' }}>Fatal</option>
                    </select>
                </div>
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('sstsena.funcionario.emergencies.index') }}"
                        class="btn btn-outline-secondary px-4"
                        style="border-color: #6c757d;">Cancelar</a>
                    <button type="submit" class="btn btn-primary px-4"
                        style="background-color: #1a3c6e; border-color: #1a3c6e;">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection