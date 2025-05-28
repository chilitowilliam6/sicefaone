@extends('sstsena.lacyouts.master')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm rounded-3" style="background-color: #ffffff;">
        <div class="card-header" style="background-color: #f8f9fa; border-bottom: 1px solid #dee2e6;">
            <h3 class="text-center" style="color: #1a3c6e; font-weight: 600;">Crear Persona Involucrada</h3>
        </div>
        <div class="card-body p-4">
            <form action="" method="POST">
                @csrf

                {{-- Tipo de Documento --}}
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

                {{-- Número de Documento --}}
                <div class="mb-4">
                    <label for="document_number" class="form-label" style="color: #34495e; font-weight: 500;">Número de Documento</label>
                    <input type="text" name="document_number" id="document_number" class="form-control border-light-subtle" required>
                </div>

                {{-- Nombre --}}
                <div class="mb-4">
                    <label for="name" class="form-label" style="color: #34495e; font-weight: 500;">Nombre</label>
                    <input type="text" name="name" id="name" class="form-control border-light-subtle" required>
                </div>

                {{-- Apellido --}}
                <div class="mb-4">
                    <label for="last_name" class="form-label" style="color: #34495e; font-weight: 500;">Apellido</label>
                    <input type="text" name="last_name" id="last_name" class="form-control border-light-subtle" required>
                </div>

                {{-- Fecha de Nacimiento --}}
                <div class="mb-4">
                    <label for="birth_date" class="form-label" style="color: #34495e; font-weight: 500;">Fecha de Nacimiento</label>
                    <input type="date" name="birth_date" id="birth_date" class="form-control border-light-subtle" required>
                </div>

                {{-- Género --}}
                <div class="mb-4">
                    <label for="gender" class="form-label" style="color: #34495e; font-weight: 500;">Género</label>
                    <select name="gender" id="gender" class="form-control border-light-subtle" required>
                        <option value="">Selecciona una opción</option>
                        <option value="Masculino">Masculino</option>
                        <option value="Femenino">Femenino</option>
                        <option value="Otro">Otro</option>
                    </select>
                </div>

                {{-- Tipo de Persona (Relación con person_types) --}}
                <div class="mb-4">
                    <label for="person_type_id" class="form-label" style="color: #34495e; font-weight: 500;">Tipo de Persona</label>
                    <select name="person_type_id" id="person_type_id" class="form-control border-light-subtle" required>
                        <option value="">Seleccione una opción</option>
                        @foreach ($typePersons as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Teléfono --}}
                <div class="mb-4">
                    <label for="phone" class="form-label" style="color: #34495e; font-weight: 500;">Teléfono</label>
                    <input type="text" name="phone" id="phone" class="form-control border-light-subtle">
                </div>

                {{-- Dirección --}}
                <div class="mb-4">
                    <label for="address" class="form-label" style="color: #34495e; font-weight: 500;">Dirección</label>
                    <input type="text" name="address" id="address" class="form-control border-light-subtle">
                </div>

                {{-- Relación con Accidente --}}
                <div class="mb-4">
                    <label for="accident_id" class="form-label" style="color: #34495e; font-weight: 500;">Accidente Asociado</label>
                    <select name="accident_id" id="accident_id" class="form-control border-light-subtle" required>
                        <option value="">Seleccione un accidente</option>
                        @foreach ($accidents as $accident)
                            <option value="{{ $accident->id }}">{{ $accident->title ?? 'Accidente #'.$accident->id }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Botón --}}
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary px-5">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
