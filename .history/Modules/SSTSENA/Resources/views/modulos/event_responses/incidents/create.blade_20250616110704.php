@extends('sstsena::layouts.master')

@section('content')
<div class="container mt-4">
    <div class="card shadow rounded">
        <div class="card-header text-center bg-white border-bottom">
            <h4 class="text-primary fw-bold">Agregar Respuesta a Incidente #{{ $event->id }}</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('sstsena.incidents.responses.store', $event->id) }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="response" class="form-label fw-semibold">Respuesta</label>
                    <textarea class="form-control @error('response') is-invalid @enderror" id="response" name="response" rows="4">{{ old('response') }}</textarea>
                    @error('response')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="actions_taken" class="form-label fw-semibold">Acciones Tomadas</label>
                    <textarea class="form-control @error('actions_taken') is-invalid @enderror" id="actions_taken" name="actions_taken" rows="4">{{ old('actions_taken') }}</textarea>
                    @error('actions_taken')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label fw-semibold">Estado</label>
                    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                        <option value="investigation" {{ old('status') == 'investigation' ? 'selected' : '' }}>Investigación</option>
                        <option value="finalized" {{ old('status') == 'finalized' ? 'selected' : '' }}>Finalizado</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="severity" class="form-label fw-semibold">Severidad</label>
                    <select class="form-select @error('severity') is-invalid @enderror" id="severity" name="severity">
                        <option value="minor" {{ old('severity') == 'minor' ? 'selected' : '' }}>Menor</option>
                        <option value="moderate" {{ old('severity') == 'moderate' ? 'selected' : '' }}>Moderado</option>
                        <option value="serious" {{ old('severity') == 'serious' ? 'selected' : '' }}>Serio</option>
                        <option value="fatal" {{ old('severity') == 'fatal' ? 'selected' : '' }}>Fatal</option>
                    </select>
                    @error('severity')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="response_date" class="form-label fw-semibold">Fecha de Respuesta</label>
                    <input type="datetime-local" class="form-control @error('response_date') is-invalid @enderror" id="response_date" name="response_date" value="{{ old('response_date') ? \Carbon\Carbon::parse(old('response_date'))->format('Y-m-d\TH:i') : now()->format('Y-m-d\TH:i') }}">
                    @error('response_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Enviar</button>
                    <a href="{{ route('sstsena.incidents.responses.index', $event->id) }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
