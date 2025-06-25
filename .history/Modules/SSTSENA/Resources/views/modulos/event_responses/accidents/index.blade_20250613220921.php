<div id="successModal" class="modal-confirm">
    <div class="modal-content success-modal animate__animated animate__fadeIn">
        <div class="modal-header success-header">
            <div class="success-icon-container">
                <svg class="success-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="12" cy="12" r="10" stroke="#28a745" stroke-width="2"/>
                    <path d="M8 12l3 3 5-6" stroke="#28a745" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <h3>¡Operación Exitosa!</h3>
        </div>
        <div class="modal-body">
            <p>{{ session('success') }}</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="corporate-btn success-btn" onclick="closeSuccessModal()">Aceptar</button>
        </div>
    </div>
</div>

<style>
/* Success Modal Styling */
.success-modal {
    background: linear-gradient(145deg, #ffffff, #f8f9fa);
    border-radius: 12px;
    border: 1px solid #28a745;
    box-shadow: 0 8px 32px rgba(40, 167, 69, 0.2);
    max-width: 500px;
    padding: 1.5rem;
}

.success-header {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding-bottom: 1.25rem;
    border-bottom: 1px solid rgba(40, 167, 69, 0.2);
}

.success-icon-container {
    width: 48px;
    height: 48px;
    background: rgba(40, 167, 69, 0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    animation: pulse 2s infinite ease-in-out;
}

.success-icon {
    width: 28px;
    height: 28px;
    animation: checkmark 0.5s ease-out forwards;
}

.success-header h3 {
    margin: 0;
    font-size: 1.5rem;
    font-weight: 700;
    color: #28a745;
    letter-spacing: 0.3px;
}

.modal-body p {
    font-size: 1.1rem;
    color: #343a40;
    margin: 0;
    line-height: 1.5;
}

.success-btn {
    background: #28a745;
    color: white;
    border-color: #28a745;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.success-btn:hover {
    background: #218838;
    border-color: #218838;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
}

/* Animations */
@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.1); }
    100% { transform: scale(1); }
}

@keyframes checkmark {
    0% { stroke-dasharray: 50; stroke-dashoffset: 50; }
    100% { stroke-dasharray: 50; stroke-dashoffset: 0; }
}

/* Responsive Design */
@media (max-width: 576px) {
    .success-modal {
        width: 95%;
        padding: 1rem;
    }
    
    .success-header h3 {
        font-size: 1.25rem;
    }
    
    .success-icon-container {
        width: 40px;
        height: 40px;
    }
    
    .success-icon {
        width: 24px;
        height: 24px;
    }
    
    .modal-body p {
        font-size: 1rem;
    }
    
    .success-btn {
        padding: 0.6rem 1.2rem;
        font-size: 0.9rem;
    }
}
</style>
<script>
    end