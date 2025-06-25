@extends('sstsena::layouts.master')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm rounded-3" style="background-color: #ffffff;">
        <div class="card-header" style="background-color: #f8f9fa; border-bottom: 1px solid #dee2e6;">
            <h3 class="text-center" style="color: #1a3c6e; font-weight: 600;">
                Agregar Respuesta a Accidente #{{ $event->id }}
            </h3>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('sstsena.accidents.responses.store', $event->id) }}" method="POST">
                @csrf

                {{-- Campo de respuesta --}}
                <div class="mb-4">
                    <label for="response" class="form-label" style="color: #34495e; font-weight: 500;">Respuesta</label>
                    <textarea class="form-control border-light-subtle @error('response') is-invalid @enderror" 
                              id="response" name="response" rows="5">{{ old('response') }}</textarea>
                    @error('response')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Campo de acciones tomadas --}}
                <div class="mb-4">
                    <label for="actions_taken" class="form-label" style="color: #34495e; font-weight: 500;">Acciones Tomadas</label>
                    <textarea class="form-control border-light-subtle @error('actions_taken') is-invalid @enderror" 
                              id="actions_taken" name="actions_taken" rows="4">{{ old('actions_taken') }}</textarea>
                    @error('actions_taken')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Campo de severidad --}}
                <div class="mb-4">
                    <label for="severity" class="form-label" style="color: #34495e; font-weight: 500;">Gravedad</label>
                    <select class="form-select border-light-subtle @error('severity') is-invalid @enderror" 
                            name="severity" id="severity" required>
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
                <div class="mb-4">
                    <label for="status" class="form-label" style="color: #34495e; font-weight: 500;">Estado</label>
                    <select class="form-select border-light-subtle @error('status') is-invalid @enderror" 
                            name="status" id="status" required>
                        <option value="investigation" {{ old('status') == 'investigation' ? 'selected' : '' }}>En investigación</option>
                        <option value="finalized" {{ old('status') == 'finalized' ? 'selected' : '' }}>Finalizado</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Campo de fecha de respuesta --}}
                <div class="mb-4">
                    <label for="response_date" class="form-label" style="color: #34495e; font-weight: 500;">Fecha de Respuesta</label>
                    <input type="datetime-local" 
                           class="form-control border-light-subtle @error('response_date') is-invalid @enderror" 
                           name="response_date" id="response_date" 
                           value="{{ old('response_date', now()->format('Y-m-d\TH:i')) }}" required>
                    @error('response_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Botones --}}
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('sstsena.accidents.responses.index', $event->id) }}" 
                       class="btn btn-outline-secondary px-4" 
                       style="border-color: #6c757d;">Cancelar</a>
                    <button type="submit" class="btn btn-primary px-4" 
                            style="background-color: #1a3c6e; border-color: #1a3c6e;">Enviar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
