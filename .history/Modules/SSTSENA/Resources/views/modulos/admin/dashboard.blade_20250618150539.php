@extends('sstsena::layouts.master')
@section('content')
<h1>Administrador</h1>

<div class="container mt-5">
    <h2 class="mb-4 text-center">Comparación de Eventos Registrados</h2>
    <div class="card shadow-sm p-4">
        <canvas id="eventsChart"></canvas>
    </div>
</div>

<!-- Incluye Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('eventsChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Accidentes', 'Incidentes', 'Emergencias', 'Actos Inseguros'],
                datasets: [{
                    label: 'Cantidad de Eventos',
                    data: [
                        {{ \App\Models\Accidents::count() }},
                        {{ \App\Models\Incident::count() }},
                        {{ \App\Models\Emergency::count() }},
                        {{ \App\Models\UnsafeAct::count() }}
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.6)', // Accidentes
                        'rgba(54, 162, 235, 0.6)', // Incidentes
                        'rgba(255, 206, 86, 0.6)', // Emergencias
                        'rgba(75, 192, 192, 0.6)'  // Actos Inseguros
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Cantidad'
                        },
                        ticks: {
                            precision: 0
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Tipo de Evento'
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': ' + context.raw;
                            }
                        }
                    }
                }
            }
        });
    });
</script>

@endsection