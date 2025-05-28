@extends('sstsena::layouts.master')
@section('content')

<div class="container mt-5">
   

    <form action="{{ route('sstsena.admin.injury_types.update', $injuryType->id) }}" 
          method="POST" 
          class="bg-white p-5 rounded-lg shadow-sm">
        @csrf
        @method('PUT')
 <h1 class="mb-4" style="color: #1a3c6e; font-weight: 600;">Editar Tipo de Lesión</h1>
        <div class="mb-4">
            <label for="name" class="form-label" style="color: #34495e; font-weight: 500;">Nombre</label>
            <input type="text" 
                   name="name" 
                   id="name" 
                   class="form-control border-light-subtle" 
                   value="{{ $injuryType->name }}" 
                   required>
        </div>

        <div class="mb-4">
            <label for="description" class="form-label" style="color: #34495e; font-weight: 500;">Descripción</label>
            <textarea name="description" 
                      id="description" 
                      class="form-control border-light-subtle" 
                      rows="4" 
                      required>{{ $injuryType->description }}</textarea>
        </div>

        <div class="d-flex justify-content-center gap-3 mt-4">
            <a href="{{ route('sstsena.admin.injury_types.index') }}" 
               class="btn btn-outline-secondary px-4" 
               style="border-color: #6c757d;">Cancelar</a>
            <button type="submit" 
                     class="btn btn-primary px-4" 
                     style="background-color: #1a3c6e; border-color: #1a3c6e;">Actualizar</button>
        </div>
    </form>
</div>

@endsection