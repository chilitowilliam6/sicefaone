@extends('sstsena::layouts.master')
@section('content')
<div class="card shadow-sm rounded-3 mb-4" style="background-color: #077ef5;">
    <div class="card shadow-sm rounded-3" style="background-color: #ffffff;">
        <div class="card-header d-flex justify-content-between align-items-center" style="background-color: #f8f9fa; border-bottom: 1px solid #dee2e6;">
            <h3 class="text-center m-0" style="color: #1a3c6e; font-weight: 600;">Lista de Actos Inseguros</h3>

        </div>
    <table class="table table-bordered table-hover shadow-sm bg-white">
        <thead class="bg-light">
            <tr>
                <th>ID</th>
                <th>Fecha y Hora</th>
                <th>Ubicacion</th>
                <th>Tipo de Riesgo</th>
                <th>Tipo de acto inseguro</th>
                <th>Descripción</th>
                <th>Gravedad</th>
                <th>Evidencia</th>
                <th>Creado por</th>
                <th>Acciones</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($unsafe_acts as $unsafe_act)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $unsafe_act->date_time }}</td>
                <td>{{ $unsafe_act->environment->name ?? 'N/A' }}</td>
                <td>{{ $unsafe_act->riskType->name ?? 'N/A' }}</td>
                <td>{{ $unsafe_act->unsafeActType->name ?? 'N/A' }}</td>
                <td>{{ $unsafe_act->description }}</td>
                <td>
                    <span class="badge @switch($unsafe_act->severity)
                            @case('minor') bg-success @break
                            @case('moderate') bg-warning text-dark @break
                            @case('serious') bg-danger @break
                            @case('fatal') bg-dark @break
                        @endswitch">
                        {{ ucfirst($unsafe_act->severity) }}
                    </span>
                </td> <!-- CIERRO EL TD DE GRAVEDAD AQUÍ -->

                <td class="text-center align-middle">
                    @if($unsafe_act->evidence)
                    @php
                    $ext = strtolower(pathinfo($unsafe_act->evidence, PATHINFO_EXTENSION));
                    $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                    $isImage = in_array($ext, $imageExtensions);
                    $modalId = 'incidentEvidenceModal' . $unsafe_act->id;
                    @endphp

                    @if($isImage)
                    <!-- Imagen pequeña con botón para abrir el modal -->
                    <a href="#" data-bs-toggle="modal" data-bs-target="#{{ $modalId }}">
                        <img src="{{ asset('storage/' . $unsafe_act->evidence) }}"
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
                                    <img src="{{ asset('storage/' . $unsafe_act->evidence) }}"
                                        alt="Evidencia"
                                        class="img-fluid rounded"
                                        style="max-block-size: 600px; object-fit: contain;">
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <!-- Botón para ver archivo no imagen -->
                    <a href="{{ asset('storage/' . $unsafe_act->evidence) }}"
                        class="btn btn-sm btn-primary"
                        target="_blank">
                        Ver archivo
                    </a>
                    @endif
                    @else
                    <span class="text-muted">Sin evidencia</span>
                    @endif
                </td>


                <td>{{ $unsafe_act->user->person->name ?? 'Desconocido' }}</td>
                <td class="d-flex gap-1">
                    <a href="{{ route('sstsena.funcionario.unsafe_acts.edit', $unsafe_act->id) }}" class="btn btn-sm btn-outline-success">Editar</a>
                </td>
                <td>
                    <form action="{{ route('sstsena.funcionario.unsafe_acts.destroy', $unsafe_act->id) }}" method="POST" onsubmit="return confirm('¿Eliminar este incidente?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                    </form>

                </td>
            </tr>
            @empty
            <tr>
                <td colspan="10" class="text-center text-muted">No hay Actos Inseguros registrados.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

</div>
@endsection
