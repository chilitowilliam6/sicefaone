@extends('sstsena::layouts.master')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container my-5">
    <h1 class="text-center mb-5 fw-bold text-dark">Dashboard de Eventos de Seguridad y Salud</h1>

    <div class="card shadow-sm p-4 bg-gradient bg-light">
        <div class="d-flex justify-content-end align-items-center mb-4">
            <label for="yearSelect" class="form-label me-3 fw-semibold">Año:</label>
            <select id="yearSelect" class="form-select w-auto" onchange="updateChart()"></select>
        </div>
        <canvas id="miGrafica" style="max-height: 600px;"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js"></script>

<script>
    const rawData = {
        accidents: [@foreach ($accidents as $a){ date_time: '{{ $a->date_time }}' }{{ !$loop->last ? ',' : '' }}@endforeach],
        incidents: [@foreach ($incidents as $i){ date_time: '{{ $i->date_time }}' }{{ !$loop->last ? ',' : '' }}@endforeach],
        emergencies: [@foreach ($emergencies as $e){ date_time: '{{ $e->date_time }}' }{{ !$loop->last ? ',' : '' }}@endforeach],
        unsafeActs: [@foreach ($unsafeActs as $u){ date_time: '{{ $u->date_time }}' }{{ !$loop->last ? ',' : '' }}@endforeach]
    };

    const colors = {
        accidents: 'rgba(255, 99, 132, 0.8)',
        incidents: 'rgba(54, 162, 235, 0.8)',
        emergencies: 'rgba(75, 192, 192, 0.8)',
        unsafeActs: 'rgba(255, 159, 64, 0.8)'
    };

    let chart;

    function processDataByMonthYear(data, year) {
        const result = {
            accidents: Array(12).fill(0),
            incidents: Array(12).fill(0),
            emergencies: Array(12).fill(0),
            unsafeActs: Array(12).fill(0)
        };

        for (const type in data) {
            data[type].forEach(item => {
                const date = moment(item.date_time);
                if (date.isValid() && date.year() === parseInt(year)) {
                    result[type][date.month()]++;
                }
            });
        }

        return result;
    }

    function getUniqueYears(data) {
        const years = new Set();
        for (const type in data) {
            data[type].forEach(item => {
                const date = moment(item.date_time);
                if (date.isValid()) {
                    years.add(date.year());
                }
            });
        }
        return Array.from(years).sort();
    }

    function initializeChart() {
        const years = getUniqueYears(rawData);
        const yearSelect = document.getElementById('yearSelect');
        yearSelect.innerHTML = years.map(year => `<option value="${year}">${year}</option>`).join('');
        yearSelect.value = years[years.length - 1];
        updateChart();
    }

    function updateChart() {
        const year = document.getElementById('yearSelect').value;
        const data = processDataByMonthYear(rawData, year);

        if (chart) chart.destroy();

        const ctx = document.getElementById('miGrafica').getContext('2d');
        chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: moment.monthsShort(),
                datasets: [
                    {
                        label: 'Accidentes',
                        data: data.accidents,
                        backgroundColor: colors.accidents,
                        borderRadius: 10,
                        borderSkipped: false
                    },
                    {
                        label: 'Incidentes',
                        data: data.incidents,
                        backgroundColor: colors.incidents,
                        borderRadius: 10,
                        borderSkipped: false
                    },
                    {
                        label: 'Emergencias',
                        data: data.emergencies,
                        backgroundColor: colors.emergencies,
                        borderRadius: 10,
                        borderSkipped: false
                    },
                    {
                        label: 'Actos Inseguros',
                        data: data.unsafeActs,
                        backgroundColor: colors.unsafeActs,
                        borderRadius: 10,
                        borderSkipped: false
                    }
                ]
            },
            options: {
                animation: false,
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Cantidad',
                            font: { size: 16 }
                        },
                        ticks: { font: { size: 14 } }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Mes',
                            font: { size: 16 }
                        },
                        ticks: { font: { size: 14 } }
                    }
                },
                barPercentage: 1.0,
                categoryPercentage: 1.0,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            font: { size: 16 }
                        }
                    },
                    title: {
                        display: true,
                        text: `Eventos SST por Mes - ${year}`,
                        font: { size: 20 }
                    }
                }
            }
        });
    }

    window.onload = initializeChart;
</script>
@endsection
