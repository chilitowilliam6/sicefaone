@extends('sstsena::layouts.master')
@section('content')

<div class="container mt-4">
    <h1 class="text-white">Crear Tipo de Riesgo</h1>

    <form action="{{ route('sstsena.admin.risk_types.store') }}" method="POST" class="bg-dark text-white p-4 rounded shadow">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea name="description" id="description" class="form-control" rows="4" required></textarea>
        </div>

        <div class="d-flex justify-content-center gap-3 mt-4">
            <a href="{{ route('sstsena.admin.risk_types.index') }}" class="btn btn-outline-light">Cancelar</a>
            <button type="submit" class="btn btn-success">Crear</button>
        </div>
    </form>
</div>

@endsection

