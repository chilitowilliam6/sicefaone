@extends('sstsena::layouts.master')
@section('content')
<div class="container mt-4">
    <h1 class="text-white mb-4">Crear Accidente</h1>

    <form action="{{ route('sstsena.funcionario.accidents.store') }}" method="POST" class="bg-dark text-white p-4 rounded shadow">
        @csrf
       //  $table->dateTime('date_time');
       // 
       //     // Foreign key relationships (as shown in the image)
       //     $table->foreignId('environment_id')->constrained('environments')->onDelete('cascade');
       //     $table->foreignId('injury_type_id')->constrained('injury_types')->onDelete('cascade');
       //     $table->foreignId('risk_type_id')->constrained('risk_types')->onDelete('cascade');
       //     $table->foreignId('accident_type_id')->constrained('accident_types')->onDelete('cascade');
       // 
       //     // Text fields
       //     $table->text('description')->nullable();
       //     $table->text('evidence')->nullable();
       // 
       //     // Enum for severity
       //     $table->enum('severity', ['minor', 'moderate', 'serious', 'fatal']);
       //     $table->string('created_by')->nullable();
       //     @endsection

        <div class="mb-3">
            <label for="date_time" class="form-label">Fecha y Hora</label>
            <input type="datetime-local" name="date_time" id="date_time" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="environment_id" class="form-label">Entorno</label>
            <select name="environment_id" id="environment_id" class="form-select" required>
                <option value="" disabled selected>Seleccione un entorno</option>
                @foreach($environments as $environment)
                    <option value="{{ $environment->id }}">{{ $environment->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="injury_type_id" class="form-label">Tipo de Lesión</label>
            <select name="injury_type_id" id="injury_type_id" class="form-select" required>
                <option value="" disabled selected>Seleccione un tipo de lesión</option>
                @foreach($injuryTypes as $injuryType)
                    <option value="{{ $injuryType->id }}">{{ $injuryType->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="risk_type_id" class="form-label">Tipo de Riesgo</label>
            <select name="risk_type_id" id="risk_type_id" class="form-select" required>
                <option value="" disabled selected>Seleccione un tipo de riesgo</option>
                @foreach($riskTypes as $riskType)
                    <option value="{{ $riskType->id }}">{{ $riskType->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="accident_type_id" class="form-label">Tipo de Accidente</label>
            <select name="accident_type_id" id="accident_type_id" class="form-select" required>
                <option value="" disabled selected>Seleccione un tipo de accidente</option>
                @foreach($accidentTypes as $accidentType)
                    <option value="{{ $accidentType->id }}">{{ $accidentType->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea name="description" id="description" class="form-control" rows="4" required></textarea>
        </div>
        <div class="mb-3">
            <label for="evidence" class="form-label">Evidencia</label>
            <textarea name="evidence" id="evidence" class="form-control" rows="4"></textarea>
        </div>
        <div class="mb-3">
            <label for="severity" class="form-label">Severidad</label>
            <select name="severity" id="severity" class="form-select" required>
                <option value="" disabled selected>Seleccione una severidad</option>
                <option value="minor">Menor</option>
                <option value="moderate">Moderada</option>
                <option value="serious">Seria</option>
                <option value="fatal">Fatal</option>
            </select>
        </div>
        <div class="d-flex justify-content-center gap-3 mt-4">
            <a href="{{ route('sstsena.funcionario.accidents.index') }}" class="btn btn-outline-light">Cancelar</a>
            <button type="submit" class="btn btn-success">Crear</button>
            </div>