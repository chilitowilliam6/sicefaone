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