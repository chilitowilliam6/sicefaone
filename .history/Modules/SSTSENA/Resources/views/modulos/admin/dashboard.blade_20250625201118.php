@extends('sstsena::layouts.master')

@section('content')
    <div class="container">
        <h1 class="title">Safety Analytics Dashboard</h1>
        <div class="chart-wrapper">
            <select id="yearSelect" onchange="updateChart()" class="year-select"></select>
            <canvas id="eventsChart"></canvas>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment@2.30.1/min/moment.min.js"></script>

    <style>
        .container {
            max-width: 1000px;
            margin: 30px auto;
            font-family: 'Inter', -apple-system, sans-serif;
        }
        .title {
            font-size: 28px;
            font-weight: 700;
            color: #101828;
            text-align: center;
            margin-bottom: 24px;
        }
        .chart-wrapper {
            background: #ffffff;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }
        .year-select {
            padding: 10px 14px;
            font-size: 14px;
            font-weight: 500;
            border: 1px solid #e4e7ec;
            border-radius: 8px;
            background: #f9fafb;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .year-select:focus {
            outline: none;
            border-color: #0052cc;
            box-shadow: 0 0 0 3px rgba(0, 82, 204, 0.1);
        }
        canvas {
            max-height: 450px;
        }
    </style>

    <script>
        const rawData = {
            accidents: [@foreach ($accidents as $accident){ date_time: '{{ $accident->date_time }}' }{{ !$loop->last ? ',' : '' }}@endforeach],
            incidents: [@foreach ($incidents as $incident){ date_time: '{{ $incident->date_time }}' }{{ !$loop->last ? ',' : '' }}@endforeach],
            emergencies: [@foreach ($emergencies as $emergency){ date_time: '{{ $emergency->date_time }}' }{{ !$loop->last ? ',' : '' }}@endforeach],
            unsafeActs: [@foreach ($unsafeActs as $unsafeAct){ date_time: '{{ $unsafeAct->date_time }}' }{{ !$loop->last ? ',' : '' }}@endforeach]
        };

        function processData(data, year) {
            const months = moment.monthsShort();
            const counts = { accidents: Array(12).fill(0), incidents: Array(12).fill(0), emergencies: Array(12).fill(0), unsafeActs: Array(12).fill(0) };
            ['accidents', 'incidents', 'emergencies', 'unsafeActs'].forEach(type => {
                data[type].forEach(item => {
                    if (item.date_time && moment(item.date_time).isValid() && moment(item.date_time).year() === +year) {
                        counts[type][moment(item.date_time).month()]++;
                    }
                });
            });
            return { months, ...counts };
        }

        function getYears(data) {
            const years = new Set();
            ['accidents', 'incidents', 'emergencies', 'unsafeActs'].forEach(type => {
                data[type].forEach(item => item.date_time && years.add(moment(item.date_time).year()));
            });
            return Array.from(years).sort();
        }

        let chart;
        function initChart() {
            const years = getYears(rawData);
            const select = document.getElementById('yearSelect');
            select.innerHTML = years.length ? years.map(y => `<option value="${y}">${y}</option>`).join('') : '<option value="">No Data</option>';
            select.value = years[years.length - 1] || '';
            updateChart();
        }

        function updateChart() {
            const year = document.getElementById('yearSelect').value;
            if (!year) return;
            const { months, accidents, incidents, emergencies, unsafeActs } = processData(rawData, year);
            if (chart) chart.destroy();

            chart = new Chart(document.getElementById('eventsChart'), {
                type: 'bar',
                data: {
                    labels: months,
                    datasets: [
                        { label: 'Accidents', data: accidents, backgroundColor: '#ef4444', borderColor: '#b91c1c', borderWidth: 1 },
                        { label: 'Incidents', data: incidents, backgroundColor: #3b82f6, borderColor: '#1d4ed8', borderWidth: 1 },
                        { label: 'Emergencies', data: emergencies, backgroundColor: '#10b981', borderColor: '#047857', borderWidth: 1 },
                        { label: 'Unsafe Acts', data: unsafeActs, backgroundColor: '#f59e0b', borderColor: '#b45309', borderWidth: 1 }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: { beginAtZero: true, title: { display: true, text: 'Event Count', font: { size: 14, family: 'Inter' } }, grid: { color: '#e4e7ec' } },
                        x: { title: { display: true, text: 'Month', font: { size: 14, family: 'Inter' } }, grid: { display: false } }
                    },
                    plugins: {
                        legend: { position: 'top', labels: { font: { size: 12, family: 'Inter' }, color: '#101828' } },
                        title: { display: true, text: `Safety Events (${year})`, font: { size: 18, family: 'Inter', weight: '600' }, color: '#101828' }
                    }
                }
            });
        }

        window.onload = initChart;
    </script>
@endsection