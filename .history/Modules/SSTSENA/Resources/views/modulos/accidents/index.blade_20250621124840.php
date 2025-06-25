@extends('sstsena::layouts.master')

@section('content')
<h2 class="text-uppercase fw-bold text-center text-primary-emphasis mb-4">
    <i class="bi bi-hospital-fill me-2"></i> Lista de Accidentes
</h2>

<div class="card border-0 shadow rounded-4 p-4 bg-white mb-5">
    <div class="row align-items-center">
        <div class="col-md-6 d-flex align-items-center mb-3 mb-md-0">
            <div class="bg-primary text-white rounded-circle d-flex justify-content-center align-items-center me-3" style="width: 50px; height: 50px;">
                <i class="bi bi-bar-chart-fill fs-4"></i>
            </div>
            <div>
                <h6 class="mb-0 text-dark fw-semibold">Total de Registros</h6>
                <span class="fs-4 fw-bold text-primary">{{ $accidents->count() }}</span>
            </div>
        </div>
        <div class="col-md-6 d-flex justify-content-start justify-content-md-end gap-2">
            <a href="{{ route('sstsena.funcionario.accidents.create') }}" class="btn btn-outline-success btn-lg fw-semibold shadow-sm">
                <i class="bi bi-file-earmark-plus-fill me-1"></i> Nuevo Accidente
            </a>
            <button class="btn btn-outline-primary btn-lg fw-semibold shadow-sm" data-bs-toggle="modal" data-bs-target="#agregarPersonaModal">
                <i class="bi bi-people-fill me-1"></i> Personas Involucradas
            </button>
        </div>
    </div>
</div>

{{-- Modal Personas Involucradas --}}
@include('sstsena::partials.modal_persona_involucrada') {{-- Puedes mover aquí tu modal para ordenarlo mejor --}}

<div class="container-fluid px-0">
    <div class="table-responsive shadow rounded-4">
        <table class="table table-hover table-bordered align-middle mb-0" style="background-color: #ffffff;">
            <thead class="table-light text-center">
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
                    <th colspan="2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($accidents as $accident)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $accident->date_time }}</td>
                    <td>{{ $accident->environment->name ?? 'N/A' }}</td>
                    <td>{{ $accident->injuryType->name ?? 'N/A' }}</td>
                    <td>{{ $accident->riskType->name ?? 'N/A' }}</td>
                    <td>{{ $accident->accidentType->name ?? 'N/A' }}</td>
                    <td>{{ $accident->description }}</td>
                    <td class="text-center">
                        <span class="badge 
                            @if($accident->severity == 'Minor') bg-success 
                            @elseif($accident->severity == 'Moderate') bg-warning text-dark 
                            @elseif($accident->severity == 'Serious') bg-danger 
                            @elseif($accident->severity == 'Fatal') bg-dark 
                            @endif
                            fw-semibold px-3 py-2">
                            {{ ucfirst($accident->severity) }}
                        </span>
                    </td>
                    <td class="text-center">
                        @if($accident->evidence)
                            @php
                                $ext = strtolower(pathinfo($accident->evidence, PATHINFO_EXTENSION));
                                $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                                $isImage = in_array($ext, $imageExtensions);
                                $modalId = 'evidenceModal' . $accident->id;
                            @endphp

                            @if($isImage)
                                <a href="#" data-bs-toggle="modal" data-bs-target="#{{ $modalId }}">
                                    <img src="{{ asset('storage/evidences/' . $accident->evidence) }}" alt="Evidencia" class="img-thumbnail" style="width: 50px; height: 50px; object-fit: cover;">
                                </a>

                                <!-- Modal -->
                                <div class="modal fade" id="{{ $modalId }}" tabindex="-1" aria-labelledby="{{ $modalId }}Label" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="{{ $modalId }}Label">Evidencia</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <img src="{{ asset('storage/evidences/' . $accident->evidence) }}" alt="Evidencia" class="img-fluid rounded">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <a href="{{ asset('storage/evidences/' . $accident->evidence) }}" class="btn btn-sm btn-outline-primary" target="_blank">
                                    Ver archivo
                                </a>
                            @endif
                        @else
                            <span class="text-muted">Sin evidencia</span>
                        @endif
                    </td>
                    <td>{{ $accident->user->nickname ?? 'Desconocido' }}</td>
                    <td class="text-center">
                        <a href="{{ route('sstsena.funcionario.accidents.edit', $accident->id) }}" class="btn btn-sm btn-outline-success">
                            <i class="bi bi-pencil-square"></i> Editar
                        </a>
                    </td>
                    <td class="text-center">
                        <form action="{{ route('sstsena.funcionario.accidents.destroy', $accident->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este accidente?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-trash-fill"></i> Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="12" class="text-center text-muted py-4">
                        <i class="bi bi-clipboard-x fs-4 me-2"></i> No hay accidentes registrados.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
