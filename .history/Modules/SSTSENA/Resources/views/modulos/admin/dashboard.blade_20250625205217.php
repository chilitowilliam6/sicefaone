@extends('sstsena::layouts.master')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<div class="container my-5">
    <h1 class="text-center mb-5 fw-bold text-dark">Dashboard de Eventos de Seguridad y Salud</h1>

    <div class="card shadow-sm p-4 bg-gradient bg-light">
        <div class="d-flex justify-content-end align-items-center mb-4">
            <label for="yearSelect" class="form-label me-3 fw-semibold">Año:</label>
            <select id="yearSelect" class="form-select w-auto" onchange="updateChart()"></select>
        </div>
        <canvas id="eventsChart" class="w-100" style="max-height: 600px;"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<script>
    const rawData = {
        accidents: [@foreach ($accidents as $a){ date_time: '{{ $a->date_time }}' }{{ !$loop->last ? ',' : '' }}@endforeach],
        incidents: [@foreach ($incidents as $i){ date_time: '{{ $i->date_time }}' }{{ !$loop->last ? ',' : '' }}@endforeach],
        emergencies: [@foreach ($emergencies as $e){ date_time: '{{ $e->date_time }}' }{{ !$loop->last ? ',' : '' }}@endforeach],
        unsafeActs: [@foreach ($unsafeActs as $u){ date_time: '{{ $u->date_time }}' }{{ !$loop->last ? ',' : '' }}@endforeach]
    };

    // Colores más notables y apropiados para el tema de seguridad
    const colors = {
        accidents: '#DC2626', // Rojo intenso para accidentes (peligro crítico)
        incidents: '#F59E0B', // Amarillo/naranja para incidentes (precaución)
        emergencies: '#EF4444', // Rojo brillante para emergencias (alerta máxima)
        unsafeActs: '#FB923C' // Naranja vibrante para actos inseguros (advertencia)
    };

    // Colores de borde más oscuros para mayor contraste
    const borderColors = {
        accidents: '#991B1B',
        incidents: '#D97706', 
        emergencies: '#B91C1C',
        unsafeActs: '#EA580C'
    };

    function processDataByMonthYear(data, year) {
        const counts = {
            accidents: new Array(12).fill(0),
            incidents: new Array(12).fill(0),
            emergencies: new Array(12).fill(0),
            unsafeActs: new Array(12).fill(0)
        };

        for (const type in data) {
            data[type].forEach(item => {
                const date = moment(item.date_time);
                if (date.isValid() && date.year() === parseInt(year)) {
                    counts[type][date.month()]++;
                }
            });
        }
        return counts;
    }

    function getUniqueYears(data) {
        const years = new Set();
        for (const type in data) {
            data[type].forEach(item => {
                if (item.date_time) years.add(moment(item.date_time).year());
            });
        }
        return Array.from(years).sort();
    }

    let chart;
    function initializeChart() {
        const years = getUniqueYears(rawData);
        const yearSelect = document.getElementById('yearSelect');
        yearSelect.innerHTML = years.map(year => `<option value="${year}">${year}</option>`).join('');
        yearSelect.value = years[years.length - 1];
        updateChart();
    }

    function updateChart() {
        const year = document.getElementById('yearSelect').value;
        if (!year) return;

        const { accidents, incidents, emergencies, unsafeActs } = processDataByMonthYear(rawData, year);

        if (chart) chart.destroy();

        chart = new Chart(document.getElementById('eventsChart'), {
            type: 'bar',
            data: {
                labels: moment.monthsShort(),
                datasets: [
                    { 
                        label: 'Accidentes', 
                        data: accidents, 
                        backgroundColor: colors.accidents,
                        borderColor: borderColors.accidents,
                        borderWidth: 2,
                        borderRadius: 8,
                        borderSkipped: false,
                    },
                    { 
                        label: 'Incidentes', 
                        data: incidents, 
                        backgroundColor: colors.incidents,
                        borderColor: borderColors.incidents,
                        borderWidth: 2,
                        borderRadius: 8,
                        borderSkipped: false,
                    },
                    { 
                        label: 'Emergencias', 
                        data: emergencies, 
                        backgroundColor: colors.emergencies,
                        borderColor: borderColors.emergencies,
                        borderWidth: 2,
                        borderRadius: 8,
                        borderSkipped: false,
                    },
                    { 
                        label: 'Actos Inseguros', 
                        data: unsafeActs, 
                        backgroundColor: colors.unsafeActs,
                        borderColor: borderColors.unsafeActs,
                        borderWidth: 2,
                        borderRadius: 8,
                        borderSkipped: false,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: { 
                            font: { size: 16, weight: '600' }, 
                            color: '#212529', 
                            padding: 24,
                            usePointStyle: true,
                            pointStyle: 'rect'
                        }
                    },
                    title: {
                        display: true,
                        text: `Eventos SST por Mes (${year})`,
                        font: { size: 24, weight: '600' },
                        color: '#212529',
                        padding: { top: 24, bottom: 24 }
                    },
                    tooltip: {
                        backgroundColor: '#212529',
                        titleFont: { size: 16 },
                        bodyFont: { size: 14 },
                        padding: 14,
                        cornerRadius: 10,
                        borderColor: '#fff',
                        borderWidth: 1
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: { 
                            display: true, 
                            text: 'Cantidad de Eventos', 
                            font: { size: 16, weight: '600' },
                            color: '#374151'
                        },
                        grid: { 
                            color: '#E5E7EB',
                            lineWidth: 1
                        },
                        ticks: { 
                            font: { size: 14 },
                            color: '#374151'
                        }
                    },
                    x: {
                        title: { 
                            display: true, 
                            text: 'Mes del Año', 
                            font: { size: 16, weight: '600' },
                            color: '#374151'
                        },
                        grid: { display: false },
                        ticks: { 
                            font: { size: 14 },
                            color: '#374151'
                        }
                    }
                },
                // Configuración para barras MUY anchas
                barPercentage: 1.0, // Máximo ancho de barras (100%)
                categoryPercentage: 0.95, // Mínimo espacio entre grupos (5%)
                
                // Animaciones más llamativas
                animation: {
                    duration: 1500,
                    easing: 'easeInOutQuart'
                },
                
                // Interactividad mejorada
                interaction: {
                    intersect: false,
                    mode: 'index'
                }
            }
        });
    }

    window.onload = initializeChart;
</script>
@endsection