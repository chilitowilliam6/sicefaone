@foreach ($sections as $index => $section)
    @if ($section['title'] == 'Accidentes Laborales')
        @forelse ($section['items'] as $itemIndex => $item)
            <tr class="corporate-row">
                <!-- Other table cells remain unchanged -->
                <td class="corporate-cell accidents-cell-extra align-middle">
                    <div class="evidence-content">
                        @if($item->evidence)
                            @php
                                $ext = strtolower(pathinfo($item->evidence, PATHINFO_EXTENSION));
                                $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                                $isImage = in_array($ext, $imageExtensions);
                                $modalId = 'evidenceModal' . $item->id;
                            @endphp

                            @if($isImage)
                                <!-- Miniatura con enlace al modal -->
                                <a href="#"
                                   data-bs-toggle="modal"
                                   data-bs-target="#{{ $modalId }}"
                                   class="evidence-link"
                                   aria-label="Ver evidencia en tamaño completo para accidente #{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}"
                                   role="button">
                                    <img src="{{ asset('storage/evidences/' . $item->evidence) }}"
                                         alt="Evidencia del accidente #{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}"
                                         class="img-thumbnail evidence-thumbnail"
                                         style="width: 60px; height: 60px; object-fit: cover; cursor: pointer;"
                                         loading="lazy">
                                </a>

                                <!-- Modal mejorado para la imagen -->
                                <div class="modal fade" id="{{ $modalId }}" tabindex="-1" aria-labelledby="{{ $modalId }}Label" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content corporate-modal" style="background: var(--corporate-secondary); border: 1px solid var(--corporate-border); border-radius: 12px; overflow: hidden;">
                                            <div class="modal-header border-0" style="background: var(--corporate-primary); color: white; padding: 1rem 1.5rem;">
                                                <h5 class="modal-title" id="{{ $modalId }}Label">
                                                    <i class="fas fa-image me-2"></i>Evidencia - Accidente #{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}
                                                </h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar modal de evidencia"></button>
                                            </div>
                                            <div class="modal-body p-0">
                                                <div class="image-container" style="position: relative; max-height: 80vh; overflow: auto;">
                                                    <img src="{{ asset('storage/evidences/' . $item->evidence) }}"
                                                         alt="Evidencia del accidente #{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}"
                                                         class="img-fluid corporate-modal-image"
                                                         style="width: 100%; height: auto; object-fit: contain; border-radius: 8px;">
                                                </div>
                                            </div>
                                            <div class="modal-footer border-0" style="padding: 1rem 1.5rem; background: var(--corporate-secondary);">
                                                <a href="{{ asset('storage/evidences/' . $item->evidence) }}"
                                                   class="corporate-btn me-2"
                                                   download
                                                   aria-label="Descargar evidencia del accidente #{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}">
                                                    <i class="fas fa-download me-2"></i>Descargar
                                                </a>
                                                <button type="button" class="corporate-btn" data-bs-dismiss="modal">
                                                    <i class="fas fa-times me-2"></i>Cerrar
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <!-- Enlace para archivo no imagen -->
                                <a href="{{ asset('storage/evidences/' . $item->evidence) }}"
                                   class="btn btn-sm corporate-btn"
                                   target="_blank"
                                   aria-label="Ver archivo de evidencia para accidente #{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}">
                                    <i class="fas fa-file-alt me-2"></i>Ver archivo
                                </a>
                            @endif
                        @else
                            <span class="text-muted">Sin evidencia</span>
                        @endif
                    </div>
                </td>
                <!-- Other table cells remain unchanged -->
            </tr>
        @empty
            <tr>
                <td colspan="12" class="text-center py-5">
                    <div class="empty-state-corporate">
                        <div class="empty-icon mb-3">
                            <i class="fas {{ $section['icon'] }} fa-3x text-muted opacity-25"></i>
                        </div>
                        <h6 class="text-muted mb-2 fw-normal">No se encontraron registros de {{ strtolower($section['title']) }}</h6>
                        <p class="text-muted mb-0 small">
                            Los nuevos incidentes se registrarán y mostrarán aquí automáticamente
                        </p>
                    </div>
                </td>
            </tr>
        @endforelse
    @endif
@endforeach

<style>
/* Estilos adicionales para el modal */
.corporate-modal {
    box-shadow: 0 12px 24px var(--corporate-shadow);
    transition: transform 0.3s ease;
}

.corporate-modal-image {
    transition: transform 0.3s ease;
}

.corporate-modal-image:hover {
    transform: scale(1.02);
}

/* Mejoras de accesibilidad */
.corporate-modal:focus-within {
    outline: 2px solid var(--corporate-accent);
    outline-offset: 2px;
}

.modal-content {
    contain: content;
}

/* Ajustes responsivos para el modal */
@media (max-width: 576px) {
    .modal-dialog {
        margin: 0.5rem;
    }
    
    .corporate-modal-image {
        max-height: 60vh;
    }
    
    .modal-header,
    .modal-footer {
        padding: 0.75rem 1rem;
    }
    
    .modal-title {
        font-size: 1.1rem;
    }
}
</style>