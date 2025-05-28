@extends('sstsena::layouts.master')
@section('content')

<div class="container mt-5">
  
    
    @if ($errors->any())
    <div class="alert alert-danger border-0 shadow-sm">
        <strong class="d-block mb-2">¡Ups! Algo salió mal.</strong>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('sstsena.funcionario.accidents.store') }}" method="POST" 
          class="bg-white p-5 rounded-lg shadow" enctype="multipart/form-data">
        @csrf
 <center> <h1 class="mb-4" style="color: #1a3c6e; font-weight: 600;">Crear Accidente</h1></center>
        <div class="mb-4">
            <label for="date_time" class="form-label" style="color: #34495e; font-weight: 500;">Fecha y Hora</label>
            <input type="datetime-local" name="date_time" id="date_time" 
                   class="form-control border-light-subtle" required>
        </div>

        <div class="mb-4">
            <label for="environment_id" class="form-label" style="color: #34495e; font-weight: 500;">Ubicación</label>
            <select name="environment_id" id="environment_id" class="form-select border-light-subtle" required>
                <option value="" disabled selected>Seleccione un entorno</option>
                @foreach($environmets as $environmet)
                    <option value="{{ $environmet->id }}">{{ $environmet->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="injury_type_id" class="form-label" style="color: #34495e; font-weight: 500;">Tipo de Lesión</label>
            <select name="injury_type_id" id="injury_type_id" class="form-select border-light-subtle" required>
                <option value="" disabled selected>Seleccione un tipo de lesión</option>
                @foreach($injuryTypes as $injuryType)
                    <option value="{{ $injuryType->id }}">{{ $injuryType->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="risk_type_id" class="form-label" style="color: #34495e; font-weight: 500;">Tipo de Riesgo</label>
            <select name="risk_type_id" id="risk_type_id" class="form-select border-light-subtle" required>
                <option value="" disabled selected>Seleccione un tipo de riesgo</option>
                @foreach($riskTypes as $riskType)
                    <option value="{{ $riskType->id }}">{{ $riskType->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="accident_type_id" class="form-label" style="color: #34495e; font-weight: 500;">Tipo de Accidente</label>
            <select name="accident_type_id" id="accident_type_id" class="form-select border-light-subtle" required>
                <option value="" disabled selected>Seleccione un tipo de accidente</option>
                @foreach($accidentTypes as $accidentType)
                    <option value="{{ $accidentType->id }}">{{ $accidentType->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="description" class="form-label" style="color: #34495e; font-weight: 500;">Descripción</label>
            <textarea name="description" id="description" class="form-control border-light-subtle" rows="4" required></textarea>
        </div>

        <div class="mb-4">
            <label for="evidence" class="form-label" style="color: #34495e; font-weight: 500;">Evidencia (Imagen)</label>
            <input type="file" name="evidence" id="evidence" class="form-control border-light-subtle" accept=".jpg,.jpeg,.png">
        </div>

        <div class="mb-4">
            <label for="severity" class="form-label" style="color: #34495e; font-weight: 500;">Severidad</label>
            <select name="severity" id="severity" class="form-select border-light-subtle" required>
                <option value="" disabled selected>Seleccione una severidad</option>
                <option value="minor">Menor</option>
                <option value="moderate">Moderada</option>
                <option value="serious">Seria</option>
                <option value="fatal">Fatal</option>
            </select>
        </div>

        <div class="d-flex justify-content-center gap-3 mt-4">
            <a href="{{ route('sstsena.funcionario.accidents.index') }}" 
               class="btn btn-outline-secondary px-4" style="border-color: #6c757d;">Cancelar</a>
            <button type="submit" class="btn btn-primary px-4" style="background-color: #1a3c6e; border-color: #1a3c6e;">Crear</button>
        </div>
    </form>
</div>
@endsection