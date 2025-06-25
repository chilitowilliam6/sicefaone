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
            <h3 class="text-center" style="color: #1a3c6e; font-weight: 600;">Editar Acto Inseguro</h3>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('sstsena.funcionario.unsafe_acts.update', $unsafe_act->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="date_time" class="form-label" style="color: #34495e; font-weight: 500;">Fecha y Hora</label>
                    <input type="datetime-local" name="date_time" id="date_time" class="form-control border-light-subtle" value="{{ $unsafe_act->date_time }}" required>
                </div>
                <div class="mb-4">
                    <label for="environment_id" class="form-label" style="color: #34495e; font-weight: 500;">Entorno</label>
                    <select name="environment_id" id="environment_id" class="form-select border-light-subtle" required>
                        @foreach($environments as $environment)
                        <option value="{{ $environment->id }}" {{ $unsafe_act->environment_id == $environment->id ? 'selected' : '' }}>
                            {{ $environment->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="risk_type_id" class="form-label" style="color: #34495e; font-weight: 500;">Tipo de Riesgo</label>
                    <select name="risk_type_id" id="risk_type_id" class="form-select border-light-subtle" required>
                        @foreach($riskTypes as $riskType)
                        <option

                            value="{{ $riskType->id }}" {{ $unsafe_act->risk_type_id == $riskType->id ? 'selected' : '' }}>
                            {{ $riskType->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="unsafe_act_type_id" class="form-label" style="color: #34495e; font-weight: 500;">Tipo de Acto Inseguro</label>
                    <select name="unsafe_act_type_id" id="unsafe_act_type_id" class="form-select border-light-subtle" required>
                        @foreach($unsafeActTypes as $unsafeActType)
                        <option value="{{ $unsafeActType->id }}" {{ $unsafe_act->unsafe_act_type_id == $unsafeActType->id ? 'selected' : '' }}>
                            {{ $unsafeActType->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="description" class="form-label" style="color: #34495e; font-weight: 500;">Descripción</label>
                    <textarea name="description" id="description" class="form-control border-light-subtle" rows="4">{{ $unsafe_act->description }}</textarea>
                </div>
                <div class="mb-3">
    <label for="evidence" class="form-label">Evidencia</label>
    <input type="file" name="evidence" id="evidence" class="form-control">

    @if ($unsafe_act->evidence)
        <div class="mt-3">
            <label class="form-label">Vista previa actual:</label>
            <div class="border p-2 rounded" style="max-width: 200px;">
                <!-- Botón que abre el modal -->
                <a href="#" data-bs-toggle="modal" data-bs-target="#evidenceModal">
                    <img src="{{ asset('storage/' . $unsafe_act->evidence) }}"
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
                        <img src="{{ asset('storage/' . $unsafe_act->evidence) }}"
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
                    <label for="severity" class="form-label" style="color: #34495e; font-weight: 500;">Gravedad</label>
                    <select name="severity" id="severity" class="form-select border-light-subtle" required>
                        <option value="minor" {{ $unsafe_act->severity == 'minor' ? 'selected' : '' }}>Leve</option>
                        <option value="moderate" {{ $unsafe_act->severity == 'moderate' ? 'selected' : '' }}>Moderada</option>
                        <option value="serious" {{ $unsafe_act->severity == 'serious' ? 'selected' : '' }}>Grave</option>
                        <option value="fatal" {{ $unsafe_act->severity == 'fatal' ? 'selected' : '' }}>Fatal</option>
                    </select>
                </div>
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('sstsena.funcionario.unsafe_acts.index') }}"
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
