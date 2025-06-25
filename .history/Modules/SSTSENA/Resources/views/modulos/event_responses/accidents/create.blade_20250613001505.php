@extends('sstsena::layouts.master')

@section('content')
<div class="container mt-5">
    {{-- Alert personalizado grande y centrado --}}
    <div class="row justify-content-center mb-4">
        <div class="col-md-10">
            <div class="alert alert-info shadow-lg rounded-4 border-0 p-4" 
                 style="background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%); 
                        border-left: 5px solid #2196f3;">
                <div class="d-flex align-items-center justify-content-center">
                    <div class="me-3">
                        <svg width="32" height="32" fill="#1976d2" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                        </svg>
                    </div>
                    <div class="flex-grow-1 text-center">
                        <h5 class="alert-heading mb-2" style="color: #1976d2; font-weight: 600;">
                            📋 Registro de Respuesta a Accidente
                        </h5>
                        <p class="mb-0" style="color: #424242; font-size: 1.1rem;">
                            Complete todos los campos requeridos para documentar la respuesta al accidente de manera adecuada. 
                            Esta información será utilizada para el seguimiento y análisis posterior.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                              id="response" name="response" rows="5" 
                              placeholder="Describa la respuesta detallada al accidente...">{{ old('response') }}</textarea>
                    @error('response')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Campo de acciones tomadas --}}
                <div class="mb-4">
                    <label for="actions_taken" class="form-label" style="color: #34495e; font-weight: 500;">Acciones Tomadas</label>
                    <textarea class="form-control border-light-subtle @error('actions_taken') is-invalid @enderror" 
                              id="actions_taken" name="actions_taken" rows="4"
                              placeholder="Liste las acciones específicas que se tomaron...">{{ old('actions_taken') }}</textarea>
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

{{-- Estilos adicionales para el alert --}}
<style>
    .alert-info {
        animation: slideInDown 0.5s ease-out;
    }
    
    @keyframes slideInDown {
        from {
            transform: translateY(-30px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }
    
    .alert-info:hover {
        transform: translateY(-2px);
        transition: transform 0.3s ease;
    }
</style>
@endsection