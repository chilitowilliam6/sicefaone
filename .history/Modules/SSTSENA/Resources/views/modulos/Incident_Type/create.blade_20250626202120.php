@extends('sstsena::layouts.master')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm rounded-3" style="background-color: #ffffff;">
        <div class="card-header" style="background-color: #f8f9fa; border-block-end: 1px solid #dee2e6;">
            <h3 class="text-center" style="color: #1a3c6e; font-weight: 600;">Registrar Tipo de Incidentes</h3>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('sstsena.admin.incident_types.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name" class="form-label" style="color: #34495e; font-weight: 500;">Nombre</label>
                    <input type="text" class="form-control border-light-subtle" id="name" name="name" required>
                </div>
                <div class="mb-4">
                    <label for="description" class="form-label" style="color: #34495e; font-weight: 500;">Descripción</label>
                    <textarea class="form-control border-light-subtle" id="description" name="description" rows="4" required></textarea>
                </div>
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('sstsena.admin.incident_types.index') }}" 
                    class="btn btn-outline-secondary px-4" 
                    style="border-color: #6c757d;">Cancelar</a>
                    <button type="submit" class="btn btn-primary px-4" 
                            style="background-color: #1a3c6e; border-color: #1a3c6e;">Registrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection