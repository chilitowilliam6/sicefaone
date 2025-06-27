@extends('sstsena::layouts.master')

@section('content')
<div class="container">
    <h1 class="dashboard-title">Dashboard de Eventos de Seguridad y Salud</h1>

    <div class="dashboard-card">
        <div class="select-container">
            <label for="yearSelect">Año:</label>
            <select id="yearSelect" onchange="updateChart()"></select>
        </div>
        <canvas id="eventsChart"></canvas>
    </div>
</div>

<style>
    body {
        background-color: #f8fafc;
        font-family: 'Inter', sans-serif;
    }

    .container {
        max-width: 1200px;
        margin: 40px auto;
        padding: 0 24px;
    }

    .dashboard-title {
        text-align: center;
        font-size: 32px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 32px;
    }

    .dashboard-card {
        background: linear-gradient(145deg, #ffffff, #f1f5f9);
        border-radius: 16px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
        padding: 32px;
        border: 1px solid #e2e8f0;
    }

    .select-container {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 12px;
        margin-bottom: 24px;
    }

    #yearSelect {
        padding: 10px 16px;
        font-size: 16px;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        background-color: #ffffff;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    #yearSelect:hover, #yearSelect:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        outline: none;
    }

    canvas {
        max-height: 500px !important;
    }
</style>

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
        accidents: '#dc2626',
        incidents: '#2563eb',
        emergencies: '#059669',
        unsafeActs: '#d97706'
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
                    { label: 'Accidentes', data: accidents, backgroundColor: colors.accidents, borderRadius: 10 },
                    { label: 'Incidentes', data: incidents, backgroundColor: colors.incidents, borderRadius: 10 },
                    { label: 'Emergencias', data: emergencies, backgroundColor: colors.emergencies, borderRadius: 10 },
                    { label: 'Actos Inseguros', data: unsafeActs, backgroundColor: colors.unsafeActs, borderRadius: 10 }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: { font: { size: 14, weight: '600' }, color: '#1e293b', padding: 20 }
                    },
                    title: {
                        display: true,
                        text: `Eventos SST por Mes (${year})`,
                        font: { size: 20, weight: '600' },
                        color: '#1e293b',
                        padding: { top: 20, bottom: 20 }
                    },
                    tooltip: {
                        backgroundColor: '#1e293b',
                        titleFont: { size: 14 },
                        bodyFont: { size: 13 },
                        padding: 12,
                        cornerRadius: 8
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: { display: true, text: 'Cantidad', font: { size: 14 } },
                        grid: { color: '#e2e8f0' }
                    },
                    x: {
                        title: { display: true, text: 'Mes', font: { size: 14 } },
                        grid: { display: false }
                    }
                },
                barPercentage: 0.28,
                categoryPercentage: 0.95
            }
        });
    }

    window.onload = initializeChart;
</script>
@endsection