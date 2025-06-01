@extends('sstsena::layouts.master')
@section('content')
<div class="card shadow-sm rounded-3 mb-4" style="background-color: #077ef5;">
    <div class="card shadow-sm rounded-3" style="background-color: #ffffff;">
        <div class="card-header d-flex justify-content-between align-items-center" style="background-color: #f8f9fa; border-bottom: 1px solid #dee2e6;">
            <h3 class="text-center m-0" style="color: #1a3c6e; font-weight: 600;">Lista de Emergencias</h3>
            
        </div>
    <table class="table table-bordered table-hover shadow-sm bg-white">
        <thead class="bg-light">
            <tr>
                <th>ID</th>
                <th>Fecha y Hora</th>
                <th>Ubicacion</th>
                <th>Tipo de Riesgo</th>
                <th>Tipo de Emergencia</th>
                <th>Descripción</th>
                <th>Gravedad</th>
                <th>Evidencia</th>
                <th>Creado por</th>
                <th>Acciones</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($emergency as $emergency)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $emergency->date_time }}</td>
                <td>{{ $emergency->environment->name ?? 'N/A' }}</td>
                <td>{{ $emergency->riskType->name ?? 'N/A' }}</td>
                <td>{{ $emergency->emergencyType->name ?? 'N/A' }}</td>
                <td>{{ $emergency->description }}</td>
                <td>
                    <span class="badge @switch($emergency->severity)
                            @case('minor') bg-success @break
                            @case('moderate') bg-warning text-dark @break
                            @case('serious') bg-danger @break
                            @case('fatal') bg-dark @break
                        @endswitch">
                        {{ ucfirst($emergency->severity) }}
                    </span>
                </td> <!-- CIERRO EL TD DE GRAVEDAD AQUÍ -->

                <td class="text-center align-middle">
                    @if($emergency->evidence)
                    @php
                    $ext = strtolower(pathinfo($emergency->evidence, PATHINFO_EXTENSION));
                    $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                    $isImage = in_array($ext, $imageExtensions);
                    $modalId = 'incidentEvidenceModal' . $emergency->id;
                    @endphp

                    @if($isImage)
                    <!-- Imagen pequeña con botón para abrir el modal -->
                    <a href="#" data-bs-toggle="modal" data-bs-target="#{{ $modalId }}">
                        <img src="{{ asset('storage/evidences/' . $emergency->evidence) }}"
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
                                    <img src="{{ asset('storage/evidences/' . $emergency->evidence) }}"
                                        alt="Evidencia"
                                        class="img-fluid rounded"
                                        style="max-block-size: 600px; object-fit: contain;">
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <!-- Botón para ver archivo no imagen -->
                    <a href="{{ asset('storage/evidences/' . $emergency->evidence) }}"
                        class="btn btn-sm btn-primary"
                        target="_blank">
                        Ver archivo
                    </a>
                    @endif
                    @else
                    <span class="text-muted">Sin evidencia</span>
                    @endif
                </td>


                <td>{{ $emergency->user->nickname ?? 'Desconocido' }}</td>
                <td class="d-flex gap-1">
                    <a href="{{ route('sstsena.funcionario.emergencies.edit', $emergency->id) }}" class="btn btn-sm btn-outline-success">Editar</a>
                </td>
                <td>
                    <form action="{{ route('sstsena.funcionario.emergencies.destroy', $emergency->id) }}" method="POST" onsubmit="return confirm('¿Eliminar este incidente?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                    </form>

                </td>
            </tr>
            @empty
            <tr>
                <td colspan="10" class="text-center text-muted">No hay Emergencias registradas.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

</div>
@endsection