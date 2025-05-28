@extends('sstsena::layouts.master')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-4" style="background-color: #f8f9fa; color: #333;">
        <div class="card-header bg-primary text-white text-center py-3">
            <h3 class="mb-0 fw-bold">Crear Tipo de Accidente</h3>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('sstsena.admin.accident_types.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name" class="form-label fw-medium text-dark">Nombre</label>
                    <input type="text" class="form-control border-dark-subtle" id="name" name="name" required style="background-color: #fff; color: #333;">
                </div>
                <div class="mb-4">
                    <label for="description" class="form-label fw-medium text-dark">Descripción</label>
                    <textarea class="form-control border-dark-subtle" id="description" name="description" rows="4" required style="background-color: #fff; color: #333;"></textarea>
                </div>
                <div class="d-grid gap-3">
                    <button type="submit" class="btn btn-primary btn-lg fw-medium">Crear</button>
                    <a href="{{ route('sstsena.admin.accident_types.index') }}" class="btn btn-outline-secondary btn-lg fw-medium">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection