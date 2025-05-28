@extends ('sstsena::layouts.master')
@section('content')
<div class="container mt-5">
    <h2>Crear Tipo de Persona</h2>
    <form action="{{ route('sstsena.funcionario.person_types.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nombre del Tipo de Persona</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>