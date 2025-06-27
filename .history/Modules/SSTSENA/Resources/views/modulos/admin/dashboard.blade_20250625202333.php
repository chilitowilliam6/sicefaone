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

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js"></script>

<style>
    body {
        background-color: #f4f6f9;
        font-family: 'Segoe UI', sans-serif;
    }

    .container {
        max-width: 960px;
        margin: 40px auto;
        padding: 0 20px;
    }

    .dashboard-title {
        text-align: center;
        font-size: 28px;
        font-weight: bold;
        color: #2c3e50;
        margin-bottom: 30px;
    }

    .dashboard-card {
        background-color: #ffffff;
        border-radius: 12px;
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
        padding: 30px;
    }

    .select-container {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        margin-bottom: 20px;
        gap: 10px;
    }

    #yearSelect {
        padding: 8px 12px;
        font-size: 14px;
        border: 1px solid #ccc;
        border-radius: 6px;
        background-color: #f0f0f0;
        transition: border-color 0.3s;
    }

    #yearSelect:focus {
        outline: none;
        border-color: #007bff;
        background-color: #fff;
    }

    canvas {
        max-height: 400px;
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
        accidents: '#e74c3c',
        incidents: '#2980b9',
        emergencies: '#16a085',
        unsafeActs: '#f39c12'
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

        chart = new Chart(document.getElementById('eventsChart'), {
            type: 'bar',
            data: {
                labels: moment.monthsShort(),
                datasets: [
                    { label: 'Accidentes', data: accidents, backgroundColor: colors.accidents },
                    { label: 'Incidentes', data: incidents, backgroundColor: colors.incidents },
                    { label: 'Emergencias', data: emergencies, backgroundColor: colors.emergencies },
                    { label: 'Actos Inseguros', data: unsafeActs, backgroundColor: colors.unsafeActs }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'top', labels: { font: { size: 13 }, color: '#2c3e50' } },
                    title: {
                        display: true,
                        text: `Eventos SST por Mes (${year})`,
                        font: { size: 18 },
                        color: '#2c3e50'
                    }
                },
                scales: {
                    y: { beginAtZero: true, title: { display: true, text: 'Cantidad' } },
                    x: { title: { display: true, text: 'Mes' } }
                }
            }
        });
    }

    window.onload = initializeChart;
</script>
@endsection
