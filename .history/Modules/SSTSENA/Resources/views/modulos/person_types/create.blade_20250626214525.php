@extends ('sstsena::layouts.master')
@section('content')
<div class="container mt-5">
    <h2>Registrar Tipo de Persona</h2>
    <form action="{{route('sstsena.admin.TypePerson.store')}}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nombre del Tipo de Persona</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <a href="{{ route('sstsena.admin.injury_types.index') }}" 
                       class="btn btn-outline-secondary px-4" 
                       style="border-color: #6c757d;">Cancelar</a>
                    <button type="submit" class="btn btn-primary px-4" 
                            style="background-color: #1a3c6e; border-color: #1a3c6e;">Registrar</button>
      
    </form>

    </div>
    @endsection