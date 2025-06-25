@extends('sstsena::layouts.master')

@section('content')
{{-- Modal de éxito personalizado --}}
@if(session('success'))
<div class="success-modal-overlay" id="successModal">
    <div class="success-modal">
        <div class="success-modal-content">
            <div class="success-icon-container">
                <div class="success-icon">
                    <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                        <circle class="checkmark-circle" cx="26" cy="26" r="25" fill="none"/>
                        <path class="checkmark-check" fill="none" d="m14.1 27.2l7.1 7.2 16.7-16.8"/>
                    </svg>
                </div>
            </div>
            <h2 class="success-title">¡Respuesta Registrada!</h2>
            <p class="success-message">{{ session('success') }}</p>
            <div class="success-actions">
                <button class="btn-success-primary" onclick="closeSuccessModal()">Continuar</button>
            </div>
        </div>
    </div>
</div>
@endif

<div class="container mt-5">

    <div class="card shadow-sm rounded-3" style="background-color: #ffffff;">
        <div class="card-header" style="background-color: #f8f9fa; border-bottom: 1px solid #dee2e6;">
            <h3 class="text-center" style="color: #1a3c6e; font-weight: 600;">
                Agregar Respuesta a Accidente #{{ $event->id }}
            </h3>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('sstsena.accidents.responses.store', $event->id) }}" method="POST" id="responseForm">
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
                            style="background-color: #1a3c6e; border-color: #1a3c6e;">
                        <span class="spinner-border spinner-border-sm me-2 d-none" id="loadingSpinner" role="status" aria-hidden="true"></span>
                        Enviar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
/* Modal de éxito personalizado */
.success-modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.6);
    backdrop-filter: blur(5px);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
    animation: fadeIn 0.3s ease-out;
}

.success-modal {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 20px;
    padding: 3px;
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
    animation: slideIn 0.4s ease-out;
    max-width: 450px;
    width: 90%;
}

.success-modal-content {
    background: white;
    border-radius: 17px;
    padding: 40px 30px;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.success-modal-content::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: linear-gradient(45deg, transparent, rgba(102, 126, 234, 0.1), transparent);
    animation: shimmer 3s infinite;
    pointer-events: none;
}

.success-icon-container {
    margin-bottom: 25px;
}

.success-icon {
    width: 80px;
    height: 80px;
    margin: 0 auto;
    background: linear-gradient(135deg, #4CAF50, #45a049);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 10px 25px rgba(76, 175, 80, 0.3);
    animation: bounceIn 0.6s ease-out 0.2s both;
}

.checkmark {
    width: 40px;
    height: 40px;
}

.checkmark-circle {
    stroke-dasharray: 166;
    stroke-dashoffset: 166;
    stroke-width: 2;
    stroke: white;
    fill: none;
    animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) 0.4s both;
}

.checkmark-check {
    transform-origin: 50% 50%;
    stroke-dasharray: 48;
    stroke-dashoffset: 48;
    stroke-width: 3;
    stroke: white;
    stroke-linecap: round;
    animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s both;
}

.success-title {
    font-size: 24px;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 15px;
    animation: fadeInUp 0.5s ease-out 0.3s both;
}

.success-message {
    font-size: 16px;
    color: #5a6c75;
    margin-bottom: 30px;
    line-height: 1.5;
    animation: fadeInUp 0.5s ease-out 0.4s both;
}

.success-actions {
    animation: fadeInUp 0.5s ease-out 0.5s both;
}

.btn-success-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    padding: 12px 30px;
    border-radius: 25px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
    position: relative;
    overflow: hidden;
}

.btn-success-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
}

.btn-success-primary:active {
    transform: translateY(0);
}

.btn-success-primary::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s;
}

.btn-success-primary:hover::before {
    left: 100%;
}

/* Animaciones */
@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: scale(0.7) translateY(-50px);
    }
    to {
        opacity: 1;
        transform: scale(1) translateY(0);
    }
}

@keyframes bounceIn {
    0% {
        opacity: 0;
        transform: scale(0.3);
    }
    50% {
        opacity: 1;
        transform: scale(1.05);
    }
    70% {
        transform: scale(0.9);
    }
    100% {
        opacity: 1;
        transform: scale(1);
    }
}

@keyframes stroke {
    100% {
        stroke-dashoffset: 0;
    }
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes shimmer {
    0% { transform: translateX(-100%) translateY(-100%) rotate(30deg); }
    100% { transform: translateX(100%) translateY(100%) rotate(30deg); }
}

/* Responsive */
@media (max-width: 480px) {
    .success-modal-content {
        padding: 30px 20px;
    }
    
    .success-title {
        font-size: 20px;
    }
    
    .success-message {
        font-size: 14px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('responseForm');
    const submitButton = form.querySelector('button[type="submit"]');
    const loadingSpinner = document.getElementById('loadingSpinner');

    form.addEventListener('submit', function(e) {
        // Mostrar spinner de carga
        loadingSpinner.classList.remove('d-none');
        submitButton.disabled = true;
        submitButton.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Enviando...';
    });

    // Auto-mostrar modal si existe mensaje de éxito
    const successModal = document.getElementById('successModal');
    if (successModal) {
        document.body.style.overflow = 'hidden';
        
        // Auto-cerrar después de 5 segundos
        setTimeout(() => {
            closeSuccessModal();
        }, 5000);
    }
});

function closeSuccessModal() {
    const modal = document.getElementById('successModal');
    if (modal) {
        modal.style.animation = 'fadeOut 0.3s ease-out';
        setTimeout(() => {
            modal.remove();
            document.body.style.overflow = 'auto';
        }, 300);
    }
}

// Agregar animación de fadeOut
const style = document.createElement('style');
style.textContent = `
    @keyframes fadeOut {
        from { opacity: 1; }
        to { opacity: 0; }
    }
`;
document.head.appendChild(style);
</script>
@endsection