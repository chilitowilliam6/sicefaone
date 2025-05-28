@extends('sstsena::layouts.master')
@section('content')

<div class="container mt-4">
    <h1 class="text-white mb-4">Editar Tipo de Riesgo</h1>

    <form action="{{ route('sstsena.admin.risk_types.update', $riskType->id) }}" method="POST" class="bg-dark text-white p-4 rounded shadow">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $riskType->name }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea name="description" id="description" class="form-control" rows="4" required>{{ $riskType->description }}</textarea>
        </div>

        <div class="d-flex justify-content-center gap-3 mt-4">
            <a href="{{ route('sstsena.admin.risk_types.index') }}" class="btn btn-outline-light">Cancelar</a>
            <button type="submit" class="btn btn-success">Actualizar</button>
        </div>
    </form>
</div>

@endsection
