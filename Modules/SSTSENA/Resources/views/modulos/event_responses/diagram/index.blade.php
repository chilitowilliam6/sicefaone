@extends('sstsena::layouts.master')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/moment"></script>

<style>
    #eventsChart {
        max-height: 360px;
    }

    @media (max-width: 768px) {
        #eventsChart {
            max-height: 280px;
        }
    }
</style>

<div class="container py-5">
    <div class="bg-white rounded-4 shadow p-4">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4">
            <h3 class="fw-bold text-primary mb-3 mb-md-0">📊 Eventos SST por Mes o Trimestre</h3>
            <div class="d-flex gap-3 align-items-center">
                <div>
                    <label for="yearSelect" class="form-label mb-0 fw-semibold">Año:</label>
                    <select id="yearSelect" class="form-select form-select-sm shadow-sm"></select>
                </div>
                <div>
                    <label for="groupBy" class="form-label mb-0 fw-semibold">Agrupar por:</label>
                    <select id="groupBy" class="form-select form-select-sm shadow-sm">
                        <option value="month">📆 Mes</option>
                        <option value="quarter">📊 Trimestre</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="bg-light rounded-3 p-3" style="height: 400px;">
            <canvas id="eventsChart"></canvas>
        </div>
    </div>
</div>

<script>
    const rawData = {
        accidents: [
            @foreach ($accidents as $a)
                { date_time: '{{ $a->date_time }}' }
                {{ !$loop->last ? ',' : '' }}
            @endforeach
        ],
        incidents: [
            @foreach ($incidents as $i)
                { date_time: '{{ $i->date_time }}' }
                {{ !$loop->last ? ',' : '' }}
            @endforeach
        ],
        emergencies: [
            @foreach ($emergencies as $e)
                { date_time: '{{ $e->date_time }}' }
                {{ !$loop->last ? ',' : '' }}
            @endforeach
        ],
        unsafeActs: [
            @foreach ($unsafeActs as $u)
                { date_time: '{{ $u->date_time }}' }
                {{ !$loop->last ? ',' : '' }}
            @endforeach
        ]
    };

    const colors = {
        accidents: '#F87171',
        incidents: '#60A5FA',
        emergencies: '#34D399',
        unsafeActs: '#FBBF24'
    };

    let chart;

    function getYears() {
        const years = new Set();
        for (const type in rawData) {
            rawData[type].forEach(item => {
                if (item.date_time) years.add(moment(item.date_time).year());
            });
        }
        return Array.from(years).sort();
    }

    function groupDataBy(data, year, groupBy) {
        const countMap = {
            accidents: groupBy === 'month' ? new Array(12).fill(0) : new Array(4).fill(0),
            incidents: groupBy === 'month' ? new Array(12).fill(0) : new Array(4).fill(0),
            emergencies: groupBy === 'month' ? new Array(12).fill(0) : new Array(4).fill(0),
            unsafeActs: groupBy === 'month' ? new Array(12).fill(0) : new Array(4).fill(0)
        };

        for (const type in data) {
            data[type].forEach(item => {
                const date = moment(item.date_time);
                if (date.isValid() && date.year() === parseInt(year)) {
                    const index = groupBy === 'month' ? date.month() : Math.floor(date.month() / 3);
                    countMap[type][index]++;
                }
            });
        }

        return countMap;
    }

    function updateChart() {
        const year = document.getElementById('yearSelect').value;
        const groupBy = document.getElementById('groupBy').value;
        const groupedData = groupDataBy(rawData, year, groupBy);

        const labels = groupBy === 'month'
            ? moment.monthsShort()
            : ['1er Trimestre', '2do Trimestre', '3er Trimestre'];

        const datasets = Object.keys(groupedData).map(type => ({
            label: type.charAt(0).toUpperCase() + type.slice(1),
            data: groupedData[type],
            backgroundColor: colors[type],
            borderRadius: 10
        }));

        if (chart) chart.destroy();

        chart = new Chart(document.getElementById('eventsChart'), {
            type: 'bar',
            data: {
                labels,
                datasets
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: `Eventos por ${groupBy === 'month' ? 'Mes' : 'Trimestre'} - Año ${year}`,
                        font: { size: 20 }
                    },
                    legend: {
                        position: 'top',
                        labels: { font: { size: 14 }, padding: 16 }
                    },
                    tooltip: {
                        backgroundColor: '#333',
                        titleFont: { size: 14 },
                        bodyFont: { size: 12 },
                        padding: 12,
                        cornerRadius: 8
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: { display: true, text: 'Cantidad' },
                        ticks: { stepSize: 1 }
                    },
                    x: {
                        title: { display: true, text: groupBy === 'month' ? 'Mes' : 'Trimestre' }
                    }
                }
            }
        });
    }

    function initFilters() {
        const years = getYears();
        const yearSelect = document.getElementById('yearSelect');
        yearSelect.innerHTML = years.map(y => `<option value="${y}">${y}</option>`).join('');
        yearSelect.value = years[years.length - 1];
        document.getElementById('yearSelect').addEventListener('change', updateChart);
        document.getElementById('groupBy').addEventListener('change', updateChart);
        updateChart();
    }

    window.onload = initFilters;
</script>
@endsection
