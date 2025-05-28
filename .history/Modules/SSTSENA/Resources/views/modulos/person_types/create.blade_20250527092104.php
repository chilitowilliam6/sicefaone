@extends ('sstsena::layouts.master')
@section('content')
<div class="container mt-5">
    <h2>Crear Tipo de Persona</h2>
    <form action="{{ route('sstsena.admin.person_types.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nombre del Tipo de Persona</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>