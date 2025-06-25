@extends('sstsena::layouts.master')

@section('content')
<style>
    .events-dashboard {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        padding: 2rem 0;
    }
    
    .dashboard-header {
        background: rgba(255,255,255,0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        border: 1px solid rgba(255,255,255,0.2);
    }
    
    .dashboard-title {
        color: #2d3748;
        font-weight: 700;
        font-size: 2.5rem;
        margin: 0;
        background: linear-gradient(135deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        text-align: center;
    }
    
    .event-card {
        background: rgba(255,255,255,0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        margin-bottom: 2rem;
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        border: 1px solid rgba(255,255,255,0.2);
        overflow: hidden;
        transition: all 0.3s ease;
    }
    
    .event-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 30px 60px rgba(0,0,0,0.15);
    }
    
    .event-header {
        padding: 1.5rem 2rem;
        border-bottom: 1px solid rgba(0,0,0,0.1);
        position: relative;
    }
    
    .event-title {
        font-size: 1.5rem;
        font-weight: 600;
        margin: 0;
        color: #2d3748;
    }
    
    .event-icon {
        position: absolute;
        right: 2rem;
        top: 50%;
        transform: translateY(-50%);
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.2rem;
    }
    
    .accidents-icon { background: linear-gradient(135deg, #ff6b6b, #ee5a52); }
    .incidents-icon { background: linear-gradient(135deg, #ffa726, #ff9800); }
    .emergencies-icon { background: linear-gradient(135deg, #ef5350, #e53935); }
    .unsafe-acts-icon { background: linear-gradient(135deg, #42a5f5, #1e88e5); }
    
    .modern-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }
    
    .modern-table th {
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        color: #495057;
        font-weight: 600;
        padding: 1rem;
        text-align: left;
        border: none;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .modern-table td {
        padding: 1rem;
        border: none;
        border-bottom: 1px solid rgba(0,0,0,0.05);
        color: #495057;
        transition: background-color 0.2s ease;
    }
    
    .modern-table tbody tr:hover td {
        background-color: rgba(102, 126, 234, 0.05);
    }
    
    .severity-badge {
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 500;
        text-transform: capitalize;
    }
    
    .severity-alta { background: rgba(239, 83, 80, 0.1); color: #e53935; }
    .severity-media { background: rgba(255, 167, 38, 0.1); color: #ff9800; }
    .severity-baja { background: rgba(76, 175, 80, 0.1); color: #4caf50; }
    
    .action-btn {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 500;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
    }
    
    .action-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        color: white;
        text-decoration: none;
    }
    
    .empty-state {
        text-align: center;
        padding: 3rem;
        color: #6c757d;
        font-style: italic;
    }
    
    .success-alert {
        background: rgba(76, 175, 80, 0.1);
        border: 1px solid rgba(76, 175, 80, 0.2);
        color: #2e7d32;
        padding: 1rem;
        border-radius: 10px;
        margin-bottom: 2rem;
    }
    
    .response-count {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        padding: 0.25rem 0.5rem;
        border-radius: 15px;
        font-size: 0.8rem;
        font-weight: 600;
        min-width: 25px;
        text-align: center;
        display: inline-block;
    }
</style>

<div class="events-dashboard">
    <div class="container">
        <div class="dashboard-header">
            <h1 class="dashboard-title">Sistema de Gestión de Eventos SST</h1>
        </div>

        @if (session('success'))
            <div class="success-alert">
                {{ session('success') }}
            </div>
        @endif

        <!-- Accidentes -->
        <div class="event-card">
            <div class="event-header">
                <h2 class="event-title">Accidentes</h2>
                <div class="event-icon accidents-icon">⚠️</div>
            </div>
            <table class="modern-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Fecha y Hora</th>
                        <th>Descripción</th>
                        <th>Severidad</th>
                        <th>Respuestas</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($accidents as $accident)
                        <tr>
                            <td><strong>#{{ $accident->id }}</strong></td>
                            <td>{{ $accident->date_time->format('Y-m-d H:i:s') }}</td>
                            <td>{{ $accident->description ?? 'Sin descripción' }}</td>
                            <td><span class="severity-badge severity-{{ strtolower($accident->severity) }}">{{ ucfirst($accident->severity) }}</span></td>
                            <td><span class="response-count">{{ $accident->eventResponses->count() }}</span></td>
                            <td>
                                <a href="{{ route('sstsena.accidents.responses.index', $accident->id) }}" class="action-btn">Ver Respuestas</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="empty-state">No se encontraron accidentes registrados</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Incidentes -->
        <div class="event-card">
            <div class="event-header">
                <h2 class="event-title">Incidentes</h2>
                <div class="event-icon incidents-icon">🔍</div>
            </div>
            <table class="modern-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Fecha y Hora</th>
                        <th>Descripción</th>
                        <th>Severidad</th>
                        <th>Respuestas</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($incidents as $incident)
                        <tr>
                            <td><strong>#{{ $incident->id }}</strong></td>
                            <td>{{ $incident->date_time->format('Y-m-d H:i:s') }}</td>
                            <td>{{ $incident->description ?? 'Sin descripción' }}</td>
                            <td><span class="severity-badge severity-{{ strtolower($incident->severity) }}">{{ ucfirst($incident->severity) }}</span></td>
                            <td><span class="response-count">{{ $incident->eventResponses->count() }}</span></td>
                            <td>
                                <a href="{{ route('sstsena.incidents.responses.index', $incident->id) }}" class="action-btn">Ver Respuestas</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="empty-state">No se encontraron incidentes registrados</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Emergencias -->
        <div class="event-card">
            <div class="event-header">
                <h2 class="event-title">Emergencias</h2>
                <div class="event-icon emergencies-icon">🚨</div>
            </div>
            <table class="modern-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Fecha y Hora</th>
                        <th>Descripción</th>
                        <th>Severidad</th>
                        <th>Respuestas</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($emergencies as $emergency)
                        <tr>
                            <td><strong>#{{ $emergency->id }}</strong></td>
                            <td>{{ $emergency->date_time->format('Y-m-d H:i:s') }}</td>
                            <td>{{ $emergency->description ?? 'Sin descripción' }}</td>
                            <td><span class="severity-badge severity-{{ strtolower($emergency->severity) }}">{{ ucfirst($emergency->severity) }}</span></td>
                            <td><span class="response-count">{{ $emergency->eventResponses->count() }}</span></td>
                            <td>
                                <a href="{{ route('sstsena.emergencies.responses.index', $emergency->id) }}" class="action-btn">Ver Respuestas</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="empty-state">No se encontraron emergencias registradas</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Actos Inseguros -->
        <div class="event-card">
            <div class="event-header">
                <h2 class="event-title">Actos Inseguros</h2>
                <div class="event-icon unsafe-acts-icon">🛡️</div>
            </div>
            <table class="modern-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Fecha y Hora</th>
                        <th>Descripción</th>
                        <th>Severidad</th>
                        <th>Respuestas</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($unsafeActs as $unsafeAct)
                        <tr>
                            <td><strong>#{{ $unsafeAct->id }}</strong></td>
                            <td>{{ $unsafeAct->date_time->format('Y-m-d H:i:s') }}</td>
                            <td>{{ $unsafeAct->description ?? 'Sin descripción' }}</td>
                            <td><span class="severity-badge severity-{{ strtolower($unsafeAct->severity) }}">{{ ucfirst($unsafeAct->severity) }}</span></td>
                            <td><span class="response-count">{{ $unsafeAct->eventResponses->count() }}</span></td>
                            <td>
                                <a href="{{ route('sstsena.unsafe_acts.responses.index', $unsafeAct->id) }}" class="action-btn">Ver Respuestas</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="empty-state">No se encontraron actos inseguros registrados</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection