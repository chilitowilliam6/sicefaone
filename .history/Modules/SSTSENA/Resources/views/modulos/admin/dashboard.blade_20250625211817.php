@extends('sstsena::layouts.master')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container-fluid py-5" style="background-color: #1f1f2e;">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="text-white fw-bold display-5">
                <i class="bi bi-graph-up-arrow text-info"></i> Reporte Mensual SST
            </h2>
            <p class="text-secondary">Visualización gráfica de accidentes, incidentes, emergencias y actos inseguros</p>
        </div>

        <div class="card p-4 shadow-lg bg-dark bg-opacity-75 border-0 rounded-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="text-light mb-0">Eventos por mes</h5>
                <div class="d-flex align-items-center">
                    <label for="yearSelect" class="text-white me-2">Seleccionar año:</label>
                    <select id="yearSelect" class="form-select bg-dark text-white border-secondary w-auto" onchange="updateChart()"></select>
                </div>
            </div>

            <div style="width: 100%; height: 500px;">
                <canvas id="eventsChart"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js"></script>

<script>
    const rawData = {
        accidents: [@foreach ($accidents as $a){ date_time: '{{ $a->date_time }}' }{{ !$loop->last ? ',' : '' }}@endforeach],
        incidents: [@foreach ($incidents as $i){ date_time: '{{ $i->date_time }}' }{{ !$loop->last ? ',' : '' }}@endforeach],
        emergencies: [@foreach ($emergencies as $e){ date_time: '{{ $e->date_time }}' }{{ !$loop->last ? ',' : '' }}@endforeach],
        unsafeActs: [@foreach ($unsafeActs as $u){ date_time: '{{ $u->date_time }}' }{{ !$loop->last ? ',' : '' }}@endforeach]
    };

    const colors = {
        accidents: '#dc3545',
        incidents: '#0d6efd',
        emergencies: '#198754',
        unsafeActs: '#ffc107'
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
                    { label: 'Accidentes', data: accidents, backgroundColor: colors.accidents, borderRadius: 8 },
                    { label: 'Incidentes', data: incidents, backgroundColor: colors.incidents, borderRadius: 8 },
                    { label: 'Emergencias', data: emergencies, backgroundColor: colors.emergencies, borderRadius: 8 },
                    { label: 'Actos Inseguros', data: unsafeActs, backgroundColor: colors.unsafeActs, borderRadius: 8 }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                layout: {
                    padding: 20
                },
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: '#ffffff',
                            font: { size: 14, weight: 'bold' },
                            padding: 20
                        }
                    },
                    title: {
                        display: true,
                        text: `Eventos SST - ${year}`,
                        color: '#ffffff',
                        font: { size: 20, weight: 'bold' },
                        padding: { top: 10, bottom: 20 }
                    },
                    tooltip: {
                        backgroundColor: '#000',
                        titleFont: { size: 14 },
                        bodyFont: { size: 13 },
                        borderWidth: 1,
                        borderColor: '#ffffff'
                    }
                },
                scales: {
                    x: {
                        ticks: { color: '#ffffff', font: { size: 12 } },
                        grid: { color: '#444' },
                        title: {
                            display: true,
                            text: 'Mes',
                            color: '#aaa',
                            font: { size: 14, weight: 'bold' }
                        }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: { color: '#ffffff', font: { size: 12 } },
                        grid: { color: '#444' },
                        title: {
                            display: true,
                            text: 'Cantidad de eventos',
                            color: '#aaa',
                            font: { size: 14, weight: 'bold' }
                        }
                    }
                }
            }
        });
    }

    window.onload = initializeChart;
</script>
@endsection
