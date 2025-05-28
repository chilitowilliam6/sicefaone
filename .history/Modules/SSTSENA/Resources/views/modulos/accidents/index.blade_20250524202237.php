@extends('sstsena::layouts.master')
@section('content')
<table class="table table-dark table-striped table-hover rounded shadow">
    <thead class="thead-light">
        <tr>
            <th>#</th>
            <th>Fecha y hora</th>
            <th>Ambiente</th>
            <th>Tipo de lesión</th>
            <th>Tipo de riesgo</th>
            <th>Tipo de accidente</th>
            <th>Descripción</th>
            <th>Gravedad</th>
            <th>Evidencia</th>
        </tr>
    </thead>
    <tbody>
        @forelse($environmets as $accident)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $accident->date_time }}</td>
                <td>{{ $accident->environment->name ?? 'N/A' }}</td>
                <td>{{ $accident->injuryType->name ?? 'N/A' }}</td>
                <td>{{ $accident->riskType->name ?? 'N/A' }}</td>
                <td>{{ $accident->accidentType->name ?? 'N/A' }}</td>
                <td>{{ $accident->description }}</td>
                <td>
                    <span class="badge 
                        @if($accident->severity == 'minor') bg-success
                        @elseif($accident->severity == 'moderate') bg-warning
                        @elseif($accident->severity == 'serious') bg-danger
                        @elseif($accident->severity == 'fatal') bg-dark
                        @endif">
                        {{ ucfirst($accident->severity) }}
                    </span>
                </td>
                <td>
                    @if ($accident->evidence)
                        <a href="{{ asset('storage/' . $accident->evidence) }}" target="_blank" class="btn btn-outline-info btn-sm">
                            Ver archivo
                        </a>
                    @else
                        <span class="text-muted">No hay</span>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="9" class="text-center text-muted">No hay accidentes registrados.</td>
            </tr>
        @endforelse
    </tbody>
</table>

