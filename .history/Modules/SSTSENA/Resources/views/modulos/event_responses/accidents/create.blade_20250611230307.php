@extends('sstsena::layouts.master')

@section('content')
<div class="container mt-5">
    <h1>Agregar Respuesta a Accidente #{{ $event->id }}</h1>

    <form action="{{ route('sstsena.accidents.responses.store', $event->id) }}" method="POST">
        @csrf

        {{-- Campo de respuesta --}}
        <div class="mb-3">
            <label for="response" class="form-label">Respuesta</label>
            <textarea class="form-control @error('response') is-invalid @enderror" id="response" name="response" rows="5">{{ old('response') }}</textarea>
            @error('response')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Campo de acciones tomadas --}}
        <div class="mb-3">
            <label for="actions_taken" class="form-label">Acciones Tomadas </label>
            <textarea class="form-control @error('actions_taken') is-invalid @enderror" id="actions_taken" name="actions_taken" rows="4">{{ old('actions_taken') }}</textarea>
            @error('actions_taken')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Campo de severidad --}}
        <div class="mb-3">
            <label for="severity" class="form-label">Gravedad</label>
            <select class="form-select @error('severity') is-invalid @enderror" name="severity" id="severity" required>
                <option value="">Seleccione una opción</option>
                <option value="minor" {{ old('severity') == 'minor' ? 'selected' : '' }}>Leve</option>
                <option value="moderate" {{ old('severity') == 'moderate' ? 'selected' : '' }}>Moderada</option>
                <option value="serious" {{ old('severity') == 'serious' ? 'selected' : '' }}>Grave</option>
                <option value="fatal" {{ old('severity') == 'fatal' ? 'selected' : '' }}>Fatal</option>
            </select>
            @error('severity')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Campo de estado --}}
        <div class="mb-3">
            <label for="status" class="form-label">Estado</label>
            <select class="form-select @error('status') is-invalid @enderror" name="status" id="status" required>
                <option value="investigation" {{ old('status') == 'investigation' ? 'selected' : '' }}>En investigación</option>
                <option value="finalized" {{ old('status') == 'finalized' ? 'selected' : '' }}>Finalizado</option>
            </select>
            @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Campo de fecha de respuesta --}}
        <div class="mb-3">
            <label for="response_date" class="form-label">Fecha de Respuesta</label>
            <input type="datetime-local" class="form-control @error('response_date') is-invalid @enderror" name="response_date" id="response_date" value="{{ old('response_date', now()->format('Y-m-d\TH:i')) }}" required>
            @error('response_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Botones --}}
        <button type="submit" class="btn btn-primary">Enviar</button>
        <a href="{{ route('sstsena.accidents.responses.index', $event->id) }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
