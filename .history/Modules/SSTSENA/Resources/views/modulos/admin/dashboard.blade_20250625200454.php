<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Safety Events Dashboard</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', system-ui, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        
        .dashboard {
            max-width: 1200px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            animation: slideUp 0.8s ease-out;
        }
        
        .header {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            padding: 40px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255,255,255,0.1), transparent);
            animation: shimmer 3s infinite;
        }
        
        .header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
            text-shadow: 0 2px 10px rgba(0,0,0,0.3);
        }
        
        .header p {
            font-size: 1.1rem;
            opacity: 0.9;
            font-weight: 300;
        }
        
        .controls {
            padding: 30px 40px;
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .year-selector {
            position: relative;
            display: inline-block;
        }
        
        .year-selector select {
            appearance: none;
            background: white;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 12px 40px 12px 16px;
            font-size: 16px;
            font-weight: 500;
            color: #374151;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07);
        }
        
        .year-selector select:hover {
            border-color: #3b82f6;
            box-shadow: 0 6px 20px rgba(59, 130, 246, 0.15);
        }
        
        .year-selector::after {
            content: '▼';
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #6b7280;
            pointer-events: none;
        }
        
        .chart-container {
            padding: 40px;
            background: white;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
            padding: 20px;
            border-radius: 16px;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid rgba(255,255,255,0.2);
        }
        
        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        
        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 5px;
        }
        
        .stat-label {
            font-size: 0.875rem;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 500;
        }
        
        .accidents { color: #ef4444; }
        .incidents { color: #3b82f6; }
        .emergencies { color: #10b981; }
        .unsafe-acts { color: #f59e0b; }
        
        #eventsChart {
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07);
        }
        
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes shimmer {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }
        
        @media (max-width: 768px) {
            .header h1 { font-size: 2rem; }
            .header, .controls, .chart-container { padding: 20px; }
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
        }
    </style>
</head>
<body>
    <div class="dashboard">
        <div class="header">
            <h1>Safety Events Dashboard</h1>
            <p>Real-time Safety Performance Analytics</p>
        </div>
        
        <div class="controls">
            <div class="year-selector">
                <select id="yearSelect" onchange="updateChart()">
                    <option value="">Select Year</option>
                </select>
            </div>
        </div>
        
        <div class="chart-container">
            <div class="stats-grid" id="statsGrid">
                <div class="stat-card">
                    <div class="stat-value accidents" id="accidentsTotal">0</div>
                    <div class="stat-label">Accidents</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value incidents" id="incidentsTotal">0</div>
                    <div class="stat-label">Incidents</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value emergencies" id="emergenciesTotal">0</div>
                    <div class="stat-label">Emergencies</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value unsafe-acts" id="unsafeActsTotal">0</div>
                    <div class="stat-label">Unsafe Acts</div>
                </div>
            </div>
            <canvas id="eventsChart"></canvas>
        </div>
    </div>

    <script>
        // Sample data - replace with your Laravel data injection
        const rawData = {
            accidents: [
                { date_time: '2024-01-15' }, { date_time: '2024-02-20' }, { date_time: '2024-03-10' },
                { date_time: '2024-04-05' }, { date_time: '2024-05-12' }, { date_time: '2024-06-18' },
                { date_time: '2023-01-08' }, { date_time: '2023-03-22' }, { date_time: '2023-07-14' }
            ],
            incidents: [
                { date_time: '2024-01-22' }, { date_time: '2024-02-14' }, { date_time: '2024-03-28' },
                { date_time: '2024-04-11' }, { date_time: '2024-05-30' }, { date_time: '2024-06-25' },
                { date_time: '2023-02-15' }, { date_time: '2023-04-18' }, { date_time: '2023-08-20' }
            ],
            emergencies: [
                { date_time: '2024-01-30' }, { date_time: '2024-03-15' }, { date_time: '2024-05-20' },
                { date_time: '2023-01-25' }, { date_time: '2023-06-10' }
            ],
            unsafeActs: [
                { date_time: '2024-01-12' }, { date_time: '2024-02-28' }, { date_time: '2024-04-16' },
                { date_time: '2024-05-08' }, { date_time: '2024-06-30' }, { date_time: '2024-07-14' },
                { date_time: '2023-03-12' }, { date_time: '2023-05-28' }, { date_time: '2023-09-16' }
            ]
        };

        function processDataByMonthYear(data, year) {
            const months = moment.monthsShort();
            const counts = { accidents: new Array(12).fill(0), incidents: new Array(12).fill(0), emergencies: new Array(12).fill(0), unsafeActs: new Array(12).fill(0) };

            Object.keys(counts).forEach(type => {
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
            Object.values(data).flat().forEach(item => {
                if (item.date_time) {
                    const year = moment(item.date_time).year();
                    if (year) years.add(year);
                }
            });
            return Array.from(years).sort().reverse();
        }

        function updateStats(data, year) {
            const totals = { accidents: 0, incidents: 0, emergencies: 0, unsafeActs: 0 };
            
            Object.keys(totals).forEach(type => {
                totals[type] = data[type].filter(item => 
                    item.date_time && moment(item.date_time).year() === parseInt(year)
                ).length;
            });

            document.getElementById('accidentsTotal').textContent = totals.accidents;
            document.getElementById('incidentsTotal').textContent = totals.incidents;
            document.getElementById('emergenciesTotal').textContent = totals.emergencies;
            document.getElementById('unsafeActsTotal').textContent = totals.unsafeActs;
        }

        let chart;
        function initializeChart() {
            const years = getUniqueYears(rawData);
            const yearSelect = document.getElementById('yearSelect');

            if (years.length === 0) {
                yearSelect.innerHTML = '<option value="">No data available</option>';
                return;
            }

            years.forEach(year => {
                const option = document.createElement('option');
                option.value = year;
                option.textContent = year;
                yearSelect.appendChild(option);
            });

            yearSelect.value = years[0];
            updateChart();
        }

        function updateChart() {
            const selectedYear = document.getElementById('yearSelect').value;
            if (!selectedYear) return;

            const { months, accidents, incidents, emergencies, unsafeActs } = processDataByMonthYear(rawData, selectedYear);
            updateStats(rawData, selectedYear);

            if (chart) chart.destroy();

            chart = new Chart(document.getElementById('eventsChart'), {
                type: 'bar',
                data: {
                    labels: months,
                    datasets: [
                        { label: 'Accidents', data: accidents, backgroundColor: 'rgba(239, 68, 68, 0.8)', borderColor: 'rgba(239, 68, 68, 1)', borderWidth: 2, borderRadius: 8 },
                        { label: 'Incidents', data: incidents, backgroundColor: 'rgba(59, 130, 246, 0.8)', borderColor: 'rgba(59, 130, 246, 1)', borderWidth: 2, borderRadius: 8 },
                        { label: 'Emergencies', data: emergencies, backgroundColor: 'rgba(16, 185, 129, 0.8)', borderColor: 'rgba(16, 185, 129, 1)', borderWidth: 2, borderRadius: 8 },
                        { label: 'Unsafe Acts', data: unsafeActs, backgroundColor: 'rgba(245, 158, 11, 0.8)', borderColor: 'rgba(245, 158, 11, 1)', borderWidth: 2, borderRadius: 8 }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'top', labels: { padding: 20, font: { size: 14, weight: '500' } } },
                        title: { display: true, text: `Safety Events Analysis - ${selectedYear}`, font: { size: 18, weight: '600' }, padding: 20 }
                    },
                    scales: {
                        y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.05)' }, ticks: { font: { size: 12 } } },
                        x: { grid: { display: false }, ticks: { font: { size: 12 } } }
                    },
                    animation: { duration: 1000, easing: 'easeOutQuart' }
                }
            });
            
            chart.canvas.style.height = '400px';
        }

        window.onload = initializeChart;
    </script>
</body>
</html>