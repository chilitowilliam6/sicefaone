@extends('sstsena::layouts.master')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm rounded-3" style="background-color: #ffffff;">
        <div class="card-header" style="background-color: #f8f9fa; border-bottom: 1px solid #dee2e6;">
            <h3 class="text-center" style="color: #1a3c6e; font-weight: 600;">Crear Tipo de Lesión</h3>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('sstsena.admin.injury_types.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="form-label" style="color: #34495e; font-weight: 500;">Nombre</label>
                    <input type="text" name="name" class="form-control border-light-subtle" required>
                </div>
                <div class="mb-4">
                    <label class="form-label" style="color: #34495e; font-weight: 500;">Descripción</label>
                    <textarea name="description" rows="4" class="form-control border-light-subtle" required></textarea>
                </div>
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('sstsena.admin.injury_types.index') }}" 
                       class="btn btn-outline-secondary px-4" 
                       style="border-color: #6c757d;">Cancelar</a>
                    <button type="submit" class="btn btn-primary px-4" 
                            style="background-color: #1a3c6e; border-color: #1a3c6e;">Crear</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection