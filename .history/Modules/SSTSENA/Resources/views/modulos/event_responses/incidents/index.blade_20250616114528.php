@if ($section['title'] == 'Incidentes de Trabajo')
    {{-- Table for Incidentes de Trabajo with fields from migration --}}
    <thead>
        <tr class="corporate-header-row">
            <th class="corporate-th" style="width: 5%;">
                <div class="th-content">
                    <i class="fas fa-hashtag me-2"></i>
                    <span>#</span>
                </div>
            </th>
            <th class="corporate-th" style="width: 8%;">
                <div class="th-content">
                    <i class="fas fa-calendar-alt me-2"></i>
                    <span>Fecha y Hora</span>
                </div>
            </th>
            <th class="corporate-th incidents-th-extra" style="width: 8%;">
                <div class="th-content">
                    <i class="fas fa-map-marker-alt me-2"></i>
                    <span>Ubicación</span>
                </div>
            </th>
            <th class="corporate-th incidents-th-extra" style="width: 8%;">
                <div class="th-content">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <span>Tipo de Riesgo</span>
                </div>
            </th>
            <th class="corporate-th incidents-th-extra" style="width: 8%;">
                <div class="th-content">
                    <i class="fas fa-briefcase me-2"></i>
                    <span>Tipo de Incidente</span>
                </div>
            </th>
            <th class="corporate-th" style="width: 30%;">
                <div class="th-content">
                    <i class="fas fa-file-alt me-3"></i>
                    <span>Descripción del Incidente</span>
                </div>
            </th>
            <th class="corporate-th" style="width: 8%;">
                <div class="th-content">
                    <i class="fas fa-thermometer-half me-2"></i>
                    <span>Gravedad</span>
                </div>
            </th>
            <th class="corporate-th incidents-th-extra" style="width: 8%;">
                <div class="th-content">
                    <i class="fas fa-camera me-2"></i>
                    <span>Evidencia</span>
                </div>
            </th>
            <th class="corporate-th incidents-th-extra" style="width: 8%;">
                <div class="th-content">
                    <i class="fas fa-user me-2"></i>
                    <span>Creado por</span>
                </div>
            </th>
            <th class="corporate-th text-center" style="width: 8%;">
                <div class="th-content justify-content-center">
                    <i class="fas fa-comments me-2"></i>
                    <span>Respuestas</span>
                </div>
            </th>
            <th class="corporate-th text-center" style="width: 8%;">
                <div class="th-content justify-content-center">
                    <i class="fas fa-tools me-2"></i>
                    <span>Acciones</span>
                </div>
            </th>
        </tr>
    </thead>
    <tbody>
        @forelse ($section['items'] as $itemIndex => $item)
            <tr class="corporate-row">
                <td class="corporate-cell" style="width: 5%;">
                    <div class="reference-id">
                        <span class="fw-bold" style="color: {{ $section['color'] }};">
                            #{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}
                        </span>
                    </div>
                </td>
                <td class="corporate-cell" style="width: 8%;">
                    <div class="datetime-info">
                        <div class="fw-semibold text-dark">{{ $item->date_time->format('d M Y') }}</div>
                        <small class="text-muted">
                            <i class="fas fa-clock me-1"></i>{{ $item->date_time->format('H:i') }}
                        </small>
                    </div>
                </td>
                <td class="corporate-cell incidents-cell-extra" style="width: 8%;">
                    <div class="environment-info">
                        <span class="fw-semibold text-dark">{{ $item->environment->name ?? 'N/A' }}</span>
                    </div>
                </td>
                <td class="corporate-cell incidents-cell-extra" style="width: 8%;">
                    <div class="risk-type-info">
                        <span class="fw-semibold text-dark">{{ $item->riskType->name ?? 'N/A' }}</span>
                    </div>
                </td>
                <td class="corporate-cell incidents-cell-extra" style="width: 8%;">
                    <div class="incident-type-info">
                        <span class="fw-semibold text-dark">{{ $item->incidentType->name ?? 'N/A' }}</span>
                    </div>
                </td>
                <td class="corporate-cell" style="width: 30%;">
                    <div class="description-content">
                        <p class="mb-0 text-dark lh-sm expandable-text" id="description-{{ $section['route_prefix'] }}-{{ $item->id }}"
                           style="max-height: 3em; overflow: hidden; transition: max-height 0.3s ease;">
                            {{ $item->description ?? 'Sin descripción disponible' }}
                        </p>
                        @if(strlen($item->description ?? '') > 65)
                            <small class="text-muted mt-1 d-block toggle-text" onclick="toggleText('description-{{ $section['route_prefix'] }}-{{ $item->id }}')">
                                <i class="fas fa-chevron-down me-1 toggle-icon"></i>
                                <span class="toggle-label">Mostrar más</span>
                            </small>
                        @endif
                    </div>
                </td>
                <td class="corporate-cell" style="width: 8%;">
                    @switch($item->severity)
                        @case('minor')
                            <span class="severity-badge severity-low">
                                <div class="severity-indicator"></div>
                                <span>Leve</span>
                            </span>
                        @break
                        @case('moderate')
                            <span class="severity-badge severity-medium">
                                <div class="severity-indicator"></div>
                                <span>Moderada</span>
                            </span>
                        @break
                        @case('serious')
                            <span class="severity-badge severity-high">
                                <div class="severity-indicator"></div>
                                <span>Grave</span>
                            </span>
                        @break
                        @case('fatal')
                            <span class="severity-badge severity-critical">
                                <div class="severity-indicator"></div>
                                <span>Fatal</span>
                            </span>
                        @break
                        @default
                            <span class="severity-badge severity-pending">
                                <div class="severity-indicator"></div>
                                <span>En Revisión</span>
                            </span>
                    @endswitch
                </td>
                <td class="corporate-cell incidents-cell-extra align-middle" style="width: 8%;">
                    <div class="evidence-container">
                        @if($item->evidence)
                            @php
                                $ext = strtolower(pathinfo($item->evidence, PATHINFO_EXTENSION));
                                $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                                $isImage = in_array($ext, $imageExtensions);
                                $modalId = 'evidenceModal' . $item->id;
                                $evidenceAlt = "Evidencia del incidente #" . str_pad($item->id, 4, '0', STR_PAD_LEFT);
                            @endphp

                            @if($isImage)
                                <div class="evidence-preview">
                                    <!-- Miniatura clickeable -->
                                    <button type="button"
                                            class="evidence-thumbnail-btn p-0 border-0 bg-transparent"
                                            data-bs-toggle="modal"
                                            data-bs-target="#{{ $modalId }}"
                                            aria-label="Ampliar imagen de evidencia">
                                        <img src="{{ asset('storage/evidences/' . $item->evidence) }}"
                                             alt="{{ $evidenceAlt }}"
                                             class="img-thumbnail evidence-thumbnail"
                                             style="max-height: 60px; width: auto; object-fit: contain; cursor: pointer;"
                                             loading="lazy">
                                    </button>

                                    <!-- Botón de descarga directo -->
                                    <div class="evidence-actions mt-2">
                                        <a href="{{ asset('storage/evidences/' . $item->evidence) }}"
                                           class="btn btn-sm corporate-btn"
                                           download="{{ 'evidencia-incidente-' . str_pad($item->id, 4, '0', STR_PAD_LEFT) . '.' . $ext }}">
                                            <center><i class="fas fa-download me-1"></i>Descargar</center>
                                        </a>
                                    </div>
                                </div>

                                <!-- Modal estilizado -->
                                <div class="modal fade" id="{{ $modalId }}" tabindex="-1"
                                     aria-labelledby="{{ $modalId }}Label" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-xl">
                                        <div class="modal-content bg-white rounded-3 shadow">
                                            <div class="modal-header border-bottom-0">
                                                <h5 class="modal-title text-dark" id="{{ $modalId }}Label">
                                                    <i class="fas fa-image me-2"></i>{{ $evidenceAlt }}
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                            </div>
                                            <div class="modal-body d-flex justify-content-center p-4" style="min-height: 300px;">
                                                <img src="{{ asset('storage/evidences/' . $item->evidence) }}"
                                                     alt="{{ $evidenceAlt }}"
                                                     class="img-fluid rounded"
                                                     style="max-height: 80vh; object-fit: contain; width: auto;"
                                                     loading="lazy">
                                            </div>
                                            <div class="modal-footer border-top-0 justify-content-between px-4 pb-3">
                                                <a href="{{ asset('storage/evidences/' . $item->evidence) }}"
                                                   class="btn btn-primary"
                                                   download="{{ 'evidencia-incidente-' . str_pad($item->id, 4, '0', STR_PAD_LEFT) . '.' . $ext }}">
                                                    <i class="fas fa-download me-2"></i> Descargar
                                                </a>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    <i class="fas fa-times me-2"></i> Cerrar
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <!-- Si no es imagen -->
                                <a href="{{ asset('storage/evidences/' . $item->evidence) }}"
                                   class="btn btn-sm corporate-btn"
                                   target="_blank"
                                   rel="noopener noreferrer">
                                    <i class="fas fa-file-alt me-1"></i> Ver archivo
                                </a>
                            @endif
                        @else
                            <p class="text-muted mb-0">Sin evidencia</p>
                        @endif
                    </div>
                </td>
                <td class="corporate-cell incidents-cell-extra" style="width: 8%;">
                    <div class="created-by-info">
                        <span class="fw-semibold text-dark">{{ $item->user->nickname ?? 'Funcionario' }}</span>
                        @if($item->user)
                            <small class="text-muted d-block">{{ $item->user->email ?? '' }}</small>
                        @endif
                    </div>
                </td>
                <td class="text-center corporate-cell" style="width: 8%;">
                    <div class="response-indicator">
                        <span class="response-count">{{ $item->eventResponses->count() }}</span>
                        <i class="fas fa-comment-dots ms-1 text-muted"></i>
                    </div>
                </td>
                <td class="text-center corporate-cell" style="width: 8%;">
                    <a href="{{ route('sstsena.' . $section['route_prefix'] . '.responses.index', $item->id) }}"
                       class="corporate-btn">
                        <i class="fas fa-folder-open me-2"></i>
                        <span>Revisar Caso</span>
                    </a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="11" class="text-center py-5">
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
    </tbody>
@else
    {{-- Keep the existing table for other sections (Emergencias, Comportamientos) --}}
    <thead>
        <tr class="corporate-header-row">
            <th class="corporate-th">
                <div class="th-content">
                    <i class="fas fa-hashtag me-2"></i>
                    <span>ID</span>
                </div>
            </th>
            <th class="corporate-th">
                <div class="th-content">
                    <i class="fas fa-calendar-alt me-2"></i>
                    <span>Fecha y Hora</span>
                </div>
            </th>
            <th class="corporate-th">
                <div class="th-content">
                    <i class="fas fa-file-alt me-2"></i>
                    <span>Descripción</span>
                </div>
            </th>
            <th class="corporate-th">
                <div class="th-content">
                    <i class="fas fa-thermometer-half me-2"></i>
                    <span>Nivel de Gravedad</span>
                </div>
            </th>
            <th class="corporate-th text-center">
                <div class="th-content justify-content-center">
                    <i class="fas fa-comments me-2"></i>
                    <span>Respuestas</span>
                </div>
            </th>
            <th class="corporate-th text-center">
                <div class="th-content justify-content-center">
                    <i class="fas fa-tools me-2"></i>
                    <span>Acciones</span>
                </div>
            </th>
        </tr>
    </thead>
    <tbody>
        @forelse ($section['items'] as $itemIndex => $item)
            <tr class="corporate-row">
                <td class="corporate-cell">
                    <div class="reference-id">
                        <span class="fw-bold" style="color: {{ $section['color'] }};">
                            #{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}
                        </span>
                    </div>
                </td>
                <td class="corporate-cell">
                    <div class="datetime-info">
                        <div class="fw-semibold text-dark">{{ $item->date_time->format('d M Y') }}</div>
                        <small class="text-muted">
                            <i class="fas fa-clock me-1"></i>{{ $item->date_time->format('H:i') }}
                        </small>
                    </div>
                </td>
                <td class="corporate-cell">
                    <div class="description-content">
                        <p class="mb-0 text-dark lh-sm expandable-text" id="description-{{ $section['route_prefix'] }}-{{ $item->id }}"
                           style="max-height: 3em; overflow: hidden; transition: max-height 0.3s ease;">
                            {{ $item->description ?? 'Sin descripción disponible' }}
                        </p>
                        @if(strlen($item->description ?? '') > 65)
                            <small class="text-muted mt-1 d-block toggle-text" onclick="toggleText('description-{{ $section['route_prefix'] }}-{{ $item->id }}')">
                                <i class="fas fa-chevron-down me-1 toggle-icon"></i>
                                <span class="toggle-label">Mostrar más</span>
                            </small>
                        @endif
                    </div>
                </td>
                <td class="corporate-cell">
                    @switch($item->severity)
                        @case('minor')
                            <span class="severity-badge severity-low">
                                <div class="severity-indicator"></div>
                                <span>Leve</span>
                            </span>
                        @break
                        @case('moderate')
                            <span class="severity-badge severity-medium">
                                <div class="severity-indicator"></div>
                                <span>Moderada</span>
                            </span>
                        @break
                        @case('serious')
                            <span class="severity-badge severity-high">
                                <div class="severity-indicator"></div>
                                <span>Grave</span>
                            </span>
                        @break
                        @case('fatal')
                            <span class="severity-badge severity-critical">
                                <div class="severity-indicator"></div>
                                <span>Fatal</span>
                            </span>
                        @break
                        @default
                            <span class="severity-badge severity-pending">
                                <div class="severity-indicator"></div>
                                <span>En Revisión</span>
                            </span>
                    @endswitch
                </td>
                <td class="text-center corporate-cell">
                    <div class="response-indicator">
                        <span class="response-count">{{ $item->eventResponses->count() }}</span>
                        <i class="fas fa-comment-dots ms-1 text-muted"></i>
                    </div>
                </td>
                <td class="text-center corporate-cell">
                    <a href="{{ route('sstsena.' . $section['route_prefix'] . '.responses.index', $item->id) }}"
                       class="corporate-btn">
                        <i class="fas fa-folder-open me-2"></i>
                        <span>Revisar Caso</span>
                    </a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center py-5">
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
    </tbody>
@endif