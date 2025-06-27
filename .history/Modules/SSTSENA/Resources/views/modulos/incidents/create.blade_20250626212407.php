@extends('sstsena::layouts.master')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm rounded-3">
        <div class="card-header bg-light">
            <h1 class="text-center  fw-bold" style="color: #1a3c6e; font-weight: 600;">Registrar Incidente</h1>
        </div>
        <div class="card-body p-4">

            {{-- Mensajes de éxito o error general --}}
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @elseif(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <form action="{{ route('sstsena.funcionario.incidents.store') }}" method="POST" enctype="multipart/form-data" novalidate>
                @csrf

                <div class="mb-3">
                    <label for="date_time" class="form-label">Fecha y Hora <span class="text-danger">*</span></label>
                    <input 
                        type="datetime-local" 
                        name="date_time" 
                        id="date_time" 
                        class="form-control @error('date_time') is-invalid @enderror" 
                        value="{{ old('date_time') }}" 
                        required
                    >
                    @error('date_time')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="environment_id" class="form-label">Entorno <span class="text-danger">*</span></label>
                    <select 
                        name="environment_id" 
                        id="environment_id" 
                        class="form-select @error('environment_id') is-invalid @enderror" 
                        required
                    >
                        <option value="" disabled {{ old('environment_id') ? '' : 'selected' }}>Seleccione un entorno</option>
                        @foreach($environments as $env)
                            <option value="{{ $env->id }}" {{ old('environment_id') == $env->id ? 'selected' : '' }}>
                                {{ $env->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('environment_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="risk_type_id" class="form-label">Tipo de Riesgo <span class="text-danger">*</span></label>
                    <select 
                        name="risk_type_id" 
                        id="risk_type_id" 
                        class="form-select @error('risk_type_id') is-invalid @enderror" 
                        required
                    >
                        <option value="" disabled {{ old('risk_type_id') ? '' : 'selected' }}>Seleccione un tipo de riesgo</option>
                        @foreach($riskTypes as $risk)
                            <option value="{{ $risk->id }}" {{ old('risk_type_id') == $risk->id ? 'selected' : '' }}>
                                {{ $risk->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('risk_type_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="incident_type_id" class="form-label">Tipo de Incidente <span class="text-danger">*</span></label>
                    <select 
                        name="incident_type_id" 
                        id="incident_type_id" 
                        class="form-select @error('incident_type_id') is-invalid @enderror" 
                        required
                    >
                        <option value="" disabled {{ old('incident_type_id') ? '' : 'selected' }}>Seleccione un tipo de incidente</option>
                        @foreach($incidentTypes as $type)
                            <option value="{{ $type->id }}" {{ old('incident_type_id') == $type->id ? 'selected' : '' }}>
                                {{ $type->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('incident_type_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Descripción</label>
                    <textarea 
                        name="description" 
                        id="description" 
                        class="form-control @error('description') is-invalid @enderror" 
                        rows="4"
                    >{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="evidence" class="form-label">Evidencia</label>
                    <input 
                        type="file" 
                        name="evidence" 
                        id="evidence" 
                        class="form-control @error('evidence') is-invalid @enderror"
                        accept="image/*,application/pdf"
                    >
                    @error('evidence')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="severity" class="form-label">Severidad <span class="text-danger">*</span></label>
                    <select 
                        name="severity" 
                        id="severity" 
                        class="form-select @error('severity') is-invalid @enderror" 
                        required
                    >
                        <option value="" disabled {{ old('severity') ? '' : 'selected' }}>Seleccione severidad</option>
                        <option value="minor" {{ old('severity') == 'minor' ? 'selected' : '' }}>Leve</option>
                        <option value="moderate" {{ old('severity') == 'moderate' ? 'selected' : '' }}>Moderada</option>
                        <option value="serious" {{ old('severity') == 'serious' ? 'selected' : '' }}>Grave</option>
                        <option value="fatal" {{ old('severity') == 'fatal' ? 'selected' : '' }}>Fatal</option>
                    </select>
                    @error('severity')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="text-end">
                    <a href="{{ route('sstsena.funcionario.incidents.index') }}" class="btn btn-outline-secondary me-2">Cancelar</a>
                    <button type="submit" class="btn b"  style="color: #1a3c6e; font-weight: 600;">Registrar</button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
