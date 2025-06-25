@extends('sstsena::layouts.master')

@section('content')
<div class="container mt-5">
    {{-- Alert personalizado tipo modal card --}}
    <div class="row justify-content-center mb-4">
        <div class="col-md-6">
            <div class="custom-alert-card">
                <div class="alert-icon success-icon">
                    <svg width="24" height="24" fill="white" viewBox="0 0 16 16">
                        <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                    </svg>
                </div>
                <h4 class="alert-title">Nuevo Registro</h4>
                <p class="alert-message">
                    Complete el formulario para documentar la respuesta al accidente. 
                    Todos los campos son importantes para el seguimiento adecuado.
                </p>
                <button type="button" class="alert-button success-button" onclick="this.parentElement.style.display='none'">
                    Continuar
                </button>
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

{{-- Estilos personalizados para alerts tipo modal --}}
<style>
    .custom-alert-card {
        background: white;
        border-radius: 20px;
        padding: 30px;
        text-align: center;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        animation: slideInDown 0.6s ease-out;
        position: relative;
        overflow: hidden;
    }
    
    .custom-alert-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #4285f4, #34a853);
    }
    
    .alert-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }
    
    .success-icon {
        background: linear-gradient(135deg, #4285f4, #1976d2);
    }
    
    .error-icon {
        background: linear-gradient(135deg, #ff4757, #ff3742);
    }
    
    .alert-title {
        color: #2c3e50;
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 15px;
        margin-top: 0;
    }
    
    .alert-message {
        color: #7f8c8d;
        font-size: 1rem;
        line-height: 1.6;
        margin-bottom: 25px;
        max-width: 300px;
        margin-left: auto;
        margin-right: auto;
    }
    
    .alert-button {
        border: none;
        border-radius: 10px;
        padding: 12px 30px;
        font-size: 1rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        text-transform: capitalize;
        min-width: 120px;
    }
    
    .success-button {
        background: linear-gradient(135deg, #4285f4, #1976d2);
        color: white;
    }
    
    .success-button:hover {
        background: linear-gradient(135deg, #1976d2, #1565c0);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(66, 133, 244, 0.3);
    }
    
    .error-button {
        background: linear-gradient(135deg, #ff4757, #ff3742);
        color: white;
    }
    
    .error-button:hover {
        background: linear-gradient(135deg, #ff3742, #ff1744);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(255, 71, 87, 0.3);
    }
    
    @keyframes slideInDown {
        from {
            transform: translateY(-50px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }
    
    .custom-alert-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        transition: all 0.3s ease;
    }
    
    /* Variante de error para usar cuando sea necesario */
    .alert-error {
        border-top: 4px solid #ff4757;
    }
    
    .alert-error::before {
        background: linear-gradient(90deg, #ff4757, #ff3742);
    }
</style>
@endsection