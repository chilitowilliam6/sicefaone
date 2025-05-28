
 // $table->dateTime('date_time');
 //       
 //           // Foreign key relationships (as shown in the image)
 //           $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
 //           $table->foreignId('environment_id')->constrained('environments')->onDelete('cascade');
 //           $table->foreignId('injury_type_id')->constrained('injury_types')->onDelete('cascade');
 //           $table->foreignId('risk_type_id')->constrained('risk_types')->onDelete('cascade');
 //           $table->foreignId('accident_type_id')->constrained('accident_types')->onDelete('cascade');
 //       
 //           // Text fields
 //           $table->text('description')->nullable();
 //           $table->text('evidence')->nullable();
 //       
 //           // Enum for severity
 //           $table->enum('severity', ['minor', 'moderate', 'serious', 'fatal']);


@extends ('sstsena::layouts.master')
@section('content')

<div class="container mt-5">
    <div class="card shadow-sm rounded-3" style="background-color: #ffffff;">
        <div class="card-header" style="background-color: #f8f9fa; border-bottom: 1px solid #dee2e6;">
            <h3 class="text-center" style="color: #1a3c6e; font-weight: 600;">Editar  Accidente</h3>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('sstsena.admin.accidents.update', $accident->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-4">
                    <label for="date_time" class="form-label" style="color: #34495e; font-weight: 500;">Fecha y Hora</label>
                    <input type="datetime-local" name="date_time" id="date_time" class="form-control border-light-subtle" value="{{ $accident->date_time }}" required>
                </div>

                <div class="mb-4">
                    <label for="environment_id" class="form-label" style="color: #34495e; font-weight: 500;">Entorno</label>
                    <select name="environment_id" id="environment_id" class="form-select border-light-subtle" required>
                        @foreach($environments as $environment)
                            <option value="{{ $environment->id }}" {{ $accident->environment_id == $environment->id ? 'selected' : '' }}>
                                {{ $environment->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="injury_type_id" class="form-label" style="color: #34495e; font-weight: 500;">Tipo de Lesión</label>
                    <select name="injury_type_id" id="injury_type_id" class="form-select border-light-subtle" required>
                        @foreach($injuryTypes as $injuryType)
                            <option value="{{ $injuryType->id }}" {{ $accident->injury_type_id == $injuryType->id ? 'selected' : '' }}>
                                {{ $injuryType->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="risk_type_id" class="form-label" style="color: #34495e; font-weight: 500;">Tipo de Riesgo</label>
                    <select name="risk_type_id" id="risk_type_id" class="form-select border-light-subtle" required>
                        @foreach($riskTypes as $riskType)
                            <option value="{{ $riskType->id }}" {{ $accident->risk_type_id == $riskType->id ? 'selected' : '' }}>
                                {{ $riskType->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="accident_type_id" class="form-label" style="color: #34495e; font-weight: 500;">Tipo de Accidente</label>
                    <select name="accident_type_id" id="accident_type_id" class="form-select border-light-subtle" required>
                        @foreach($accidentTypes as $accidentType)
                            <option value="{{ $accidentType->id }}" {{ $accident->accident_type_id == $accidentType->id ? 'selected' : '' }}>
                                {{ $accidentType->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="description" class="form-label" style="color: #34495e; font-weight: 500;">Descripción</label>
                    <textarea name="description" id="description" class="form-control border-light-subtle" rows="4">{{ $accident->description }}</textarea>
                </div>
                <div class="mb-4">
                    <label for="evidence" class="form-label" style="color: #34495e; font-weight: 500;">Evidencia</label>
                    <input type="file" name="evidence" id="evidence" class="form-control border-light-subtle">
                </div>