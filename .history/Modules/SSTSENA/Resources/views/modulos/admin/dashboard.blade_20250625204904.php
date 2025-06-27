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

    const colors = {
        accidents: '#ff0000', // Bright Red
        incidents: '#0066ff', // Bright Blue
        emergencies: '#00cc00', // Bright Green
        unsafeActs: '#ff9900' // Bright Orange
    };

    function processDataByYearMonth(data, year) {
        const months = Array(12).fill().map(() => ({
            accidents: 0,
            incidents: 0,
            emergencies: 0,
            unsafeActs: 0
        }));

        for (const type in data) {
            data[type].forEach(item => {
                const date = moment(item.date_time);
                if (date.isValid() && date.year() === parseInt(year)) {
                    const monthIndex = date.month();
                    months[monthIndex][type]++;
                }
            });
        }
        return months;
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

        const monthsData = processDataByYearMonth(rawData, year);

        if (chart) chart.destroy();

        chart = new Chart(document.getElementById('eventsChart'), {
            type: 'bar',
            data: {
                labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                datasets: [
                    {
                        label: 'Accidentes',
                        data: monthsData.map(m => m.accidents),
                        backgroundColor: colors.accidents,
                        borderColor: '#ffffff',
                        borderWidth: 1,
                        barThickness: 30
                    },
                    {
                        label: 'Incidentes',
sec                    data: monthsData.map(m => m.incidents),
                        backgroundColor: colors.incidents,
                        borderColor: '#ffffff',
                        borderWidth: 1,
                        barThickness: 30
                    },
                    {
                        label: 'Emergencias',
                        data: monthsData.map(m => m.emergencies),
                        backgroundColor: colors.emergencies,
                        borderColor: '#ffffff',
                        borderWidth: 1,
                        barThickness: 30
                    },
                    {
                        label: 'Actos Inseguros',
                        data: monthsData.map(m => m.unsafeActs),
                        backgroundColor: colors.unsafeActs,
                        borderColor: '#ffffff',
                        borderWidth: 1,
                        barThickness: 30
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: { font: { size: 16, weight: '600' }, color: '#212529', padding: 24 }
                    },
                    title: {
                        display: true,
                        text: `Eventos SST (${year})`,
                        font: { size: 24, weight: '600' },
                        color: '#212529',
                        padding: { top: 24, bottom: 24 }
                    },
                    tooltip: {
                        backgroundColor: '#212529',
                        titleFont: { size: 16 },
                        bodyFont: { size: 14 },
                        padding: 14,
                        cornerRadius: 10
                    }
                },
                scales: {
                    x: {
                        stacked: false,
                        ticks: { font: { size: 14 }, color: '#212529' },
                        grid: { display: false }
                    },
                    y: {
                        stacked: false,
                        beginAtZero: true,
                        ticks: { font: { size: 14 }, color: '#212529' },
                        grid: { color: '#dee2e6' }
                    }
                }
            }
        });
    }

    window.onload = initializeChart;
</script>
@endsection