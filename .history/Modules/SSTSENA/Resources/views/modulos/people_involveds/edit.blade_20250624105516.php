@extends('sstsena::layouts.master')
@section('content')
<div class="container mt-5">
    <div class="card shadow-sm rounded-3" style="background-color: #ffffff;">
        <div class="card-header" style="background-color: #f8f9fa; border-bottom: 1px solid #dee2e6;">
            <h3 class="text-center" style="color: #1a3c6e; font-weight: 600;">Editar Persona Involucrada</h3>
        </div>
        <div class="card-body p-4">
             @if(checkRol('sstsena.funcionario'))
           <form action="{{ route('sstsena.funcionario.people_involved.update', $peopleInvolved->id) }}" method="POST">
          @elseif(checkRol('sstsena.admin'))
           <form action="{{ route('sstsena..people_involved.update', $peopleInvolved->id) }}" method="POST">
            @endif
            
                @csrf
                @method('PUT')

                {{-- Nombre --}}
                <div class="mb-4">
                    <label for="name" class="form-label" style="color: #34495e; font-weight: 500;">Nombre</label>
                    <input type="text" name="name" id="name" class="form-control border-light-subtle" value="{{ $peopleInvolved->name }}" required>
                </div>

                {{-- Apellido --}}
                <div class="mb-4">
                    <label for="last_name" class="form-label" style="color: #34495e; font-weight: 500;">Apellido</label>
                    <input type="text" name="last_name" id="last_name" class="form-control border-light-subtle" value="{{ $peopleInvolved->last_name }}" required>
                </div>

                {{-- Tipo de Documento --}}
                <div class="mb-4">
                    <label for="document_type" class="form-label" style="color: #34495e; font-weight: 500;">Tipo de Documento</label>
                    <select name="document_type" id="document_type" class="form-control border-light-subtle" required>
                        <option value="CC" {{ $peopleInvolved->document_type == 'CC' ? 'selected' : '' }}>Cédula de Ciudadanía</option>
                        <option value="TI" {{ $peopleInvolved->document_type == 'TI' ? 'selected' : '' }}>Tarjeta de Identidad</option>
                        <option value="CE" {{ $peopleInvolved->document_type == 'CE' ? 'selected' : '' }}>Cédula de Extranjería</option>
                        <option value="PAS" {{ $peopleInvolved->document_type == 'PAS' ? 'selected' : '' }}>Pasaporte</option>
                        <option value="OTRO" {{ $peopleInvolved->document_type == 'OTRO' ? 'selected' : '' }}>Otro</option>
                    </select>
                </div>

                {{-- Número de Documento --}}
                <div class="mb-4">
                    <label for="document_number" class="form-label" style="color: #34495e; font-weight: 500;">Número de Documento</label>
                    <input type="text" name="document_number" id="document_number" class="form-control border-light-subtle" value="{{ $peopleInvolved->document_number }}" required>
                </div>

                {{-- Fecha de Nacimiento --}}
                <div class="mb-4">
                    <label for="birth_date" class="form-label" style="color: #34495e; font-weight: 500;">Fecha de Nacimiento</label>
                    <input type="date" name="birth_date" id="birth_date" class="form-control border-light-subtle" value="{{ $peopleInvolved->birth_date }}" required>
                </div>

                {{-- Género --}}
                <div class="mb-4">
                    <label for="gender" class="form-label" style="color: #34495e; font-weight: 500;">Género</label>
                    <select name="gender" id="gender" class="form-control border-light-subtle" required>
                        <option value="">Selecciona una opción</option>
                        <option value="Masculino" {{ $peopleInvolved->gender == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                        <option value="Femenino" {{ $peopleInvolved->gender == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                        <option value="Otro" {{ $peopleInvolved->gender == 'Otro' ? 'selected' : '' }}>Otro</option>
                    </select>
                </div>

                {{-- Tipo de Persona (Relación con person_types) --}}
                <div class="mb-4">
                    <label for="person_type_id" class="form-label" style="color: #34495e; font-weight: 500;">Tipo de Persona</label>
                    <select name="person_type_id" id="person_type_id" class="form-control border-light-subtle" required>
                        <option value="">Seleccione una opción</option>
                        @foreach ($typePersons as $type)
                            <option value="{{ $type->id }}" {{ $peopleInvolved->person_type_id == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Teléfono --}}
                <div class="mb-4">
                    <label for="phone" class="form-label" style="color: #34495e; font-weight: 500;">Teléfono</label>
                    <input type="text" name="phone" id="phone" class="form-control border-light-subtle" value="{{ $peopleInvolved->phone }}">
                </div>

                {{-- Dirección --}}
                <div class="mb-4">
                    <label for="address" class="form-label" style="color: #34495e; font-weight: 500;">Dirección</label>
                    <input type="text" name="address" id="address" class="form-control border-light-subtle" value="{{ $peopleInvolved->address }}">
                </div>

                {{-- Relación con Accidente --}}
                <div class="mb-4">
                    <label for="accident_id" class="form-label" style="color: #34495e; font-weight: 500;">Accidente Asociado</label>
                    <select name="accident_id" id="accident_id" class="form-control border-light-subtle" required>
                        <option value="">Seleccione un accidente</option>
                        @foreach ($accident as $accident)
                            <option value="{{ $accident->id }}" {{ $peopleInvolved->accident_id == $accident->id ? 'selected' : '' }}>
                                {{ $accident->id . ' - ' . $accident->description }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('sstsena.funcionario.people_involved.index') }}" 
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