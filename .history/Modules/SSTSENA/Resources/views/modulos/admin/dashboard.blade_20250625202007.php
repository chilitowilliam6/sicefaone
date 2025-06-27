@extends('sstsena::layouts.master')

@section('content')
    <div class="container">
        <h1 class="title">Safety Analytics Dashboard</h1>
        <div class="dashboard-card">
            <div class="card-header">
                <div class="header-content">
                    <div class="header-info">
                        <div class="icon-wrapper">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                        <div class="title-section">
                            <h4>Event Trends</h4>
                            <p>Monthly breakdown of safety events</p>
                        </div>
                    </div>
                    <div class="stats-display">
                        <div class="total-count">{{ $accidents->count() + $incidents->count() + $emergencies->count() + $unsafeActs->count() }}</div>
                        <div class="total-label">Total Events</div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="controls-section">
                    <select id="yearSelect" onchange="updateChart()" class="year-selector">
                        <option value="">Select Year</option>
                    </select>
                </div>
                <div class="chart-container">
                    <canvas id="eventsChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment@2.30.1/min/moment.min.js"></script>

    <style>
        * { box-sizing: border-box; }
        
        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .title {
            font-size: 32px;
            font-weight: 700;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-align: center;
            margin-bottom: 30px;
        }
        
        .dashboard-card {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.18);
        }
        
        .card-header {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
            padding: 24px;
        }
        
        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .header-info {
            display: flex;
            align-items: center;
            gap: 16px;
        }
        
        .icon-wrapper {
            width: 56px;
            height: 56px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(10px);
        }
        
        .icon-wrapper i {
            font-size: 24px;
            color: white;
        }
        
        .title-section h4 {
            margin: 0;
            font-size: 22px;
            font-weight: 600;
        }
        
        .title-section p {
            margin: 4px 0 0 0;
            opacity: 0.9;
            font-size: 14px;
        }
        
        .stats-display {
            text-align: center;
            background: rgba(255, 255, 255, 0.1);
            padding: 16px 24px;
            border-radius: 12px;
            backdrop-filter: blur(10px);
        }
        
        .total-count {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 4px;
        }
        
        .total-label {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            opacity: 0.9;
        }
        
        .card-body {
            padding: 30px;
        }
        
        .controls-section {
            margin-bottom: 24px;
            display: flex;
            justify-content: flex-end;
        }
        
        .year-selector {
            padding: 12px 20px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            background: white;
            font-size: 14px;
            font-weight: 500;
            color: #334155;
            cursor: pointer;
            transition: all 0.3s ease;
            min-width: 120px;
        }
        
        .year-selector:hover {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        
        .year-selector:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
        }
        
        .chart-container {
            position: relative;
            height: 450px;
            background: #fafbfc;
            border-radius: 12px;
            padding: 20px;
        }
        
        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                gap: 16px;
                text-align: center;
            }
            .stats-display {
                width: 100%;
            }
            .chart-container {
                height: 350px;
                padding: 15px;
            }
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
            select.innerHTML = '<option value="">Select Year</option>' + (years.length ? years.map(y => `<option value="${y}">${y}</option>`).join('') : '<option value="" disabled>No Data Available</option>');
            if (years.length > 0) {
                select.value = years[years.length - 1];
                updateChart();
            }
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
                        { 
                            label: 'Accidents', 
                            data: accidents, 
                            backgroundColor: 'rgba(239, 68, 68, 0.8)', 
                            borderColor: '#dc2626', 
                            borderWidth: 2,
                            borderRadius: 6,
                            borderSkipped: false
                        },
                        { 
                            label: 'Incidents', 
                            data: incidents, 
                            backgroundColor: 'rgba(59, 130, 246, 0.8)', 
                            borderColor: '#2563eb', 
                            borderWidth: 2,
                            borderRadius: 6,
                            borderSkipped: false
                        },
                        { 
                            label: 'Emergencies', 
                            data: emergencies, 
                            backgroundColor: 'rgba(16, 185, 129, 0.8)', 
                            borderColor: '#059669', 
                            borderWidth: 2,
                            borderRadius: 6,
                            borderSkipped: false
                        },
                        { 
                            label: 'Unsafe Acts', 
                            data: unsafeActs, 
                            backgroundColor: 'rgba(245, 158, 11, 0.8)', 
                            borderColor: '#d97706', 
                            borderWidth: 2,
                            borderRadius: 6,
                            borderSkipped: false
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
                                font: { size: 13, weight: '600' },
                                color: '#374151',
                                padding: 20,
                                usePointStyle: true,
                                pointStyle: 'circle'
                            }
                        },
                        title: {
                            display: true,
                            text: `Safety Events Overview - ${year}`,
                            font: { size: 20, weight: '700' },
                            color: '#1f2937',
                            padding: { bottom: 30 }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Number of Events',
                                font: { size: 14, weight: '600' },
                                color: '#374151'
                            },
                            grid: {
                                color: 'rgba(156, 163, 175, 0.3)',
                                lineWidth: 1
                            },
                            ticks: {
                                font: { size: 12 },
                                color: '#6b7280'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Months',
                                font: { size: 14, weight: '600' },
                                color: '#374151'
                            },
                            grid: { display: false },
                            ticks: {
                                font: { size: 12, weight: '500' },
                                color: '#6b7280'
                            }
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index'
                    },
                    animation: {
                        duration: 1000,
                        easing: 'easeOutQuart'
                    }
                }
            });
        }

        window.onload = initChart;
    </script>
@endsection