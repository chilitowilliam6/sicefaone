@extends('sstsena::layouts.master')
@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Lista de Incidentes</h2>
    <table class="table table-bordered table-hover shadow-sm bg-white">
        <thead class="bg-light">
            <tr>
                <th>ID</th>
                <th>Fecha y Hora</th>
                <th>Ubicacion</th>
                <th>Tipo de Riesgo</th>
                <th>Tipo de Incidente</th>
                <th>Descripción</th>
                <th>Gravedad</th>
                <th>Evidencia</th>
                <th>Creado por</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($incidents as $incident)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $incident->date_time }}</td>
                <td>{{ $incident->environment->name ?? 'N/A' }}</td>
                <td>{{ $incident->riskType->name ?? 'N/A' }}</td>
                <td>{{ $incident->incidentType->name ?? 'N/A' }}</td>
                <td>{{ $incident->description }}</td>
                <td>
                    <span class="badge @switch($incident->severity)
                            @case('minor') bg-success @break
                            @case('moderate') bg-warning text-dark @break
                            @case('serious') bg-danger @break
                            @case('fatal') bg-dark @break
                        @endswitch">
                        {{ ucfirst($incident->severity) }}
                    </span>
                </td> <!-- CIERRO EL TD DE GRAVEDAD AQUÍ -->

                <td class="text-center align-middle">
                    @if($incident->evidence)
                    @php
                    $ext = strtolower(pathinfo($incident->evidence, PATHINFO_EXTENSION));
                    $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                    $isImage = in_array($ext, $imageExtensions);
                    $modalId = 'incidentEvidenceModal' . $incident->id;
                    @endphp

                    @if($isImage)
                    <!-- Imagen pequeña con botón para abrir el modal -->
                    <a href="#" data-bs-toggle="modal" data-bs-target="#{{ $modalId }}">
                        <img src="{{ asset('storage/evidences/' . $incident->evidence) }}"
                            alt="Evidencia"
                            class="img-thumbnail"
                            style="inline-size: 60px; block-size: 60px; object-fit: cover;">
                    </a>

                    <!-- Modal para mostrar imagen más grande -->
                    <div class="modal fade" id="{{ $modalId }}" tabindex="-1" aria-labelledby="{{ $modalId }}Label" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <br>
                                <div class="modal-header">
                                    <h5 class="modal-title" id="{{ $modalId }}Label">Evidencia</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                </div>
                                <div class="modal-body text-center">
                                    <img src="{{ asset('storage/evidences/' . $incident->evidence) }}"
                                        alt="Evidencia"
                                        class="img-fluid rounded"
                                        style="max-block-size: 600px; object-fit: contain;">
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <!-- Botón para ver archivo no imagen -->
                    <a href="{{ asset('storage/evidences/' . $incident->evidence) }}"
                        class="btn btn-sm btn-primary"
                        target="_blank">
                        Ver archivo
                    </a>
                    @endif
                    @else
                    <span class="text-muted">Sin evidencia</span>
                    @endif
                </td>


                <td>{{ $incident->user->nickname ?? 'Desconocido' }}</td>
                <td class="d-flex gap-1">
                    <a href="{{ route('sstsena.funcionario.incidents.edit', $incident->id) }}" class="btn btn-sm btn-outline-success">Editar</a>
                    <form action="{{ route('sstsena.funcionario.incidents.destroy', $incident->id) }}" method="POST" onsubmit="return confirm('¿Eliminar este incidente?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="10" class="text-center text-muted">No hay incidentes registrados.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection