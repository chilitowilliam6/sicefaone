@extends('sstsena::layouts.master')
@section('content')

<!-- Título -->
<h2 class="text-center mb-4 fw-bold" style="color: #1a1a1a;">Lista de Accidentes</h2>

<!-- Botones de acción -->
<div class="text-center mb-4 d-flex justify-content-center gap-3 flex-wrap">
    <a href="{{ route('sstsena.funcionario.accidents.create') }}" class="btn btn-lg btn-success shadow-sm rounded-pill px-4">
        <i class="fas fa-plus-circle me-2"></i>Agregar Accidente
    </a>
    <button class="btn btn-lg btn-primary shadow-sm rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#agregarPersonaModal">
        <i class="fas fa-user-injured me-2"></i>Agregar Personas Involucradas
    </button>
</div>

@include('partials.modal-personas-involucradas', ['typePersons' => $typePersons ?? [], 'accidents' => $accidents ?? []])

<!-- Contenedor de tabla -->
<div class="container mt-4">
    <div class="table-responsive shadow rounded border">
        <table class="table table-hover align-middle mb-0 bg-white">
            <thead class="bg-light text-uppercase small font-weight-bold">
                <tr>
                    <th>#</th>
                    <th>Fecha y Hora</th>
                    <th>Ubicación</th>
                    <th>Tipo de Lesión</th>
                    <th>Tipo de Riesgo</th>
                    <th>Tipo de Accidente</th>
                    <th>Descripción</th>
                    <th>Gravedad</th>
                    <th>Evidencia</th>
                    <th>Creado por</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($accidents as $accident)
                <tr>
                    <td><strong>{{ $loop->iteration }}</strong></td>
                    <td>{{ $accident->date_time }}</td>
                    <td>{{ $accident->environment->name ?? 'N/A' }}</td>
                    <td>{{ $accident->injuryType->name ?? 'N/A' }}</td>
                    <td>{{ $accident->riskType->name ?? 'N/A' }}</td>
                    <td>{{ $accident->accidentType->name ?? 'N/A' }}</td>
                    <td class="text-truncate" style="max-width: 200px;">
                        {{ $accident->description }}
                    </td>
                    <td>
                        <span class="badge rounded-pill fs-6
                                @if($accident->severity == 'Minor') bg-success
                                @elseif($accident->severity == 'Moderate') bg-warning text-dark
                                @elseif($accident->severity == 'Serious') bg-danger
                                @elseif($accident->severity == 'Fatal') bg-dark
                                @endif">
                            {{ ucfirst($accident->severity) }}
                        </span>
                    </td>
                    <td class="text-center">
                        @if($accident->evidence)
                            @php
                                $ext = strtolower(pathinfo($accident->evidence, PATHINFO_EXTENSION));
                                $isImage = in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp']);
                                $modalId = 'evidenceModal' . $accident->id;
                            @endphp
                            @if($isImage)
                                <a href="#" data-bs-toggle="modal" data-bs-target="#{{ $modalId }}">
                                    <img src="{{ asset('storage/evidences/' . $accident->evidence) }}"
                                         alt="Evidencia"
                                         class="img-thumbnail shadow-sm"
                                         style="width: 60px; height: 60px; object-fit: cover;">
                                </a>
                                <!-- Modal Imagen -->
                                <div class="modal fade" id="{{ $modalId }}" tabindex="-1" aria-labelledby="{{ $modalId }}Label" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Evidencia del Accidente</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <img src="{{ asset('storage/evidences/' . $accident->evidence) }}"
                                                     alt="Evidencia Ampliada"
                                                     class="img-fluid rounded shadow"
                                                     style="max-height: 600px; object-fit: contain;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <a href="{{ asset('storage/evidences/' . $accident->evidence) }}"
                                   class="btn btn-sm btn-outline-primary"
                                   target="_blank">
                                    <i class="fas fa-file-alt me-1"></i>Ver Archivo
                                </a>
                            @endif
                        @else
                            <span class="text-muted">Sin evidencia</span>
                        @endif
                    </td>
                    <td>{{ $accident->user->nickname ?? 'Desconocido' }}</td>
                    <td>
                        <a href="{{ route('sstsena.funcionario.accidents.edit', $accident->id) }}"
                           class="btn btn-sm btn-outline-success rounded-circle">
                            <i class="fas fa-edit"></i>
                        </a>
                    </td>
                    <td>
                        <form action="{{ route('sstsena.funcionario.accidents.destroy', $accident->id) }}" method="POST"
                              onsubmit="return confirm('¿Estás seguro de eliminar este accidente?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="12" class="text-center py-4 text-muted">
                        <i class="fas fa-exclamation-triangle me-2"></i>No hay accidentes registrados.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection