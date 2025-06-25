@extends('sstsena::layouts.master')

@section('content')
<div class="container-fluid py-4">

    {{-- Título y botones --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Lista de Accidentes</h2>
        <div class="d-flex gap-3">
            <a href="{{ route('sstsena.funcionario.accidents.create') }}" class="btn btn-success">
                <i class="fas fa-plus-circle me-2"></i> Agregar Accidente
            </a>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregarPersonaModal">
                <i class="fas fa-user-plus me-2"></i> Agregar Personas Involucradas
            </button>
        </div>
    </div>

    {{-- Modal Crear Persona Involucrada (sin cambios) --}}
    <div class="modal fade" id="agregarPersonaModal" tabindex="-1" aria-labelledby="agregarPersonaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <!-- contenido modal sin cambios -->
                <div class="modal-header bg-light">
                    <h5 class="modal-title text-primary" id="agregarPersonaModalLabel">Crear Persona Involucrada</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('sstsena.funcionario.people_involved.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <!-- Tus campos aquí -->
                            <!-- ... (mantén igual tu formulario) ... -->
                        </div>
                        <div class="text-center mt-3">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Lista de Accidentes con diseño inspirado en ejemplo --}}
    <div class="row g-4">
        <div class="col-12">
            <div class="corporate-card border-0 shadow-sm mb-4">
                <div class="section-header d-flex justify-content-between align-items-center" style="border-left: 4px solid #34495e;">
                    <div class="d-flex align-items-center py-3 px-4 w-100">
                        <div class="section-icon me-3 bg-primary bg-opacity-10 rounded p-2">
                            <i class="fas fa-exclamation-triangle fa-lg" style="color:#34495e;"></i>
                        </div>
                        <div>
                            <h4 class="mb-1 fw-semibold text-dark">Lista de Accidentes</h4>
                            <small class="text-muted">Gestión de Accidentes Registrados</small>
                        </div>
                        <div class="ms-auto d-flex align-items-center gap-3">
                            <span class="text-muted small">Total: <strong>{{ $accidents->count() }}</strong></span>
                        </div>
                    </div>
                </div>

                {{-- Tabla de accidentes --}}
                <div class="table-responsive px-4 pb-4">
                    <table class="table table-hover mb-0 align-middle" style="background-color: #fff;">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" style="width: 3%;"></th>
                                <th scope="col" style="width: 12%;">Fecha y Hora</th>
                                <th scope="col" style="width: 15%;">Ubicación</th>
                                <th scope="col" style="width: 10%;">Tipo de Lesión</th>
                                <th scope="col" style="width: 10%;">Tipo de Riesgo</th>
                                <th scope="col" style="width: 10%;">Tipo de Accidente</th>
                                <th scope="col" style="width: 20%;">Descripción</th>
                                <th scope="col" style="width: 8%;">Gravedad</th>
                                <th scope="col" style="width: 8%;">Evidencia</th>
                                <th scope="col" style="width: 9%;">Creado por</th>
                                <th scope="col" style="width: 8%;" colspan="2" class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($accidents as $accident)
                            <tr class="border-bottom">
                                <td>
                                    <div class="reference-id">{{ $loop->iteration }}</div>
                                </td>
                                <td>
                                    <div>
                                        <div class="fw-semibold text-dark">{{ $accident->date_time }}</div>
                                        <small class="text-muted">{{ $accident->environment->name ?? 'N/A' }}</small>
                                    </div>
                                </td>
                                <td>{{ $accident->environment->name ?? 'N/A' }}</td>
                                <td>{{ $accident->injuryType->name ?? 'N/A' }}</td>
                                <td>{{ $accident->riskType->name ?? 'N/A' }}</td>
                                <td>{{ $accident->accidentType->name ?? 'N/A' }}</td>
                                <td>
                                    <div class="description-content lh-sm" style="max-height: 3em; overflow: hidden;">
                                        {{ $accident->description }}
                                    </div>
                                    @if(strlen($accident->description) > 65)
                                    <small class="toggle-text text-primary fw-semibold" style="cursor:pointer;" onclick="toggleText('desc{{ $accident->id }}')">
                                        <i class="fas fa-chevron-down me-1 toggle-icon"></i> Mostrar más
                                    </small>
                                    <div id="desc{{ $accident->id }}" class="d-none">
                                        <p class="mb-0">{{ $accident->description }}</p>
                                    </div>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge 
                                        @if($accident->severity == 'Minor') bg-success text-white
                                        @elseif($accident->severity == 'Moderate') bg-warning text-dark
                                        @elseif($accident->severity == 'Serious') bg-danger text-white
                                        @elseif($accident->severity == 'Fatal') bg-dark text-white
                                        @endif"
                                        style="padding: 0.3em 0.75em; border-radius: 0.25rem;">
                                        {{ ucfirst($accident->severity) }}
                                    </span>
                                </td>
                                <td class="text-center align-middle">
                                    @if($accident->evidence)
                                    @php
                                    $ext = strtolower(pathinfo($accident->evidence, PATHINFO_EXTENSION));
                                    $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                                    $isImage = in_array($ext, $imageExtensions);
                                    $modalId = 'evidenceModal' . $accident->id;
                                    @endphp

                                    @if($isImage)
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#{{ $modalId }}">
                                        <img src="{{ asset('storage/evidences/' . $accident->evidence) }}" alt="Evidencia" class="img-thumbnail" style="inline-size: 60px; block-size: 60px; object-fit: cover;">
                                    </a>
                                    <div class="modal fade" id="{{ $modalId }}" tabindex="-1" aria-labelledby="{{ $modalId }}Label" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content p-3">
                                                <div class="modal-header border-0 pb-2">
                                                    <h5 class="modal-title" id="{{ $modalId }}Label">Evidencia</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <img src="{{ asset('storage/evidences/' . $accident->evidence) }}" class="img-fluid rounded" style="max-height: 600px; object-fit: contain;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @else
                                    <a href="{{ asset('storage/evidences/' . $accident->evidence) }}" class="btn btn-sm btn-primary" target="_blank">
                                        Ver archivo
                                    </a>
                                    @endif
                                    @else
                                    <span class="text-muted">Sin evidencia</span>
                                    @endif
                                </td>
                                <td>{{ $accident->user->nickname ?? 'Desconocido' }}</td>
                                <td class="text-center align-middle">
                                    <a href="{{ route('sstsena.funcionario.accidents.edit', $accident->id) }}" class="btn btn-sm btn-outline-success me-2" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                                <td class="text-center align-middle">
                                    <form action="{{ route('sstsena.funcionario.accidents.destroy', $accident->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este accidente?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Eliminar">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="13" class="text-center py-4 text-muted">
                                    No hay accidentes registrados.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- Estilos para modernizar y hacer más visual --}}
<style>
/* Paleta de colores y estilos inspirados en ejemplo */
:root {
    --primary-color: #34495e;
    --secondary-color: #f8f9fa;
    --accent-color: #6c757d;
    --border-color: #dee2e6;
    --shadow: rgba(0, 0, 0, 0.05);
    --hover-bg: #f1f3f4;
    --text-color: #212529;
    --muted-color: #6c757d;
    --success-color: #28a745;
    --warning-color: #ffc107;
    --danger-color: #dc3545;
    --info-color: #17a2b8;
}

/* Cards y contenedores */
.corporate-card {
    background: #fff;
    border-radius: 8px;
    border: 1px solid var(--border-color);
    transition: box-shadow 0.3s, transform 0.3s;
}
.corporate-card:hover {
    box-shadow: 0 8px 20px var(--shadow);
    transform: translateY(-2px);
}

/* Encabezado de sección */
.section-header {
    background: var(--secondary-color);
    border-left: 4px solid var(--primary-color);
    padding: 0;
}

.section-header .d-flex {
    padding: 1rem 1.5rem;
}

.section-icon {
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: rgba(52, 152, 219, 0.1);
    border-radius: 8px;
}

.stats-container {
    margin-left: auto;
    text-align: right;
}

.stats-number {
    font-size: 1.5rem;
    font-weight: 700;
}

.stats-label {
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    color: var(--muted-color);
}

/* Tabla */
.table thead {
    background-color: #f8f9fa;
}
.table th {
    font-size: 0.75rem;
    font-weight: 600;
    color: var(--muted-color);
    text-transform: uppercase;
    padding: 0.75rem 1rem;
}
.table td {
    padding: 0.75rem 1rem;
    vertical-align: middle;
}
.reference-id {
    font-family: 'SF Mono', 'Courier New', monospace;
    font-weight: 600;
    font-size: 0.9rem;
    color: var(--primary-color);
}
.description-content {
    font-size: 0.85rem;
}
.toggle-text {
    cursor: pointer;
    font-size: 0.75rem;
    display: inline-flex;
    align-items: center;
    color: var(--primary-color);
}
.toggle-icon {
    margin-left: 0.25rem;
    transition: transform 0.3s;
}
.expanded .toggle-icon {
    transform: rotate(180deg);
}

/* Badge gravedad */
.severity-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5em;
    padding: 0.3em 0.75em;
    border-radius: 4px;
    font-weight: 600;
    font-size: 0.75rem;
    text-transform: uppercase;
}
.bg-success { background-color: #d4edda; color: #155724; }
.bg-warning { background-color: #fff3cd; color: #856404; }
.bg-danger { background-color: #f8d7da; color: #721c24; }
.bg-dark { background-color: #343a40; color: #fff; }

/* Botones de acción */
.btn {
    display: inline-flex;
    align-items: center;
    gap: 0.4em;
    font-size: 0.75rem;
    padding: 0.375em 0.75em;
    border-radius: 4px;
    font-weight: 600;
    transition: all 0.2s;
}
.btn-sm { font-size: 0.75rem; padding: 0.375em 0.75em; }
.btn-outline-success { border-color: #28a745; color: #28a745; }
.btn-outline-success:hover { background-color: #28a745; color: #fff; }
.btn-outline-danger { border-color: #dc3545; color: #dc3545; }
.btn-outline-danger:hover { background-color: #dc3545; color: #fff; }

/* Modal y confirmación */
</style>

{{-- Scripts para toggle y confirmación --}}
<script>
function toggleText(id) {
    const el = document.getElementById(id);
    const isHidden = el.classList.toggle('d-none');
    const icon = el.previousElementSibling.querySelector('.toggle-icon');
    if (isHidden) {
        icon.style.transform = 'rotate(0deg)';
        el.previousElementSibling.innerHTML = '<i class="fas fa-chevron-down me-1 toggle-icon"></i> Mostrar más';
    } else {
        icon.style.transform = 'rotate(180deg)';
        el.previousElementSibling.innerHTML = '<i class="fas fa-chevron-up me-1 toggle-icon"></i> Mostrar menos';
    }
}
</script>

@endsection