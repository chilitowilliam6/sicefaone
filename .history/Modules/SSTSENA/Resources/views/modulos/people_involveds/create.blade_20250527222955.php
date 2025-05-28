@extends('sstsena.lacyouts.master')
@section('content')
 $table->id();
//            $table->enum('document_type', ['CC', 'TI', 'CE', 'PAS','OTRO']);
//            $table->string('document_number');
//            $table->string('name');
//            $table->string('last_name');
//            $table->date('birth_date');
//            $table->string('gender');
//            $table->foreignId('person_type_id')->constrained('person_types')->onDelete('cascade');
//            $table->string('phone')->nullable();
//            $table->string('address')->nullable();
//            $table->foreignId('accident_id')->constrained('accidents')->onDelete('cascade');
//            $table->timestamps();

<div class="container mt-5">
    <div class="card shadow-sm rounded-3" style="background-color: #ffffff;">
        <div class="card-header" style="background-color: #f8f9fa; border-bottom: 1px solid #dee2e6;">
            <h3 class="text-center" style="color: #1a3c6e; font-weight: 600;">Crear Persona Involucrada</h3>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('sstsena.admin.people_involveds.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="document_type" class="form-label" style="color: #34495e; font-weight: 500;">Tipo de Documento</label>
                    <select name="document_type" id="document_type" class="form-control border-light-subtle" required>
                        <option value="CC">Cédula de Ciudadanía</option>
                        <option value="TI">Tarjeta de Identidad</option>
                        <option value="CE">Cédula de Extranjería</option>
                        <option value="PAS">Pasaporte</option>
                        <option value="OTRO">Otro</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="document_number" class="form-label" style="color: #34495e; font-weight: 500;">Número de Documento</label>
                    <input type="text" name="document_number" id="document_number" class="form-control border-light-subtle" required>
                </div>
                <div class="mb-4">
                    <label for="name" class="form-label" style="color: #34495e; font-weight: 500;">Nombre</label>
                    <input type="text" name="name" id="name" class="form-control border-light-subtle" required>
                </div>
                <div class="mb-4">
                    <label for="last_name" class="form-label" style="color: #34495e; font-weight: 500;">Apellido</label>
                    <input type="text" name="last_name" id="last_name" class="form-control border-light-subtle" required>
                </div>
                <div class="mb-4">
                    <label for="birth_date" class="form-label" style="color: #34495e; font-weight: 500;">Fecha de Nacimiento</label>
                    <input type="date" name="birth_date" id="birth_date" class="form-control border-light-subtle" required>
                </div>
                //            $table->date('birth_date');
                <div class="mb-4">
                    <label for="
              
@endsection

