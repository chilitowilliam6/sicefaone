@extends('sstsena::layouts.master')

@section('content')
    <div class="container">
        <h1 class="title">Safety Events Dashboard</h1>
        <div class="chart-container">
            <select id="yearSelect" onchange="updateChart()" class="year-select"></select>
            <canvas id="eventsChart"></canvas>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js"></script>

    <style>
        .container {
            max-width: 900px;
            margin: 20px auto;
            font-family: 'Arial', sans-serif;
        }
        .title {
            text-align: center;
            font-size: 24px;
            font-weight: 600;
            color: #1a1a1a;
            margin-bottom: 20px;
        }
        .chart-container {
            background: #fff;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .year-select {
            width: 120px;
            padding: 8px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 6px;
            background: #f9f9f9;
            cursor: pointer;
            margin-bottom: 15px;
        }
        .year-select:focus {
            outline: none;
            border-color: #0052cc;
        }
        canvas {
            max-height: 400px;
        }
    </style>

    <script>
        const rawData = {
            accidents: [@foreach ($accidents as $accident){ date_time: '{{ $accident->date_time }}' }{{ !$loop->last ? ',' : '' }}@endforeach],
            incidents: [@foreach ($incidents as $incident){ date_time: '{{ $incident->date_time }}' }{{ !$loop->last ? ',' : '' }}@endforeach],
            emergencies: [@foreach ($emergencies as $emergency){ date_time: '{{ $emergency->date_time }}' }{{ !$loop->last ? ',' : '' }}@endforeach],
            unsafeActs: [@foreach ($unsafeActs as $unsafeAct){ date_time: '{{ $unsafeAct->date_time }}' }{{ !$loop->last ? ',' : '' }}@endforeach]
        };

        function processDataByMonthYear(data, year) {
            const months = moment.monthsShort();
            const counts = { accidents: new Array(12).fill(0), incidents: new Array(12).fill(0), emergencies: new Array(12).fill(0), unsafeActs: new Array(12).fill(0) };

            ['accidents', 'incidents', 'emergencies', 'unsafeActs'].forEach(type => {
                data[type].forEach(item => {
                    if (item.date_time) {
                        const date = moment(item.date_time);
                        if (date.isValid() && date.year() === parseInt(year)) {
                            counts[type][date.month()]++;
                        }
                    }
                });
            });

            return { months, ...counts };
        }

        function getUniqueYears(data) {
            const years = new Set();
            ['accidents', 'incidents', 'emergencies', 'unsafeActs'].forEach(type => {
                data[type].forEach(item => {
                    if (item.date_time) years.add(moment(item.date_time).year());
                });
            });
            return Array.from(years).sort();
        }

        let chart;
        function initializeChart() {
            const years = getUniqueYears(rawData);
            const yearSelect = document.getElementById('yearSelect');
            yearSelect.innerHTML = years.length ? years.map(year => `<option value="${year}">${year}</option>`).join('') : '<option value="">No Data</option>';
            yearSelect.value = years[years.length - 1] || '';
            updateChart();
        }

        function updateChart() {
            const year = document.getElementById('yearSelect').value;
            if (!year) return;

            const { months, accidents, incidents, emergencies, unsafeActs } = processDataByMonthYear(rawData, year);
            if (chart) chart.destroy();

            chart = new Chart(document.getElementById('eventsChart'), {
                type: 'bar',
                data: {
                    labels: months,
                    datasets: [
                        { label: 'Accidents', data: accidents, backgroundColor: '#ff4d4f', borderColor: '#d9363e', borderWidth: 1 },
                        { label: 'Incidents', data: incidents, backgroundColor: '#1890ff', borderColor: '#096dd9', borderWidth: 1 },
                        { label: 'Emergencies', data: emergencies, backgroundColor: '#13c2c2', borderColor: '#08979c', borderWidth: 1 },
                        { label: 'Unsafe Acts', data: unsafeActs, backgroundColor: '#fa8c16', borderColor: '#d46b08', borderWidth: 1 }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: { beginAtZero: true, title: { display: true, text: 'Event Count', font: { size: 14 } } },
                        x: { title: { display: true, text: 'Month', font: { size: 14 } } }
                    },
                    plugins: {
                        legend: { position: 'top', labels: { font: { size: 12 }, color: '#1a1a1a' } },
                        title: { display: true, text: `Safety Events by Month (${year})`, font: { size: 16, weight: '600' }, color: '#1a1a1a' }
                    }
                }
            });
        }

        window.onload = initializeChart;
    </script>
@endsection