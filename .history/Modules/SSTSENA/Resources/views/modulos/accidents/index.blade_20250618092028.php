@section('content')
<div class="container-fluid py-4">
    {{-- Success alert modal --}}
    @if (session('success'))
        <div id="successModal" class="modal-confirm">
            <!-- Mantener mismo modal de éxito -->
        </div>
    @endif

    <div class="row g-4">
        <!-- Sección Accidentes -->
        <div class="col-12 section-item">
            <div class="corporate-card border-0 shadow-sm">
                {{-- Encabezado con nuevo diseño --}}
                <div class="section-header" style="border-left: 4px solid #FF8C00;">
                    <div class="section-content d-flex justify-content-between align-items-center py-4 px-4">
                        <div class="d-flex align-items-center">
                            <div class="section-icon me-4" style="background-color: #FF8C0015;">
                                <i class="fas fa-exclamation-triangle fa-lg" style="color: #FF8C00;"></i>
                            </div>
                            <div>
                                <h4 class="mb-1 fw-semibold text-dark">Listado de Accidentes</h4>
                                <small class="text-muted">Registro de incidentes</small>
                            </div>
                        </div>
                        <div class="stats-container">
                            <div class="stats-number">{{ $accidents->count() }}</div>
                            <div class="stats-label">Registros</div>
                        </div>
                    </div>
                </div>

                {{-- Botones y tabla --}}
                <div class="px-4 py-3">
                    <div class="d-flex justify-content-center gap-3 mb-4">
                        <a href="{{ route('sstsena.funcionario.accidents.create') }}" class="corporate-btn">
                            <i class="fas fa-plus-circle me-2"></i>Agregar Accidente
                        </a>
                        <button class="corporate-btn" data-bs-toggle="modal" data-bs-target="#agregarPersonaModal">
                            <i class="fas fa-user-plus me-2"></i>Agregar Involucrados
                        </button>
                    </div>

                    {{-- Tabla con estilos actualizados --}}
                    <div class="corporate-table">
                        <table class="table table-hover mb-0">
                            <thead class="corporate-table-header">
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
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Mantener misma lógica de iteración --}}
                                @forelse ($accidents as $accident)
                                <tr>
                                    {{-- Campos existentes sin cambios --}}
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $accident->date_time }}</td>
                                    <td>{{ $accident->environment->name ?? 'N/A' }}</td>
                                    <td>{{ $accident->injuryType->name ?? 'N/A' }}</td>
                                    <td>{{ $accident->riskType->name ?? 'N/A' }}</td>
                                    <td>{{ $accident->accidentType->name ?? 'N/A' }}</td>
                                    <td>{{ $accident->description }}</td>
                                    
                                    {{-- Gravedad (mantener lógica original) --}}
                                    <td>
                                        <span class="badge 
                                            @if($accident->severity == 'Minor') bg-success
                                            @elseif($accident->severity == 'Moderate') bg-warning
                                            @elseif($accident->severity == 'Serious') bg-danger
                                            @elseif($accident->severity == 'Fatal') bg-dark @endif">
                                            {{ ucfirst($accident->severity) }}
                                        </span>
                                    </td>
                                    
                                    {{-- Evidencia (sin cambios) --}}
                                    <td class="text-center align-middle">
                                        @if($accident->evidence)
                                            {{-- Lógica original de visualización --}}
                                        @else
                                            <span class="text-muted">Sin evidencia</span>
                                        @endif
                                    </td>
                                    
                                    <td>{{ $accident->user->nickname ?? 'Desconocido' }}</td>
                                    
                                    {{-- Acciones (mantener rutas originales) --}}
                                    <td class="action-buttons">
                                        <a href="{{ route('sstsena.funcionario.accidents.edit', $accident->id) }}" 
                                           class="btn btn-sm btn-outline-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('sstsena.funcionario.accidents.destroy', $accident->id) }}" 
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="11" class="text-center text-muted py-4">
                                        No hay accidentes registrados
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
</div>

<!-- Mantener modales existentes sin cambios -->
@endsection
