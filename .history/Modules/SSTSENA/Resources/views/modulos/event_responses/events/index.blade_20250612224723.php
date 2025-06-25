@extends('sstsena::layouts.master')

@section('content')
<div class="container-fluid py-4">
    {{-- Alerta de éxito corporativa --}}
    @if (session('success'))
        <div id="alertaExito" class="alert alert-success border-0 shadow-sm mx-auto mb-4 fade-in corporate-alert" style="max-width: 500px;">
            <div class="d-flex align-items-center">
                <div class="alert-icon me-3">
                    <i class="fas fa-check-circle fa-lg"></i>
                </div>
                <div class="flex-grow-1">
                    <strong>Operación Exitosa</strong><br>
                    <small class="text-muted">{{ session('success') }}</small>
                </div>
                <button type="button" class="btn-close btn-close-sm" onclick="document.getElementById('alertaExito')?.remove()"></button>
            </div>
        </div>
        <script>setTimeout колеб() => document.getElementById('alertaExito')?.classList.add('fade-out'), 5000);</script>
    @endif

    @php
        $sections = [
            [
                'title' => 'Accidentes Laborales',
                'items' => $accidents,
                'route_prefix' => 'accidents',
                'icon' => 'fa-exclamation-triangle',
                'color' => '#DC143C'
            ],
            [
                'title' => 'Incidentes de Trabajo',
                'items' => $incidents,
                'route_prefix' => 'incidents',
                'icon' => 'fa-clipboard-list',
                'color' => '#FF8C00'
            ],
            [
                'title' => 'Situaciones de Emergencia',
                'items' => $emergencies,
                'route_prefix' => 'emergencies',
                'icon' => 'fa-shield-alt',
                'color' => '#4169E1'
            ],
            [
                'title' => 'Comportamientos Inseguros',
                'items' => $unsafeActs,
                'route_prefix' => 'unsafe_acts',
                'icon' => 'fa-eye-slash',
                'color' => '#708090'
            ],
        ];
    @endphp

    {{-- Lista estructurada --}}
    @foreach ($sections as $section)
        <div class="section-item mb-4">
            <div class="corporate-table border-0 shadow-sm">
                <div class="section-header" style="border-left: 4px solid {{ $section['color'] }};">
                    <div class="section-content d-flex justify-content-between align-items-center py-4 px-4">
                        <div class="d-flex align-items-center">
                            <div class="section-icon me-4" style="background-color: {{ $section['color'] }}15;">
                                <i class="fas {{ $section['icon'] }} fa-lg" style="color: {{ $section['color'] }};"></i>
                            </div>
                            <div>
                                <h4 class="mb-1 fw-semibold text-dark">{{ $section['title'] }}</h4>
                                <small class="text-muted">Evaluación y Gestión de Riesgos</small>
                            </div>
                        </div>
                        <div class="stats-container">
                            <div class="stats-number">{{ $section['items']->count() }}</div>
                            <div class="stats-label">Registros</div>
                        </div>
                    </div>
                </div>

                <div class="table-container p-4">
                    @if ($section['items']->isEmpty())
                        <div class="empty-state-corporate text-center py-5">
                            <div class="empty-icon mb-3">
                                <i class="fas {{ $section['icon'] }} fa-3x text-muted opacity-25"></i>
                            </div>
                            <h6 class="text-muted mb-2 fw-normal">No se encontraron registros de {{ strtolower($section['title']) }}</h6>
                            <p class="text-muted mb-0 small">
                                Los nuevos incidentes se registrarán y mostrarán aquí automáticamente
                            </p>
                        </div>
                    @else
                        <table class="table table-hover corporate-table-list">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Fecha y Hora</th>
                                    <th scope="col">Descripción</th>
                                    <th scope="col">Severidad</th>
                                    @if ($section['title'] == 'Accidentes Laborales')
                                        <th scope="col">Ambiente</th>
                                        <th scope="col">Tipo de Lesión</th>
                                        <th scope="col">Evidencia</th>
                                    @endif
                                    <th scope="col">Respuestas</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($section['items'] as $item)
                                    <tr style="--table-accent: {{ $section['color'] }};">
                                        <td class="fw-bold" style="color: {{ $section['color'] }};">
                                            #{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}
                                        </td>
                                        <td>
                                            <div class="fw-semibold text-dark">{{ $item->date_time->format('d M Y') }}</div>
                                            <small class="text-muted">
                                                <i class="fas fa-clock me-1"></i>{{ $item->date_time->format('H:i') }}
                                            </small>
                                        </td>
                                        <td>{{ Str::limit($item->description ?? 'Sin descripción disponible', 100) }}</td>
                                        <td>
                                            @switch($item->severity)
                                                @case('minor')
                                                    <span class="severity-badge severity-low">
                                                        <div class="severity-indicator"></div>
                                                        | Leve
                                                    </span>
                                                @break
                                                @case('moderate')
                                                    <span class="severity-badge severity-medium">
                                                        <div class="severity-indicator"></div>
                                                        | Moderada
                                                    </span>
                                                @break
                                                @case('serious')
                                                    <span class="severity-badge severity-high">
                                                        <div class="severity-indicator"></div>
                                                        | Grave
                                                    </span>
                                                @break
                                                @case('fatal')
                                                    <span class="severity-badge severity-critical">
                                                        <div class="severity-indicator"></div>
                                                        | Fatal
                                                    </span>
                                                @break
                                                @default
                                                    <span class="severity-badge severity-pending">
                                                        <div class="severity-indicator"></div>
                                                        | En Revisión
                                                    </span>
                                            @endswitch
                                        </td>
                                        @if ($section['title'] == 'Accidentes Laborales')
                                            <td>{{ $item->environment->name ?? 'N/A' }}</td>
                                            <td>{{ $item->injuryType->name ?? 'N/A' }}</td>
                                            <td>
                                                @if($item->evidence)
                                                    @php
                                                        $ext = strtolower(pathinfo($item->evidence, PATHINFO_EXTENSION));
                                                        $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                                                        $isImage = in_array($ext, $imageExtensions);
                                                        $modalId = 'evidenceModal' . $item->id;
                                                    @endphp
                                                    @if($isImage)
                                                        <a href="#"
                                                           data-bs-toggle="modal"
                                                           data-bs-target="#{{ $modalId }}"
                                                           class="evidence-link"
                                                           aria-label="Ver evidencia en tamaño completo"
                                                           role="button">
                                                            <img src="{{ asset('storage/evidences/' . $item->evidence) }}"
                                                                 alt="Evidencia del accidente #{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}"
                                                                 class="img-thumbnail evidence-thumbnail"
                                                                 style="width: 60px; height: 60px; object-fit: cover; cursor: pointer;"
                                                                 loading="lazy">
                                                        </a>
                                                        <div class="modal fade" id="{{ $modalId }}" tabindex="-1" aria-labelledby="{{ $modalId }}Label" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                                <div class="modal-content corporate-modal">
                                                                    <div class="modal-header border-0">
                                                                        <h5 class="modal-title" id="{{ $modalId }}Label">Evidencia - Accidente #{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}</h5>
                                                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                                                    </div>
                                                                    <div class="modal-body text-center p-0">
                                                                        <img src="{{ asset('storage/evidences/' . $item->evidence) }}"
                                                                             alt="Evidencia del accidente #{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}"
                                                                             class="img-fluid rounded corporate-modal-image"
                                                                             style="max-height: 80vh; width: 100%; object-fit: contain;">
                                                                    </div>
                                                                    <div class="modal-footer border-0">
                                                                        <a href="{{ asset('storage/evidences/' . $item->evidence) }}"
                                                                           class="btn corporate-btn"
                                                                           download
                                                                           aria-label="Descargar evidencia">
                                                                            <i class="fas fa-download me-2"></i>Descargar
                                                                        </a>
                                                                        <button type="button" class="btn corporate-btn" data-bs-dismiss="modal">
                                                                            <i class="fas fa-times me-2"></i>Cerrar
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <a href="{{ asset('storage/evidences/' . $item->evidence) }}"
                                                           class="btn btn-sm corporate-btn"
                                                           target="_blank"
                                                           aria-label="Ver archivo de evidencia">
                                                            <i class="fas fa-file-alt me-2"></i>Ver archivo
                                                        </a>
                                                    @endif
                                                @else
                                                    <span class="text-muted">Sin evidencia</span>
                                                @endif
                                            </td>
                                        @endif
                                        <td>
                                            <span class="response-count">{{ $item->eventResponses->count() }}</span>
                                            <i class="fas fa-comment-dots ms-1 text-muted"></i>
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('sstsena.' . $section['route_prefix'] . '.responses.index', $item->id) }}"
                                                   class="btn btn-sm corporate-btn">
                                                    <i class="fas fa-folder-open me-2"></i>Revisar
                                                </a>
                                                <button type="button"
                                                        class="btn btn-sm corporate-btn"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#detailsModal{{ $item->id }}"
                                                        aria-label="Ver detalles completos del {{ strtolower($section['title']) }} #{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}">
                                                    <i class="fas fa-expand-alt me-2"></i>Detalles
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    {{-- Modal de Detalles --}}
                                    <div class="modal fade" id="detailsModal{{ $item->id }}" tabindex="-1" aria-labelledby="detailsModal{{ $item->id }}Label" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content corporate-modal">
                                                <div class="modal-header border-0">
                                                    <h5 class="modal-title" id="detailsModal{{ $item->id }}Label">
                                                        {{ $section['title'] }} #{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}
                                                    </h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                                </div>
                                                <div class="modal-body" id="modalContent{{ $item->id }}">
                                                    <div class="mb-4">
                                                        <h6 class="fw-semibold">Fecha y Hora</h6>
                                                        <p class="text-dark">
                                                            <i class="fas fa-calendar-alt me-2"></i>{{ $item->date_time->format('d M Y') }} a las {{ $item->date_time->format('H:i') }}
                                                        </p>
                                                    </div>
                                                    <div class="mb-4">
                                                        <h6 class="fw-semibold">Severidad</h6>
                                                        @switch($item->severity)
                                                            @case('minor')
                                                                <span class="severity-badge severity-low">
                                                                    <div class="severity-indicator"></div>
                                                                    | Leve
                                                                </span>
                                                            @break
                                                            @case('moderate')
                                                                <span class="severity-badge severity-medium">
                                                                    <div class="severity-indicator"></div>
                                                                    | Moderada
                                                                </span>
                                                            @break
                                                            @case('serious')
                                                                <span class="severity-badge severity-high">
                                                                    <div class="severity-indicator"></div>
                                                                    | Grave
                                                                </span>
                                                            @break
                                                            @case('fatal')
                                                                <span class="severity-badge severity-critical">
                                                                    <div class="severity-indicator"></div>
                                                                    | Fatal
                                                                </span>
                                                            @break
                                                            @default
                                                                <span class="severity-badge severity-pending">
                                                                    <div class="severity-indicator"></div>
                                                                    | En Revisión
                                                                </span>
                                                        @endswitch
                                                    </div>
                                                    <div class="mb-4">
                                                        <h6 class="fw-semibold">Descripción</h6>
                                                        <p class="text-dark">{{ $item->description ?? 'Sin descripción disponible' }}</p>
                                                    </div>
                                                    <div class="mb-4">
                                                        <h6 class="fw-semibold">Respuestas</h6>
                                                        <p class="text-dark">
                                                            <i class="fas fa-comment-dots me-2"></i>{{ $item->eventResponses->count() }} respuestas
                                                        </p>
                                                    </div>
                                                    @if ($section['title'] == 'Accidentes Laborales')
                                                        <div class="mb-4">
                                                            <h6 class="fw-semibold">Información Adicional</h6>
                                                            <div class="additional-info">
                                                                <div class="info-item">
                                                                    <i class="fas fa-map-marker-alt me-2"></i>
                                                                    <span>{{ $item->environment->name ?? 'N/A' }}</span>
                                                                </div>
                                                                <div class="info-item">
                                                                    <i class="fas fa-medkit me-2"></i>
                                                                    <span>{{ $item->injuryType->name ?? 'N/A' }}</span>
                                                                </div>
                                                                <div class="info-item">
                                                                    <i class="fas fa-exclamation-circle me-2"></i>
                                                                    <span>{{ $item->riskType->name ?? 'N/A' }}</span>
                                                                </div>
                                                                <div class="info-item">
                                                                    <i class="fas fa-briefcase me-2"></i>
                                                                    <span>{{ $item->accidentType->name ?? 'N/A' }}</span>
                                                                </div>
                                                                <div class="info-item">
                                                                    <i class="fas fa-user me-2"></i>
                                                                    <span>{{ $item->createdBy->name ?? 'N/A' }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mb-4">
                                                            <h6 class="fw-semibold">Evidencia</h6>
                                                            @if($item->evidence)
                                                                @php
                                                                    $ext = strtolower(pathinfo($item->evidence, PATHINFO_EXTENSION));
                                                                    $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                                                                    $isImage = in_array($ext, $imageExtensions);
                                                                @endphp
                                                                @if($isImage)
                                                                    <img src="{{ asset('storage/evidences/' . $item->evidence) }}"
                                                                         alt="Evidencia del accidente #{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}"
                                                                         class="img-fluid rounded corporate-modal-image"
                                                                         style="max-height: 300px; width: 100%; object-fit: contain;">
                                                                    <div class="mt-2">
                                                                        <a href="{{ asset('storage/evidences/' . $item->evidence) }}"
                                                                           class="btn corporate-btn"
                                                                           download
                                                                           aria-label="Descargar evidencia">
                                                                            <i class="fas fa-download me-2"></i>Descargar
                                                                        </a>
                                                                        <a href="#"
                                                                           data-bs-toggle="modal"
                                                                           data-bs-target="#evidenceModal{{ $item->id }}"
                                                                           class="btn corporate-btn"
                                                                           aria-label="Ver evidencia en tamaño completo">
                                                                            <i class="fas fa-expand me-2"></i>Ampliar
                                                                        </a>
                                                                    </div>
                                                                @else
                                                                    <a href="{{ asset('storage/evidences/' . $item->evidence) }}"
                                                                       class="btn corporate-btn"
                                                                       target="_blank"
                                                                       aria-label="Ver archivo de evidencia">
                                                                        <i class="fas fa-file-alt me-2"></i>Ver archivo
                                                                    </a>
                                                                @endif
                                                            @else
                                                                <p class="text-muted">Sin evidencia</p>
                                                            @endif
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="modal-footer border-0">
                                                    <div class="export-buttons me-auto">
                                                        <button class="btn corporate-btn export-btn" onclick="exportToPDF('modalContent{{ $item->id }}', '{{ $section['title'] }}_{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}')">
                                                            <i class="fas fa-file-pdf me-2"></i>PDF
                                                        </button>
                                                        <button class="btn corporate-btn export-btn" onclick="exportToWord('modalContent{{ $item->id }}', '{{ $section['title'] }}_{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}')">
                                                            <i class="fas fa-file-word me-2"></i>Word
                                                        </button>
                                                    </div>
                                                    <a href="{{ route('sstsena.' . $section['route_prefix'] . '.responses.index', $item->id) }}"
                                                       class="btn corporate-btn">
                                                        <i class="fas fa-folder-open me-2"></i>Revisar Caso
                                                    </a>
                                                    <button type="button" class="btn corporate-btn" data-bs-dismiss="modal">
                                                        <i class="fas fa-times me-2"></i>Cerrar
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/docx/7.8.2/docx.min.js"></script>
    <script>
        function logError(message, error) {
            console.error(`Export Error: ${message}`, error);
            alert(`Error al exportar: ${message}. Por favor, revisa la consola para más detalles.`);
        }

        function exportToPDF(elementId, filename) {
            try {
                const element = document.getElementById(elementId);
                if (!element) {
                    throw new Error('Elemento con ID ' + elementId + ' no encontrado.');
                }

                const clonedElement = element.cloneNode(true);
                const buttons = clonedElement.querySelectorAll('button, a');
                buttons.forEach(btn => btn.remove());

                const opt = {
                    margin: [0.5, 0.5, 0.5, 0.5],
                    filename: `${filename}.pdf`,
                    image: { type: 'jpeg', quality: 0.98 },
                    html2canvas: { 
                        scale: 2,
                        useCORS: true,
                        logging: true
                    },
                    jsPDF: { 
                        unit: 'in', 
                        format: 'letter', 
                        orientation: 'portrait' 
                    }
                };

                console.log('Iniciando exportación a PDF para', elementId);
                html2pdf().from(clonedElement).set(opt).save().catch(err => {
                    logError('Fallo en la exportación a PDF', err);
                });
            } catch (error) {
                logError('Error en exportToPDF', error);
            }
        }

        function exportToWord(elementId, filename) {
            try {
                const element = document.getElementById(elementId);
                if (!element) {
                    throw new Error('Elemento con ID ' + elementId + ' no encontrado.');
                }

                const sections = [];
                const headers = element.querySelectorAll('h6');
                const contents = element.querySelectorAll('.modal-body > div > p, .modal-body > div > .additional-info');

                headers.forEach((header, index) => {
                    let contentText = '';
                    if (contents[index].classList.contains('additional-info')) {
                        const infoItems = contents[index].querySelectorAll('.info-item span');
                        contentText = Array.from(infoItems).map(item => item.textContent.trim()).join('\n');
                    } else {
                        contentText = contents[index].textContent.trim();
                    }
                    sections.push(
                        new docx.Paragraph({
                            text: header.textContent.trim(),
                            heading: docx.HeadingLevel.HEADING_2,
                            spacing: { after: 200 }
                        }),
                        new docx.Paragraph({
                            text: contentText,
                            spacing: { after: 200 }
                        })
                    );
                });

                const doc = new docx.Document({
                    sections: [{
                        properties: {},
                        children: [
                            new docx.Paragraph({
                                text: document.getElementById(`detailsModal${elementId.replace('modalContent', '')}Label`).textContent,
                                heading: docx.HeadingLevel.HEADING_1,
                                spacing: { after: 400 }
                            }),
                            ...sections
                        ]
                    }]
                });

                console.log('Iniciando exportación a Word para', elementId);
                docx.Packer.toBlob(doc).then(blob => {
                    const url = window.URL.createObjectURL(blob);
                    const a = document.createElement('a');
                    a.href = url;
                    a.download = `${filename}.docx`;
                    a.click();
                    window.URL.revokeObjectURL(url);
                }).catch(err => {
                    logError('Fallo en la exportación a Word', err);
                });
            } catch (error) {
                logError('Error en exportToWord', error);
            }
        }
    </script>
@endsection

<style>
/* Estilos base */
.corporate-table {
    background: white;
    border-radius: 8px;
    overflow: hidden;
}

.section-header {
    background: var(--corporate-secondary);
}

.section-content {
    color: var(--corporate-text);
}

.section-icon {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 6px;
}

.stats-container {
    text-align: center;
}

.stats-number {
    font-size: 1.5rem;
    font-weight: 600;
    color: var(--corporate-primary);
}

.stats-label {
    font-size: 0.8rem;
    color: var(--corporate-text-muted);
}

.table-container {
    background: var(--corporate-bg);
}

.corporate-table-list {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
}

.corporate-table-list th {
    background: var(--corporate-secondary);
    color: var(--corporate-text);
    font-weight: 600;
    padding: 1rem;
    text-align: left;
    font-size: 0.9rem;
    border-bottom: 1px solid var(--corporate-border);
}

.corporate-table-list td {
    padding: 1rem;
    vertical-align: middle;
    border-bottom: 1px solid var(--corporate-border);
    font-size: 0.85rem;
}

.corporate-table-list tr {
    background: white;
    border-left: 4px solid var(--table-accent);
}

.corporate-table-list tr:hover {
    background: var(--corporate-bg);
}

.severity-badge {
    font-size: 0.8rem;
    padding: 0.25rem 0.5rem;
    border-radius: 12px;
    display: inline-flex;
    align-items: center;
}

.severity-indicator {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    margin-right: 0.5rem;
}

.severity-low { background: #D4EDDA; color: #155724; }
.severity-low .severity-indicator { background: #28A745; }
.severity-medium { background: #FFF3CD; color: #856404; }
.severity-medium .severity-indicator { background: #FFC107; }
.severity-high { background: #F8D7DA; color: #721C24; }
.severity-high .severity-indicator { background: #DC3545; }
.severity-critical { background: #2C2C2C; color: #FFFFFF; }
.severity-critical .severity-indicator { background: #FF0000; }
.severity-pending { background: #E2E3E5; color: #383D41; }
.severity-pending .severity-indicator { background: #6C757D; }

.corporate-btn {
    font-size: 0.85rem;
    padding: 0.5rem 1rem;
    border-radius: 6px;
    background: var(--corporate-primary);
    color: white;
    border: none;
    transition: background 0.2s;
}

.corporate-btn:hover {
    background: var(--corporate-primary-dark);
}

.empty-state-corporate {
    background: var(--corporate-bg);
    border-radius: 6px;
}

/* Estilos de modales */
.corporate-modal {
    background: white;
    border-radius: 8px;
    border: 1px solid var(--corporate-border);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
}

.corporate-modal .modal-header {
    background: var(--corporate-secondary);
    padding: 1.25rem;
}

.corporate-modal .modal-title {
    color: var(--corporate-text);
    font-weight: 600;
}

.corporate-modal .modal-body {
    padding: 1.5rem;
}

.corporate-modal .modal-footer {
    padding: 1rem;
    background: var(--corporate-secondary);
}

.corporate-modal .btn-close-white {
    filter: invert(0.6);
}

.corporate-modal-image {
    border: 1px solid var(--corporate-border);
    border-radius: 6px;
}

.export-buttons {
    display: flex;
    gap: 0.5rem;
}

.export-btn {
    font-size: 0.85rem;
    padding: 0.5rem 1rem;
}

.modal-content {
    contain: layout style;
}

.modal-body h6 {
    color: var(--corporate-text);
    margin-bottom: 1rem;
    font-size: 1rem;
}

.modal-body p,
.modal-body .info-item {
    font-size: 0.9rem;
    line-height: 1.5;
}

/* Responsividad */
@media (max-width: 768px) {
    .corporate-table-list {
        display: block;
        overflow-x: auto;
        white-space: nowrap;
    }

    .section-content {
        flex-direction: column;
        align-items: flex-start;
    }

    .stats-container {
        margin-top: 1rem;
    }

    .corporate-btn {
        font-size: 0.8rem;
        padding: 0.4rem 0.8rem;
    }

    .modal-dialog {
        margin: 0.5rem;
    }

    .modal-body {
        padding: 1rem;
    }

    .modal-footer .btn {
        font-size: 0.8rem;
        padding: 0.4rem 0.8rem;
    }

    .export-buttons {
        flex-direction: column;
        width: 100%;
    }

    .export-btn {
        width: 100%;
    }
}
</style>
@endsection