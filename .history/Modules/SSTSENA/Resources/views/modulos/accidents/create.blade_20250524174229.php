@extends('sstsena::layouts.master')
@section('content')
<div class="container mt-4">
    <h1 class="text-white mb-4">Crear Accidente</h1>

    <form action="{{ route('sstsena.admin.accidents.store') }}" method="POST" class="bg-dark text-white p-4 rounded shadow">
        @csrf

        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea name="description" id="description" class="form-control" rows="4" required></textarea>
        </div>

        <div class="mb-3">
            <label for="date" class="form-label">Fecha</label>
            <input type="date" name="date" id="date" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="location" class="form-label">Ubicación</label>
            <input type="text" name="location" id="location" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="injury_type_id" class="form-label">Tipo de Lesión</label>
            <select name="injury_type_id" id="injury_type_id" class="form-control" required>
                <option value="">Seleccione un tipo de lesión</option>
                @foreach ($injuryTypes as $injuryType)
                    <option value="{{ $injuryType->id }}">{{ $injuryType->name }}</option>
                @endforeach