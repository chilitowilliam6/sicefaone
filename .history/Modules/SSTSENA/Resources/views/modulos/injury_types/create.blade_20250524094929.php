@extends('sstsena::layouts.master')

@section('content')
<div class="container mt-5">
    <div class="card bg-dark text-white shadow rounded-4">
        <div class="card-header bg-primary text-center">
            <h3>Crear Tipo de Lesión</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('sstsena.admin.injury_types.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="name" class="form-control bg-dark text-white border-secondary" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Descripción</label>
                    <textarea name="description" rows="4" class="form-control bg-dark text-white border-secondary" required></textarea>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="{{ route('sstsena.admin.injury_types.index') }}" class="btn btn-outline-light">Cancelar</a>
                    <button type="submit" class="btn btn-success">Crear</button>
                    <button type="reset" class="btn btn-secondary">cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
