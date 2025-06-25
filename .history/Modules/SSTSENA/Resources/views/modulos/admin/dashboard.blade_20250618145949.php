@extends('sstsena::layouts.master')
@section('content')

<h1>Comparativa de Accidentes, Incidentes, Emergencias y Actos Inseguros</h1>

<!-- Contenedor para la gráfica -->
<canvas id="comparativaChart" width="100%" height="400"></canvas>

<!-- Scripts: Incluye Chart.js desde CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('comparativaChart').getContext('2d');
    const data = {
        labels: ['Accidentes', 'Incidentes', 'Emergencias', 'Actos Inseguros'],
        datasets: [{
            label: 'Cantidad',
            data: [
                {{ $accidentsCount }},
                {{ $incidentsCount }},
                {{ $emergenciesCount }},
                {{ $unsafeActsCount }}
            ],
            backgroundColor: [
                'rgba(52, 152, 219, 0.7)',   // Azul
                'rgba(231, 76, 60, 0.7)',    // Rojo
                'rgba(241, 196, 15, 0.7)',   // Amarillo
                'rgba(155, 89, 182, 0.7)'    // Morado
            ],
            borderColor: [
                'rgba(41, 128, 185, 1)',
                'rgba(192, 57, 43, 1)',
                'rgba(243, 156, 18, 1)',
                'rgba(142, 68, 173, 1)'
            ],
            borderWidth: 1
        }]
    };

    const config = {
        type: 'bar', // Puedes cambiar a 'doughnut', 'pie', etc.
        data: data,
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                title: {
                    display: true,
                    text: 'Comparativa de Reportes'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision:0
                    }
                }
            }
        }
    };

    const comparativaChart = new Chart(ctx, config);
</script>

@endsection