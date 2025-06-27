@extends('sstsena::layouts.master')

@section('content')
    <div class="container">
        <h1 class="title">Safety Analytics Dashboard</h1>
        <div class="corporate-card shadow-sm mb-4">
            <div class="section-header" style="border-left: 4px solid #e63946;">
                <div class="section-content d-flex justify-content-between align-items-center py-4 px-4">
                    <div class="d-flex align-items-center">
                        <div class="section-icon me-4">
                            <i class="fas fa-chart-bar fa-lg" style="color: #e63946;"></i>
                        </div>
                        <div>
                            <h4 class="mb-1 fw-semibold text-dark">Event Trends</h4>
                            <small class="text-muted">Monthly breakdown of safety events</small>
                        </div>
                    </div>
                    <div class="stats-container">
                        <div class="stats-number">{{ $accidents->count() + $incidents->count() + $emergencies->count() + $unsafeActs->count() }}</div>
                        <div class="stats-label">Total Events</div>
                    </div>
                </div>
            </div>
            <div class="px-4 py-3">
                <div class="chart-wrapper">
                    <select id="yearSelect" onchange="updateChart()" class="corporate-btn"></select>
                    <canvas id="eventsChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment@2.30.1/min/moment.min.js"></script>

    <style>
        :root {
            --corporate-border: #e9ecef;
            --corporate-hover: #f1f3f4;
            --corporate-text: #343a40;
            --corporate-muted: #6c757d;
        }
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
        .corporate-card {
            background: white;
            border-radius: 8px;
            border: 1px solid var(--corporate-border);
            overflow: hidden;
        }
        .section-header {
            background: #f8f9fa;
            border-bottom: 1px solid var(--corporate-border);
        }
        .section-icon {
            width: 48px;
            height: 48px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #e6394615;
            border: 1px solid rgba(0, 0, 0, 0.08);
        }
        .stats-container {
            text-align: center;
            min-width: 80px;
        }
        .stats-number {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--corporate-text);
            line-height: 1;
        }
        .stats-label {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--corporate-muted);
            font-weight: 600;
        }
        .chart-wrapper {
            padding: 16px;
        }
        .corporate-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background: #f9fafb;
            color: var(--corporate-text);
            border: 2px solid var(--corporate-border);
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.875rem;
            transition: all 0.2s ease;
            cursor: pointer;
        }
        .corporate-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.12);
        }
        .corporate-btn:focus {
            outline: none;
            border-color: #0052cc;
            box-shadow: 0 0 0 3px rgba(0, 82, 204, 0.1);
        }
        canvas {
            max-height: 400px;
        }
        @media (max-width: 768px) {
            .stats-container { display: none; }
            .section-content { flex-direction: column; align-items: flex-start !important; gap: 1rem; }
            .corporate-btn { padding: 0.4rem 0.8rem; font-size: 0.75rem; }
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
                        { label: 'Incidents', data: incidents, backgroundColor: '#3b82f6', borderColor: '#1d4ed8', borderWidth: 1 },
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