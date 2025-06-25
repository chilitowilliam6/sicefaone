@extends('sstsena::layouts.master')

@section('content')
<div class="container mt-5">
    <h1>Agregar Nuevo Incidente</h1>

   <form action="{{ route('sstsena.incidents.responses.store', ['incidentId' => $incidents->id]) }}" method="POST">

        @csrf
        <div class="mb-3">
            <label for="date_time" class="form-label">Fecha y Hora</label>
            <input type="datetime-local" class="form-control @error('date_time') is-invalid @enderror" id="date_time" name="date_time" value="{{ old('date_time') }}">
            @error('date_time')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="created_by" class="form-label">Creado Por</label>
            <select class="form-control @error('created_by') is-invalid @enderror" id="created_by" name="created_by">
                <option value="">Seleccione un usuario</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ old('created_by') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                @endforeach
            </select>
            @error('created_by')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="environment_id" class="form-label">Ambiente</label>
            <select class="form-control @error('environment_id') is-invalid @enderror" id="environment_id" name="environment_id">
                <option value="">Seleccione un ambiente</option>
                @foreach ($environments as $environment)
                    <option value="{{ $environment->id }}" {{ old('environment_id') == $environment->id ? 'selected' : '' }}>{{ $environment->name }}</option>
                @endforeach
            </select>
            @error('environment_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="risk_type_id" class="form-label">Tipo de Riesgo</label>
            <select class="form-control @error('risk_type_id') is-invalid @enderror" id="risk_type_id" name="risk_type_id">
                <option value="">Seleccione un tipo de riesgo</option>
                @foreach ($riskTypes as $riskType)
                    <option value="{{ $riskType->id }}" {{ old('risk_type_id') == $riskType->id ? 'selected' : '' }}>{{ $riskType->name }}</option>
                @endforeach
            </select>
            @error('risk_type_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="incident_type_id" class="form-label">Tipo de Incidente</label>
            <select class="form-control @error('incident_type_id') is-invalid @enderror" id="incident_type_id" name="incident_type_id">
                <option value="">Seleccione un tipo de incidente</option>
                @foreach ($incidentTypes as $incidentType)
                    <option value="{{ $incidentType->id }}" {{ old('incident_type_id') == $incidentType->id ? 'selected' : '' }}>{{ $incidentType->name }}</option>
                @endforeach
            </select>
            @error('incident_type_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5">{{ old('description') }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="evidence" class="form-label">Evidencia</label>
            <textarea class="form-control @error('evidence') is-invalid @enderror" id="evidence" name="evidence" rows="5">{{ old('evidence') }}</textarea>
            @error('evidence')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="severity" class="form-label">Severidad</label>
            <select class="form-control @error('severity') is-invalid @enderror" id="severity" name="severity">
                <option value="">Seleccione la severidad</option>
                <option value="minor" {{ old('severity') == 'minor' ? 'selected' : '' }}>Menor</option>
                <option value="moderate" {{ old('severity') == 'moderate' ? 'selected' : '' }}>Moderado</option>
                <option value="serious" {{ old('severity') == 'serious' ? 'selected' : '' }}>Grave</option>
                <option value="fatal" {{ old('severity') == 'fatal' ? 'selected' : '' }}>Fatal</option>
            </select>
            @error('severity')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('sstsena.incidents.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection