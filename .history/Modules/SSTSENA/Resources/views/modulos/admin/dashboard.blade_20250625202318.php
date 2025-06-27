@extends('sstsena::layouts.master')

@section('content')
<div class="container">
    <h1 class="dashboard-title">Dashboard de Eventos de Seguridad y Salud</h1>

    <div class="dashboard-card">
        <div class="select-container">
            <label for="yearSelect">Año:</label>
            <select id="yearSelect" class="form-select" onchange="updateChart()"></select>
        </div>
        <div class="chart-container">
            <canvas id="eventsChart"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js"></script>

<style>
    body {
        background-color: #f8fafc;
        font-family: 'Inter', sans-serif;
    }

    .container {
        max-width: 1200px;
        margin: 2rem auto;
        padding: 0 1.5rem;
    }

    .dashboard-title {
        text-align: center;
        font-size: 1.8rem;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 2rem;
    }

    .dashboard-card {
        background-color: #ffffff;
        border-radius: 0.75rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        padding: 2rem;
    }

    .select-container {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        margin-bottom: 1.5rem;
        gap: 0.75rem;
    }

    .form-select {
        padding: 0.5rem 1rem;
        font-size: 0.875rem;
        border: 1px solid #e2e8f0;
        border-radius: 0.5rem;
        background-color: #fff;
        color: #475569;
        transition: all 0.2s;
    }

    .form-select:focus {
        outline: none;
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
    }

    .chart-container {
        position: relative;
        height: 500px;
        width: 100%;
    }
</style>

<script>
    const rawData = {
        accidents: [@foreach ($accidents as $a){ date_time: '{{ $a->date_time }}' }{{ !$loop->last ? ',' : '' }}@endforeach],
        incidents: [@foreach ($incidents as $i){ date_time: '{{ $i->date_time }}' }{{ !$loop->last ? ',' : '' }}@endforeach],
        emergencies: [@foreach ($emergencies as $e){ date_time: '{{ $e->date_time }}' }{{ !$loop->last ? ',' : '' }}@endforeach],
        unsafeActs: [@foreach ($unsafeActs as $u){ date_time: '{{ $u->date_time }}' }{{ !$loop->last ? ',' : '' }}@endforeach]
    };

    const colors = {
        accidents: 'rgba(239, 68, 68, 0.8)',
        incidents: 'rgba(59, 130, 246, 0.8)',
        emergencies: 'rgba(16, 185, 129, 0.8)',
        unsafeActs: 'rgba(245, 158, 11, 0.8)'
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
                if (item.date_time) {
                    years.add(moment(item.date_time).year());
                }
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

        const ctx = document.getElementById('eventsChart').getContext('2d');
        chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: moment.monthsShort(),
                datasets: [
                    {
                        label: 'Accidentes',
                        data: accidents,
                        backgroundColor: colors.accidents,
                        borderColor: 'rgba(239, 68, 68, 1)',
                        borderWidth: 1,
                        borderRadius: 4
                    },
                    {
                        label: 'Incidentes',
                        data: incidents,
                        backgroundColor: colors.incidents,
                        borderColor: 'rgba(59, 130, 246, 1)',
                        borderWidth: 1,
                        borderRadius: 4
                    },
                    {
                        label: 'Emergencias',
                        data: emergencies,
                        backgroundColor: colors.emergencies,
                        borderColor: 'rgba(16, 185, 129, 1)',
                        borderWidth: 1,
                        borderRadius: 4
                    },
                    {
                        label: 'Actos Inseguros',
                        data: unsafeActs,
                        backgroundColor: colors.unsafeActs,
                        borderColor: 'rgba(245, 158, 11, 1)',
                        borderWidth: 1,
                        borderRadius: 4
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
                            font: { size: 14, family: 'Inter' },
                            padding: 20,
                            usePointStyle: true,
                            pointStyle: 'circle'
                        }
                    },
                    title: {
                        display: true,
                        text: `Eventos SST por Mes (${year})`,
                        font: { size: 18, weight: '600' },
                        color: '#1e293b',
                        padding: { bottom: 20 }
                    },
                    tooltip: {
                        backgroundColor: '#1e293b',
                        titleFont: { size: 14, weight: '600' },
                        bodyFont: { size: 13 },
                        padding: 12,
                        cornerRadius: 8,
                        displayColors: true,
                        usePointStyle: true
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Cantidad de Eventos',
                            font: { size: 14, weight: '500' }
                        },
                        grid: {
                            color: '#e2e8f0',
                            drawBorder: false
                        },
                        ticks: {
                            font: { size: 12 }
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Meses del Año',
                            font: { size: 14, weight: '500' }
                        },
                        grid: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            font: { size: 12 }
                        }
                    }
                },
                animation: {
                    duration: 1000,
                    easing: 'easeInOutQuad'
                }
            }
        });
    }

    window.onload = initializeChart;
</script>
@endsection